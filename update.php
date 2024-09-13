<?php
session_start();


if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: login.php");
    exit(); 
}


require('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nazwa = $_POST["nazwa"];
    $idZagrozenie = $_POST["idZagrozenie"];
    $idMotywacja = $_POST["idMotywacja"];
    $idCel = $_POST["idCel"];
    $idKonsekwencje = $_POST["idKonsekwencje"];
    $idMocna_strona1 = $_POST["idMocna_strona1"];
    $idMocna_strona2 = $_POST["idMocna_strona2"];
    $idProblem = $_POST["idProblem"];
    $notatki = $_POST["notatki"];

    
    $sql = "UPDATE gry 
            SET nazwa = ?, 
                idZagrozenie = ?, 
                idMotywacja = ?, 
                idCel = ?, 
                idKonsekwencje = ?, 
                idMocna_strona1 = ?, 
                idMocna_strona2 = ?, 
                idProblem = ?, 
                notatki = ? 
            WHERE id = ?";

  
    $stmt = $conn->prepare($sql);

    
    if ($stmt === false) {
        die("Błąd przygotowania zapytania: " . $conn->error);
    }

    
    $stmt->bind_param("siiiiisisi", 
        $nazwa, 
        $idZagrozenie, 
        $idMotywacja, 
        $idCel, 
        $idKonsekwencje, 
        $idMocna_strona1, 
        $idMocna_strona2, 
        $idProblem, 
        $notatki, 
        $id
    );

  
    if ($stmt->execute()) {
        
        header("Location: details.php?id=" . $id);
        exit();
    } else {
        die("Błąd zapytania: " . $stmt->error);
    }

   
    $stmt->close();
}
?>
