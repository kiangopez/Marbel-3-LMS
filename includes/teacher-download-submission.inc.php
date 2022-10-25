<?php
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $student_submission_id = $_POST['student_submission_id'];
    $sb_id = $_POST['sb_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM student_submission WHERE student_submission_id = $student_submission_id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../assets/submissions/' . $file['file'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../assets/submissions/' . $file['file']));
        readfile('../assets/submissions/' . $file['file']);

        header("location:".SITEURL."teacher/view-submissions.php?id=$sb_id");
        exit;
    }
}