CREATE DATABASE IF NOT EXISTS `presentationCalendar`;

USE `presentationCalendar`;

SET GLOBAL event_scheduler = ON;

drop event if exists delete_shared_notes;

CREATE EVENT delete_shared_notes 
ON SCHEDULE EVERY 1 DAY 
STARTS TIMESTAMP (CURDATE() + INTERVAL 1 DAY, '00:00:01') DO DELETE FROM sharedNotes;

show events;