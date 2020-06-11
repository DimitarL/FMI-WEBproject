<?php

include "./db_manipulation.php";

$input_json = file_get_contents('php://input');
$input = json_decode($input_json);


$username = $input->username;
$topic = $input->topic;
$presentation = $input->presentation;
$invitation = $input->invitation;
$timeDate = $input->timeDate;

$result = insertPresentation($username, $topic, $presentation, $invitation, $timeDate);
echo $result;

// if($result){
//     echo true;
// } else {
//     echo false;
// }

?>