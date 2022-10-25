<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $cat_name = $_POST['cat-name'];
    $cat_code = $_POST['cat-code'];

    require_once "functions.inc.php";

    if (emptyInputCategoryUpdate($cat_name, $cat_code) !== false ) {
        header("location: ../admin/manage-subjects.php?error=emptyinput");
        exit();
    }

    updateCategory($conn, $id, $cat_name, $cat_code);
}