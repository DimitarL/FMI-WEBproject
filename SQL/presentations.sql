CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

CREATE TABLE IF NOT EXISTS presentations (
    topic VARCHAR(128),
    username VARCHAR(64),
    presentation VARCHAR(64) NOT NULL,
    invitation VARCHAR(64) NOT NULL,
    timeDate timestamp REFERENCES fkDate FOREIGN KEY DATES(timeDate),
    constraint primary key(topic, username)
);