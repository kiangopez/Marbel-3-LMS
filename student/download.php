<?php
include "../config/constants.php";

if(isset($_GET['id'])) {
    $file_id = $_GET['id'];
    $subject_id = $_POST['subj_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE file_id = $file_id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../assets/subject_files/' . $file['filename'];

    if (file_exists($filepath)) {
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../assets/subject_files/' . $file['filename']));
        readfile('../assets/subject_files/' . $file['filename']);


        header("location:".SITEURL."student/download.php?id=$subject_id");
        exit;
    }
}