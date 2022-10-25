<?php
include "../config/constants.php";

if (isset($_POST['read'])){
    $student_id = $_SESSION['studentId'];
    $id = $_POST['selector'];
    $user_id = $_POST['user_id'];
    if($id < 1) {
        header("location:".SITEURL."student/chat.php?id=$student_id");
    }
    $N = count($id);
    for($i=0; $i < $N; $i++)
    {
        $sql = "UPDATE message SET read_status = 'read' WHERE message_id = '$id[$i]';";
        $res = mysqli_query($conn, $sql);
    }
    header("location:".SITEURL."student/chat.php?id=$user_id");
    }