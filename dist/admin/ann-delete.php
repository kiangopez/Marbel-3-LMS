<?php include "partials-admin/header.php"; ?>

<?php 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $_GET['user']; 

    if ($user == "admin") {
        $sql = "DELETE FROM ann_admin WHERE id=$id;";
        $res = mysqli_query($conn, $sql);
        header("location:".SITEURL."admin/admin-announcement.php?delete=success");
    } else if ($user == "student") {
        $sql = "DELETE FROM ann_student WHERE id=$id;";
        $res = mysqli_query($conn, $sql);
        header("location:".SITEURL."admin/admin-announcement.php?delete=success");
    } else if ($user == "teacher") {
        $sql = "DELETE FROM ann_teacher WHERE id=$id;";
        $res = mysqli_query($conn, $sql);
        header("location:".SITEURL."admin/admin-announcement.php?delete=success");
    }
}