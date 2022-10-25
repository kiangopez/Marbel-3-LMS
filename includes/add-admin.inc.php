<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $full_name = htmlspecialchars($_POST['full_name']);
    $uid = $_POST['uid'];
    $pwd = htmlspecialchars($_POST['pwd']);
    $pwd_repeat = htmlspecialchars($_POST['pwd_repeat']);
    $admin_id = $_POST['admin_id'];
    $role = $_POST['role'];

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

    createAdmin($conn, $full_name, $uid, $pwd, $admin_id, $role);
  
}