<?php
include "../config/constants.php";

if(isset($_POST['submit'])) {
    // name of the uploaded file
    $filename = $_FILES['files']['name'];
    $user_id = $_POST['user_id'];
    $subject_id = $_POST['subject_id'];

    $sql2 = "SELECT * FROM admin_tbl WHERE id = $user_id";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);

    $user_name = $row2['full_name'];
    $status = "active";

    date_default_timezone_set('Asia/Manila');
    $date = date('d-m-y h:i:s');

    // destination of the file on the server
    $destination = '../assets/subject_files/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['files']['tmp_name'];
    $size = $_FILES['files']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        header("location:".SITEURL."admin/upload-file.php?id=$subject_id&user_id=$user_id");
        $_SESSION['fileUpload'] = "<div class='error p-0'>Error: File extension must be 'zip', 'pdf', or 'docx'</div>";
    } elseif ($_FILES['files']['size'] > 5000000) { // file shouldn't be larger than 5Megabyte
        header("location:".SITEURL."admin/upload-file.php?id=$subject_id&user_id=$user_id");
        $_SESSION['fileUpload'] = "<div class='error p-0'>Error: File too large! File musn't exceed 5MB</div>";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql1 = "INSERT INTO files (subject_id, filename, uploaded_by, upload_date, status) VALUES ($subject_id, '$filename', '$user_name', '$date', '$status');";
            if (mysqli_query($conn, $sql1)) {
                header("location:".SITEURL."admin/upload-file.php?id=$subject_id&user_id=$user_id");
                $_SESSION['fileUpload'] = "<div class='success p-0'>File Uploaded Successfully</div>";
            }
        } else {
            header("location:".SITEURL."admin/upload-file.php?id=$subject_id&user_id=$user_id");
            $_SESSION['fileUpload'] = "<div class='error p-0'>Error: Failed to upload file</div>";
        }
    }
}