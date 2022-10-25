<?php

function userLog($conn, $username, $action) {
    if(!$conn) {
        echo mysqli_error($conn); die;
    }
    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');
    
    $sql55 = "INSERT INTO user_log (username, activity_date, action) VALUES ($username , $date_today, $action);";
    $res55 = mysqli_query($conn, $sql55);
}

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

function createAdmin($conn, $full_name, $uid, $pwd, $admin_id, $role) {
    $sql =  "INSERT INTO admin_tbl (full_name, username, password, role) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-admin.php?error=stmtfailed");
        exit();
    } 

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $full_name, $uid, $hashedPwd, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Created an Admin account', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

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

function createStudent($conn, $usn, $fname, $lname, $mname, $email, $student_cat, $pwd, $admin_id, $section) {
    $sql =  "INSERT INTO students_tbl (USN, fname, lname, mname, email, category_id, password, section_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-students.php?error=stmt2failed&page=1");
        exit();
    } 

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "issssisi", $usn ,$fname, $lname, $mname, $email, $student_cat, $hashedPwd, $section);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $action_details = $user_name." created a student account named ".$fname." ".$mname. " ".$lname." (".$usn.")" ;

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Created a Student account', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    if($row_ad['role'] == "admin") {
        header("location:".SITEURL."tempadmin/manage-students.php?page=1");
        $_SESSION['adds'] = "<div class='success'>Student Added Successfully</div>";
    } else if ($row_ad['role'] == "superadmin") {
        header("location:".SITEURL."admin/manage-students.php?page=1");
        $_SESSION['adds'] = "<div class='success'>Student Added Successfully</div>";
    }


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

function createTeacher($conn, $usn, $fname, $lname, $mname, $email, $pwd, $admin_id) {
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

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $action_details = $user_name." created a teacher account named ".$fname." ".$mname. " ".$lname." (".$usn.")" ;

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Created a Teacher account', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

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
        if($adminUidExists["role"] == "superadmin") {
            session_start();
            $_SESSION["adminId"] = $adminUidExists["id"];
            $_SESSION["adminUid"] = $adminUidExists["username"];
        
            $sql_ad = "SELECT * FROM admin_tbl WHERE id = ".$adminUidExists["id"];
            $res_ad = mysqli_query($conn, $sql_ad);
            $row_ad = mysqli_fetch_assoc($res_ad);
            $user_name = $row_ad['full_name'];
            $role = "Administrator";
            $user_usn = $adminUidExists["id"];

        
            date_default_timezone_set('Asia/Manila');
            $date_today = date('d-m-y H:i:s');

            $action_details = $user_name." logged in on ".$date_today;
        
            $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role, user_usn) VALUES ('$user_name' , '$date_today', 'Login', '$action_details', '$role', '$user_usn');";
            $res_user_log = mysqli_query($conn, $sql_user_log);
        
            header("location:".SITEURL."admin/home.php");
            exit();
        } else if ($adminUidExists["role"] == "admin") {
            session_start();
            $_SESSION["adminId"] = $adminUidExists["id"];
            $_SESSION["adminUid"] = $adminUidExists["username"];
        
            $sql_ad = "SELECT * FROM admin_tbl WHERE id = ".$adminUidExists["id"];
            $res_ad = mysqli_query($conn, $sql_ad);
            $row_ad = mysqli_fetch_assoc($res_ad);
            $user_name = $row_ad['full_name'];
            $role = "Administrator";

        
            date_default_timezone_set('Asia/Manila');
            $date_today = date('d-m-y H:i:s');

            $action_details = $user_name." logged in on ".$date_today;
        
            $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Login', '$action_details', '$role');";
            $res_user_log = mysqli_query($conn, $sql_user_log);
        
            header("location:".SITEURL."tempadmin/home.php");
            exit();
        } else {
            header("location:".SITEURL."admin/admin-login.php?error=wrongrole");
            exit();
        }
        
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

        $sql_ad = "SELECT * FROM students_tbl WHERE student_id = ".$usnExists["student_id"];
        $res_ad = mysqli_query($conn, $sql_ad);
        $row_ad = mysqli_fetch_assoc($res_ad);
        $user_name = $row_ad['fname']." ".$row_ad['lname'];
        $role = "Student";
        $user_usn = $usnExists["USN"];

    
        date_default_timezone_set('Asia/Manila');
        $date_today = date('d-m-y H:i:s');

        $action_details = $user_name." logged in on ".$date_today;
    
        $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role, user_usn) VALUES ('$user_name' , '$date_today', 'Login', '$action_details', '$role', '$user_usn');";
        $res_user_log = mysqli_query($conn, $sql_user_log);

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

        $sql_ad = "SELECT * FROM teachers_tbl WHERE teacher_id = ".$urnExists["teacher_id"];
        $res_ad = mysqli_query($conn, $sql_ad);
        $row_ad = mysqli_fetch_assoc($res_ad);
        $user_name = $row_ad['fname']." ".$row_ad['lname'];
        $role = "Teacher";
        $user_usn = $urnExists["URN"];
    
        date_default_timezone_set('Asia/Manila');
        $date_today = date('d-m-y H:i:s');

        $action_details = $user_name." logged in on ".$date_today;
    
        $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role, user_usn) VALUES ('$user_name' , '$date_today', 'Login', '$action_details', '$role', '$user_usn');";
        $res_user_log = mysqli_query($conn, $sql_user_log);

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
// **************TEMPADMIN PROFILE UPDATE STARTS**************

