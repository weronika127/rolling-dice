<?php
session_start();
require('db.php');

$isLoggedIn = isset($_SESSION['username']);

if (!$isLoggedIn) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['gameId'])) {
    die("Nie znaleziono gry.");
}

$gameId = intval($_GET['gameId']);

function getOptions($conn, $table) {
    $sql = "SELECT id, nazwa FROM $table ORDER BY nazwa ASC";
    $result = $conn->query($sql);
    $options = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[$row['id']] = $row['nazwa'];
        }
    }
    return $options;
}

$styles = getOptions($conn, 'styl');
$roles = getOptions($conn, 'rola');

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Nową Postać</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="content">
        <h1>Dodaj Nową Postać</h1>
        <form method="POST" action="insert_character.php" enctype="multipart/form-data">
            <input type="hidden" name="gameId" value="<?php echo $gameId; ?>">
            
            <label for="nazwa_postaci">Nazwa Postaci:</label><br>
            <input type="text" id="nazwa_postaci" name="nazwa_postaci" required><br><br>

            <label for="nazwa_gracza">Nazwa Gracza:</label><br>
            <input type="text" id="nazwa_gracza" name="nazwa_gracza" required><br><br>

            <label for="idStyl">Styl:</label><br>
            <select id="idStyl" name="idStyl" required>
                <?php foreach ($styles as $id => $name): ?>
                    <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($name); ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="idRola">Rola:</label><br>
            <select id="idRola" name="idRola" required>
                <?php foreach ($roles as $id => $name): ?>
                    <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($name); ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="numer">Numer:</label><br>
            <select id="numer" name="numer" required>
                <?php for ($i = 2; $i <= 5; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select><br><br>

            <label for="cel_postaci">Cel Postaci:</label><br>
            <textarea id="cel_postaci" name="cel_postaci" required></textarea><br><br>

            <label for="notatki">Notatki:</label><br>
            <textarea id="notatki" name="notatki"></textarea><br><br>

            <label for="obrazek">Obrazek:</label><br>
            <input type="file" id="obrazek" name="obrazek"><br><br>

            <input type="submit" value="Dodaj Postać">
        </form>
        <p><a href="play_game.php?id=<?php echo $gameId; ?>" class="button">Powrót do Gry</a></p>

    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
</body>
</html>


