<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $cat_name = htmlspecialchars($_POST['cat-name']);
    $cat_code = htmlspecialchars($_POST['cat-code']);
    $admin_id = $_POST['admin_id'];

    require_once "functions.inc.php";

    if (emptyInputCategoryUpdate($cat_name, $cat_code) !== false ) {
        header("location: ../admin/manage-subjects.php?error=emptyinput");
        exit();
    }

    updateCategory($conn, $id, $cat_name, $cat_code, $admin_id);
}