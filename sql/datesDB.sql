CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

CREATE TABLE IF NOT EXISTS dates(
    timeDate timestamp PRIMARY KEY DEFAULT CURRENT_TIMESTAMP,
    hasPresentation boolean DEFAULT false,
    timeEnd timestamp DEFAULT CURRENT_TIMESTAMP,
    duration int NOT NULL
);