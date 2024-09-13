<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
$twoColumns = true; 
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="styles.css">
    <style>
      
        .content {
            display: grid;
            grid-template-columns: 1fr; 
            gap: 20px; 
        }

        .content.two-columns {
            grid-template-columns: 1fr 1fr; 
        }

        .column {
            padding: 10px; 
        }
    </style>
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="content <?php echo $twoColumns ? 'two-columns' : ''; ?>">
        <div class="column">
            <h1>ZAGRAJ W LASERY I UCZUCIA</h1>
            <p>Jesteście załogą międzynarodowego statku zwiadowczego RAPORT. Waszą misją jest zbadanie nieznanych zakątków kosmosu, spotkanie przyjaznych i wrogich kosmitów oraz ochrona światów Konsorcjum przed kosmicznymi zagrożeniami. KAPITAN DARCY został opętany przez dziwną mentalną istotę znaną jako Coś Innego, pozostawiając was samych sobie, dopuki nie wyleczy się w kapsule medycznej.</p>
            <h2>Rozpocznij przygodę!</h2>
            <a href="add_game.php" class="button">Nowa Gra</a>
            <h2>Prowadź grę</h2>
            <p>Graj, by dowiedzieć się jak pokonać zagrożenie. Wprowadź zagrożenie przedstawiając dowody jego zła. Zanim zagrożenie zrobi coś postaciom, daj znaki mówiące, że coś takiego się stanie i później spytaj się ich, co robią. „Zorgon celuje mega-armatą w wasz statek. Co robicie?" „Daneela nalewa ci szklankę Arcturanyjskiej whisky i obejmuje twoje biodra. Co robisz?"

- Domagaj się wykonania rzutu, jeśli sytuacja nie jest pewna. Nie planuj rezultatów naprzód niech się dzieje co się chce. Używaj porażek by pchać akcję do przodu. Sytuacja zawsze zmienia się po rzucie. Na lepsze lub gorsze.

Zadawaj pytania i buduj przygodę na odpowiedziach. „Czy któryś was spotkał kiedyś kultystę próżni? Gdzie? I co się działo?"</p>
        </div>
        <?php if ($twoColumns): ?>
            <div class="column">
                <h1></h1>
                <p></p>
                <img src="lasery.jpg" alt="Opis zdjęcia" width="100%" />

                <h2>Jak grać!</h2>
                <p>Jeśli robisz coś ryzykownego, rzuć 1k6, by dowiedzieć się jak poszło. Dorzuć +1k jeśli jesteś PRZYGOTOWANY i +1k jeśli jesteś EKSPERTEM. RZUĆ SWOIMI KOŚĆMI I PORÓWNAJ WYNIKI KAŻDEJ Z TWOIM NUMEREM.</p>
                <ul>
                    <li>Jeśli używasz LASERÓW (nauka, logika), to chcesz rzucić PONIŻEJ swojego numeru.</li>
                    <li>Jeśli używasz UCZUĆ (porozumienia, pasji), to chcesz rzucić POWYŻEJ swojego numeru.</li>
                    <li>Jeśli żADNA z kości nie zaliczyła rzutu, to akcja się nie udaje. Opisujesz w jaki sposób sytuacja się pogarsza.</li>
                    <li>Jeśli JEDNA kość zaliczyła rzut, to ledwo się udaje. Opisujesz w jaki sposób sytuacja się pogarsza.</li>
                    <li>Jeśli DWIE kostki zaliczyły rzut, to wszystko się udaje. Dobra robota!</li>
                    <li>Jeśli TRZY kostki zaliczyły rzut, to jest to krytyczny sukces! Opisujesz dodatkowe, pozytywne efekty akcji</li>
                    <li>Jeśli gracz wyrzucił dokładnie SWÓJ NUMER, to dostaje LASEROWE UCZUCIA. Zostaje dokładnie wtajemniczony w to co się dzieje. Musisz szczerze odpowiedzieć na pytanie gracza.</li>    
                </ul>
                <p>POMAGANIE: Jeśli gracz chce komuś pomóc, kto wykonuje rzut, to powinien opisać w jaki sposób to robi i wykonać rzut. Jeśli się uda, to dodaje graczowi +1k.</p>


            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; Rolling Dice</p>
    </footer>
</body>
</html>



