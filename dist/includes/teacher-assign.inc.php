<?php 

include "../config/constants.php";
if(isset($_POST['submit'])) {
    $teacher_id = $_POST['teacher_id'];
    $subject_id = $_POST['subject_id'];
    
    function duplicateSubject(){
        //dont allow duplicate subjects per teacher
        
    }

    foreach($subject_id as $item) {
        $sql = "INSERT INTO teacher_subject (teacher_id, subject_id) VALUES ($teacher_id, $item);";
        $res = mysqli_query($conn, $sql);
    }


    header("location:".SITEURL."admin/subjects-handled.php?id=$teacher_id");
}
