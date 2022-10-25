<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $subj_name = $_POST['subj-name']; 
    $subj_code = $_POST['subj-code']; 
    $image = $_POST['image'];
    $subj_cat = $_POST['subj-cat'];
    $description = $_POST['description'];

    if(isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if($image_name != "") {
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
        }
    } else {
        $image_name = "";

    }

    require_once "functions.inc.php";

    if (emptyInputSubject($subj_name, $subj_code, $subj_cat, $description) !== false ) {
        header("location:".SITEURL."admin/manage-subjects.php?error=emptyinput");
        exit();
    }

    createSubject($conn, $subj_name, $subj_code, $subj_cat, $image_name, $description);
  
}