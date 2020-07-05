CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

CREATE TABLE IF NOT EXISTS dates(
    timeDate timestamp PRIMARY KEY DEFAULT CURRENT_TIMESTAMP,
    hasPresentation boolean DEFAULT false,
    timeEnd timestamp DEFAULT CURRENT_TIMESTAMP,
    duration int NOT NULL,
    room varchar(64) NOT NULL,
    day INT NOT NULL
);

CREATE TABLE IF NOT EXISTS students (
    username VARCHAR(64) PRIMARY KEY,
    firstName VARCHAR(64) NOT NULL,
    lastName VARCHAR(64) NOT NULL,
    password VARCHAR(64) NOT NULL,
    course tinyint  NOT NULL, 
    specialty VARCHAR(128) NOT NULL, 
    facultyNumber INT NOT NULL, 
    groupNumber SMALLINT UNSIGNED NOT NULL
);

CREATE TABLE IF NOT EXISTS lectors (
    username VARCHAR(64) PRIMARY KEY,
    firstName VARCHAR(64) NOT NULL,
    lastName VARCHAR(64) NOT NULL,
    password VARCHAR(64) NOT NULL
);

CREATE TABLE IF NOT EXISTS topicsInfo (
    topicId INT PRIMARY KEY,
    topic VARCHAR(124),
    presentationPath VARCHAR(64) NOT NULL,
    invitationPath VARCHAR(64) NOT NULL
);

CREATE TABLE IF NOT EXISTS present (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(64), 
    topicId INT NOT NULL,
    timeIn timestamp DEFAULT CURRENT_TIMESTAMP,
    timeOut timestamp NULL,
    FOREIGN KEY (username)
    REFERENCES students(username),
    FOREIGN KEY (topicId)
    REFERENCES topicsInfo(topicId)    
);

CREATE TABLE IF NOT EXISTS presentations (
    topicId INT,
    username VARCHAR(64),
    timeDate timestamp NULL,
    presentationLink VARCHAR(128) NOT NULL,
    CONSTRAINT fkDate FOREIGN KEY (timeDate)
    REFERENCES dates(timeDate) ON UPDATE CASCADE,
    CONSTRAINT fkStudent FOREIGN KEY (username)
    REFERENCES students(username) ON UPDATE CASCADE,
    CONSTRAINT fkTopicId FOREIGN KEY (topicId)
    REFERENCES topicsInfo(topicId),  
    PRIMARY KEY(topicId, username)
);

CREATE TABLE IF NOT EXISTS sharedNotes (
  inputNotes longtext NOT NULL,
  noteTime text NOT NULL,
  authorUsername text NOT NULL,
  topicId INT NOT NULL,
  FOREIGN KEY (topicId)
  REFERENCES topicsInfo(topicId)  
); 

SET GLOBAL event_scheduler = ON;

drop event if exists delete_shared_notes;

CREATE EVENT delete_shared_notes 
ON SCHEDULE EVERY 1 DAY 
STARTS TIMESTAMP (CURDATE() + INTERVAL 1 DAY, '00:00:01') DO DELETE FROM sharedNotes;

show events; 