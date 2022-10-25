<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $usn = mysqli_real_escape_string($conn, $_POST['usn']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $current_image = $_POST['current_image'];
    

    require_once "functions.inc.php";


    if (emptyInputStudentUpdate($fname, $mname, $lname) !== false ) {
        header("location:".SITEURL."student/student-profile.php?error=emptyinput&id=$id");
        exit();
    }
    if (invalidEmail($email) !== false ) {
        header("location:".SITEURL."student/student-profile.php?error=invalidEmail&id=$id");
        exit();
    }


    studentProfileUpdate($conn, $fname, $mname, $lname, $email, $usn, $id, $current_image);
}