<?php

include "./db_manipulation.php";

if(!session_id()){
    session_start();
}


$request = $_SERVER['REQUEST_METHOD'];

$input_json = file_get_contents('php://input');
$input = json_encode($input_json);

if($_SESSION["username"]){
    if(strcmp($request, 'POST') == 0){
        echo($input);
        $result = $input;
        // $result = addPresent($_SESSION["username"]);
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