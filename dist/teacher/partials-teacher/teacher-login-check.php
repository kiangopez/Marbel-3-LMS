<?php 
    // AUTHORIZATION - ACCESS CONTROL
    // Check whether the user is logged in or not
    if(!isset($_SESSION['teacherUid'])) { //If user is not set 
        // User is not logged in
        // Redirect to login page
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Teacher's Dashboard</div>";
        header('location:'.SITEURL.'teacher/teacher-login.php');
    }