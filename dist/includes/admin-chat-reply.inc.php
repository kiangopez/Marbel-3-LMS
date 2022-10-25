<?php 
include "../config/constants.php";
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $usn = $_POST['usn'];
    $receiver = $_POST['receiver'];
    $message = $_POST['message'];
    $message_status = "active";
    date_default_timezone_set('Asia/Manila');
    $date = date('d-m-y h:i:s');
    $receiver_name = $_POST['receiver_name'];
    $sender_name = $_POST['sender_name'];

    $sql1 = "SELECT * FROM admin_tbl WHERE id = $usn";
    $res1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($res1);
    $sender_name = $row1['full_name'];




    $sql2 =  "INSERT INTO message (receiver_id, content, date_sended, sender_id, receiver_name, sender_name, message_status) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql2)) {
        header("location:".SITEURL."teacher/chat-student.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "ississs", $receiver, $message, $date, $usn, $receiver_name, $sender_name, $message_status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql3 =  "INSERT INTO message_sent (receiver_id, content, date_sended, sender_id, receiver_name, sender_name) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql3)) {
        header("location:".SITEURL."teacher/chat-student.php?error=stmtfailed2");
        exit();
    } 

    mysqli_stmt_bind_param($stmt2, "ississ", $receiver, $message, $date, $usn, $receiver_name, $sender_name);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);


    $_SESSION['messageSent'] = "<div class='success'>Message Sent</div>";
    header("location:".SITEURL."admin/chat.php?id=$id");

}
