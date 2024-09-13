<?php
session_start();

$isLoggedIn = isset($_SESSION['username']);

if (!$isLoggedIn) {
    header("Location: login.php");
    exit(); 
}


require('db.php');

$userId = isset($_SESSION['id']) ? $_SESSION['id'] : 0;


$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';


$searchTermSQL = "%{$searchTerm}%"; 
$sql = "SELECT * FROM gry WHERE idUzytkownika = ? AND nazwa LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $userId, $searchTermSQL);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje Gry</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="content">
        <h1>Twoje gry!</h1>
        <a href="add_game.php" class="button">Nowa Gra</a> 

        <form>
    <p>
        <input type="text" name="fraza" placeholder="Wyszukaj grę...">
        <input type="submit" value="Wyszukaj">
    </p>
</form>


        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nr</th>
                        <th>Nazwa Gry</th>
                        <th>Zarządzaj</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nr = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $nr++; ?></td>
                            <td><?php echo htmlspecialchars($row['nazwa'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="play_game.php?id=<?php echo $row['id']; ?>" class="button">Zagraj</a>
                                <a href="details.php?id=<?php echo $row['id']; ?>" class="button">Podgląd</a>
                                
                                <a href="edit_game.php?id=<?php echo $row['id']; ?>" class="button">Edytuj</a>
                                <a href="delete_game.php?id=<?php echo $row['id']; ?>" class="button">Usuń</a>
                                
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Brak gier do wyświetlenia.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
</body>
</html>


