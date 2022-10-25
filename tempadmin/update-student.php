<?php include "partials-tempadmin/header.php"; ?>

        <?php
        if(is_numeric($_GET['id'])) {

            $sql_er = "SELECT * FROM students_tbl WHERE student_id =". $_GET['id'];
            $res_er = mysqli_query($conn, $sql_er);
            $count_er = mysqli_num_rows($res_er);
    
            if($count_er == true) {
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
                    }
                } else {
                    header("location:".SITEURL."tempadmin/manage-students.php");
                }
            
        ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Update Student</h2></div>
        <br>
        
        <div class="form-wrapper">
            <!-- NO ACTION FILE CREATED -->
            <form action="../includes/tempadmin-student-update.inc.php" method="POST" class="pt-20">
                <div>
                    <label for="usn">USN:</label>
                    <input type="number" name="usn" id="usn" value="<?php echo $usn; ?>" readonly>

                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>">
                                
                    <label for="mname">Middle Name:</label>
                    <input type="text" name="mname" id="mname" value="<?php echo $mname; ?>">

                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>">
                           
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" readonly>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <!-- <input class="primary-btn" type="submit" name="submit" value="Update Profile"> -->
                    <button class="primary-btn" type="submit" name="submit">Update Profile</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>tempadmin/manage-students.php?page=1">Back</a>
                </div>
            </form>
        </div>
        <?php
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>tempadmin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
            } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>tempadmin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
    </section>


<?php include "partials-tempadmin/footer.php"; ?>