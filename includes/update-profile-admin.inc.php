<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $full_name = htmlspecialchars($_POST['full_name']);
    $uid = $_POST['uid'];
    $id = $_POST['id'];
    $current_image = $_POST['current_image'];

    require_once "functions.inc.php";


    if (emptyInputUpdateAdmin($full_name, $uid) !== false ) {
        header("location:".SITEURL."admin/admin-profile.php?error=emptyinput");
        exit();
    }

    if (invalidUid($uid) !== false ) {
        header("location:".SITEURL."admin/admin-profile.php?error=invaliduid");
        exit();
    }

    updateProfileAdmin($conn, $full_name, $uid, $id, $current_image);
}