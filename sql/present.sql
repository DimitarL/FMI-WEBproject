CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

CREATE TABLE IF NOT EXISTS present (
    username VARCHAR(64), 
    CONSTRAINT fkUser FOREIGN KEY (username)
    REFERENCES students(username)  
);

INSERT INTO present(username)
VALUES ('asimeonov'),
('cvnoncheva');