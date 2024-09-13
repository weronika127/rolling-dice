<?php
session_start();
require('db.php');


$isLoggedIn = isset($_SESSION['username']);

if (!isset($_GET['id'])) {
    die("Nie znaleziono gry.");
}

$gameId = intval($_GET['id']);


function getDescription($conn, $table, $id) {
    $sql = "SELECT nazwa FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_object();
        return $row->nazwa;
    } else {
        return 'Nieznane';
    }
}


$sql = "SELECT * FROM gry WHERE id = ? AND idUzytkownika = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $gameId, $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Gra nie została znaleziona.");
}

$game = $result->fetch_assoc();


$zagrozenie = getDescription($conn, 'zagrozenie', $game['idZagrozenie']);
$motywacja = getDescription($conn, 'motywacja', $game['idMotywacja']);
$cel = getDescription($conn, 'cel', $game['idCel']);
$konsekwencje = getDescription($conn, 'konsekwencje', $game['idKonsekwencje']);
$mocna_strona1 = getDescription($conn, 'mocna_strona', $game['idMocna_strona1']);
$mocna_strona2 = getDescription($conn, 'mocna_strona', $game['idMocna_strona2']);
$problem = getDescription($conn, 'problem', $game['idProblem']);


$searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';
$searchNumber = isset($_GET['searchNumber']) ? intval($_GET['searchNumber']) : 0;
$searchStyle = isset($_GET['searchStyle']) ? intval($_GET['searchStyle']) : 0;
$searchRole = isset($_GET['searchRole']) ? intval($_GET['searchRole']) : 0;


$sql_characters = "
    SELECT 
        p.*, 
        s.nazwa AS styl_nazwa, 
        r.nazwa AS rola_nazwa 
    FROM 
        postacie p
    LEFT JOIN 
        styl s ON p.idStyl = s.id
    LEFT JOIN 
        rola r ON p.idRola = r.id
    WHERE 
        p.idGry = ?
        AND (p.nazwa_postaci LIKE ?)
        AND (? = 0 OR p.numer = ?)
        AND (? = 0 OR p.idStyl = ?)
        AND (? = 0 OR p.idRola = ?)
";


$searchNameSQL = "%{$searchName}%";


$stmt_characters = $conn->prepare($sql_characters);
$stmt_characters->bind_param("ssiiiiii", $gameId, $searchNameSQL, $searchNumber, $searchNumber, $searchStyle, $searchStyle, $searchRole, $searchRole);
$stmt_characters->execute();
$charactersResult = $stmt_characters->get_result();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zagraj w grę</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function rollDice() {
            const diceCount = document.getElementById('diceCount').value;
            const results = [];

            for (let i = 0; i < diceCount; i++) {
                results.push(Math.floor(Math.random() * 6) + 1);
            }

            document.getElementById('rollResults').innerHTML = results.join(', ');
        }
    </script>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div class="content">
        <h1><?php echo htmlspecialchars($game['nazwa']); ?></h1>
        <p><strong>Zagrożenie:</strong></p>
        <p><?php echo htmlspecialchars($zagrozenie); ?> chce <?php echo htmlspecialchars($motywacja); ?> co/z czym <?php echo htmlspecialchars($cel); ?>, co doprowadzi do <?php echo htmlspecialchars($konsekwencje); ?>!</p>
        <p><strong>Cechy statku Raport:</strong></p>
        <p><strong>Mocne strony:</strong> <?php echo htmlspecialchars($mocna_strona1); ?>, <?php echo htmlspecialchars($mocna_strona2); ?></p>
        <p><strong>Słaba strona:</strong> <?php echo htmlspecialchars($problem); ?></p>
        <p><strong>Notatki:</strong> <?php echo htmlspecialchars($game['notatki']); ?></p>

        <a href="edit_game.php?id=<?php echo $gameId; ?>" class="button">Edytuj grę</a>

        <h2>Rzut kostką</h2>
        <label for="diceCount">Ilość kości (od 1 do 4):</label>
        <input type="number" id="diceCount" name="diceCount" min="1" max="4" value="1" required>
        <button onclick="rollDice()">Rzuć</button>

        <h3>Wyniki rzutu:</h3>
        <p id="rollResults">-</p>

        <h2>Postacie</h2>

        <form action="" method="get">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($gameId); ?>">
            
            <label for="searchName">Nazwa postaci:</label>
            <input type="text" name="searchName" placeholder="Wyszukaj postać po nazwie" value="<?php echo htmlspecialchars($searchName); ?>">

            <label for="searchNumber">Numer:</label>
            <select id="searchNumber" name="searchNumber">
                <option value="">Wszystkie</option>
                <?php for ($i = 2; $i <= 5; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo ($searchNumber == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>

            <label for="searchStyle">Styl:</label>
            <select id="searchStyle" name="searchStyle">
                <option value="">Wszystkie</option>
                <?php 
                $sql_styles = "SELECT id, nazwa FROM styl";
                $result_styles = $conn->query($sql_styles);
                while ($style = $result_styles->fetch_object()): ?>
                    <option value="<?php echo $style->id; ?>" <?php echo ($searchStyle == $style->id) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($style->nazwa); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="searchRole">Rola:</label>
            <select id="searchRole" name="searchRole">
                <option value="">Wszystkie</option>
                <?php 
                $sql_roles = "SELECT id, nazwa FROM rola";
                $result_roles = $conn->query($sql_roles);
                while ($role = $result_roles->fetch_object()): ?>
                    <option value="<?php echo $role->id; ?>" <?php echo ($searchRole == $role->id) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($role->nazwa); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit" class="button">Szukaj</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nr</th>
                    <th>Obrazek</th>
                    <th>Nazwa Postaci</th>
                    <th>Numer</th>
                    <th>Opis</th>
                    <th>Edycja</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($charactersResult->num_rows > 0): ?>
                    <?php $nr = 1; ?>
                    <?php while ($character = $charactersResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $nr++; ?></td>
                            <td>
                                <?php if (!empty($character['obrazek']) && file_exists('obrazki/' . $character['obrazek'])): ?>
                                    <img src="obrazki/<?php echo htmlspecialchars($character['obrazek']); ?>" alt="Obrazek postaci" width="100">
                                <?php else: ?>
                                    Brak obrazka
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($character['nazwa_postaci']); ?>
                                <br> 
                                <small>(<?php echo htmlspecialchars($character['nazwa_gracza']); ?>)</small>
                            </td>
                            <td><?php echo htmlspecialchars($character['numer']); ?></td>
                            <td>
                                <strong>Styl:</strong> <?php echo htmlspecialchars($character['styl_nazwa']); ?><br>
                                <strong>Rola:</strong> <?php echo htmlspecialchars($character['rola_nazwa']); ?><br>
                                <strong>Cel:</strong> <?php echo htmlspecialchars($character['cel_postaci']); ?><br>
                                <strong>Notatki:</strong> <?php echo htmlspecialchars($character['notatki']); ?>
                            </td>
                            <td>
                                <a href="edit_character.php?id=<?php echo $character['id']; ?>&gameId=<?php echo $gameId; ?>" class="button">Edytuj</a>
                                <a href="delete_character.php?id=<?php echo $character['id']; ?>&gameId=<?php echo $gameId; ?>" class="button">Usuń</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Brak postaci do wyświetlenia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="add_character.php?gameId=<?php echo $gameId; ?>" class="button">Dodaj postać</a>
    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
    <script src="dice.js"></script>
</body>
</html>

<?php
$stmt->close();
$stmt_characters->close();
$conn->close();
?>
