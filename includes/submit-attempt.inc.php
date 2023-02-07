<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $quiz_id = $_POST['quiz_id'];
    $student_id = $_POST['student_id'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $time_limit = $_POST['time_limit'];
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

    // Check if the current attempt is higher than the old attempt or 0
    $sql_check = "SELECT * FROM quiz_student WHERE quiz_id = $quiz_id";
    $res_check = mysqli_query($conn, $sql_check);
    $row_check = mysqli_fetch_assoc($res_check);
    $old_score = $row_check['grade'];

    if($old_score > $score) {
        $score = $old_score;
    } else if($old_score < $score) {
        $score = $score;
    }


    mysqli_query($conn,"UPDATE quiz_student SET quiz_time = $time_limit ,status = 'submitted' ,`grade` = '".$score."', items = '".($x-1)."' 
    WHERE quiz_id = '$quiz_id' and student_id = '$student_id'")or die(mysqli_error());
    
    unset($_SESSION['duration']);
    unset($_SESSION['start_time']);
    unset($_SESSION['end_time']);

    $sql_ad = "SELECT * FROM students_tbl WHERE student_id =".$_SESSION['studentId'];
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['fname']." ".$row_ad['lname'];

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');
    $role = "Student";
    $quiz_date = date('D, M d, Y');

    $action_details = $user_name." submitted an attempt on a quiz in ".$subject_name." (".$subject_code.").";

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Submitted an attempt on a quiz', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    // INSERT TO ATTEMPT TABLE
    $total_items = ($x-1);
    $sql_attempt = "INSERT INTO attempt_tbl (quiz_id, student_id, date_attempted, grade, items) VALUES ($quiz_id, $student_id, '$quiz_date', $score, $total_items);";
    $res_attempt = mysqli_query($conn, $sql_attempt);
    
    header("location:".SITEURL."student/quiz.php?id=$quiz_id");



    // Add timer
    // Save the score into database
    // Create Grades table 

}
?>