function updateProfileTempAdmin($conn, $full_name, $uid, $id, $current_image) {

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
                header("location:".SITEURL."tempadmin/profile.php?error=uploadfailed&id=$id");
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
                    header("location:".SITEURL."tempadmin/profile.php?error=removefailed");
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
        header("location:".SITEURL."tempadmin/profile.php?error=invalidstmt");
        $_SESSION['update'] = "<div class='danger p-20'>Failed to Update Profile</div>";
    } else {
        header("location:".SITEURL."tempadmin/profile.php?id=$id");
        $_SESSION['update'] = "<div class='success p-20'>Profile Updated Successfully</div>";
    }
    exit();
}
// **************TEMPADMIN PROFILE UPDATE ENDS**************
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

function createCategory($conn, $cat_name, $cat_code, $admin_id) {
    $sql =  "INSERT INTO categories_tbl (category_name, category_code) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-subjects.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "ss", $cat_name, $cat_code);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Created Category', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    $_SESSION['addCategory'] = "<div class='success'>Category Added Successfully</div>";
    header("location:".SITEURL."admin/manage-subjects.php");
    exit();
    
}
// **************CREATE CATEGORY ENDS**************
// **************CREATE TERM STARTS**************
function createTerm($conn, $term, $admin_id) {
    $sql =  "INSERT INTO term (session, status) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-subjects.php?error=stmtfailed");
        exit();
    } 
    $term_status = "inactive";
    mysqli_stmt_bind_param($stmt, "ss", $term, $term_status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Created Term', '$action_details', $role);";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    $_SESSION['addTerm'] = "<div class='success'>Term Added Successfully</div>";
    header("location:".SITEURL."admin/manage-subjects.php");
    exit();
    
}
// **************CREATE TERM ENDS**************
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

