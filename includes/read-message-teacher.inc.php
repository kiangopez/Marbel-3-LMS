<?php
include "../config/constants.php";

if (isset($_POST['read'])){
    $teacher_id = $_SESSION['teacherId'];
    $id = $_POST['selector'];
    $user_id = $_POST['user_id'];
    if($id < 1) {
        header("location:".SITEURL."teacher/chat.php?id=$teacher_id");
    }
    $N = count($id);
    for($i=0; $i < $N; $i++)
    {
        $sql = "UPDATE message SET read_status = 'read' WHERE message_id = '$id[$i]';";
        $res = mysqli_query($conn, $sql);
    }
    header("location:".SITEURL."teacher/chat.php?id=$user_id");
    }