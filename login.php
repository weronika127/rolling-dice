<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="content">
        <?php
        require('db.php');

        if (isset($_POST["submit"])) {
            $login = $_POST["login"];
            $haslo = md5($_POST["haslo"]);

            
            $stmt = $conn->prepare("SELECT * FROM uzytkownicy WHERE login = ? AND haslo = ?");
            $stmt->bind_param("ss", $login, $haslo);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                
                $user = $result->fetch_object();

                
                $_SESSION["username"] = $login;
                $_SESSION["id"] = $user->id;

            
                header("Location: index.php");
                exit(); 
            } else {
                echo "<div class='form'>
                <h3>Nieprawidłowy login lub hasło.</h3><br/>
                <p class='link'>Ponów próbę <a href='login.php'>logowania</a>.</p>
                </div>";
            }

            $stmt->close();
        } else {
        ?>
        <form class="form" method="post" name="login">
            <h1 class="login-title">Logowanie</h1>
            <input type="text" class="login-input" name="login" placeholder="Login" autofocus="true"/>
            <input type="password" class="login-input" name="haslo" placeholder="Hasło"/>
            <input type="submit" value="Zaloguj" name="submit" class="login-button"/>
            <p class="link"><a href="registration.php">Zarejestruj się</a></p>
        </form>
        <?php
        }
        ?>
    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
</body>
</html>

