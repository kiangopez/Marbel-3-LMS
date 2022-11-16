<?php
include "../config/constants.php";

$quiz_id = $_GET['quiz_id'];

// $sql3 = "SELECT * FROM quiz_student WHERE quiz_id = $quiz_id";
// $res3 = mysqli_query($conn, $sql3);
// $row3 = mysqli_fetch_assoc($res3);
// $quiz_time = $row3['quiz_time'];

// $sql4 = "SELECT * FROM quiz WHERE quiz_id = $quiz_id";
// $res4 = mysqli_query($conn, $sql4);
// $row4 = mysqli_fetch_assoc($res4);
// $time_limit = $row4['time_limit'];

// if($quiz_time <= $time_limit AND $quiz_time > 0){
//     $sql2 = "UPDATE quiz_student SET 
//     quiz_time = '$quiz_time - 1',
//     WHERE quiz_id = $quiz_id;
//     ";
//     $res2 = mysqli_query($conn, $sql2);

//     $init = $quiz_time;
//     $minutes = floor(($init / 60) % 60);
//     $seconds = $init % 60;
//     if($init > 59){		
//         echo "$minutes : $seconds $init";
//     } else {
//         echo "$seconds ";
//     }
// }

$stud_id = $_SESSION['studentId'];

$sql = "SELECT * FROM quiz_student WHERE quiz_id = $quiz_id";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$quiz_time = $row['quiz_time'];

$sql2 = "SELECT * FROM quiz WHERE quiz_id = $quiz_id";
$res2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($res2);
$time_limit = $row2['time_limit'];


if($quiz_time <= $time_limit AND $quiz_time > 0) {
    $sql3 = "UPDATE quiz_student SET
            quiz_time = $quiz_time - 1 
            WHERE student_id = $stud_id 
            AND quiz_id = $quiz_id";
    $res3 = mysqli_query($conn, $sql3);

    $init = $quiz_time;
	$minutes = floor(($init / 60) % 60);
    $seconds = $init % 60;
    
    if($seconds < 10){
        $seconds = "0".$seconds ;
    }
    if($minutes < 10){
        $minutes = "0".$minutes ;
    }

    $mIndicator = "minute";
    $sIndicator = "seconds";

    if($minutes >= 2) {
        $mIndicator = "minutes";
    } else {
        $mIndicator = "minute";
    }
    
    echo "$minutes $mIndicator : $seconds seconds";

	// if($init > 59){		
	// 	echo "$minutes:$seconds";
	// } else {
	// 	echo "$seconds";
	// }

}
