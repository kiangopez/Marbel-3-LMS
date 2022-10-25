<?php
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $file_id = $_POST['file_id'];
    $subject_id = $_POST['subject_id'];
    $user_id = $_POST['user_id'];

    $status = "inactive";

    $sql = "UPDATE files SET status = '$status' WHERE file_id = $file_id;";
    $res = mysqli_query($conn, $sql);

    header("location:".SITEURL."teacher/upload-file.php?subj_id=$subject_id&user_id=$user_id");
    $_SESSION['fileRemove'] = "<div class='success p-0'>File Removed Successfully</div>";
}