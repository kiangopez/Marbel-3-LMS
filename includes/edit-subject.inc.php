<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $subj_name = htmlspecialchars($_POST['subj-name']);
    $subj_code = htmlspecialchars($_POST['subj-code']);
    $current_image = $_POST['current_image'];
    $subj_cat = $_POST['subj-cat'];
    $description = htmlspecialchars($_POST['description']);
    $admin_id = $_POST['admin_id'];
    
    if(isset($_FILES['image']['name'])) {
        // Clicked
        $image_name = $_FILES['image']['name'];

        // Check if the file is available
        if($image_name != "") {
            // available
            // rename the image
            $ext = end(explode('.', $image_name));
            $image_name = "Subject-Banner-".rand(0000,9999).".".$ext;
            $src = $_FILES['image']['tmp_name'];
            $dst = "../assets/subject_images/".$image_name;
            $upload = move_uploaded_file($src, $dst);

            if($upload == false) {
                $_SESSION['upload'] = "<div class'error'>Failed to upload image</div>";
                header('location:'.SITEURL.'admin/manage-subjects.php?error=uploadfailed');
                die();
            }

            // 3. Remove the image if new image is uploaded and current image exists
            if($current_image != "") {
                $remove_path = "../assets/subject_images/".$current_image;

                $remove = unlink($remove_path);

                // Check whether the image is removed or not
                // If failed to remove then display message and stop the process
                if($remove == false) {
                    // Failed to remove the image
                    header('location:'.SITEURL.'admin/manage-subjects.php?error=removefailed');
                    die();
                }
            } 
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql = "UPDATE subjects_tbl SET
    subject_name = '$subj_name',
    subject_code = '$subj_code',
    image_name = '$image_name',
    category_id = '$subj_cat',
    description = '$description'
    WHERE subject_id = $id;
    ";

    $res = mysqli_query($conn, $sql);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');
    $role = "Administrator";

    $action_details = "The subject ".$subj_name." (".$subj_code.") "." has been updated.";

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Updated Subject', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    if(!$res) {
        header('location:'.SITEURL.'admin/manage-subjects.php?error=stmtfailed');
    } else {
        header('location:'.SITEURL.'admin/manage-subjects.php');
    }
}