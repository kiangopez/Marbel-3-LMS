<?php 

include "../config/constants.php";
if(isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $student_subject_id = $_POST['student_subject_id'];
    $admin_id = $_POST['admin_id'];

    $sql1 = "SELECT * FROM students_tbl WHERE student_id = $student_id";
    $res1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($res1);
    $fname = $row1['fname'];
    $mname = $row1['mname'];
    $lname = $row1['lname'];
    $usn = $row1['USN'];

    $sql = "DELETE FROM student_subject WHERE student_subject_id = $student_subject_id;";
    $res = mysqli_query($conn, $sql);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $action_details = $user_name." removed subject(s) from the student ".$fname." ".$mname. " ".$lname." (".$usn.")" ;

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Removed Student Subjects', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    header("location:".SITEURL."admin/enrolled-subjects.php?id=$student_id");
    $_SESSION['Unassign'] = "<div class='success'>Subject unassigned successfully</div>";
}
