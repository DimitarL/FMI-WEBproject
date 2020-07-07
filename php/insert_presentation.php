<?php

include "./db_manipulation.php";

if(!session_id()){
    session_start();
}
 
if(!$_SESSION["username"]) {
    echo "Only authenticated users are allowed";
} else {

    $input_json = file_get_contents('php://input');
    $input = json_decode($input_json);
    
    $username = $_SESSION['username'];
    $presentation = $input->presentationLink;
    $timeDate = $input->timeDate;

    $result = insertPresentation($username, $presentation, $timeDate);
    echo $result;
}

?>