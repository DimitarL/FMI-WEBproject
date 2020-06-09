CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

CREATE TABLE IF NOT EXISTS dates(
    timeDate timestamp PRIMARY KEY,
    hasPresentation boolean DEFAULT false
)