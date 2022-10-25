<?php

include "../config/constants.php";

$id = $_GET['id'];
$sql = "DELETE FROM admin_tbl WHERE id=$id;";
$res = mysqli_query($conn, $sql);

if($res == false) {
    header("location:".SITEURL."admin/manage-admin.php?error=invalidstmt");
    $_SESSION['delete'] = "<div>Failed to Update Admin</div>";
} else {
    header("location:".SITEURL."admin/manage-admin.php?error=none");
    $_SESSION['delete'] = "<div>Admin Successfully Deleted</div>";
}

exit();