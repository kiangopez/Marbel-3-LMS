<?php

include "../config/constants.php";

$status = $_GET['status'];
$term_id = $_GET['id'];
$admin_id = $_GET['user_id'];

if($status == "inactive") {

    $sql2 = "SELECT * FROM term WHERE status = 'active';";
    $res2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($res2);

    if($count2 > 0) {
        $_SESSION['check'] = "<div class='error-b'><p>There is an active term already!</p></div>";
        header("location:".SITEURL."admin/manage-subjects.php");
    } else {
        $sql = "UPDATE term SET status = 'active' WHERE term_id = $term_id";
        $res = mysqli_query($conn, $sql);
    
    
        $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
        $res_ad = mysqli_query($conn, $sql_ad);
        $row_ad = mysqli_fetch_assoc($res_ad);
        $user_name = $row_ad['full_name'];
    
        $sql_sub = "SELECT * FROM term WHERE term_id = $term_id;";
        $res_sub = mysqli_query($conn, $sql_sub);
        $row_sub = mysqli_fetch_assoc($res_sub);
    
        date_default_timezone_set('Asia/Manila');
        $role = "Administrator";
        $date_today = date('d-m-y h:i:s');
    
        $action_details = $row_sub['session']." "."Term has been set to active";
    
        $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'set term to active', '$action_details', '$role');";
        $res_user_log = mysqli_query($conn, $sql_user_log);

    }



    header("location:".SITEURL."admin/manage-subjects.php");
    $_SESSION['termStatus'] = "<div class='success p-20 mt-20'>Term status updated successfully</div>";

} else if ($status == "active") {
    $sql1 = "UPDATE term SET status = 'inactive' WHERE term_id = $term_id";
    $res1 = mysqli_query($conn, $sql1);


    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];

    $sql_sub = "SELECT * FROM term WHERE term_id = $term_id;";
    $res_sub = mysqli_query($conn, $sql_sub);
    $row_sub = mysqli_fetch_assoc($res_sub);

    date_default_timezone_set('Asia/Manila');
    $role = "Administrator";
    $date_today = date('d-m-y h:i:s');

    $action_details = $row_sub['session']." "."Term has been set to inactive";

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'set term to inactive', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);


    header("location:".SITEURL."admin/manage-subjects.php");
    $_SESSION['termStatus'] = "<div class='success p-20 mt-20'>Term status updated successfully</div>";
}