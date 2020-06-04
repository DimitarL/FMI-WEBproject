CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

use `presentationCalendar`;

create table presentations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    presentation VARCHAR(64) NOT NULL,
    invitation VARCHAR(64) NOT NULL,
    topic VARCHAR(128) NOT NULL
);