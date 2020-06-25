CREATE TABLE `shared_notes` (
  `inputNotes` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `shared_notes`
--

INSERT INTO `shared_notes` (`inputNotes`) VALUES
('Иван има правописни грешки'),
('Таня е работила върху грешна тема'),
('Надя няма презентация');
COMMIT;