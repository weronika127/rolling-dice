-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Wrz 13, 2024 at 04:00 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dice`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cel`
--

CREATE TABLE `cel` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `cel`
--

INSERT INTO `cel` (`id`, `nazwa`) VALUES
(1, 'PIRACKIEGO KRÓLA/KRÓLOWĄ'),
(2, 'KRYSZTAŁY PRÓŻNI'),
(3, 'GWIEZDNEGO NISZCZYCIELA'),
(4, 'TUNEL KWANTOWY'),
(5, 'ANTYCZNE GWIEZDNE RUINY'),
(6, 'ARTEFAKT KOSMITÓW');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gry`
--

CREATE TABLE `gry` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `idZagrozenie` int(10) UNSIGNED NOT NULL,
  `idMotywacja` int(10) UNSIGNED NOT NULL,
  `idCel` int(10) UNSIGNED NOT NULL,
  `idKonsekwencje` int(10) UNSIGNED NOT NULL,
  `idMocna_strona1` int(10) UNSIGNED NOT NULL,
  `idMocna_strona2` int(10) UNSIGNED NOT NULL,
  `idProblem` int(10) UNSIGNED NOT NULL,
  `notatki` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `gry`
--

INSERT INTO `gry` (`id`, `idUzytkownika`, `nazwa`, `idZagrozenie`, `idMotywacja`, `idCel`, `idKonsekwencje`, `idMocna_strona1`, `idMocna_strona2`, `idProblem`, `notatki`) VALUES
(1, 1, 'gra 2', 5, 3, 1, 1, 1, 1, 1, 'bla bla bbb'),
(2, 1, 'dudu', 1, 1, 1, 1, 1, 1, 1, ''),
(3, 3, 'Gra 1', 5, 2, 1, 4, 4, 7, 2, 'bla bla bla'),
(4, 4, 'Gra 1', 6, 4, 6, 6, 6, 4, 4, 'notatki bla bla'),
(5, 4, 'nazwa gry 2', 1, 1, 1, 1, 2, 1, 1, 'nanana');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konsekwencje`
--

CREATE TABLE `konsekwencje` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `konsekwencje`
--

INSERT INTO `konsekwencje` (`id`, `nazwa`) VALUES
(1, 'ZNISZCZENIA UKŁADU'),
(2, 'ODWRÓCENIA CZASU'),
(3, 'PODBICIA PLANETY'),
(4, 'ROZPOCZĘCIA WOJNY'),
(5, 'DZIURY W RZECZYWISTOŚCI'),
(6, 'NAPRAWY WSZYSTKIEGO');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mocna_strona`
--

CREATE TABLE `mocna_strona` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `mocna_strona`
--

INSERT INTO `mocna_strona` (`id`, `nazwa`) VALUES
(1, 'DOBRZE UZBROJONY'),
(2, 'DOSKONAŁE CZUJNIKI'),
(3, 'MYŚLIWCE'),
(4, 'SZYBKI'),
(5, 'URZĄDZENIE MASKUJĄCE'),
(6, 'WYTRZYMAŁE TARCZE'),
(7, 'ZWROTNY');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `motywacja`
--

CREATE TABLE `motywacja` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `motywacja`
--

INSERT INTO `motywacja` (`id`, `nazwa`) VALUES
(1, 'ZNISZCZYĆ/ZEPSUĆ'),
(2, 'ZNISZCZYĆ/POJMAĆ'),
(3, 'ZWIĄZAĆ SIĘ Z'),
(4, 'OCHRONIĆ/WZMOCNIĆ'),
(5, 'ZBUDOWAĆ/SYNTEZOWAĆ'),
(6, 'SPACYFIKOWAĆ/OKUPOWAĆ');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `postacie`
--

CREATE TABLE `postacie` (
  `id` int(10) UNSIGNED NOT NULL,
  `idGry` int(10) UNSIGNED NOT NULL,
  `nazwa_postaci` varchar(50) NOT NULL,
  `nazwa_gracza` varchar(50) NOT NULL,
  `idStyl` int(10) UNSIGNED NOT NULL,
  `idRola` int(10) UNSIGNED NOT NULL,
  `numer` int(10) UNSIGNED NOT NULL,
  `cel_postaci` varchar(100) NOT NULL,
  `notatki` varchar(200) NOT NULL,
  `obrazek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `postacie`
