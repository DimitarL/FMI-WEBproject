<?php
include './db_connection.php';

$date = $_POST["date"];
$startHour = $_POST["start"];
$endHour = $_POST["end"];
$durationPresentation = $_POST["duration"];
$interval = " ";
$startDate = $date . $interval . $startHour;
$endDate = $date . $interval . $endHour;


function getCountBetweenTwoDates($startDate, $endDate)
{
    $conn = dbConnection();
    $sql = "SELECT timeDate FROM dates";
    $sql = "SELECT count(timeDate) FROM dates where timedate between :startDate and :endDate";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":startDate", $startDate);
    $stmt->bindParam(":endDate", $endDate);
    $stmt->execute() or die("Failed to query from DB!");
    return $stmt->fetchColumn();
}

function createPresentationSlots($duration, $start, $end, $date)
{
    $count = getCountBetweenTwoDates($start, $end);
    $hours = 0;
    if ($count == 0) {
        $start_time = $start;
        $end_time = $end;
        while (strtotime('+' . $duration . ' minutes', strtotime($start_time)) <= strtotime($end_time)) {
            echo $start_time;
            echo '<br>';
            $end = date('Y-m-d H:i', strtotime('+' . $duration . ' minutes', strtotime($start_time)));
            $start_time = $end;
            insertDateSlots($start);  
            $hours++;
        }
        if ($hours == 0) {
            echo "Не може да генерирате часове в този интервал. Няма да име време за презентиране!";
            header("refresh:6;url=../html/generateDate.html");
        } else {
            echo "Генерирахте успешно $hours слота за $date с $duration минути продължителност.";
            header("refresh:6;url=../html/generateDate.html");
        }
    } else {
        echo "Вече сте генерирали часове за този времеви интервал! Моля генерирайте пак!";
        header("refresh:5;url=../html/generateDate.html");
    }
}
createPresentationSlots($durationPresentation, $startDate, $endDate, $date, $endHour);

function insertDateSlots($date)
{
    $conn = dbConnection();
    $sql = "INSERT INTO dates (timeDate) values (:datePlaceholder);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":datePlaceholder", $date);
    $stmt->execute() or die("Failed!");
    $conn = null;
}
