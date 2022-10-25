<?php 

include "../config/constants.php";
if(isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    
    function duplicateSubject(){
        //dont allow duplicate subjects per teacher
        
    }

    foreach($subject_id as $item) {
        $sql = "INSERT INTO student_subject (student_id, subject_id) VALUES ($student_id, $item);";
        $res = mysqli_query($conn, $sql);
    }


    header("location:".SITEURL."admin/enrolled-subjects.php?id=$student_id");
}
