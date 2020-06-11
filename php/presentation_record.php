<?php

include "./db_manipulation.php";

$dates = getFreeDates();
echo json_encode($dates);
?>