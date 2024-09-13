<?php
session_start();
require('db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


if (!isset($_POST['gameId'])) {
    die("Nie znaleziono gry.");
}

$gameId = intval($_POST['gameId']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nazwaPostaci = $_POST['nazwa_postaci'];
    $nazwaGracza = $_POST['nazwa_gracza'];
    $idStyl = intval($_POST['idStyl']);
    $idRola = intval($_POST['idRola']);
    $numer = intval($_POST['numer']);
    $celPostaci = $_POST['cel_postaci'];
    $notatki = $_POST['notatki'];

    $obrazek = null;
    if (isset($_FILES['obrazek']) && $_FILES['obrazek']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['obrazek']['tmp_name'];
        $obrazek = basename($_FILES['obrazek']['name']);
        $uploadDir = 'obrazki/'; 
        $uploadFile = $uploadDir . $obrazek;

        
        if (file_exists($uploadFile)) {
            die("Plik o tej nazwie już istnieje.");
        }

        
        $fileType = mime_content_type($tmpName);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($fileType, $allowedTypes)) {
            die("Nieobsługiwany typ pliku.");
        }

        
        if (!move_uploaded_file($tmpName, $uploadFile)) {
            die("Wystąpił problem podczas przesyłania pliku.");
        }
    }

    
    $sql = "INSERT INTO postacie (idGry, nazwa_postaci, nazwa_gracza, idStyl, idRola, numer, cel_postaci, notatki, obrazek) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issiiisss", $gameId, $nazwaPostaci, $nazwaGracza, $idStyl, $idRola, $numer, $celPostaci, $notatki, $obrazek);

    if ($stmt->execute()) {
        
        header("Location: play_game.php?id=" . $gameId);
        exit();
    } else {
        die("Wystąpił błąd podczas dodawania postaci: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>

