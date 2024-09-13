<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


require('db.php');

$gameId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($gameId <= 0) {
    die("Nieprawidłowe ID gry.");
}

$sql = "SELECT id FROM gry WHERE id = ? AND idUzytkownika = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $gameId, $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Nie znaleziono gry lub brak uprawnień do usunięcia.");
}

$sql = "DELETE FROM gry WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $gameId);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    die("Błąd zapytania: " . $stmt->error);
}

$stmt->close();
?>
