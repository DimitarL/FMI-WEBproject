<?php

include "./db_manipulation.php";

$input_json = file_get_contents('php://input');

$dates = getFreeDates($input_json);
echo json_encode($dates);
?>