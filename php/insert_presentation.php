<?php

include "./db_manipulation.php";

session_start();
 
if(!$_SESSION["username"]) {
    echo "Only authenticated users are allowed";
} else {

    $input_json = file_get_contents('php://input');
    $input = json_decode($input_json);
    
    $username = $_SESSION['username'];
    $topic = $input->topic;
    $presentation = $input->presentation;
    $invitation = $input->invitation;
    $timeDate = $input->timeDate;

    $result = insertPresentation($username, $topic, $presentation, $invitation, $timeDate);
    echo $result;
}

?>