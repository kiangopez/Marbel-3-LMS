<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $quiz_id = $_POST['quiz_id'];
    $student_id = $_POST['student_id'];
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
    
    header("location:".SITEURL."student/quiz.php?id=$quiz_id");



    // Add timer
    // Save the score into database
    // Create Grades table 

}
?>

