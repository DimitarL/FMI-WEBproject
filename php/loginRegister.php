<?php
include "./loginFieldValidation.php";

session_start();

$username_Max_Length = 64;
$password_Max_Length = 64;

$adminTableName = "lectors";
$userTableName = "students";

$errors = array();

if ($_POST) {
    $usernameToCheck = $_POST['username'];
    $passwordToCheck = $_POST['password'];

    if (count($errors) == 0) {
        isTheFieldFilled($usernameToCheck, $errors);
        isTheFieldFilled($passwordToCheck, $errors);

        validateMaxLength($usernameToCheck, $username_Max_Length, $errors);
        validateMaxLength($passwordToCheck, $password_Max_Length, $errors);

        if (count($errors) == 0) {
            validateUsername($usernameToCheck, $errors);
            validatePassword($passwordToCheck, $errors);

            if (count($errors) == 0) {
                checkData();
            }
        } else {
            foreach ($errors as $err) {
                echo $err . "<br>";
            }
            echo "Моля поправете грешките!" . "<br>";
        }
    } else {
        foreach ($errors as $err) {
            echo $err . "<br>";
        }
        echo "Моля поправете грешките!" . "<br>";
    }
}
