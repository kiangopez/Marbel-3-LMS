<?php

include "../config/constants.php";

$status = $_GET['status'];
$sb_id = $_GET['id'];
$subj_id = $_GET['subj_id'];
$admin_id = $_GET['user_id'];


if($status == "inactive") {
    $sql = "UPDATE file_submission SET status = 'active' WHERE submission_id = $sb_id";
    $res = mysqli_query($conn, $sql);


    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];

    $sql_sub = "SELECT * FROM subjects_tbl WHERE subject_id = $subj_id;";
    $res_sub = mysqli_query($conn, $sql_sub);
    $row_sub = mysqli_fetch_assoc($res_sub);

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y h:i:s');
    $role = "Administrator";

    $action_details = "Quiz Submission has been set to active at subject ".$row_sub['subject_name']." (".$row_sub['subject_code'].")";

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'set quiz submission to active', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);


    header("location:".SITEURL."admin/submission.php?id=$subj_id");
    $_SESSION['quizStatus'] = "<div class='success p-20 mt-20'>Quiz status updated successfully</div>";
} else if ($status == "active") {
    $sql1 = "UPDATE file_submission SET status = 'inactive' WHERE submission_id = $sb_id";
    $res1 = mysqli_query($conn, $sql1);


    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];

    $sql_sub = "SELECT * FROM subjects_tbl WHERE subject_id = $subj_id;";
    $res_sub = mysqli_query($conn, $sql_sub);
    $row_sub = mysqli_fetch_assoc($res_sub);

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y h:i:s');
    $role = "Administrator";

    $action_details = "Quiz Submission has been set to inactive at subject ".$row_sub['subject_name']." (".$row_sub['subject_code'].")";

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'set quiz submission to inactive', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);


    header("location:".SITEURL."admin/submission.php?id=$subj_id");
    $_SESSION['quizStatus'] = "<div class='success p-20 mt-20'>Quiz status updated successfully</div>";
}