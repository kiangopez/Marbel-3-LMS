<?php include"partials-student/header.php"; ?>
        <?php
            if($_GET['id'] == $_SESSION['studentId']) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM students_tbl WHERE student_id = $id";
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
                    $current_image = $row['image_name'];
                }
            } else {
                header("location:".SITEURL."student/student-profile.php");
            }
        ?>
<section class="dashboard wrapper column" id="dashboard">
    <div class="heading p-20"><h2>Edit Profile</h2></div>


    <div class="form-wrapper">
        <form action="../includes/student-update.inc.php" method="POST" enctype="multipart/form-data" class="pt-20">
            <div class="form-control">
            <label>Current Profile Picture:</label>
            <br>
                <?php 
                    if($current_image == "") {
                        echo "No image uploaded <br>";
                    } else {
                        ?>
                            <img src="<?php echo SITEURL;?>assets/user_images/<?php echo $current_image; ?>" width="150px">
                        <?php
                    }
                ?>
                <br>
                <input type="file" name="image">
                <br>
                <br>
            </div>
            <div class="form-control">
                <label for="usn">Student ID:</label>
                <input type="text" name="usn" id="usn" value="<?php echo $usn; ?>" readonly>               
            </div>

            <div class="form-control">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" readonly>               
            </div>

            <div class="form-control">
                <label for="mname">Middle Name:</label>
                <input type="text" name="mname" id="mname" value="<?php echo $mname; ?>" readonly>
            </div>

            <div class="form-control">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>" readonly>
            </div>

            <div class="form-control">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="<?php echo $email; ?>">
            </div>

            <div class="form-control">  
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <button class="primary-btn" type="submit" name="submit">Update Profile</button>
                <a class="secondary-btn" href="<?php echo SITEURL;?>student/student-profile.php?id=<?php echo $id; ?>">Back</a>
            </div>
        </form>
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