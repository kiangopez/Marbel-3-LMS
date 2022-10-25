<?php
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $file_id = $_POST['file_id'];
    $subject_id = $_POST['subject_id'];
    $user_id = $_POST['user_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE file_id = $file_id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../assets/subject_files/' . $file['filename'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../assets/subject_files/' . $file['filename']));
        readfile('../assets/subject_files/' . $file['filename']);

        header("location:".SITEURL."teacher/upload-file.php?subj_id=$subject_id&user_id=$user_id");
        exit;
    }
}