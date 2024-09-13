<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
require('db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$characterId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$gameId = isset($_GET['gameId']) ? intval($_GET['gameId']) : 0;

$sql = "SELECT * FROM postacie WHERE id = ? AND idGry = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $characterId, $gameId);
$stmt->execute();
$result = $stmt->get_result();
$character = $result->fetch_assoc();

if (!$character) {
    die("Postać nie została znaleziona.");
}

$stmt->close();

$stylesResult = $conn->query("SELECT id, nazwa FROM styl");

$rolesResult = $conn->query("SELECT id, nazwa FROM rola");

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Postać</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="content">
        <h1>Edytuj Postać</h1>
        <form method="post" action="update_character.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($character['id']); ?>">
            <input type="hidden" name="gameId" value="<?= htmlspecialchars($gameId); ?>">

            <label for="nazwa_postaci">Nazwa Postaci:</label>
            <input type="text" id="nazwa_postaci" name="nazwa_postaci" value="<?= htmlspecialchars($character['nazwa_postaci']); ?>" required><br>

            <label for="nazwa_gracza">Nazwa Gracza:</label>
            <input type="text" id="nazwa_gracza" name="nazwa_gracza" value="<?= htmlspecialchars($character['nazwa_gracza']); ?>" required><br>

            <label for="idStyl">Styl:</label>
            <select id="idStyl" name="idStyl" required>
                <?php while ($style = $stylesResult->fetch_assoc()): ?>
                    <option value="<?= $style['id']; ?>" <?= $style['id'] == $character['idStyl'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($style['nazwa']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>

            <label for="idRola">Rola:</label>
            <select id="idRola" name="idRola" required>
                <?php while ($role = $rolesResult->fetch_assoc()): ?>
                    <option value="<?= $role['id']; ?>" <?= $role['id'] == $character['idRola'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($role['nazwa']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>

            <label for="numer">Numer:</label>
            <select id="numer" name="numer" required>
                <?php for ($i = 2; $i <= 5; $i++): ?>
                    <option value="<?= $i; ?>" <?= $i == $character['numer'] ? 'selected' : ''; ?>>
                        <?= $i; ?>
                    </option>
                <?php endfor; ?>
            </select><br>

            <label for="cel_postaci">Cel Postaci:</label>
            <textarea id="cel_postaci" name="cel_postaci" required><?= htmlspecialchars($character['cel_postaci']); ?></textarea><br>

            <label for="notatki">Notatki:</label>
            <textarea id="notatki" name="notatki"><?= htmlspecialchars($character['notatki']); ?></textarea><br>

            <input type="submit" value="Zapisz zmiany">
        </form>

        <a href="play_game.php?id=<?= $gameId; ?>" class="button">Powrót do Gry</a>

    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

