<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $urn = mysqli_real_escape_string($conn, $_POST['URN']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $current_image = $_POST['current_image'];
    

    require_once "functions.inc.php";


    if (emptyInputTeacherUpdate($fname, $mname, $lname) !== false ) {
        header("location:".SITEURL."teacher/teacher-profile.php?error=emptyinput&id=$id");
        exit();
    }
    if (invalidEmail($email) !== false ) {
        header("location:".SITEURL."teacher/teacher-profile.php?error=invalidEmail&id=$id");
        exit();
    }


    teacherProfileUpdate($conn, $urn, $fname, $mname, $lname, $email, $id, $current_image);
}