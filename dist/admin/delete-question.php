<?php
include "../config/constants.php";

$id = $_GET['id'];
$quiz_id = $_GET['quiz_id'];

$sql = "DELETE FROM quiz_question WHERE quiz_question_id = $id";
$res = mysqli_query($conn, $sql);

if($res) {
    header("location:".SITEURL."admin/questions.php?id=$quiz_id");
    $_SESSION['deleteQuestion'] = "<div class='success p-20 mt-20'>Question Successfully Deleted</div>";
} else {
    header("location:".SITEURL."admin/questions.php?id=$quiz_id&error=stmtfailed");
}