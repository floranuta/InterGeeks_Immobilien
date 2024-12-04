-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 04 2024 г., 12:44
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `immobilien_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bilder`
--

CREATE TABLE `bilder` (
  `BildId` int(11) NOT NULL,
  `BildData` longblob NOT NULL,
  `Name` varchar(20) NOT NULL,
  `WohnungId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `favoriten`
--

CREATE TABLE `favoriten` (
  `NutzerID` int(11) NOT NULL,
  `WohnungId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nutzer`
--

CREATE TABLE `nutzer` (
  `NutzerId` int(11) NOT NULL,
  `Vorname` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Kennwort` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `wohnungen`
--

CREATE TABLE `wohnungen` (
  `WohnungId` int(11) NOT NULL,
  `Stadt` varchar(20) NOT NULL,
  `Postleitzahl` int(11) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Zimmerzahl` int(11) NOT NULL,
  `Wohnflaeche` int(11) NOT NULL,
  `Etage` int(11) NOT NULL,
  `Kaltmiete` int(11) NOT NULL,
  `Nebenkosten` int(11) NOT NULL,
  `Kaution` int(11) NOT NULL,
  `Titel` varchar(250) NOT NULL,
  `Beschreibung` varchar(350) NOT NULL,
  `Haustiere` tinyint(1) NOT NULL,
  `Baujahr` int(11) NOT NULL,
  `NutzerId` int(11) NOT NULL,
  `Wohnungstype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bilder`
--
ALTER TABLE `bilder`
  ADD PRIMARY KEY (`BildId`),
  ADD KEY `WohnungId` (`WohnungId`);

--
-- Индексы таблицы `favoriten`
--
ALTER TABLE `favoriten`
  ADD PRIMARY KEY (`NutzerID`,`WohnungId`),
  ADD KEY `WohnungId` (`WohnungId`);

--
-- Индексы таблицы `nutzer`
--
ALTER TABLE `nutzer`
  ADD PRIMARY KEY (`NutzerId`),
  ADD UNIQUE KEY `Kennwort` (`Kennwort`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Индексы таблицы `wohnungen`
--
ALTER TABLE `wohnungen`
  ADD PRIMARY KEY (`WohnungId`),
  ADD KEY `NutzerId` (`NutzerId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bilder`
--
ALTER TABLE `bilder`
  MODIFY `BildId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nutzer`
--
ALTER TABLE `nutzer`
  MODIFY `NutzerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `wohnungen`
--
ALTER TABLE `wohnungen`
  MODIFY `WohnungId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bilder`
--
ALTER TABLE `bilder`
  ADD CONSTRAINT `bilder_ibfk_1` FOREIGN KEY (`WohnungId`) REFERENCES `wohnungen` (`WohnungId`);

--
-- Ограничения внешнего ключа таблицы `favoriten`
--
ALTER TABLE `favoriten`
  ADD CONSTRAINT `favoriten_ibfk_1` FOREIGN KEY (`NutzerID`) REFERENCES `nutzer` (`NutzerId`),
  ADD CONSTRAINT `favoriten_ibfk_2` FOREIGN KEY (`WohnungId`) REFERENCES `wohnungen` (`WohnungId`);

--
-- Ограничения внешнего ключа таблицы `wohnungen`
--
ALTER TABLE `wohnungen`
  ADD CONSTRAINT `wohnungen_ibfk_1` FOREIGN KEY (`NutzerId`) REFERENCES `nutzer` (`NutzerId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
