<?php 

include "../config/constants.php";

if(isset($_POST['cancel'])) {
    header("location:".SITEURL."teacher/teacher-login.php");
}

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    $np = strlen($new_password);

    $sql = "SELECT * FROM teachers_tbl WHERE teacher_id = $id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    require_once "../includes/functions.inc.php";

    if(empty($new_password) || empty($confirm_password)) {
        $_SESSION['forgot-message'] = "<p>Please fill up all fields</p>";
        header("location:".SITEURL."teacher/forgot-password.php");
        exit();
     }

    if (pwdMatch($new_password, $confirm_password) !== false ) {
        $_SESSION['forgot-message'] = "<p>Passwords do not match</p>";
        header("location:".SITEURL."teacher/forgot-password.php");
        exit();
    }

    if($np < 6) {
        header("location:".SITEURL."teacher/forgot-password.php");
        $_SESSION['forgot-message'] = "<p class='error'>Passwords should contain <br/> atleast 6 characters</p>";
        exit();
    } else if ($np > 16) {
        header("location:".SITEURL."teacher/forgot-password.php");
        $_SESSION['forgot-message'] = "<p class='error'>Passwords should contain <br/> with a maximum of 16 characters</p>";
        exit();
    }

    $sql1 =  "UPDATE teachers_tbl SET password = ? WHERE teacher_id = $id;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
        header("location:".SITEURL."teacher/forgot-password.php?error=stmtfailed&id=$id");
        exit();
    } 

    $hashedPwd1 = password_hash($confirm_password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "s", $hashedPwd1);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location:".SITEURL."teacher/teacher-login.php?success=passwordSuccess");
    $_SESSION['updatePassword'] = "<div class='success'>Password Successfully Updated</div>";
    exit();
}