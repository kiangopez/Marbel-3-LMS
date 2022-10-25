<?php 

include "../config/constants.php";
if(isset($_POST['submit'])) {
    $teacher_id = $_POST['teacher_id'];
    $teacher_subject_id = $_POST['teacher_subject_id'];

    $sql = "DELETE FROM teacher_subject WHERE teacher_subject_id = $teacher_subject_id;";
    $res = mysqli_query($conn, $sql);


    header("location:".SITEURL."admin/subjects-handled.php?id=$teacher_id");
    $_SESSION['Unassign'] = "<div class='success'>Subject unassigned successfully</div>";
}
