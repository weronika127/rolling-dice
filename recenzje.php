<?php
session_start();
require('db.php');
$isLoggedIn = isset($_SESSION['username']);


$sql_reviews = "SELECT * FROM recenzje ORDER BY data DESC";
$result_reviews = $conn->query($sql_reviews);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recenzje</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="content">
        <h1>Recenzje</h1>

        <a href="add_review.php" class="button">Dodaj recenzję</a>

        <?php if ($result_reviews->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nick</th>
                        <th>Ocena</th>
                        <th>Treść</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($review = $result_reviews->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($review['nick']); ?></td>
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
    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

