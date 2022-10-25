<?php
include "../config/constants.php";

if (isset($_POST['read'])){
    $admin_id = $_SESSION['adminId'];
    $id = $_POST['selector'];
    $user_id = $_POST['user_id'];

    if($id < 1) {
        header("location:".SITEURL."tempadmin/chat.php?id=$admin_id");
    }

    $N = count($id);
    for($i=0; $i < $N; $i++)
    {
        $sql = "UPDATE message SET read_status = 'read' WHERE message_id = '$id[$i]';";
        $res = mysqli_query($conn, $sql);
    }
    header("location:".SITEURL."tempadmin/chat.php?id=$user_id");
    }