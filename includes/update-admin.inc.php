<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $uid = $_POST['uid'];
    $id = $_POST['id'];

    require_once "functions.inc.php";


    if (emptyInputUpdateAdmin($full_name, $uid) !== false ) {
        header("location:".SITEURL."admin/manage-admin.php?error=emptyinput");
        exit();
    }

    if (invalidUid($uid) !== false ) {
        header("location:".SITEURL."admin/manage-admin.php?error=invaliduid");
        exit();
    }

    updateAdmin($conn, $full_name, $uid, $id);
}