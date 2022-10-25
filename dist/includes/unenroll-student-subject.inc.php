<?php 

include "../config/constants.php";
if(isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $student_subject_id = $_POST['student_subject_id'];

    $sql = "DELETE FROM student_subject WHERE student_subject_id = $student_subject_id;";
    $res = mysqli_query($conn, $sql);


    header("location:".SITEURL."admin/enrolled-subjects.php?id=$student_id");
    $_SESSION['Unassign'] = "<div class='success'>Subject unassigned successfully</div>";
}
