<?php

include "../config/constants.php";


$id = $_GET['id'];
$s_id = $_GET['s_id'];

$sql = "DELETE FROM student_submission WHERE student_submission_id = $id";
$res = mysqli_query($conn, $sql);

if(!$res) {
    header("location:".SITEURL."student/submission.php?id=$s_id&error=stmterror");
} else {
    header("location:".SITEURL."student/submission.php?id=$s_id");
}