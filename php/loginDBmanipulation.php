<?php

include "./db_connection.php";

$tableName = "user_information";

function checkData()
{
    global $adminTableName;
    global $userTableName;

    $username = $_POST['username'];
    $password = $_POST['password'];
    unset($_SESSION['errorMessage']);

    $connection = dbConnection();

    $sql1 = "SELECT password FROM $userTableName WHERE username = :username";
    $result1 = $connection->prepare($sql1);
    $result1->bindParam(':username', $username);

    $sql2 = "SELECT password FROM $adminTableName WHERE username = :username";
    $result2 = $connection->prepare($sql2);
    $result2->bindParam(':username', $username);

    $result1->execute() or die("Неуспешно изпълнение на заявката!");
    if ($result1->rowCount() > 0) {
        $hash = $result1->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $hash['password'])) {
            $_SESSION["role"] = "student";
            $_SESSION["username"] = $username;
            header("location: calendar.php");
        } else {
            $_SESSION['errorMessage'] = 1;
            die(header("location: loginStart.php"));
        }
    } else {
        $result2->execute() or die("Неуспешно изпълнение на заявката!");
        if ($result2->rowCount() > 0) {
            $hash = $result2->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $hash['password'])) {
                $_SESSION["role"] = "admin";
                $_SESSION["username"] = $username;
                header("location: calendar.php");
            } else {
                $_SESSION['errorMessage'] = 1;
                die(header("location: loginStart.php"));
            }
        } else {
            $_SESSION['errorMessage'] = 1;
            die(header("location: loginStart.php"));
        }
    }
}
?>