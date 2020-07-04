<?php
if(!session_id()){
    session_start();
}

include "db_connection.php";

$table_name = "sharedNotes";

function insertInTable($inputNotes)
{
    try {
        $connection = dbConnection();
        $noteTime  = date('H:i');
        $authorUsername = $_SESSION["username"];
        $sql = "INSERT INTO sharedNotes(inputNotes, noteTime, authorUsername) 
            VALUES (:inputNotes, :noteTime, :authorUsername)";

        $preparedSql = $connection->prepare($sql) or die("Свързването е неуспешно!" . "<br>");
        $preparedSql->bindParam(':inputNotes', $inputNotes);
        $preparedSql->bindParam(':noteTime', $noteTime);
        $preparedSql->bindParam(':authorUsername', $authorUsername);

        if ($inputNotes != '') {
            $preparedSql->execute() or die("Неуспешно изпълнение на SQL заявката!" . "<br>");
        }
        echo "Данните са добавени успешно!" . "<br>";

        $connection = null;
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
        /*$counter = 1;*/

        $result = $connection->prepare($sql) or die("Failed to prepare select sql query.");
        $result->execute() or die("Failed to execute select sql query.");

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $noteTime = $row["noteTime"];
            $sessionUsername = $row["authorUsername"];
            /*echo "<div class=\"counter\">$counter. </div>" . $row["inputNotes"] . "<br/><br/>";*/
            echo "<div class=\"counter\">$noteTime</div>" . "<div class=\"sessionUN\">$sessionUsername</div>" . "<div class=\"counter colon\">: </div>". $row["inputNotes"] . "<br/><br/>";
            /*$counter++;*/
        }

        $connection = null;
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
?>