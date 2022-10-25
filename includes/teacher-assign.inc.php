<?php 

include "../config/constants.php";
if(isset($_POST['submit'])) {
    $teacher_id = $_POST['teacher_id'];
    $subject_id = $_POST['subject_id'];
    $admin_id = $_POST['admin_id'];

    $sql1 = "SELECT * FROM teachers_tbl WHERE teacher_id = $teacher_id";
    $res1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($res1);
    $fname = $row1['fname'];
    $mname = $row1['mname'];
    $lname = $row1['lname'];
    $usn = $row1['URN'];
    
    function duplicateSubject(){
        //dont allow duplicate subjects per teacher
        
    }

    foreach($subject_id as $item) {
        $sql = "INSERT INTO teacher_subject (teacher_id, subject_id) VALUES ($teacher_id, $item);";
        $res = mysqli_query($conn, $sql);
    }

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');
    $role = "Administrator";

    $action_details = $user_name." enrolled subjects to the student ".$fname." ".$mname. " ".$lname." (".$usn.")" ;

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Assigned Teacher Subjects', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    header("location:".SITEURL."admin/subjects-handled.php?id=$teacher_id");
}
