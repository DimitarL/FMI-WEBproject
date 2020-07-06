<?php 

include "./db_connection.php";

session_start();
$user=$_SESSION["username"];

function changeDates($user){
    try {

        $connection = dbConnection();
        $sql = "UPDATE dates d inner join presentations AS p on d.timeDate=p.timeDate set d.hasPresentation=false where p.username=:usernamePlaceholder";
        $preparedSql = $connection->prepare($sql) or die("Неуспешно свързване с базата при промяната на hasPresentation.");
        $preparedSql->bindParam(':usernamePlaceholder', $user);
        $preparedSql->execute() or die("Неуспешно свързване с базата pri prepared ."); 
        $connection = null;  
        updatePresentations($user);
    }
    catch(PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
    }
}
function updatePresentations($user){

    try {

        $connection = dbConnection();
        $sql = "UPDATE presentations SET timeDate=NULL where username=:usernamePlaceholder";
        $preparedSql = $connection->prepare($sql) or die("Неуспешно свързване с базата.");
        $preparedSql->bindParam(':usernamePlaceholder', $user);
        $preparedSql->execute() or die("Неуспешно свързване с базата."); 
        $connection = null;  
    }
    catch(PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
    }
}

changeDates($user);
header("Location: ./calendar.php");
