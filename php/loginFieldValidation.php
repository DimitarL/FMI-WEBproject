<?php
include "./loginDBmanipulation.php";

$errors = array();

function isTheFieldFilled($input, &$errors)
{
    if (!$input) {
        $errors['$input'] = "$input полето е задължително!" . "<br>";
    }
}

function validateMaxLength($input, $maxLength, &$errors)
{
    if (strlen($input) > $maxLength) {
        $errors['$input'] = "$input полето трябва да бъде по-малко от $maxLength символа!" . "<br>";
    }
}

function validateUsername($input, &$errors)
{
    if (!preg_match('/^[a-zA-Z-\p{Cyrillic}]+$/u', $input)) {
        $errors['$input'] = "Въведеното име има невалидни символи!" . "<br>";
    }
}

function validatePassword($input, &$errors)
{
    if (!preg_match('/^[0-9a-zA-Z-\p{Cyrillic}]+$/u', $input)) {
        $errors['$input'] = "Въведената парола има невалидни символи!" . "<br>";
    }
}
?>