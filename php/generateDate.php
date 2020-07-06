<?php
include './db_connection.php';
$input_json = file_get_contents('php://input');
$input = json_decode($input_json);

$date = $input->date;
$startHour =  $input->start;
$endHour =  $input->end;
$durationPresentation =  $input->duration;
$room = $input->room;
$day = $input->day;

$interval = " ";
$startDate = $date . $interval . $startHour;
$endDate = $date . $interval . $endHour;

function getCountBetweenTwoDates($startDate, $endDate)
{
    try {
        $conn = dbConnection();
        $sql = "SELECT timeDate FROM dates";
        $sql = "SELECT count(timeDate) FROM dates where timedate between :startDate and :endDate";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":startDate", $startDate);
        $stmt->bindParam(":endDate", $endDate);
        $stmt->execute() or die("Failed to query from DB!");
        return $stmt->fetchColumn();
        $conn = null;
    } catch (PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
        return false;
    }
}

function getDay (){
    try {
        $conn = dbConnection();
        $sql = "SELECT max(day) FROM dates";
        $stmt = $conn->prepare($sql);
        $stmt->execute() or die("Failed to query from DB!");
        return $stmt->fetchColumn();
        $conn = null;
    } catch (PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
        return false;
    }
}
function getLastDate (){
    try {
        $conn = dbConnection();
        $sql = "SELECT max(timeDate) FROM dates";
        $stmt = $conn->prepare($sql);
        $stmt->execute() or die("Failed to query from DB!");
        return $stmt->fetchColumn();
        $conn = null;
    } catch (PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
        return false;
    }
}
function createPresentationSlots($duration, $start, $end, $date, $room, $day)
{
    $count = getCountBetweenTwoDates($start, $end);
    $hours = 0;
    $maxDay=getDay();
    $lastdate=getLastDate();
    if ($count == 0 && $maxDay<$day ) {
        $start_time = $start;
        $end_time = $end;
        while (strtotime('+' . $duration . ' minutes', strtotime($start_time)) <= strtotime($end_time)) {
            $end = date('Y-m-d H:i', strtotime('+' . $duration . ' minutes', strtotime($start_time)));
            insertDateSlots($start_time, $end, $duration, $room, $day);
            $start_time = $end;
            $hours++;
        }
        if ($hours == 0) {
            echo "Не може да генерирате часове в този интервал. Няма да име време за презентиране!";
        } else {
            return true;
        }
    } else if( $maxDay>=$day){
        echo "Последният генериран ден е Ден $maxDay на дата $lastdate.";
    }else {
        echo "Вече сте генерирали часове за този времеви интервал! Моля генерирайте пак!";
    }
}
$result = createPresentationSlots($durationPresentation, $startDate, $endDate, $date, $room, $day);
echo $result;
function insertDateSlots($date, $end, $durationPresentation, $room, $day)
{
    try {
        $conn = dbConnection();
        $sql = "INSERT INTO dates (timeDate, timeEnd, duration, room, day) values (:datePlaceholder, :timeEndPlaceholder, :durationPlaceholder, :roomPlaceholder, :dayPlaceholder);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":datePlaceholder", $date);
        $stmt->bindParam(":timeEndPlaceholder", $end);
        $stmt->bindParam(":durationPlaceholder", $durationPresentation);
        $stmt->bindParam(":roomPlaceholder", $room);
        $stmt->bindParam(":dayPlaceholder", $day);
        $stmt->execute() or die("Failed!");
        $conn = null;
    } catch (PDOException $error) {
        echo ("Проблем със свързването с базата.Моля опитайте пак по-късно.");
        return false;
    }
}
?>