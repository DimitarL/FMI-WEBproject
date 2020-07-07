<?php
include './db_connection.php';

date_default_timezone_set('Europe/Sofia');
$date = date('Y-m-d H:i');

function getPresentation($date)
{
    try {
        $conn = dbConnection();

        $sql = "SELECT p.presentationLink, t.topicId, t.topic 
        FROM presentations AS p
        INNER JOIN dates AS d
        ON p.timeDate = d.timeDate
        INNER JOIN topicsinfo AS t
        ON p.topicId = t.topicId
        WHERE :datePlaceholder between d.timeDate and d.timeEnd;";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":datePlaceholder", $date);
        $stmt->execute() or die("Failed to query from DB!");
        $conn = null;
        
        echo(json_encode($stmt->fetch(PDO::FETCH_ASSOC)));
    } catch (PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
        return false;
    }
}

getPresentation($date);

?>