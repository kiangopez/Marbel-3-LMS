<?php
include "../config/constants.php";

if(isset($_POST['submit'])) {
    // name of the uploaded file
    $filename = $_FILES['files']['name'];
    $user_id = $_POST['user_id'];
    $subject_id = $_POST['subject_id'];

    $sql2 = "SELECT * FROM teachers_tbl WHERE teacher_id = $user_id";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);

    $user_name = $row2['fname']." ".$row2['lname'];
    $status = "active";

    date_default_timezone_set('Asia/Manila');
    $date = date('d-m-y H:i:s');

    // destination of the file on the server
    $destination = '../assets/subject_files/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['files']['tmp_name'];
    $size = $_FILES['files']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        header("location:".SITEURL."teacher/upload-file.php?subj_id=$subject_id&user_id=$user_id");
        $_SESSION['fileUpload'] = "<div class='error p-0'>Error: File extension must be 'zip', 'pdf', or 'docx'</div>";
    } elseif ($_FILES['files']['size'] > 5000000) { // file shouldn't be larger than 5Megabyte
        header("location:".SITEURL."teacher/upload-file.php?subj_id=$subject_id&user_id=$user_id");
        $_SESSION['fileUpload'] = "<div class='error p-0'>Error: File too large! File musn't exceed 5MB</div>";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql1 = "INSERT INTO files (subject_id, filename, uploaded_by, upload_date, status) VALUES ($subject_id, '$filename', '$user_name', '$date', '$status');";
            if (mysqli_query($conn, $sql1)) {

                $sql_ad = "SELECT * FROM teachers_tbl WHERE teacher_id =".$_SESSION["teacherId"];
                $res_ad = mysqli_query($conn, $sql_ad);
                $row_ad = mysqli_fetch_assoc($res_ad);
                $user_name = $row_ad['fname']." ".$row_ad['lname'];

                $sql_sub = "SELECT * FROM subjects_tbl WHERE subject_id = $subject_id;";
                $res_sub = mysqli_query($conn, $sql_sub);
                $row_sub = mysqli_fetch_assoc($res_sub);

                date_default_timezone_set('Asia/Manila');
                $date_today = date('d-m-y h:i:s');

                $action_details = "Uploaded file in the subject ".$row_sub['subject_name']." (".$row_sub['subject_code'].").";
                $role = "Administrator";

                $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'File Upload', '$action_details', '$role');";
                $res_user_log = mysqli_query($conn, $sql_user_log);

                header("location:".SITEURL."teacher/upload-file.php?subj_id=$subject_id&user_id=$user_id");
                $_SESSION['fileUpload'] = "<div class='success p-0'>File Uploaded Successfully</div>";
            }
        } else {
            header("location:".SITEURL."teacher/upload-file.php?subj_id=$subject_id&user_id=$user_id");
            $_SESSION['fileUpload'] = "<div class='error p-0'>Error: Failed to upload file</div>";
        }
    }
}