<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT * FROM admin_tbl WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    $pwdHashed = $row["password"];
    $checkPwd = password_verify($current_password, $pwdHashed);

    if($checkPwd === false) {
        header("location:".SITEURL."admin/admin-profile.php?error=wrongcurrentpassword&id=$id");
        exit();
    }

    require_once "functions.inc.php";

    if (pwdMatch($new_password, $confirm_password) !== false ) {
        header("location:".SITEURL."admin/admin-profile.php?error=passwordsdontmatch&id=$id");
        exit();
    }

    $sql1 =  "UPDATE admin_tbl SET password = ? WHERE id = $id;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
        header("location:".SITEURL."admin/admin-profile.php?error=stmtfailed&id=$id");
        exit();
    } 

    $hashedPwd1 = password_hash($confirm_password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "s", $hashedPwd1);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location:".SITEURL."admin/admin-profile.php?id=$id");
    $_SESSION['updatePassword'] = "<div class='success p-20'>Password Successfully Updated</div>";
    exit();
}