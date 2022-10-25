<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $quiz_id = $_POST['quiz_id'];
    $student_id = $_POST['student_id'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $x1 = $_POST['x'];
    $score = 0;
    // Checks the correct answers
    for($x = 1; $x <= $x1; $x++) {
        $x2 = $_POST["x-$x"];
		$q = $_POST["q-$x2"];

        $sql = "SELECT * FROM quiz_question WHERE quiz_question_id = $x2";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        if($row['answer'] == $q) {
            $score = $score + 1;
        }
    }
    
    // $sql2 = "UPDATE quiz_student SET  
    // grade = '$score',
    // items = '". "'
    // WHERE quiz_id = $quiz_id AND student_id = $student_id;
    // ";
    mysqli_query($conn,"UPDATE quiz_student SET `grade` = '".$score."', items = '".($x-1)."' 
    WHERE quiz_id = '$quiz_id' and student_id = '$student_id'")or die(mysqli_error());
    
    unset($_SESSION['duration']);
    unset($_SESSION['start_time']);
    unset($_SESSION['end_time']);

    $sql_ad = "SELECT * FROM students_tbl WHERE student_id =".$_SESSION['studentId'];
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['fname']." ".$row_ad['lname'];

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y h:i:s');
    $role = "Student";

    $action_details = $user_name." submitted an attempt on a quiz in ".$subject_name." (".$subject_code.").";

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Submitted an attempt on a quiz', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);
    
    header("location:".SITEURL."student/quiz.php?id=$quiz_id");



    // Add timer
    // Save the score into database
    // Create Grades table 

}
?>

