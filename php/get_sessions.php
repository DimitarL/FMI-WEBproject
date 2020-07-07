<?php

include "./db_manipulation.php";

$sessions = getAllSessions();
echo json_encode($sessions);
?>