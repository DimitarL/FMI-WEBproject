<?php

include "./db_manipulation.php";

if(!session_id()){
    session_start();
}

$request = $_SERVER['REQUEST_METHOD'];

if($_SESSION["username"]){
    if(strcmp($request, 'POST') == 0){
        $result = addPresent($_SESSION["username"]);
    } else if (strcmp($request, 'DELETE') == 0){
        $result = deletePresent($_SESSION["username"]);
    } else {
        $result = "Failed. Please try again later.";
    }
    echo $result;
} else {
    echo false;
}

?>