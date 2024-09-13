<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
require('db.php');


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nick = $_SESSION['username']; 
    $ocena = $_POST['ocena'];
    $tresc = $_POST['tresc'];
    $data = date('Y-m-d H:i:s');

    $sql = "INSERT INTO recenzje (nick, ocena, tresc, data) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siss", $nick, $ocena, $tresc, $data);

    if ($stmt->execute()) {
        header("Location: recenzje.php");
    } else {
        echo "Wystąpił błąd podczas dodawania recenzji.";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Recenzję</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="content">
        <h1>Dodaj Recenzję</h1>
        <form action="add_review.php" method="post">
            <label for="ocena">Ocena (1-5):</label>
            <input type="number" id="ocena" name="ocena" min="1" max="5" required>

            <label for="tresc">Treść recenzji:</label>
            <textarea id="tresc" name="tresc" required></textarea>

            <button type="submit" class="button">Dodaj Recenzję</button>
        </form>
    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

