<?php 
    include "../config/constants.php";
    session_start();
    session_unset();
    session_destroy();

    $id = $_GET['id'];

    $sql_ad = "SELECT * FROM teachers_tbl WHERE teacher_id = $id;";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['fname']." ".$row_ad['lname'];
    $role = "Teacher";


    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y h:i:s');

    $action_details = $user_name." logged out on ".$date_today;

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Logout', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);


    header("location:".SITEURL."teacher/teacher-login.php");