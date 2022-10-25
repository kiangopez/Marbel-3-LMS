<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $usn = $_POST['usn'];
    $id = $_POST['id'];
    

    require_once "functions.inc.php";


    if (emptyInputStudentUpdate($fname, $mname, $lname) !== false ) {
        header("location:".SITEURL."admin/manage-students.php?page=1&error=emptyinput");
        exit();
    }


    adminStudentProfileUpdate($conn, $fname, $mname, $lname, $email, $usn, $id);
}