<?php

include "./db_manipulation.php";

$present = getAllStudentsForSession();
foreach($present as $user){
    echo $user['firstName'] . " " . $user["lastName"] . 
    ", " . $user['facultyNumber'] . 
    ", Влезнал в: " . $user['timeIn'] . 
    ", Излезнал в: " . $user['timeOut'] . 
    ", Тема №: " . $user['topicId'] . 
    ", Тема: " . $user['topic'] . "\n";
}
?>