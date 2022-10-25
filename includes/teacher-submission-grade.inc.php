<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $sb_id = $_POST['sb_id'];
    $student_submission_id = $_POST['student_submission_id'];
    $grade = $_POST['grade'];

    $sql = "UPDATE student_submission SET grade = $grade WHERE student_submission_id = $student_submission_id;";
    $res = mysqli_query($conn, $sql);

    if(!$res) {
        header("location:".SITEURL."teacher/view-submissions.php?id=$sb_id&error=stmterror");
    } else {
        $_SESSION['grade'] = "<div class='success p-20'>Grade Successfully Updated</div>";
        header("location:".SITEURL."teacher/view-submissions.php?id=$sb_id");
    }

}