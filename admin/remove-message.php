<?php include "../config/constants.php"; ?>

<?php 

$id = $_GET['id'];
$user_id = $_GET['user_id'];
$status = "inactive";

$sql = "UPDATE message SET message_status = 'inactive', read_status = 'read' WHERE message_id = $id;";
$res = mysqli_query($conn, $sql);

if(!$res) {
    header("location:".SITEURL."admin/chat.php?error=stmterror");
} else {
    header("location:".SITEURL."admin/chat.php?id=$user_id");
}
