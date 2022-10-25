<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $urn = $_POST['URN'];
    $id = $_POST['id'];
    

    require_once "functions.inc.php";


    if (emptyInputTeacherUpdate($fname, $mname, $lname) !== false ) {
        header("location:".SITEURL."admin/manage-teachers.php?page=1&error=emptyinput");
        exit();
    }


    adminTeacherProfileUpdate($conn, $fname, $mname, $lname, $email, $urn, $id);
}