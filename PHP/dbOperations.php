<?php

function openCon()
{
    try{
    $dbhost = "localhost:3306";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "presentationcalendar";
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, [PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"]);
    return $conn;
    }catch(PDOException $error){
        die("Ooops! Problem occurred!");
    }
}
?>