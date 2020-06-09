<?php 

include "./db_connection.php";

function getFreeDates(){
    try {

        $connection = dbConnection();
        $sql = "SELECT * FROM dates WHERE hasPresentation = false";

        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        
        $preparedSql->execute() or die("Failed to execute sql query."); 
        $connection = null;  
        return $preparedSql->fetchAll();
    }
    catch(PDOException $error) {
        echo ("Request processing failed.");
    }
}

function insertPresentation($username, $topic, $presentation, $invitation, $timeDate){
    try {

        $connection = dbConnection();
        $sql = "INSERT INTO presentations( topic, username, presentation, invitation, timeDate)
        VALUES (:topic, :username, :presentation, :invitation, :timeDate);";

        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        $preparedSql->bindParam(':topic', $topic);
        $preparedSql->bindParam(':username', $username);
        $preparedSql->bindParam(':presentation', $presentation); 
        $preparedSql->bindParam(':invitation', $invitation);
        $preparedSql->bindParam(':timeDate', $timeDate);
        $preparedSql->execute() or die("Failed to execute sql query."); 
        $connection = null;  
        changeDate($timeDate);
        return true;
    }
    catch(PDOException $error) {
        echo ("Request processing failed.");
        return false;
    }
}

function changeDate($timeDate){
    try {

        $connection = dbConnection();
        $sql = "UPDATE dates SET hasPresentation = true WHERE timeDate = :timeDate; ";

        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        $preparedSql->bindParam(':timeDate', $timeDate);
        $preparedSql->execute() or die("Failed to execute sql query."); 
        $connection = null;  
   }
    catch(PDOException $error) {
        echo ("Request processing failed.");
    }  
}

?>