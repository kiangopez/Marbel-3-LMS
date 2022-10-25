<?php 

include "../config/constants.php";

if(isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $subject_id = $_POST['subj_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $limit = $_POST['limit'] * 60;
    $quarter = $_POST['quarter'];
    $admin_id = $_POST['admin_id'];


    $sql = "SELECT * FROM admin_tbl WHERE id = $user_id;";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $full_name = $row['full_name'];

    date_default_timezone_set('Asia/Manila');
    $date = date('d-m-y H:i:s');

    $sql1 = "INSERT INTO quiz (subject_id, quiz_title, quiz_description, date_added, added_by, time_limit, quarter, status)
    VALUES ($subject_id, '$title', '$description', '$date', '$full_name', $limit, $quarter, 'inactive');";
    $res1 = mysqli_query($conn, $sql1);

    if($res1 == TRUE) {
        $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
        $res_ad = mysqli_query($conn, $sql_ad);
        $row_ad = mysqli_fetch_assoc($res_ad);
        $user_name = $row_ad['full_name'];

        $sql_sub = "SELECT * FROM subjects_tbl WHERE subject_id = $subject_id;";
        $res_sub = mysqli_query($conn, $sql_sub);
        $row_sub = mysqli_fetch_assoc($res_sub);
    
        date_default_timezone_set('Asia/Manila');
        $date_today = date('d-m-y H:i:s');
    
        $action_details = "Quiz has been added at ".$row_sub['subject_name']." (".$row_sub['subject_code'].")";
        $role = "Administrator";

        $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Added Quiz', '$action_details', '$role');";
        $res_user_log = mysqli_query($conn, $sql_user_log);


        header("location:".SITEURL."admin/quiz.php?id=$subject_id");
        $_SESSION['addQuiz'] = "<div class='success p-20 mt-20'>Quiz added successfully!</div>";
    } else {
        header("location:".SITEURL."admin/quiz.php?id=$subject_id&error=stmterror");
        $_SESSION['addQuiz'] = "<div class='error p-20 mt-20'>Failed to add quiz</div>";
    }
}
