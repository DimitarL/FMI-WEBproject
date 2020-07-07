<?php 

include "./db_connection.php";

date_default_timezone_set('Europe/Sofia');

function getFreeDates($session){
    try {
        $connection = dbConnection();
        $sql = "SELECT * FROM dates WHERE hasPresentation = false AND day = :sessionDay";

        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        $preparedSql->bindParam(':sessionDay', $session);
        $preparedSql->execute() or die("Неуспешно се заредиха свободните дати."); 
        $connection = null;  
        return $preparedSql->fetchAll();
    }
    catch(PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
    }
}


function getAllSessions(){
    try {
        $connection = dbConnection();
        $sql = "SELECT DISTINCT day FROM dates WHERE hasPresentation = false";
        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        $preparedSql->execute() or die("Неуспешно се заредиха сесиите."); 
        $connection = null;  
        return $preparedSql->fetchAll();
    }
    catch(PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
    }
}

function insertPresentation($username, $presentationLink, $timeDate){
    try {

        $connection = dbConnection();
        $sql = "UPDATE presentations
        SET timeDate = :timeDate, presentationLink = :presentationLink
        WHERE username = :username;";

        $preparedSql = $connection->prepare($sql) or die("Неуспешно свързване с базата.");
        $preparedSql->bindParam(':username', $username);
        $preparedSql->bindParam(':presentationLink', $presentationLink); 
        $preparedSql->bindParam(':timeDate', $timeDate);
        $preparedSql->execute() or die("Вече сте записали тази тема."); 
        $connection = null;  
        changeDate($timeDate);
        return true;
    }
    catch(PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
        return false;
    }
}

function changeDate($timeDate){
    try {

        $connection = dbConnection();
        $sql = "UPDATE dates SET hasPresentation = true WHERE timeDate = :timeDate; ";

        $preparedSql = $connection->prepare($sql) or die("Неуспешно свързване с базата.");
        $preparedSql->bindParam(':timeDate', $timeDate);
        $preparedSql->execute() or die("Часът беше неуспешно зает."); 
        $connection = null;  
   }
    catch(PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно..");
    }  
}

function getCurrentPresent(){
    try {

        $connection = dbConnection();
        $sql = "SELECT * 
        FROM present AS p
        INNER JOIN topicsInfo AS t 
        ON p.topicId = t.topicId
        INNER JOIN students AS s
        ON p.username = s.username
        WHERE p.timeOut IS NULL;";
        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        $preparedSql->execute() or die("Failed to execute sql query."); 
        $connection = null;  
        return $preparedSql->fetchAll();
   }
    catch(PDOException $error) {
        echo ("Request processing failed.");
    }  
}

function getAllStudentsForSession(){
    try {

        $connection = dbConnection();
        $sql = "SELECT * 
        FROM present AS p
        INNER JOIN topicsInfo AS t 
        ON p.topicId = t.topicId
        INNER JOIN students AS s
        ON p.username = s.username
        WHERE p.timeOut IS NOT NULL;";
        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        $preparedSql->execute() or die("Failed to execute sql query."); 
        $connection = null;  
        return $preparedSql->fetchAll();
   }
    catch(PDOException $error) {
        echo ("Request processing failed.");
    }  
}

function addPresent($username, $topicId){
    try {
        if(studentAlreadyPresent($username, $topicId)){
            return false;
        }
        $connection = dbConnection();
        $sql = "INSERT INTO  present(username, topicId) VALUES(:username, :topicId);";
        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        $preparedSql->bindParam(':username', $username);
        $preparedSql->bindParam(':topicId', $topicId);
        $preparedSql->execute() or die("Failed to execute sql query."); 
        $connection = null;  
        return true;
    }
    catch(PDOException $error) {
        echo ("Request processing failed.");
        return false;
    }  
}

function updatePresent($username){
    try {
        $currentTime = date('Y-m-d H:i');
        $connection = dbConnection();
        $sql = "UPDATE present SET timeOut = :currentTime WHERE username = :username AND timeOut IS NULL;";
        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        $preparedSql->bindParam(':username', $username);
        $preparedSql->bindParam(':currentTime', $currentTime);
        $preparedSql->execute() or die("Failed to execute sql query 1."); 
        $connection = null;  
        return true;
   }
    catch(PDOException $error) {
        echo ("Request processing failed.");
        return false;
    }  
}

function studentAlreadyPresent($username, $topicId){
    try {
        $connection = dbConnection();
        $sql = "SELECT username FROM present WHERE username = :username AND topicId = :topicId AND timeOut IS NULL";
        $preparedSql = $connection->prepare($sql) or die("Failed to prepare sql query.");
        $preparedSql->bindParam(':username', $username);
        $preparedSql->bindParam(':topicId', $topicId);
        $preparedSql->execute() or die("Failed to execute sql query 1."); 
        $connection = null;
        if($preparedSql -> fetch()){
            return true;
        }  
        return false;
    }
    catch(PDOException $error) {
        echo ("Request processing failed.");
        return false;
    } 
}

?>