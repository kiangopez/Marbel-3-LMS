<?php

include "../config/constants.php";

$id = $_GET['id'];
$admin_id = $_GET['user_id'];

$sql1 = "SELECT * FROM admin_tbl WHERE id = $id";
$res1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($res1);


$sql = "DELETE FROM admin_tbl WHERE id=$id;";
$res = mysqli_query($conn, $sql);

if($res == false) {
    header("location:".SITEURL."admin/manage-admin.php?error=invalidstmt");
    $_SESSION['delete'] = "<div>Failed to Delete Admin</div>";
} else {

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y h:i:s');
    $role = "Administrator";

    $action_details = $user_name." deleted the admin account ".$row1['username']." (".$row1['full_name'].").";

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Deleted an Admin account', '$action_details', '$role;);";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    header("location:".SITEURL."admin/manage-admin.php?error=none");
    $_SESSION['delete'] = "<div>Admin Successfully Deleted</div>";
}

exit();