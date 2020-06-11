<?php
Include './db_connection.php';

$date = $_POST["date"];
$startHour = $_POST["start"];
$endHour = $_POST["end"];
$durationPresentation = $_POST["duration"];
$interval=" ";
$startDate=$date . $interval . $startHour;
$endDate=$date . $interval . $endHour;


function getCountBetweenTwoDates($startDate, $endDate){
    $conn=dbConnection();
    $sql="SELECT timeDate FROM dates";
    $sql="SELECT count(timeDate) FROM dates where timedate between :startDate and :endDate";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(":startDate", $startDate);
    $stmt->bindParam(":endDate", $endDate);
    $stmt -> execute() or die("Failed to query from DB!");
    return $stmt->fetchColumn();
}

function createPresentationSlots($duration, $start,$end, $date, $endHour)
{
$count=getCountBetweenTwoDates($start, $end);
    if ($count==0){
        $start_time = $start;
        $end_time = $end;
        while(strtotime($start_time) <= strtotime($end_time) ){
            $start = $start_time;
            $end = date('Y-m-d H:i',strtotime('+'.$duration.' minutes',strtotime($start_time)));
            $start_time = $end;
            insertDateSlots($start);  
        }   
        echo "Генерирахте успешно часове за $date с $duration минути продължителност.";
        header( "refresh:6;url=../html/generateDate.html" );
    } else{
        echo "Вече сте генерирали часове за този времеви интервал! Моля генерирайте пак!";
        header( "refresh:5;url=../html/generateDate.html" ); 
    }
  }
createPresentationSlots($durationPresentation, $startDate, $endDate, $date, $endHour);

function insertDateSlots($date){
    $conn=dbConnection();
    $sql="INSERT INTO dates (timeDate) values (:datePlaceholder);";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(":datePlaceholder", $date);
    $stmt->execute() or die("Failed!");
    $conn=null;
}
?>
