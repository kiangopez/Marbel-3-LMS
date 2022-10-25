<?php include "partials-student/header.php"; ?>
    <?php
    if($_GET['id'] == $_SESSION['studentId']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM students_tbl AS s 
        LEFT JOIN categories_tbl AS c
            ON s.category_id = c.category_id
        WHERE s.student_id = $id";
        $res = mysqli_query($conn, $sql);

        if($res == TRUE) {
        $count = mysqli_num_rows($res);

        if($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $usn = $row['USN'];
            $fname = $row['fname'];
            $mname = $row['mname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $image_name = $row['image_name'];
            $category_name = $row['category_name'];
            }
        } else {
        header("location:".SITEURL."student/student-profile.php");
        }

    ?>
  <section class="dashboard wrapper column" id="dashboard">
    <div class="heading"><h2>Profile Page</h2></div>
    
    <?php
        if(isset($_SESSION['updatePassword'])) {
            echo $_SESSION['updatePassword'];
            unset($_SESSION['updatePassword']);
        }
    ?>

    <div class="profile-wrapper mt-20">
        <div class="left-profile">
            <div class="profile-image">
            <?php 
                if($image_name == "") {
                    ?>
                        <img src="../assets/images/default_image.png">
                    <?php
                } else {
                    ?>
                        <img src="../assets/user_images/<?php echo $image_name; ?>" alt="Profile Picture">
                    <?php
                }
            ?>
            </div>
            <div class="profile-name">
                <p><?php echo $fname." ".$mname." ".$lname ?></p>
            </div>
            <div class="student-details text-center">
                <p>USN: <?php echo $usn; ?></p>
                <p>Grade Level: <?php echo $category_name; ?></p>
            </div>
            <a href="<?php echo SITEURL;?>student/student-edit-profile.php?id=<?php echo $id; ?>" class="primary-btn">Edit Profile</a>
            <div class="password">
                <a class="blue" href="<?php echo SITEURL;?>student/change-password.php?id=<?php echo $id; ?>">Change password</a>
            </div>
            
        </div>
        <div class="right-profile">
            <div class="email">
                <p>Email: <?php echo $email; ?></p>
            </div>
            <div class="enrolled-subjects">
                <p class="mb-10"><span>Enrolled Courses:</span></p>
                <?php
                    $sql2 = "SELECT * FROM student_subject AS ss 
                    INNER JOIN subjects_tbl AS s
                        ON ss.subject_id = s.subject_id
                    WHERE ss.student_id = $id";
                    $res2 = mysqli_query($conn, $sql2);
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        $subject_name = $row2['subject_name'];
                        $subject_code = $row2['subject_code'];
                        ?>
                            <p><?php echo $subject_code." ".$subject_name; ?></p>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>student/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
  </section>
<?php include "partials-student/footer.php"; ?>
