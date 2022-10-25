<?php
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $file_id = $_POST['file_id'];
    $subject_id = $_POST['subject_id'];
    $user_id = $_POST['user_id'];

    $status = "inactive";

    $sql = "UPDATE files SET status = '$status' WHERE file_id = $file_id;";
    $res = mysqli_query($conn, $sql);

    $sql3 = "SELECT * FROM subjects_tbl WHERE subject_id = $subject_id";
    $res3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($res3);

    $sql2 = "SELECT * FROM teachers_tbl WHERE teacher_id = $user_id";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);
    $user_name = $row2['fname']." ".$row2['lname'];

    date_default_timezone_set('Asia/Manila');
    $date = date('d-m-y H:i:s');

    $action_details = "Removed file in the subject ".$row3['subject_name']." (".$row3['subject_code'].").";
    $role = "Teacher";

    $sql55 = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date', 'Removed File', '$action_details', '$role');";
    $res55 = mysqli_query($conn, $sql55);

    header("location:".SITEURL."teacher/upload-file.php?subj_id=$subject_id&user_id=$user_id");
    $_SESSION['fileRemove'] = "<div class='success p-0'>File Removed Successfully</div>";
}