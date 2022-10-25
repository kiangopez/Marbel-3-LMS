<?php 

include "../config/constants.php";

if(isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $subject_id = $_POST['subj_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $limit = $_POST['limit'] * 60;
    $quarter = $_POST['quarter'];


    $sql = "SELECT * FROM teachers_tbl WHERE teacher_id = $user_id;";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $full_name = $row['fname']." ".$row['lname'];

    date_default_timezone_set('Asia/Manila');
    $date = date('d-m-y h:i:s');

    $sql1 = "INSERT INTO quiz (subject_id, quiz_title, quiz_description, date_added, added_by, time_limit, quarter, status)
    VALUES ($subject_id, '$title', '$description', '$date', '$full_name', $limit, $quarter, 'inactive');";
    $res1 = mysqli_query($conn, $sql1);

    if($res1 == TRUE) {
        header("location:".SITEURL."teacher/quiz.php?id=$subject_id");
        $_SESSION['addQuiz'] = "<div class='success p-20 mt-20'>Quiz added successfully!</div>";
    } else {
        header("location:".SITEURL."teacher/quiz.php?id=$subject_id&error=stmterror");
        $_SESSION['addQuiz'] = "<div class='error p-20 mt-20'>Failed to add quiz</div>";
    }
}
