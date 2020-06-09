<?php
Include 'db_connection.php';


function createPresentationSlots($duration, $start,$end)
{
        $start_time = $start;
        $end_time = $end;
        while(strtotime($start_time) <= strtotime($end_time)){
            $start = $start_time;
            $end = date('Y-m-d H:i',strtotime('+'.$duration.' minutes',strtotime($start_time)));
            $start_time = date('Y-m-d H:i',strtotime('+'.$duration.' minutes',strtotime($start_time)));
            // echo $start;
            insertDateSlots($start);  
        }    
  }
createPresentationSlots(7, '2020-06-08 10:00AM', '2020-06-08 12:00PM');

function insertDateSlots($date){
    $conn=dbConnection();
    $sql="INSERT INTO dates (timeDate) values (:datePlaceholder);";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(":datePlaceholder", $date);
    $stmt->execute() or die("Failed!");
    $conn=null;
}
?>