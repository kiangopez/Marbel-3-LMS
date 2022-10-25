<?php
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $urn = $_POST['URN'];
    $pwd = $_POST['pwd'];

    require_once 'functions.inc.php';

    if (emptyInputLogin($urn, $pwd) !== false ) {
        header("location:".SITEURL."teacher/teacher-login.php?error=emptyinput");
        exit();
    }

    loginTeacher($conn, $urn, $pwd);
} else {
    header("location:".SITEURL."teacher/teacher-login.php?error=invalidlogin");
    exit();
}