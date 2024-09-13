<header>
    <h1>ROLLING DICE</h1>
    <nav>
        <ul>
            <li><a href="stronaglowna.php">Strona główna</a></li>
            <li><a href="index.php">Twoje gry</a></li>
            <li><a href="recenzje.php">Recenzje</a></li> 
            <li>
                <?php if ($isLoggedIn): ?>
                    <a href="profile.php?id=<?php echo htmlspecialchars($_SESSION['id']); ?>">
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </a>
                    <ul class="dropdown">
                        <li><a href="logout.php">Wyloguj się</a></li>
                    </ul>
                <?php else: ?>
                    <a href="#">Zaloguj się</a>
                    <ul class="dropdown">
                        <li><a href="login.php">Zaloguj się</a></li>
                        <li><a href="registration.php">Zarejestruj się</a></li>
                    </ul>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</header>

