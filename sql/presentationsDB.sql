CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

CREATE TABLE IF NOT EXISTS presentations (
    topic VARCHAR(128),
    username VARCHAR(64),
    presentation VARCHAR(64) NOT NULL,
    invitation VARCHAR(64) NOT NULL,
    timeDate timestamp,
    CONSTRAINT fkDate FOREIGN KEY (timeDate)
    REFERENCES dates(timeDate),
    PRIMARY KEY(topic, username)
);