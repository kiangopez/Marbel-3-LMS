<?php 

include "../config/constants.php";
if(isset($_POST['submit'])) {
    $usn = $_POST['usn'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $email = $_POST['email'];
    $student_cat = $_POST['student_cat'];
    $pwd = $_POST['pwd'];
    $pwd_repeat = $_POST['pwd_repeat'];

    require_once "functions.inc.php";

    if (emptyInputStudent($usn, $fname, $lname, $mname, $email, $pwd, $pwd_repeat) !== false ) {
        header("location:".SITEURL."admin/manage-students.php?error=emptyinput&page=1");
        exit();
    }
    if (invalidEmail($email) !== false ) {
        header("location:".SITEURL."admin/manage-students.php?error=invalidemail&page=1");
        exit();
    }
    if (pwdMatch($pwd, $pwd_repeat) !== false ) {
        header("location:".SITEURL."admin/manage-students.php?error=passworddontmatch&page=1");
        exit();
    }
    if (usnExists($conn, $usn) !== false ) {
        header("location:".SITEURL."admin/manage-students.php?error=usnalreadyexists&page=1");
        exit();
    }

    createStudent($conn, $usn, $fname, $lname, $mname, $email, $student_cat, $pwd);

}
