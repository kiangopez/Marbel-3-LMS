<?php
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    require_once 'functions.inc.php';

    if (emptyInputLogin($uid, $pwd) !== false ) {
        header("location:".SITEURL."admin/admin-login.php");
        exit();
    }

    loginAdmin($conn, $uid, $pwd);
} else {
    header("location:".SITEURL."admin/admin-login.php");
    exit();
}