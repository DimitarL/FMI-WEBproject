<?php
include "sharedNotesFieldValidation.php";

$inputNotes_Max_Length = 1024;
$errors = array();

if ($_POST) {
    $inputNotes = $_POST['inputNotes'];

    validateMaxLength('inputNotes', $inputNotes_Max_Length, $errors);

    if (count($errors) == 0) {
        insertInTable($inputNotes);
    } else {
        foreach ($errors as $err) {
            echo $err . "<br>";
        }
        echo "Моля поправете грешките!" . "<br>";
    }
}
?>