--

INSERT INTO `postacie` (`id`, `idGry`, `nazwa_postaci`, `nazwa_gracza`, `idStyl`, `idRola`, `numer`, `cel_postaci`, `notatki`, `obrazek`) VALUES
(1, 1, 'Lolo', 'xyz', 4, 2, 4, 'gege', 'brbr', ''),
(3, 1, 'lololololololo', 'olololololo', 4, 1, 2, 'greagrege', 'xxxx', ''),
(4, 1, 'aaaaaaaaaaaa', 'bbb', 7, 7, 3, 'ggg', 'hhh v', 'niedzwiedz.jpg'),
(5, 2, 'sgegewg', 'ggwgrw', 4, 1, 2, 'mm', '', 'kosmita2.jpg'),
(6, 3, 'Kosmita007', 'Anna', 4, 1, 5, 'przykładowy cel', 'nanana', 'kosmita3.jpg'),
(7, 3, 'Predator', 'gracz2', 3, 2, 3, 'cel predatora', 'xxx', 'predator.jpg'),
(8, 4, 'Kosmiczny Kosmita', 'gracz1', 4, 2, 5, 'cel kosmity', 'notatki', 'kosmita4.jpg'),
(9, 4, '007', 'Olek', 2, 3, 3, 'zniszczyć świat', 'przykłądowe notatki', 'predator2.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `problem`
--

CREATE TABLE `problem` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`id`, `nazwa`) VALUES
(1, 'NIEWYDAJNY (cały czas potrzebuje kryształów energii)'),
(2, 'TYLKO JEDNA KAPSUŁA MEDYCZNA (i Kapitan Darcy jest w środku)'),
(3, 'FATALNE WYŁĄCZNIKI NADPRĄDOWE (w czasie walki, konsole na statku wybuchają)'),
(4, 'ZŁA REPUTACJA (Kapitan Darcy narobił trochę złego w przeszłości)');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recenzje`
--

CREATE TABLE `recenzje` (
  `id` int(10) UNSIGNED NOT NULL,
  `nick` varchar(50) NOT NULL,
  `ocena` int(11) NOT NULL,
  `tresc` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `recenzje`
--

INSERT INTO `recenzje` (`id`, `nick`, `ocena`, `tresc`, `data`) VALUES
(6, 'Jan_Kowalski', 2, 'Słabe', '2024-09-07 02:29:49'),
(7, 'Anna127', 5, 'Super!', '2024-09-11 21:30:55');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rola`
--

CREATE TABLE `rola` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `rola`
--

INSERT INTO `rola` (`id`, `nazwa`) VALUES
(1, 'DOKTOR'),
(2, 'PILOT'),
(3, 'INŻYNIER'),
(4, 'NAUKOWIEC'),
(5, 'ODKRYWCA'),
(6, 'WYSŁANNIK'),
(7, 'ŻOŁNIERZ');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `styl`
--

CREATE TABLE `styl` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `styl`
--

