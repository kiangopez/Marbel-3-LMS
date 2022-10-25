<?php 
    include "../config/constants.php";
    session_start();
    session_unset();
    session_destroy();
    header("location:".SITEURL."admin/admin-login.php");