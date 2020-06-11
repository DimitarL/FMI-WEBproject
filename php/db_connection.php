<?php
function dbConnection(){

    $host = "localhost";
    $dbname = "presentationcalendar";
    $username = "root";
    $pass = "";

    try{
        $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $pass, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
        return $connection;
    } catch(PDOException $error){
        die ("Неуспешен опит за свързване с базата.");
    }
}
?>
