<?php
if (!session_id()) {
    session_start();
}

include "db_connection.php";

date_default_timezone_set('Europe/Sofia');
$table_name = "sharedNotes";

function insertInTable($inputNotes) {
    try {
        $connection = dbConnection();
        $authorUsername = $_SESSION["username"];
        $noteTime  = date('H:i');
        $topicId = getCurrentTopicId();

        $sql = "INSERT INTO sharedNotes(inputNotes, noteTime, authorUsername, topicId)
                VALUES (:inputNotes, :noteTime, :authorUsername, :topicId)";
 
        $preparedSql = $connection->prepare($sql) or die("Свързването е неуспешно!" . "<br>");
        $preparedSql->bindParam(':inputNotes', $inputNotes);
        $preparedSql->bindParam(':noteTime', $noteTime);
        $preparedSql->bindParam(':authorUsername', $authorUsername);
        $preparedSql->bindParam(':topicId', $topicId);

        $preparedSql->execute() or die("Неуспешно изпълнение на SQL заявката!" . "<br>");
        echo "Данните са добавени успешно!" . "<br>";
        $connection = null;
    } catch (PDOException $error) {
        echo "Възникна грешка с добавянето на бележката. Моля, опитайте пак по-късно.";
    }
}

function getCurrentTopicId() {
    try {
        $connection = dbConnection();
        $currentTime = date('Y-m-d H:i');
        $sql = "SELECT topicId
            FROM presentations AS p
            INNER JOIN dates AS d
            ON p.timeDate = d.timeDate
            WHERE :currentTime >= d.timeDate AND :currentTime <= d.timeEnd";
        $result = $connection->prepare($sql) or die("Failed to prepare select sql query.");
        $result->bindParam(':currentTime', $currentTime);
        $result->execute() or die("Failed to execute select sql query.");
        $row = $result->fetch(PDO::FETCH_ASSOC);

        $connection = null;

        return $row['topicId'];
    } catch (PDOException $error) {
        echo "Неуспешен опит да се зареди номера на темата.";
        return 0;
    }
}

function printContentOfTable() {
    global $table_name;
    try {
        echo "<div class=\"notesTitle\">Споделени бележки:</div>" . "<br/>";

        $connection = dbConnection();
        $sql = "SELECT * FROM {$table_name}";
        $result = $connection->prepare($sql) or die("Неуспешно изпълнение на sql заявката.");
        $result->execute() or die("Неуспешно изпълнение на sql заявката.");

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $noteTime = $row["noteTime"];
            $sessionUsername = $row["authorUsername"];
            
            echo "<div class=\"counter\">$noteTime</div>" . "<div class=\"sessionUN\">$sessionUsername</div>" . "<div class=\"counter colon\">: </div>" . $row["inputNotes"] . "<br/><br/>";
        }

        $connection = null;
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

function downloadNotes() {
    try {
        $connection = dbConnection();
        $sql = "SELECT firstName, lastName, facultyNumber, t.topicId, t.topic, inputNotes, noteTime
        FROM sharednotes AS sn 
        INNER JOIN topicsInfo AS t
        ON sn.topicId = t.topicId
        INNER JOIN students AS s 
        ON s.username = sn.authorUsername
        ORDER BY noteTime;";
        $counter = 1;
        $result = $connection->prepare($sql) or die("Failed to prepare select sql query.");
        $result->execute() or die("Failed to execute select sql query.");
        
        $fileOpen = fopen('../downloaded_Notes.txt', 'w');

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            fputs($fileOpen, "Автор: " . $row['facultyNumber'] . ", " . $row['firstName'] . " " . $row['lastName'] . "\nИме на темата: " . $row['topic'] . "; Номер на темата: " . $row['topicId'] . "\n" . $counter . ". Бележка: " . $row['inputNotes'] . "\n\n");

            $counter++;
        }

        fclose($fileOpen);
        return $row;
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}
?>