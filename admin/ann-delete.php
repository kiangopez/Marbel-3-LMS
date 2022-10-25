<?php include "../config/constants.php"; ?>

<?php 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $_GET['user']; 
    $admin_id = $_GET['user_id'];

    if ($user == "admin") {
        $sql = "DELETE FROM ann_admin WHERE id=$id;";
        $res = mysqli_query($conn, $sql);

            $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
            $res_ad = mysqli_query($conn, $sql_ad);
            $row_ad = mysqli_fetch_assoc($res_ad);
            $user_name = $row_ad['full_name'];
        
            date_default_timezone_set('Asia/Manila');
            $date_today = date('d-m-y h:i:s');
        
            $action_details = $user_name." deleted an announcement to admin page.";
        
            $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details) VALUES ('$user_name' , '$date_today', 'Deleted an Announcement', '$action_details');";
            $res_user_log = mysqli_query($conn, $sql_user_log);

        header("location:".SITEURL."admin/admin-announcement.php?delete=success");
    } else if ($user == "student") {
        $sql = "DELETE FROM ann_student WHERE id=$id;";
        $res = mysqli_query($conn, $sql);

            $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
            $res_ad = mysqli_query($conn, $sql_ad);
            $row_ad = mysqli_fetch_assoc($res_ad);
            $user_name = $row_ad['full_name'];
        
            date_default_timezone_set('Asia/Manila');
            $date_today = date('d-m-y h:i:s');
        
            $action_details = $user_name." deleted an announcement to student page.";
        
            $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details) VALUES ('$user_name' , '$date_today', 'Deleted an Announcement', '$action_details');";
            $res_user_log = mysqli_query($conn, $sql_user_log);
        header("location:".SITEURL."admin/admin-announcement.php?delete=success");
    } else if ($user == "teacher") {
        $sql = "DELETE FROM ann_teacher WHERE id=$id;";
        $res = mysqli_query($conn, $sql);

            $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
            $res_ad = mysqli_query($conn, $sql_ad);
            $row_ad = mysqli_fetch_assoc($res_ad);
            $user_name = $row_ad['full_name'];
        
            date_default_timezone_set('Asia/Manila');
            $date_today = date('d-m-y h:i:s');
        
            $action_details = $user_name." deleted an announcement to teacher page.";
        
            $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details) VALUES ('$user_name' , '$date_today', 'Deleted an Announcement', '$action_details');";
            $res_user_log = mysqli_query($conn, $sql_user_log);

        header("location:".SITEURL."admin/admin-announcement.php?delete=success");
    }
}