CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(64) NOT NULL,
    lastName VARCHAR(64) NOT NULL,
    password VARCHAR(32) NOT NULL,
    course tinyint  NOT NULL, 
    specialty VARCHAR(128) NOT NULL, 
    facultyNumber INT NOT NULL, 
    groupNumber SMALLINT UNSIGNED NOT NULL
);