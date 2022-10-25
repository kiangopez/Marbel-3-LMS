<?php 
    // AUTHORIZATION - ACCESS CONTROL
    // Check whether the user is logged in or not
    if(!isset($_SESSION['adminUid'])) { //If user is not set 
        // User is not logged in
        // Redirect to login page
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel</div>";
        header('location:'.SITEURL.'admin/admin-login.php');
    }