<?php
session_start();
require('db.php');

$isLoggedIn = isset($_SESSION['username']);

if (!$isLoggedIn) {
    header("Location: login.php");
    exit(); 
}


if (!isset($_GET['id']) || !isset($_GET['gameId'])) {
    die("Nieprawidłowe dane.");
}

$characterId = intval($_GET['id']);
$gameId = intval($_GET['gameId']);

$sql = "SELECT * FROM postacie WHERE id = ? AND idGry = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $characterId, $gameId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Postać nie została znaleziona lub nie należy do tej gry.");
}


$sql_delete = "DELETE FROM postacie WHERE id = ? AND idGry = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("ii", $characterId, $gameId);

if ($stmt_delete->execute()) {
    header("Location: play_game.php?id=$gameId");
    exit();
} else {
    echo "Wystąpił błąd podczas usuwania postaci.";
}

$stmt->close();
$stmt_delete->close();
$conn->close();
?>
