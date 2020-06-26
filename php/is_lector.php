<?php

if(!session_id()){
    session_start();
}

if(strcmp($_SESSION["role"], "admin") == 0){
    echo true;
} else {
    return false;
}

?>