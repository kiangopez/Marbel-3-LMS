<?php
include "../config/constants.php";

$id = $_GET['id'];
$admin_id = $_GET['user_id'];

$sql_cat = "SELECT * FROM term WHERE term_id = $id";
$res_cat = mysqli_query($conn, $sql_cat);
$row_cat = mysqli_fetch_assoc($res_cat);

$action_details = $row_cat['session']." term has been deleted";

$sql = "DELETE FROM term WHERE term_id = $id";
$res = mysqli_query($conn, $sql);

$sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
$res_ad = mysqli_query($conn, $sql_ad);
$row_ad = mysqli_fetch_assoc($res_ad);
$user_name = $row_ad['full_name'];

date_default_timezone_set('Asia/Manila');
$date_today = date('d-m-y h:i:s');
$role = "Administrator";

$sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Deleted Term', '$action_details', '$role');";
$res_user_log = mysqli_query($conn, $sql_user_log);

if($res) {
    header("location:".SITEURL."admin/manage-subjects.php");
    $_SESSION['deleteCategory'] = "<div class='success p-20 mt-20'>Term Successfully Deleted</div>";
} else {
    header("location:".SITEURL."admin/manage-subjects.php?error=stmtfailed");
}