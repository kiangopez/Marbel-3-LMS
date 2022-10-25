<?php 

include "../config/constants.php";

if(isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $subject_id = $_POST['subj_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $end_date = date('d-m-y', strtotime($_POST['end_date']));
    $quarter = $_POST['quarter'];
    $teacher_id = $_POST['teacher_id'];


    $sql = "SELECT * FROM teachers_tbl WHERE teacher_id = $user_id;";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $full_name = $row['fname']." ".$row['lname'];

    date_default_timezone_set('Asia/Manila');
    $date = date('d-m-y H:i:s');

    $sql1 = "INSERT INTO file_submission (subject_id, title, sub_description, quarter, status, date_added, end_date, added_by)
    VALUES ($subject_id, '$title', '$description', '$quarter', 'inactive', '$date', '$end_date', '$full_name');";
    $res1 = mysqli_query($conn, $sql1);

    if($res1 == TRUE) {
        $sql_ad = "SELECT * FROM teachers_tbl WHERE teacher_id = $teacher_id";
        $res_ad = mysqli_query($conn, $sql_ad);
        $row_ad = mysqli_fetch_assoc($res_ad);
        $user_name = $row_ad['fname']." ".$row_ad['lname'];

        $sql_sub = "SELECT * FROM subjects_tbl WHERE subject_id = $subject_id;";
        $res_sub = mysqli_query($conn, $sql_sub);
        $row_sub = mysqli_fetch_assoc($res_sub);
    
        date_default_timezone_set('Asia/Manila');
        $date_today = date('d-m-y H:i:s');
    
        $action_details = "Quiz Submission has been added at ".$row_sub['subject_name']." (".$row_sub['subject_code'].")";
        $role = "Teacher";

        $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Added Quiz Submission', '$action_details', '$role');";
        $res_user_log = mysqli_query($conn, $sql_user_log);


        header("location:".SITEURL."teacher/submission.php?id=$subject_id");
        $_SESSION['addQuiz'] = "<div class='success p-20 mt-20'>Quiz added successfully!</div>";
    } else {
        header("location:".SITEURL."teacher/submission.php?id=$subject_id&error=stmterror");
        $_SESSION['addQuiz'] = "<div class='error p-20 mt-20'>Failed to add quiz submission</div>";
    }
}