function createSubject($conn, $subj_name, $subj_code, $subj_cat, $image_name, $description, $admin_id) {
    $sql =  "INSERT INTO subjects_tbl (subject_name, subject_code, category_id, image_name, description) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-subjects.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "ssiss", $subj_name, $subj_code, $subj_cat, $image_name, $description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Created Subject', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    $_SESSION['addCategory'] = "<div class='success'>Subject Added Successfully</div>";
    header("location:".SITEURL."admin/manage-subjects.php");
    exit();
}
// **************CREATE SUBJECT ENDS**************
// **************CREATE ANNOUNCEMENT STARTS**************
function createAnnouncement($conn, $ann, $user, $admin_id) {
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

        $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
        $res_ad = mysqli_query($conn, $sql_ad);
        $row_ad = mysqli_fetch_assoc($res_ad);
        $user_name = $row_ad['full_name'];
        $role = "Administrator";
    
        date_default_timezone_set('Asia/Manila');
        $date_today = date('d-m-y H:i:s');
    
        $action_details = $user_name." created an announcement to admin page.";
    
        $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Created an Announcement', '$action_details', '$role');";
        $res_user_log = mysqli_query($conn, $sql_user_log);

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

        $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
        $res_ad = mysqli_query($conn, $sql_ad);
        $row_ad = mysqli_fetch_assoc($res_ad);
        $user_name = $row_ad['full_name'];
        $role = "Administrator";
    
        date_default_timezone_set('Asia/Manila');
        $date_today = date('d-m-y H:i:s');
    
        $action_details = $user_name." created an announcement to student page.";
    
        $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Created an Announcement', '$action_details', '$role');";
        $res_user_log = mysqli_query($conn, $sql_user_log);

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

        $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
        $res_ad = mysqli_query($conn, $sql_ad);
        $row_ad = mysqli_fetch_assoc($res_ad);
        $user_name = $row_ad['full_name'];
        $role = "Administrator";
    
        date_default_timezone_set('Asia/Manila');
        $date_today = date('d-m-y H:i:s');
    
        $action_details = $user_name." created an announcement to teacher page.";
    
        $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Created an Announcement', '$action_details', '$role');";
        $res_user_log = mysqli_query($conn, $sql_user_log);

        header("location:".SITEURL."admin/admin-announcement.php");
        exit();
    }
}
// **************CREATE ANNOUNCEMENT ENDS**************
// **************EDIT ANNOUNCEMENT STARTS**************
function editAnnouncement($conn, $ann, $user, $id, $admin_id) {
    if($user == "admin") {
        $sql = "UPDATE ann_admin SET 
        announcement = '$ann'
        WHERE id = $id;
        ";
        $res = mysqli_query($conn, $sql);
        if($res == false) {
            header("location:".SITEURL."admin/admin-announcement.php?error=invalidstmt");
        } else {

            $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
            $res_ad = mysqli_query($conn, $sql_ad);
            $row_ad = mysqli_fetch_assoc($res_ad);
            $user_name = $row_ad['full_name'];
            $role = "Administrator";
        
            date_default_timezone_set('Asia/Manila');
            $date_today = date('d-m-y H:i:s');
        
            $action_details = $user_name." edited an announcement to admin page.";
        
            $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Edited an Announcement', '$action_details', '$role');";
            $res_user_log = mysqli_query($conn, $sql_user_log);

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

            $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
            $res_ad = mysqli_query($conn, $sql_ad);
            $row_ad = mysqli_fetch_assoc($res_ad);
            $user_name = $row_ad['full_name'];
            $role = "Administrator";
        
            date_default_timezone_set('Asia/Manila');
            $date_today = date('d-m-y H:i:s');
        
            $action_details = $user_name." edited an announcement to student page.";
        
            $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Edited an Announcement', '$action_details', '$role');";
            $res_user_log = mysqli_query($conn, $sql_user_log);

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

            $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
            $res_ad = mysqli_query($conn, $sql_ad);
            $row_ad = mysqli_fetch_assoc($res_ad);
            $user_name = $row_ad['full_name'];
            $role = "Administrator";
        
            date_default_timezone_set('Asia/Manila');
            $date_today = date('d-m-y H:i:s');
        
            $action_details = $user_name." edited an announcement to teacher page.";
        
            $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Edited an Announcement', '$action_details', '$role');";
            $res_user_log = mysqli_query($conn, $sql_user_log);

        header("location:".SITEURL."admin/admin-announcement.php");
        }
    }
}
// **************EDIT ANNOUNCEMENT ENDS**************
// **************ADMIN STUDENT PROFILE UPDATE STARTS**************
function adminStudentProfileUpdate($conn, $fname, $mname, $lname, $email, $usn, $id, $section) {
    $sql = "UPDATE students_tbl SET 
    USN = '$usn',
    fname = '$fname',
    mname = '$mname',
    lname = '$lname',
    email = '$email',
    section_id = $section
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
// **************ADMIN STUDENT PROFILE UPDATE STARTS**************
function tempadminStudentProfileUpdate($conn, $fname, $mname, $lname, $email, $usn, $id) {
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
        header("location:".SITEURL."tempadmin/manage-students.php?page=1");
    } else {

        header("location:".SITEURL."tempadmin/manage-students.php?page=1");
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
function updateCategory($conn, $id, $cat_name, $cat_code, $admin_id) {
    $sql = "UPDATE categories_tbl SET
    category_name = '$cat_name',
    category_code = '$cat_code'
    WHERE category_id = $id;
    ";

    $res = mysqli_query($conn, $sql);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Updated Category', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

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
// **************TERM UPDATE STARTS**************
function updateTerm($conn, $id, $term, $admin_id) {
    $sql = "UPDATE term SET
    session = '$term'
    WHERE term_id = $id;
    ";

    $res = mysqli_query($conn, $sql);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Updated Term', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    header("location: ../admin/manage-subjects.php");
}
// **************TERM UPDATE ENDS**************
// **************ADD SECTION STARTS**************
function createSection($conn, $section_name, $section_category, $admin_id, $adviser_id) {
    $sql =  "INSERT INTO section_tbl (section_name, category_id, teacher_id) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:".SITEURL."admin/manage-section.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "sii", $section_name, $section_category, $adviser_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Created Section', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    $_SESSION['addCategory'] = "<div class='success p-20'>Section Added Successfully</div>";
    header("location:".SITEURL."admin/manage-sections.php");
    exit();
}
// **************ADD SECTION ENDS**************
// **************UPDATE SECTION STARTS**************
function updateSection($conn, $section_name, $section_category, $adviser_id, $admin_id, $section_id) {
    $sql = "UPDATE section_tbl SET
    section_name = '$section_name',
    category_id = $section_category,
    teacher_id = $adviser_id
    WHERE section_id = $section_id;
    ";

    $res = mysqli_query($conn, $sql);

    $sql_ad = "SELECT * FROM admin_tbl WHERE id = $admin_id";
    $res_ad = mysqli_query($conn, $sql_ad);
    $row_ad = mysqli_fetch_assoc($res_ad);
    $user_name = $row_ad['full_name'];
    $role = "Administrator";

    date_default_timezone_set('Asia/Manila');
    $date_today = date('d-m-y H:i:s');

    $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role) VALUES ('$user_name' , '$date_today', 'Updated Section', '$action_details', '$role');";
    $res_user_log = mysqli_query($conn, $sql_user_log);

    $_SESSION['addCategory'] = "<div class='success p-20'>Section Updated Successfully</div>";
    header("location:".SITEURL."admin/manage-sections.php");
    exit();
}
// **************UPDATE SECTION ENDS**************