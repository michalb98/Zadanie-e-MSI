-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Maj 2022, 22:34
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `emsi`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `delegacje`
--

CREATE TABLE `delegacje` (
  `ID_Delegacje` int(11) NOT NULL,
  `Imie_i_Nazwisko` varchar(150) COLLATE utf8mb4_polish_ci NOT NULL,
  `Data_od` date NOT NULL,
  `Data_do` date NOT NULL,
  `Miejsce_wyjazdu` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `Miejsce_przyjazdu` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `delegacje`
--

INSERT INTO `delegacje` (`ID_Delegacje`, `Imie_i_Nazwisko`, `Data_od`, `Data_do`, `Miejsce_wyjazdu`, `Miejsce_przyjazdu`) VALUES
(1, 'Krystian Adamska', '2022-04-04', '2022-04-06', 'Łódź', 'Warszawa'),
(2, 'Łukasz Wróblewski', '2022-03-01', '2022-03-04', 'Łódź', 'Kraków'),
(3, 'Łukasz Kaźmierczak', '2022-05-16', '2022-05-20', 'Łódź', 'Gdańsk'),
(4, 'Karolina Lis', '2022-02-01', '2022-02-04', 'Poznań', 'Gdynia'),
(5, 'Aneta Zakrzewska', '2022-02-14', '2022-02-18', 'Toruń', 'Szczecin'),
(6, 'Paula Makowska', '2021-10-11', '2021-10-15', 'Kraków', 'Olsztyn');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `faktury`
--

CREATE TABLE `faktury` (
  `ID_Faktury` int(11) NOT NULL,
  `Opis` varchar(250) COLLATE utf8mb4_polish_ci NOT NULL,
  `MPK` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `Kwota_netto` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `faktury`
--

INSERT INTO `faktury` (`ID_Faktury`, `Opis`, `MPK`, `Kwota_netto`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eu magna a augue imperdiet elementum ac ut felis. Aenean purus dolor, fermentum sed dui a, euismod iaculis tellus.', 'Laboratorium techniczne', 1000.00),
(2, 'Donec mollis non sem et viverra. Suspendisse a metus sed ligula molestie sollicitudin. Duis eu libero et eros consequat volutpat.', 'Dział wykonawczy', 60.00),
(3, 'Phasellus sit amet erat vitae lectus efficitur blandit. Mauris lobortis et erat at pretium. Aliquam erat volutpat. Suspendisse at aliquam nisi.', 'Dział kontroli jakości', 75.50),
(4, 'Vestibulum placerat facilisis sem sed laoreet. Curabitur a lectus sit amet turpis cursus suscipit. Vivamus placerat justo ac dictum luctus.', 'Dział konstrukcyjny', 1000.01),
(5, 'Aenean finibus felis ante, varius cursus quam congue ut.', 'Dział przygotowania materiałów', 2500.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontraheci`
--

CREATE TABLE `kontraheci` (
  `ID_Kontraheci` int(11) NOT NULL,
  `NIP` varchar(10) COLLATE utf8mb4_polish_ci NOT NULL,
  `Regon` varchar(9) COLLATE utf8mb4_polish_ci NOT NULL,
  `Nazwa` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `Czy_vat` tinyint(1) NOT NULL,
  `Ulica` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `Numer_domu` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `Numer_mieszkania` varchar(20) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `Czy_usuniety` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `kontraheci`
--

INSERT INTO `kontraheci` (`ID_Kontraheci`, `NIP`, `Regon`, `Nazwa`, `Czy_vat`, `Ulica`, `Numer_domu`, `Numer_mieszkania`, `Czy_usuniety`) VALUES
(1, '5286471944', '933471303', 'Chip Tech', 1, 'Aleje Jerozolimskie', '12', '5', 1),
(2, '1238709831', '858279420', 'Data Tech', 0, 'Piotrkowska', '123', '12', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `ID_Pracownicy` int(11) NOT NULL,
  `Imie` varchar(60) COLLATE utf8mb4_polish_ci NOT NULL,
  `Nazwisko` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `ID_Stanowisko` int(11) NOT NULL,
  `Data_zatrudnienia` date NOT NULL,
  `Ilosc_urlopu` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`ID_Pracownicy`, `Imie`, `Nazwisko`, `ID_Stanowisko`, `Data_zatrudnienia`, `Ilosc_urlopu`) VALUES
(1, 'Adam', 'Abacki', 1, '2012-05-01', 8),
(2, 'Gracjan', 'Wróblewski', 2, '2013-05-01', 2),
(3, 'Malwina', 'Szewczyk', 3, '2014-05-05', 10),
(4, 'Joanna', 'Pawlak', 3, '2017-05-01', 6),
(5, 'Michał', 'Błaszczyk', 4, '2022-05-30', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stanowisko`
--

CREATE TABLE `stanowisko` (
  `ID_Stanowisko` int(11) NOT NULL,
  `Stanowisko` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `stanowisko`
--

INSERT INTO `stanowisko` (`ID_Stanowisko`, `Stanowisko`) VALUES
(1, 'Kierownik'),
(2, 'Asystent Działu Księgowości'),
(3, 'Tester'),
(4, 'Młodszy Wdrożeniowiec - Programista');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `delegacje`
--
ALTER TABLE `delegacje`
  ADD PRIMARY KEY (`ID_Delegacje`);

--
-- Indeksy dla tabeli `faktury`
--
ALTER TABLE `faktury`
  ADD PRIMARY KEY (`ID_Faktury`);

--
-- Indeksy dla tabeli `kontraheci`
--
ALTER TABLE `kontraheci`
  ADD PRIMARY KEY (`ID_Kontraheci`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`ID_Pracownicy`),
  ADD KEY `ID_Stanowisko` (`ID_Stanowisko`);

--
-- Indeksy dla tabeli `stanowisko`
--
ALTER TABLE `stanowisko`
  ADD PRIMARY KEY (`ID_Stanowisko`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `delegacje`
--
ALTER TABLE `delegacje`
  MODIFY `ID_Delegacje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `faktury`
--
ALTER TABLE `faktury`
  MODIFY `ID_Faktury` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `kontraheci`
--
ALTER TABLE `kontraheci`
  MODIFY `ID_Kontraheci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `ID_Pracownicy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `stanowisko`
--
ALTER TABLE `stanowisko`
  MODIFY `ID_Stanowisko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD CONSTRAINT `pracownicy_ibfk_1` FOREIGN KEY (`ID_Stanowisko`) REFERENCES `stanowisko` (`ID_Stanowisko`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
