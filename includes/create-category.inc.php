<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $cat_name = htmlspecialchars($_POST['cat-name']); 
    $cat_code = htmlspecialchars($_POST['cat-code']); 
    $admin_id = $_POST['admin_id'];
    require_once "functions.inc.php";

    if (emptyInputCategory($cat_name, $cat_code) !== false ) {
        header("location:".SITEURL."admin/manage-subjects.php?error=emptyinput");
        exit();
    }

    createCategory($conn, $cat_name, $cat_code, $admin_id);
  
}