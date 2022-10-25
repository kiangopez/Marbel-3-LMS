<?php

function pwdMatch($pwd, $pwd_repeat) {
    $result;
    if($pwd !== $pwd_repeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


// **************ADD ADMIN FUNCTIONS STARTS**************
function emptyInputAdmin($full_name, $uid, $pwd, $pwd_repeat) {
    $result;
    if(empty($full_name) || empty($uid) || empty($pwd) || empty($pwd_repeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($uid) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function adminUidExists($conn, $uid) {
    $sql = "SELECT * FROM admin_tbl WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-admin.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);

}

function createAdmin($conn, $full_name, $uid, $pwd) {
    $sql =  "INSERT INTO admin_tbl (full_name, username, password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-admin.php?error=stmtfailed");
        exit();
    } 

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $full_name, $uid, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
    header("location:".SITEURL."admin/manage-admin.php");
    exit();

}

// **************ADD ADMIN FUNCTIONS ENDS**************
// **************ADD STUDENT FUNCTIONS STARTS**************
function emptyInputStudent($usn, $fname, $lname, $mname, $email, $pwd, $pwd_repeat) {
    $result;
    if(empty($usn) || empty($fname) || empty($lname) || empty($mname) || empty($email) || empty($pwd) || empty($pwd_repeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function usnExists($conn, $usn) {
    $sql =  "SELECT * FROM students_tbl WHERE USN = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-students.php?error=stmt1failed&page=1");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "i", $usn);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createStudent($conn, $usn, $fname, $lname, $mname, $email, $student_cat, $pwd) {
    $sql =  "INSERT INTO students_tbl (USN, fname, lname, mname, email, category_id, password, image_name) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-students.php?error=stmt2failed&page=1");
        exit();
    } 

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "issssis", $usn ,$fname, $lname, $mname, $email, $student_cat, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location:".SITEURL."admin/manage-students.php?page=1");
    $_SESSION['adds'] = "<div class='success'>Student Added Successfully</div>";

    exit();
}
// **************ADD STUDENT FUNCTIONS ENDS**************
// **************ADD TEACHER FUNCTIONS STARTS**************
function emptyInputTeacher($urn, $fname, $lname, $mname, $email, $pwd, $pwd_repeat) {
    $result;
    if(empty($urn) || empty($fname) || empty($lname) || empty($mname) || empty($email) || empty($pwd) || empty($pwd_repeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function urnExists($conn, $urn) {
    $sql =  "SELECT * FROM teachers_tbl WHERE URN = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-teachers.php?error=stmt1failed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "i", $urn);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createTeacher($conn, $usn, $fname, $lname, $mname, $email, $pwd) {
    $sql =  "INSERT INTO teachers_tbl (URN, fname, lname, mname, email, password) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-teachers.php?error=stmt2failed");
        exit();
    } 

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "isssss", $usn ,$fname, $lname, $mname, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location:".SITEURL."admin/manage-teachers.php?error=none&page=1");
    $_SESSION['adds'] = "<div class='success'>Teacher Added Successfully</div>";

    exit();
}
// **************ADD TEACHER FUNCTIONS ENDS**************
// **************LOGIN ADMIN STARTS**************
function emptyInputLogin($uid, $pwd) {
    $result;
    if(empty($uid) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginAdmin($conn, $uid, $pwd) {
    $adminUidExists = adminUidExists($conn, $uid);

    if($adminUidExists === false) {
        header("location:".SITEURL."admin/admin-login.php");
        $_SESSION["loginError"] = "<div class='error text-center'>Wrong Username or Password</div>";
        
        exit();
    }

    $pwdHashed = $adminUidExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false) {
        header("location:".SITEURL."admin/admin-login.php");
        $_SESSION["loginError"] = "<div class='error text-center'>Wrong Username or Password</div>";
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["adminId"] = $adminUidExists["id"];
        $_SESSION["adminUid"] = $adminUidExists["username"];
        header("location:".SITEURL."admin/home.php");
        exit();
        
    }
}
// **************LOGIN ADMIN ENDS**************
// **************UPDATE ADMIN STARTS**************
function emptyInputUpdateAdmin($full_name, $uid) {
    $result;
    if(empty($full_name) || empty($uid)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function updateAdmin($conn, $full_name, $uid, $id) {
    $sql = "UPDATE admin_tbl SET 
        full_name = '$full_name',
        username = '$uid'
        WHERE id = $id;
        ";
    $res = mysqli_query($conn, $sql);

    if($res == false) {
        header("location:".SITEURL."admin/manage-admin.php?error=invalidstmt");
        $_SESSION['update'] = "<div>Failed to Update Admin</div>";
    } else {
        header("location:".SITEURL."admin/manage-admin.php?error=none");
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
    }
    exit();
}
// **************UPDATE ADMIN ENDS**************
// **************STUDENT LOGIN STARTS**************
function loginStudent($conn, $uid, $pwd) {
    $usnExists = usnExists($conn, $uid);

    if($usnExists === false) {
        header("location:".SITEURL."student/student-login.php?error=wronglogin");
        $_SESSION["loginError"] = "<div class='error text-center'>Wrong Username or Password</div>";
        exit();
    }

    $pwdHashed = $usnExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false) {
        header("location:".SITEURL."student/student-login.php?error=loginerror");
        $_SESSION["loginError"] = "<div class='error text-center'>Wrong Username or Password</div>";
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["studentId"] = $usnExists["student_id"];
        $_SESSION["studentUid"] = $usnExists["USN"];
        $_SESSION["studentFname"] = $usnExists["fname"];
        $_SESSION["studentLname"] = $usnExists["lname"];
        header("location:".SITEURL."student/home.php");
        exit();
    }
}
// **************STUDENT LOGIN ENDS**************
// **************TEACHER LOGIN STARTS**************
function loginTeacher($conn, $urn, $pwd) {
    $urnExists = urnExists($conn, $urn);

    if($urnExists === false) {
        header("location:".SITEURL."teacher/teacher-login.php");
        $_SESSION["loginError"] = "<div class='error text-center'>Wrong Username or Password</div>";
        exit();
    }

    $pwdHashed = $urnExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false) {
        header("location:".SITEURL."teacher/teacher-login.php");
        $_SESSION["loginError"] = "<div class='error text-center'>Wrong Username or Password</div>";
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["teacherId"] = $urnExists["teacher_id"];
        $_SESSION["teacherUid"] = $urnExists["URN"];
        $_SESSION["teacherFname"] = $urnExists["fname"];
        $_SESSION["teacherLname"] = $urnExists["lname"];
        header("location:".SITEURL."teacher/home.php");
        exit();
    }
}
// **************TEACHER LOGIN ENDS**************
// **************STUDENT PROFILE UPDATE STARTS**************
function studentProfileUpdate($conn, $fname, $mname, $lname, $email, $usn, $id, $current_image) {

    if(isset($_FILES['image']['name'])) {
        // Clicked
        $image_name = $_FILES['image']['name'];

        // Check if the file is available
        if($image_name != "") {
            // available
            // rename the image
            $ext = end(explode('.', $image_name));
            $image_name = "User-Image-".rand(0000,9999).".".$ext;
            $src = $_FILES['image']['tmp_name'];
            $dst = "../assets/user_images/".$image_name;
            $upload = move_uploaded_file($src, $dst);

            if($upload == false) {
                $_SESSION['upload'] = "<div class'error'>Failed to upload image</div>";
                header("location:".SITEURL."student/student-profile.php?error=uploadfailed&id=$id");
                die();
            }

            // 3. Remove the image if new image is uploaded and current image exists
            if($current_image != "") {
                $remove_path = "../assets/user_images/".$current_image;

                $remove = unlink($remove_path);

                // Check whether the image is removed or not
                // If failed to remove then display message and stop the process
                if($remove == false) {
                    // Failed to remove the image
                    header("location:".SITEURL."student/student-profile.php?error=removefailed&id=$id");
                    die();
                }
            } 
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql = "UPDATE students_tbl SET 
    USN = '$usn',
    fname = '$fname',
    mname = '$mname',
    lname = '$lname',
    email = '$email',
    image_name = '$image_name'
    WHERE student_id = $id
    ";

    $res = mysqli_query($conn, $sql);

    if($res == false) {
        header("location:".SITEURL."student/student-profile.php?error=invalidStmt");
        $_SESSION['studentUpdate'] = "<div>Failed to update user profile</div>";
    } else {

        header("location:".SITEURL."student/student-profile.php?id=$id");
        $_SESSION['studentUpdate'] = "<div class='success'>Profile successfully updated</div>";
    }
    exit();
}
function emptyInputStudentUpdate($fname, $mname, $lname) {
    $result;
    if(empty($fname) || empty($mname) || empty($lname)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
// **************STUDENT PROFILE UPDATE ENDS**************
// **************TEACHER PROFILE UPDATE STARTS**************
function teacherProfileUpdate($conn, $urn, $fname, $mname, $lname, $email, $id, $image_name) {

    if(isset($_FILES['image']['name'])) {
        // Clicked
        $image_name = $_FILES['image']['name'];

        // Check if the file is available
        if($image_name != "") {
            // available
            // rename the image
            $ext = end(explode('.', $image_name));
            $image_name = "User-Image-".rand(0000,9999).".".$ext;
            $src = $_FILES['image']['tmp_name'];
            $dst = "../assets/user_images/".$image_name;
            $upload = move_uploaded_file($src, $dst);

            if($upload == false) {
                $_SESSION['upload'] = "<div class'error'>Failed to upload image</div>";
                header("location:".SITEURL."teacher/teacher-profile.php?error=uploadfailed&id=$id");
                die();
            }

            // 3. Remove the image if new image is uploaded and current image exists
            if($current_image != "") {
                $remove_path = "../assets/user_images/".$current_image;

                $remove = unlink($remove_path);

                // Check whether the image is removed or not
                // If failed to remove then display message and stop the process
                if($remove == false) {
                    // Failed to remove the image
                    header("location:".SITEURL."teacher/teacher-profile.php?error=removefailed&id=$id");
                    die();
                }
            } 
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql = "UPDATE teachers_tbl SET 
    URN = '$urn',
    fname = '$fname',
    mname = '$mname',
    lname = '$lname',
    email = '$email',
    image_name = '$image_name'
    WHERE teacher_id = $id;
    ";

    $res = mysqli_query($conn, $sql);

    if($res == false) {
        header("location:".SITEURL."teacher/teacher-profile.php?error=invalidStmt");
        $_SESSION['teacherUpdate'] = "<div>Failed to update user profile</div>";
    } else {

        header("location:".SITEURL."teacher/teacher-profile.php?error=none&id=$id");
        $_SESSION['teacherUpdate'] = "<div class='success'>Profile successfully updated</div>";
    }
    exit();
}
function emptyInputTeacherUpdate($fname, $mname, $lname) {
    $result;
    if(empty($fname) || empty($mname) || empty($lname)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
// **************TEACHER PROFILE UPDATE ENDS**************
// **************ADMIN PROFILE UPDATE STARTS**************

function updateProfileAdmin($conn, $full_name, $uid, $id, $current_image) {

    if(isset($_FILES['image']['name'])) {
        // Clicked
        $image_name = $_FILES['image']['name'];

        // Check if the file is available
        if($image_name != "") {
            // available
            // rename the image
            $ext = end(explode('.', $image_name));
            $image_name = "User-Image-".rand(0000,9999).".".$ext;
            $src = $_FILES['image']['tmp_name'];
            $dst = "../assets/user_images/".$image_name;
            $upload = move_uploaded_file($src, $dst);

            if($upload == false) {
                $_SESSION['upload'] = "<div class'error'>Failed to upload image</div>";
                header("location:".SITEURL."admin/admin-profile.php?error=uploadfailed&id=$id");
                die();
            }

            // 3. Remove the image if new image is uploaded and current image exists
            if($current_image != "") {
                $remove_path = "../assets/user_images/".$current_image;

                $remove = unlink($remove_path);

                // Check whether the image is removed or not
                // If failed to remove then display message and stop the process
                if($remove == false) {
                    // Failed to remove the image
                    header("location:".SITEURL."admin/admin-profile.php?error=removefailed");
                    die();
                }
            } 
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql = "UPDATE admin_tbl SET 
        full_name = '$full_name',
        username = '$uid',
        image_name = '$image_name'
        WHERE id = $id;
        ";
    $res = mysqli_query($conn, $sql);

    if($res == false) {
        header("location:".SITEURL."admin/admin-profile.php?error=invalidstmt");
        $_SESSION['update'] = "<div>Failed to Update Profile</div>";
    } else {
        header("location:".SITEURL."admin/admin-profile.php?id=$id");
        $_SESSION['update'] = "<div class='success'>Profile Updated Successfully</div>";
    }
    exit();
}

function emptyInputAdminProfilUpdate($full_name) {
    $result;
    if(empty($full_name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
// **************ADMIN PROFILE UPDATE ENDS**************
// **************CREATE CATEGORY STARTS**************
function emptyInputCategory($cat_name, $cat_code) {
    $result;
    if(empty($cat_name) || empty($cat_code)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function createCategory($conn, $cat_name, $cat_code) {
    $sql =  "INSERT INTO categories_tbl (category_name, category_code) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-subjects.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "ss", $cat_name, $cat_code);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    $_SESSION['addCategory'] = "<div class='success'>Category Added Successfully</div>";
    header("location:".SITEURL."admin/manage-subjects.php");
    exit();
    
}
// **************CREATE CATEGORY ENDS**************
// **************CREATE SUBJECT STARTS**************
function emptyInputSubject($subj_name, $subj_code, $subj_cat, $description) {
    $result;
    if(empty($subj_name) || empty($subj_code) || empty($subj_cat) || empty($description)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function createSubject($conn, $subj_name, $subj_code, $subj_cat, $image_name, $description) {
    $sql =  "INSERT INTO subjects_tbl (subject_name, subject_code, category_id, image_name, description) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-subjects.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "ssiss", $subj_name, $subj_code, $subj_cat, $image_name, $description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    $_SESSION['addCategory'] = "<div class='success'>Subject Added Successfully</div>";
    header("location:".SITEURL."admin/manage-subjects.php");
    exit();
}
// **************CREATE SUBJECT ENDS**************
// **************CREATE ANNOUNCEMENT STARTS**************
function createAnnouncement($conn, $ann, $user) {
    if($user == "admin") {
        $sql = "INSERT INTO ann_admin (announcement) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location:".SITEURL."admin/admin-announcement.php?error=stmtfailed");
            exit();
        } 
        mysqli_stmt_bind_param($stmt, "s", $ann);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location:".SITEURL."admin/admin-announcement.php?error=none");
        exit();
    } else if($user == "student") {
        $sql = "INSERT INTO ann_student (announcement) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location:".SITEURL."admin/admin-announcement.php?error=stmtfailed");
            exit();
        } 
        mysqli_stmt_bind_param($stmt, "s", $ann);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location:".SITEURL."admin/admin-announcement.php?error=none");
        exit();
    } else if($user == "teacher") {

        $sql = "INSERT INTO ann_teacher (announcement) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location:".SITEURL."admin/admin-announcement.php?error=stmtfailed");
            exit();
        } 
        mysqli_stmt_bind_param($stmt, "s", $ann);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location:".SITEURL."admin/admin-announcement.php");
        exit();
    }
}
// **************CREATE ANNOUNCEMENT ENDS**************
// **************EDIT ANNOUNCEMENT STARTS**************
function editAnnouncement($conn, $ann, $user, $id) {
    if($user == "admin") {
        $sql = "UPDATE ann_admin SET 
        announcement = '$ann'
        WHERE id = $id;
        ";
        $res = mysqli_query($conn, $sql);
        if($res == false) {
            header("location:".SITEURL."admin/admin-announcement.php?error=invalidstmt");
        } else {
        header("location:".SITEURL."admin/admin-announcement.php");
        }
    } else if ($user == "student") {
        $sql = "UPDATE ann_student SET 
        announcement = '$ann'
        WHERE id = $id;
        ";
        $res = mysqli_query($conn, $sql);
        if($res == false) {
            header("location:".SITEURL."admin/admin-announcement.php?error=invalidstmt");
        } else {
        header("location:".SITEURL."admin/admin-announcement.php");
        }
    } else if ($user == "teacher") {
        $sql = "UPDATE ann_teacher SET 
        announcement = '$ann'
        WHERE id = $id;
        ";
        $res = mysqli_query($conn, $sql);
        if($res == false) {
            header("location:".SITEURL."admin/admin-announcement.php?error=invalidstmt");
        } else {
        header("location:".SITEURL."admin/admin-announcement.php");
        }
    }
}
// **************EDIT ANNOUNCEMENT ENDS**************
// **************ADMIN STUDENT PROFILE UPDATE STARTS**************
function adminStudentProfileUpdate($conn, $fname, $mname, $lname, $email, $usn, $id) {
    $sql = "UPDATE students_tbl SET 
    USN = '$usn',
    fname = '$fname',
    mname = '$mname',
    lname = '$lname',
    email = '$email'
    WHERE student_id = $id
    ";

    $res = mysqli_query($conn, $sql);

    if($res == false) {
        header("location:".SITEURL."admin/manage-students.php?page=1");
    } else {

        header("location:".SITEURL."admin/manage-students.php?page=1");
    }
    exit();
}
// **************ADMIN STUDENT PROFILE UPDATE ENDS**************
// **************ADMIN TEACHER PROFILE UPDATE STARTS**************
function adminTeacherProfileUpdate($conn, $urn, $fname, $mname, $lname, $email, $id) {

    if(isset($_FILES['image']['name'])) {
        // Clicked
        $image_name = $_FILES['image']['name'];

        // Check if the file is available
        if($image_name != "") {
            // available
            // rename the image
            $ext = end(explode('.', $image_name));
            $image_name = "User-Image-".rand(0000,9999).".".$ext;
            $src = $_FILES['image']['tmp_name'];
            $dst = "../assets/user_images/".$image_name;
            $upload = move_uploaded_file($src, $dst);

            if($upload == false) {
                $_SESSION['upload'] = "<div class'error'>Failed to upload image</div>";
                header("location:".SITEURL."teacher/teacher-profile.php?error=uploadfailed&id=$id");
                die();
            }

            // 3. Remove the image if new image is uploaded and current image exists
            if($current_image != "") {
                $remove_path = "../assets/user_images/".$current_image;

                $remove = unlink($remove_path);

                // Check whether the image is removed or not
                // If failed to remove then display message and stop the process
                if($remove == false) {
                    // Failed to remove the image
                    header("location:".SITEURL."teacher/teacher-profile.php?error=removefailed&id=$id");
                    die();
                }
            } 
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql = "UPDATE teachers_tbl SET 
    URN = '$urn',
    fname = '$fname',
    mname = '$mname',
    lname = '$lname',
    email = '$email',
    image_name = '$image_name'
    WHERE teacher_id = $id;
    ";

    $res = mysqli_query($conn, $sql);

    if($res == false) {
        header("location:".SITEURL."admin/manage-teachers.php?page=1&error=stmterror");
    } else {
        header("location:".SITEURL."admin/manage-teachers.php?page=1");
    }
    exit();
}
// **************ADMIN TEACHER PROFILE UPDATE ENDS**************
// **************CATEGORY UPDATE STARTS**************
function updateCategory($conn, $id, $cat_name, $cat_code) {
    $sql = "UPDATE categories_tbl SET
    category_name = '$cat_name',
    category_code = '$cat_code'
    WHERE category_id = $id;
    ";

    $res = mysqli_query($conn, $sql);

    header("location: ../admin/manage-subjects.php");
}

function emptyInputCategoryUpdate($cat_name, $cat_code) {
    $result;
    if(empty($cat_name) || empty($cat_code)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
// **************CATEGORY UPDATE ENDS**************
// **************USER LOG STARTS**************
// function userlog($conn, $uid) {
//     // userlog
//     $sql1 = "SELECT * FROM students_tbl WHERE USN = $uid;";
//     $res1 = mysqli_query($conn, $sql1);

//     $row1 = mysqli_fetch_assoc($res1);
//     $full_name = $row1['fname']." ".$row1['lname'];
//     $echo = $full_name;

//     date_default_timezone_set('Asia/Manila');
//     $date = date('d-m-y h:i:s');

//     $sql = "INSERT INTO user_log (id_user, username, login_date) VALUES ($uid, $full_name, $date)";
//     $res = mysqli_query($conn, $sql);
//     // userlog
// }
// **************USER LOG ENDS**************