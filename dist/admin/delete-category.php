<?php
include "../config/constants.php";

$id = $_GET['id'];

$sql = "DELETE FROM categories_tbl WHERE category_id = $id";
$res = mysqli_query($conn, $sql);

if($res) {
    header("location:".SITEURL."admin/manage-subjects.php");
    $_SESSION['deleteCategory'] = "<div class='success p-20 mt-20'>Category Successfully Deleted</div>";
} else {
    header("location:".SITEURL."admin/manage-subjects.php?error=stmtfailed");

}