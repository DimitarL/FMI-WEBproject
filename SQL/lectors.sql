CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

use `presentationCalendar`;

create table lectors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(64) NOT NULL,
    lastName VARCHAR(64) NOT NULL,
    password VARCHAR(32) NOT NULL
);