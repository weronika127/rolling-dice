<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);

if (!$isLoggedIn) {
    header("Location: login.php");
    exit(); 
}

require('db.php');

$gameId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM gry WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $gameId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $game = $result->fetch_assoc();
} else {
    die("Gra nie została znaleziona.");
}

function getDescription($conn, $table, $id) {
    $sql = "SELECT nazwa FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows ? $result->fetch_object()->nazwa : 'Nieznane';
}

$zagrozenie = getDescription($conn, 'zagrozenie', $game['idZagrozenie']);
$motywacja = getDescription($conn, 'motywacja', $game['idMotywacja']);
$cel = getDescription($conn, 'cel', $game['idCel']);
$konsekwencje = getDescription($conn, 'konsekwencje', $game['idKonsekwencje']);
$mocna_strona1 = getDescription($conn, 'mocna_strona', $game['idMocna_strona1']);
$mocna_strona2 = getDescription($conn, 'mocna_strona', $game['idMocna_strona2']);
$problem = getDescription($conn, 'problem', $game['idProblem']);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="content">
        <h1><?php echo htmlspecialchars($game['nazwa']); ?></h1>
        
        <p><strong>Zagrożenie:</strong> <?php echo htmlspecialchars($zagrozenie); ?></p>
        <p><strong>Chce:</strong> <?php echo htmlspecialchars($motywacja); ?></p>
        <p><strong>Co/Z czym:</strong> <?php echo htmlspecialchars($cel); ?></p>
        <p><strong>Co doprowadzi do:</strong> <?php echo htmlspecialchars($konsekwencje); ?></p>
        <p><strong>Mocne strony Raporta:</strong> <?php echo htmlspecialchars($mocna_strona1); ?>, <?php echo htmlspecialchars($mocna_strona2); ?></p>
        <p><strong>Słąba strona Raporta:</strong> <?php echo htmlspecialchars($problem); ?></p>
        <p><strong>Notatki:</strong> <?php echo nl2br(htmlspecialchars($game['notatki'])); ?></p>

        <a href="index.php" class="button">Powrót do listy gier</a>
    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
</body>
</html>
