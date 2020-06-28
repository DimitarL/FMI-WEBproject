CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

CREATE TABLE IF NOT EXISTS dates(
    timeDate timestamp PRIMARY KEY DEFAULT CURRENT_TIMESTAMP,
    hasPresentation boolean DEFAULT false,
    duration int NOT NULL
);