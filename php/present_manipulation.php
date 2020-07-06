<?php

include "./db_manipulation.php";

if(!session_id()){
    session_start();
}

$request = $_SERVER['REQUEST_METHOD'];

$input_json = file_get_contents('php://input');
$input = json_encode($input_json);

if($_SESSION["username"]){
    if(strcmp($request, 'POST') == 0 && strcmp($_SESSION['role'], 'student') == 0){
        $result = addPresent($_SESSION["username"], $input_json);
    } else if (strcmp($request, 'PUT') == 0 && strcmp($_SESSION['role'], 'student') == 0){
        $result = updatePresent($_SESSION["username"]);
    } else if (strcmp($request, 'GET') == 0){
        $present = getCurrentPresent();
        $result = "";
        foreach($present as $user){
            $result .= $user['firstName'] . " " . $user["lastName"] . "\n";
        }
    } else {
        $result = true;
    }
    echo $result;
} else {
    echo false;
}

?>