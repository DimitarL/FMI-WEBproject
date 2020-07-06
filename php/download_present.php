<?php

include "./db_manipulation.php";

$present = getCurrentPresent();
foreach($present as $user){
    echo $user['firstName'] . " " . 
    $user["lastName"] . ", " . $user['facultyNumber'] . 
    ", Влезнал в: " . $user['timeIn'] . 
    ", Тема №: " . $user['topicId'] . 
    ", Тема: " . $user['topic'] . "\n";
}
?>