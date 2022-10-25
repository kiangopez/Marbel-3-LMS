<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwd_repeat = $_POST['pwd_repeat'];

    require_once "functions.inc.php";

    if (emptyInputAdmin($full_name, $uid, $pwd, $pwd_repeat) !== false ) {
        header("location:".SITEURL."admin/manage-admin.php?error=emptyinput");
        exit();
    }

    if (invalidUid($uid) !== false ) {
        header("location:".SITEURL."admin/manage-admin.php?error=invaliduid");
        exit();
    }

    if (pwdMatch($pwd, $pwd_repeat) !== false ) {
        header("location:".SITEURL."admin/manage-admin.php?error=passwordsdontmatch");
        exit();
    }

    if (adminUidExists($conn, $uid) !== false ) {
        header("location:".SITEURL."admin/manage-admin.php?error=uidtaken");
        exit();
    }

    createAdmin($conn, $full_name, $uid, $pwd);
  
}