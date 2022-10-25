<?php 

include "../config/constants.php";
if(isset($_POST['submit'])) {
    $urn = $_POST['urn'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwd_repeat = $_POST['pwd_repeat'];

    require_once "functions.inc.php";

    if (emptyInputTeacher($urn, $fname, $lname, $mname, $email, $pwd, $pwd_repeat) !== false ) {
        header("location:".SITEURL."admin/manage-teachers.php?error=emptyinput&page=1");
        exit();
    }
    if (invalidEmail($email) !== false ) {
        header("location:".SITEURL."admin/manage-teachers.php?error=invalidemail&page=1");
        exit();
    }
    if (pwdMatch($pwd, $pwd_repeat) !== false ) {
        header("location:".SITEURL."admin/manage-teachers.php?error=passworddontmatch&page=1");
        exit();
    }
    if (urnExists($conn, $urn) !== false ) {
        header("location:".SITEURL."admin/manage-teachers.php?error=urnalreadyexists&page=1");
        exit();
    }

    createTeacher($conn, $urn, $fname, $lname, $mname, $email, $pwd);

}
