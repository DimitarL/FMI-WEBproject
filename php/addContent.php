<?php
include "dbSharedNotesManipulation.php";

$inputNotes = $_GET['inputNotes'];

insertInTable($inputNotes);
?>