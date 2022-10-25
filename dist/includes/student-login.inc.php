<?php
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $uid = mysqli_real_escape_string($conn, $_POST['USN']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    require_once 'functions.inc.php';

    if (emptyInputLogin($uid, $pwd) !== false ) {
        header("location:".SITEURL."student/student-login.php");
        exit();
    }

    // userLog($conn, $uid);
    loginStudent($conn, $uid, $pwd);
} else {
    header("location:".SITEURL."admin/student-login.php");
    exit();
}