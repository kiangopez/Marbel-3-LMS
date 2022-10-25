<?php

include "../config/constants.php";

$status = $_GET['status'];
$quiz_id = $_GET['id'];
$subj_id = $_GET['subj_id'];

if($status == "inactive") {
    $sql = "UPDATE quiz SET status = 'active' WHERE quiz_id = $quiz_id";
    $res = mysqli_query($conn, $sql);
    header("location:".SITEURL."teacher/quiz.php?id=$subj_id");
    $_SESSION['quizStatus'] = "<div class='success p-20 mt-20'>Quiz status updated successfully</div>";
} else if ($status == "active") {
    $sql1 = "UPDATE quiz SET status = 'inactive' WHERE quiz_id = $quiz_id";
    $res1 = mysqli_query($conn, $sql1);
    header("location:".SITEURL."teacher/quiz.php?id=$subj_id");
    $_SESSION['quizStatus'] = "<div class='success p-20 mt-20'>Quiz status updated successfully</div>";
}