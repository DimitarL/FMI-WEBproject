CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

CREATE TABLE IF NOT EXISTS `sharednotes` (
  `inputNotes` longtext NOT NULL,
  `noteTime` text NOT NULL,
  `authorUsername` text NOT NULL
);