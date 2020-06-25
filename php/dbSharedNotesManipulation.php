<?php
include "db_connection.php";

$table_name = "shared_notes";

function insertInTable($inputNotes)
{
    global $table_name;
    try {
        $connection = dbConnection();
        $sql = "INSERT INTO shared_notes(inputNotes) 
            VALUES (:inputNotes)";

        $preparedSql = $connection->prepare($sql) or die("Свързването е неуспешно!" . "<br>");
        $preparedSql->bindParam(':inputNotes', $inputNotes);

        if ($inputNotes != '') {
            $preparedSql->execute() or die("Неуспешно изпълнение на SQL заявката!" . "<br>");
        }
        echo "Данните са добавени успешно!" . "<br>";
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

function printContentOfTable()
{
    global $table_name;
    try {
        echo "<div class=\"notesTitle\">Споделени бележки:</div>" . "<br/>";

        $connection = dbConnection();
        $sql = "SELECT * FROM {$table_name}";
        $counter = 1;

        $result = $connection->prepare($sql) or die("Failed to prepare select sql query.");
        $result->execute() or die("Failed to execute select sql query.");

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class=\"counter\">$counter. </div>" . $row["inputNotes"] . "<br/><br/>";
            $counter++;
        }
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

function downloadNotes()
{
    global $table_name;
    try {
        $connection = dbConnection();
        $sql = "SELECT * FROM {$table_name}";
        $counter = 1;

        $result = $connection->prepare($sql) or die("Failed to prepare select sql query.");
        $result->execute() or die("Failed to execute select sql query.");
        $fileOpen = fopen('downloaded_Notes.txt', 'w');

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            fputs($fileOpen, $counter . ". " . $row['inputNotes'] . "\n");
            $counter++;
        }

        fclose($fileOpen);
        return $row;
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}
