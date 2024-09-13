<?php
session_start();
require('db.php');


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $characterId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $gameId = isset($_POST['gameId']) ? intval($_POST['gameId']) : 0;
    $nazwaPostaci = $_POST['nazwa_postaci'];
    $nazwaGracza = $_POST['nazwa_gracza'];
    $idStyl = intval($_POST['idStyl']);
    $idRola = intval($_POST['idRola']);
    $numer = intval($_POST['numer']);
    $celPostaci = $_POST['cel_postaci'];
    $notatki = $_POST['notatki'];

    
    $sql = "UPDATE postacie 
            SET nazwa_postaci = ?, 
                nazwa_gracza = ?, 
                idStyl = ?, 
                idRola = ?, 
                numer = ?, 
                cel_postaci = ?, 
                notatki = ? 
            WHERE id = ? AND idGry = ?";

   
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Błąd przygotowania zapytania: " . $conn->error);
    }

    
    $stmt->bind_param("ssiiissii", 
        $nazwaPostaci, 
        $nazwaGracza, 
        $idStyl, 
        $idRola, 
        $numer, 
        $celPostaci, 
        $notatki, 
        $characterId, 
        $gameId
    );

    
    if ($stmt->execute()) {
        
        header("Location: play_game.php?id=" . $gameId);
        exit();
    } else {
        die("Błąd zapytania: " . $stmt->error);
    }

    
    $stmt->close();
}

$conn->close();
?>
