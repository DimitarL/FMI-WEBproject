CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

CREATE TABLE IF NOT EXISTS lectors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(64) NOT NULL,
    lastName VARCHAR(64) NOT NULL,
    password VARCHAR(32) NOT NULL
);