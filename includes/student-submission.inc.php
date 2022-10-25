<?php
include "../config/constants.php";

if(isset($_POST['submit'])) {
    // name of the uploaded file
    $filename = $_FILES['files']['name'];
    $user_id = $_POST['user_id'];
    $sb_id = $_POST['sb_id'];

    $sql2 = "SELECT * FROM students_tbl WHERE student_id = $user_id";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);

    $sql3 = "SELECT * FROM file_submission WHERE submission_id = $sb_id";
    $res3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($res3);

    $user_name = $row2['fname']." ".$row2['lname'];

    date_default_timezone_set('Asia/Manila');
    $date = date('d-m-y H:i:s');

    // destination of the file on the server
    $destination = '../assets/submissions/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['files']['tmp_name'];
    $size = $_FILES['files']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpg', 'jpeg', 'png'])) {
        header("location:".SITEURL."student/edit-submission.php?id=$sb_id");
        $_SESSION['fileUpload'] = "<div class='error p-0'>Error: File extension must be 'zip', 'pdf', or 'docx'</div>";
    } elseif ($_FILES['files']['size'] > 5000000) { // file shouldn't be larger than 5Megabyte
        header("location:".SITEURL."student/edit-submission.php?id=$sb_id");
        $_SESSION['fileUpload'] = "<div class='error p-0'>Error: File too large! File musn't exceed 5MB</div>";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql1 = "INSERT INTO student_submission (student_id, submission_id, file, grade, items) VALUES ($user_id, '$sb_id', '$filename', '', '10');";
            if (mysqli_query($conn, $sql1)) {

                $action_details = "Uploaded assignment file";
                $role = "Student";

                $sql55 = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date', 'Assignment File Upload', '$action_details', '$role');";
                $res55 = mysqli_query($conn, $sql55);

                header("location:".SITEURL."student/file-upload.php?id=$sb_id");
                $_SESSION['fileUpload'] = "<div class='success p-0'>File Uploaded Successfully</div>";
            } else {
                header("location:".SITEURL."student/file-upload.php?id=$sb_id&error=stmterror");
                $_SESSION['fileUpload'] = "<div class='error p-0'>Error: Failed to upload file</div>";
            }
        } else {
            header("location:".SITEURL."student/file-upload.php?id=$sb_id&error=moveerror");
            $_SESSION['fileUpload'] = "<div class='error p-0'>Error: Failed to upload file</div>";
        }
    }
}