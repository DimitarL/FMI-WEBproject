<?php

include "./db_manipulation.php";

$present = getPresent();

foreach($present as $user){
    $fullname = getFullName($user['username']);
    echo $fullname['firstName'] . " " . $fullname["lastName"] . "\n";
}
?>