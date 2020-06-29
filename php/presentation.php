<?php
include './db_connection.php';

date_default_timezone_set('Europe/Sofia');
//$date = date('Y-m-d H:i');

//echo $date;
$date= "2020-06-29 11:00";

function getPresentation($date)
{
    try {
        $conn = dbConnection();
        $sql = "SELECT p.presentation FROM presentations p, dates d where p.timeDate=d.timeDate and :datePlaceholder between d.timeDate and d.timeEnd ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":datePlaceholder", $date);
        $stmt->execute() or die("Failed to query from DB!");
        echo $stmt->fetchColumn();
        $conn = null;
    } catch (PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
        return false;
    }
}

getPresentation($date);

?>