<?php include"partials-teacher/header.php"; ?>
    <?php

    if($_GET['id'] == $_SESSION['teacherId']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM teachers_tbl WHERE teacher_id = $id";
        $res = mysqli_query($conn, $sql);

        if($res == TRUE) {
        $count = mysqli_num_rows($res);

        if($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $usn = $row['URN'];
            $fname = $row['fname'];
            $mname = $row['mname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $image_name = $row['image_name'];
            }
        } else {
        header("location:".SITEURL."teacher/teacher-profile.php");
        }
    ?>
<section class="dashboard wrapper column" id="dashboard">
    <div class="heading p-20"><h2>Profile Page</h2></div>

    <?php
        if(isset($_SESSION['updatePassword'])) {
            echo $_SESSION['updatePassword'];
            unset($_SESSION['updatePassword']);
        }
    ?>

<div class="profile-wrapper mt-20 p-20">
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
            </div>
            <a href="<?php echo SITEURL;?>teacher/teacher-edit-profile.php?id=<?php echo $id; ?>" class="primary-btn">Edit Profile</a>
            <div class="password">
                <a class="blue" href="<?php echo SITEURL;?>teacher/change-password.php?id=<?php echo $id; ?>">Change password</a>
            </div>
            
        </div>
        <div class="right-profile">
            <div class="email">
                <p>Email: <?php echo $email; ?></p>
            </div>
            <div class="enrolled-subjects">
                <p class="mb-10"><span>Assigned Subjects:</span></p>
                <?php
                    $sql2 = "SELECT * FROM teacher_subject AS ts 
                    INNER JOIN subjects_tbl AS s
                        ON ts.subject_id = s.subject_id
                    WHERE ts.teacher_id = $id";
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
            <div class="advisory">
                <p><span>Advisory Classes:</span></p>
                <?php
                    $sql3 = "SELECT * FROM teachers_tbl AS t
                        INNER JOIN section_tbl AS s
                            ON t.teacher_id = s.teacher_id
                        INNER JOIN categories_tbl AS c
                            ON c.category_id = s.category_id
                        WHERE s.teacher_id = $id
                        ORDER BY category_name;
                    ";
                    $res3 = mysqli_query($conn, $sql3);
                    while($row3 = mysqli_fetch_assoc($res3)) {
                        $section_name = $row3['section_name'];
                        $category_name = $row3['category_name'];
                        ?>
                            <p><?php echo $category_name." ".$section_name; ?></p>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    </div>
    <?php
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>teacher/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
</section>
<?php include"partials-teacher/footer.php"; ?>