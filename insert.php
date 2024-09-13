<?php
session_start();


if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: login.php");
    exit(); 
}


require('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa = $_POST["nazwa"];
    $idZagrozenie = $_POST["idZagrozenie"];
    $idMotywacja = $_POST["idMotywacja"];
    $idCel = $_POST["idCel"];
    $idKonsekwencje = $_POST["idKonsekwencje"];
    $idMocna_strona1 = $_POST["idMocna_strona1"];
    $idMocna_strona2 = $_POST["idMocna_strona2"];
    $idProblem = $_POST["idProblem"];
    $notatki = $_POST["notatki"];

  
    if (!isset($_SESSION['id'])) {
        die("Brak ID użytkownika w sesji.");
    }

    $userId = $_SESSION['id']; 

   
    $stmt = $conn->prepare("INSERT INTO gry (idUzytkownika, nazwa, idZagrozenie, idMotywacja, idCel, idKonsekwencje, idMocna_strona1, idMocna_strona2, idProblem, notatki) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

 
    $stmt->bind_param("isiiiiisis", $userId, $nazwa, $idZagrozenie, $idMotywacja, $idCel, $idKonsekwencje, $idMocna_strona1, $idMocna_strona2, $idProblem, $notatki);

    if ($stmt->execute()) {
        
        header("Location: index.php");
        exit();
    } else {
        die("Błąd zapytania: " . $stmt->error);
    }

    $stmt->close();
}
?>

