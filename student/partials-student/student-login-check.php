<?php 
    // AUTHORIZATION - ACCESS CONTROL
    // Check whether the user is logged in or not
    if(!isset($_SESSION['studentUid'])) { //If user is not set 
        // User is not logged in
        // Redirect to login page
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access LMS Portal</div>";
        header('location:'.SITEURL.'student/student-login.php');
    }