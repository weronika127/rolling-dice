<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);

if (!$isLoggedIn) {
    header("Location: login.php");
    exit();
}

require('db.php');

$gameId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$zagrozeniaResult = $conn->query("SELECT id, nazwa FROM zagrozenie");
$motywacjeResult = $conn->query("SELECT id, nazwa FROM motywacja");
$celyResult = $conn->query("SELECT id, nazwa FROM cel");
$konsekwencjeResult = $conn->query("SELECT id, nazwa FROM konsekwencje");
$mocneStrony1Result = $conn->query("SELECT id, nazwa FROM mocna_strona");
$mocneStrony2Result = $conn->query("SELECT id, nazwa FROM mocna_strona");
$problemyResult = $conn->query("SELECT id, nazwa FROM problem");

$sql = "SELECT * FROM gry WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $gameId);
$stmt->execute();
$gameResult = $stmt->get_result();
$gameData = $gameResult->fetch_assoc();

if (!$gameData) {
    die("Gra o podanym ID nie została znaleziona.");
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Grę</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="content">
        <h1>Edytuj Grę</h1>
        <form method="post" action="update.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($gameData['id']); ?>">
            
            <label for="nazwa">Nazwa Gry:</label>
            <input type="text" id="nazwa" name="nazwa" value="<?= htmlspecialchars($gameData['nazwa']); ?>" required><br>
            <p></p>
            <label for="idZagrozenie">Zagrożenie:</label>
            <select id="idZagrozenie" name="idZagrozenie" required>
                <?php while ($row = $zagrozeniaResult->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $gameData['idZagrozenie'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['nazwa']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <p></p>
            <label for="idMotywacja">Chce:</label>
            <select id="idMotywacja" name="idMotywacja" required>
                <?php while ($row = $motywacjeResult->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $gameData['idMotywacja'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['nazwa']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <p></p>
            <label for="idCel">Co/Z czym::</label>
            <select id="idCel" name="idCel" required>
                <?php while ($row = $celyResult->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $gameData['idCel'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['nazwa']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <p></p>
            <label for="idKonsekwencje">Co doprowadzi do::</label>
            <select id="idKonsekwencje" name="idKonsekwencje" required>
                <?php while ($row = $konsekwencjeResult->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $gameData['idKonsekwencje'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['nazwa']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <p></p>
            <label for="idMocna_strona1">Mocna Strona Raporta nr 1:</label>
            <select id="idMocna_strona1" name="idMocna_strona1" required>
                <?php while ($row = $mocneStrony1Result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $gameData['idMocna_strona1'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['nazwa']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <p></p>
            <label for="idMocna_strona2">Mocna Strona Raporta nr 2:</label>
            <select id="idMocna_strona2" name="idMocna_strona2" required>
                <?php while ($row = $mocneStrony2Result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $gameData['idMocna_strona2'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['nazwa']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <p></p>
            <label for="idProblem">Słaba strona Raporta:</label>
            <select id="idProblem" name="idProblem" required>
                <?php while ($row = $problemyResult->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $gameData['idProblem'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['nazwa']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <p></p>
            <label for="notatki">Notatki:</label>
            <textarea id="notatki" name="notatki"><?= htmlspecialchars($gameData['notatki']); ?></textarea><br>
            <p></p>
            <input type="submit" value="Zapisz zmiany">
            <p></p>
        </form>
        <a href="index.php" class="button">Powrót do listy gier</a>
        <a href="play_game.php?id=<?php echo $gameId; ?>" class="button">Powrót do gry</a>



    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
</body>
</html>
