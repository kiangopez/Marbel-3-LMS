<?php 
    include "../config/constants.php";
    // $student_id = $_GET['id'];

    // // $sql1 = "SELECT * FROM user_log WHERE user_id = $student_id ORDER BY user_id DESC LIMIT 1;";
    // // $res1 = mysqli_query($conn, $sql1);
    // // $row1 = mysqli_fetch_assoc($res1);

    // date_default_timezone_set('Asia/Manila');
    // $date = date('d-m-y h:i:s');

    // $sql = "UPDATE user_log SET logout_date = '$date';";
    // $res = mysqli_query($conn, $sql);

    session_unset();
    session_destroy();

    

    header("location:".SITEURL."student/student-login.php");