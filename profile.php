<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
require('db.php');


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;


$sql = "SELECT * FROM uzytkownicy WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Użytkownik nie został znaleziony.");
}


$sql_reviews = "SELECT * FROM recenzje WHERE nick = ? ORDER BY data DESC";
$stmt_reviews = $conn->prepare($sql_reviews);
$stmt_reviews->bind_param("s", $user['login']); 
$stmt_reviews->execute();
$reviewsResult = $stmt_reviews->get_result();

$stmt->close();
$stmt_reviews->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Użytkownika</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="content">
        <h1>Profil Użytkownika</h1>
        <p><strong>Login:</strong> <?php echo htmlspecialchars($user['login']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Rola:</strong> <?php echo htmlspecialchars($user['rola']); ?></p>
        <p><strong>Data Rejestracji:</strong> <?php echo htmlspecialchars($user['data']); ?></p>
        
        <h2>Twoje recenzje</h2>
        <?php if ($reviewsResult->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Ocena</th>
                        <th>Treść</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($review = $reviewsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($review['ocena']); ?>/5</td>
                            <td><?php echo htmlspecialchars($review['tresc']); ?></td>
                            <td><?php echo htmlspecialchars($review['data']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Brak recenzji do wyświetlenia.</p>
        <?php endif; ?>

        <a href="add_review.php?id=<?php echo $userId; ?>" class="button">Dodaj recenzję</a>
        <a href="index.php" class="button">Twoje gry</a>
    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>