INSERT INTO `styl` (`id`, `nazwa`) VALUES
(1, 'ANDROID'),
(2, 'CWANY'),
(3, 'CZŁOWIEK SUKCESU'),
(4, 'KOSMITA'),
(5, 'NIEBEZPIECZNY'),
(6, 'NIEUSTRASZONY'),
(7, 'UROCZY');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rola` varchar(50) DEFAULT 'user',
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`, `rola`, `data`) VALUES
(1, 'Taemin', '202cb962ac59075b964b07152d234b70', 'taemin@gmail.com', 'user', '2024-08-29 01:12:43'),
(2, 'Kkoongie', '202cb962ac59075b964b07152d234b70', 'kingkkoongie@queen.com', 'user', '2024-08-29 03:09:42'),
(3, 'Jan_Kowalski', '202cb962ac59075b964b07152d234b70', 'jankowalski@jan.pl', 'user', '2024-09-07 02:29:30'),
(4, 'Anna127', '202cb962ac59075b964b07152d234b70', 'anna@127.pl', 'user', '2024-09-07 02:36:18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zagrozenie`
--

CREATE TABLE `zagrozenie` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `zagrozenie`
--

INSERT INTO `zagrozenie` (`id`, `nazwa`) VALUES
(1, 'ZORGON ZDOBYWCA'),
(2, 'ARMADA ROJU'),
(3, 'KAPITAN ŁOTRZYKÓW'),
(4, 'KOSMICZNI PIRACI'),
(5, 'CYBERZOMBIE'),
(6, 'KOSMICZNE MÓZGOGLISTDY');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cel`
--
ALTER TABLE `cel`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `gry`
--
ALTER TABLE `gry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUzytkownika` (`idUzytkownika`),
  ADD KEY `idCel` (`idCel`),
  ADD KEY `idKonsekwencje` (`idKonsekwencje`),
  ADD KEY `idMocna_strona1` (`idMocna_strona1`),
  ADD KEY `idMocna_strona2` (`idMocna_strona2`),
  ADD KEY `idMotywacja` (`idMotywacja`),
  ADD KEY `idProblem` (`idProblem`),
  ADD KEY `idZagrozenie` (`idZagrozenie`);

--
-- Indeksy dla tabeli `konsekwencje`
--
ALTER TABLE `konsekwencje`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `mocna_strona`
--
ALTER TABLE `mocna_strona`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `motywacja`
--
ALTER TABLE `motywacja`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `postacie`
--
ALTER TABLE `postacie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idGry` (`idGry`),
  ADD KEY `idRola` (`idRola`),
  ADD KEY `idStyl` (`idStyl`);

--
-- Indeksy dla tabeli `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `recenzje`
--
ALTER TABLE `recenzje`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rola`
--
ALTER TABLE `rola`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `styl`
--
ALTER TABLE `styl`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zagrozenie`
--
ALTER TABLE `zagrozenie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cel`
--
ALTER TABLE `cel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gry`
--
ALTER TABLE `gry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `konsekwencje`
--
ALTER TABLE `konsekwencje`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mocna_strona`
--
ALTER TABLE `mocna_strona`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `motywacja`
--
ALTER TABLE `motywacja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `postacie`
--
ALTER TABLE `postacie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recenzje`
--
ALTER TABLE `recenzje`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rola`
--
ALTER TABLE `rola`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `styl`
--
ALTER TABLE `styl`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zagrozenie`
--
ALTER TABLE `zagrozenie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gry`
--
ALTER TABLE `gry`
  ADD CONSTRAINT `gry_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gry_ibfk_2` FOREIGN KEY (`idCel`) REFERENCES `cel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gry_ibfk_3` FOREIGN KEY (`idKonsekwencje`) REFERENCES `konsekwencje` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gry_ibfk_4` FOREIGN KEY (`idMocna_strona1`) REFERENCES `mocna_strona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gry_ibfk_5` FOREIGN KEY (`idMocna_strona2`) REFERENCES `mocna_strona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gry_ibfk_6` FOREIGN KEY (`idMotywacja`) REFERENCES `motywacja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gry_ibfk_7` FOREIGN KEY (`idProblem`) REFERENCES `problem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gry_ibfk_8` FOREIGN KEY (`idZagrozenie`) REFERENCES `zagrozenie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postacie`
--
ALTER TABLE `postacie`
  ADD CONSTRAINT `postacie_ibfk_1` FOREIGN KEY (`idGry`) REFERENCES `gry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postacie_ibfk_2` FOREIGN KEY (`idRola`) REFERENCES `rola` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postacie_ibfk_3` FOREIGN KEY (`idStyl`) REFERENCES `styl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
