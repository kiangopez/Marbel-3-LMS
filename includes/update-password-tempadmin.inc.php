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
        header("location:".SITEURL."tempadmin/profile.php?error=wrongcurrentpassword&id=$id");
        exit();
    }

    require_once "functions.inc.php";

    if (pwdMatch($new_password, $confirm_password) !== false ) {
        header("location:".SITEURL."tempadmin/profile.php?error=passwordsdontmatch&id=$id");
        exit();
    }

    $sql1 =  "UPDATE admin_tbl SET password = ? WHERE id = $id;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
        header("location:".SITEURL."tempadmin/profile.php?error=stmtfailed&id=$id");
        exit();
    } 

    $hashedPwd1 = password_hash($confirm_password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "s", $hashedPwd1);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $action_details = $user_name." performed a change password.";

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Change Password', '$action_details', $role);";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    header("location:".SITEURL."tempadmin/profile.php?id=$id");
    $_SESSION['updatePassword'] = "<div class='success p-20'>Password Successfully Updated</div>";
    exit();
}