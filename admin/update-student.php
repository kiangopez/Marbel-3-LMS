<?php include "partials-admin/header.php"; ?>

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
                    $section_id = $row['section_id'];
                }
            } else {
                header("location:".SITEURL."admin/manage-students.php");
            }
            
        ?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Update Student</h2></div>
        <br>
        
        <div class="form-wrapper">
            <!-- NO ACTION FILE CREATED -->
            <form action="../includes/admin-student-update.inc.php" method="POST" class="pt-20">
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

                    <label class="text-left" for="">Section:</label>
                        <select name="section">
                            <?php
                                $sql2 = "SELECT * FROM section_tbl AS s INNER JOIN categories_tbl AS c ON s.category_id = c.category_id WHERE section_id = $section_id";
                                $res2 = mysqli_query($conn, $sql2);
                                $row2 = mysqli_fetch_assoc($res2);
                            ?>
                            <option value="<?php echo $section_id; ?>">Current Section: <?php echo $row2['category_name']." ".$row2['section_name'] ?></option>
                            <?php
                                $sql = "SELECT * FROM section_tbl AS s INNER JOIN categories_tbl AS c ON s.category_id = c.category_id ORDER BY category_name";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $section_id = $row['section_id'];
                                        $section_name = $row['section_name'];
                                        $category_name = $row['category_name'];
                                        ?> 
                                            <option value="<?php echo $section_id; ?>"><?php echo $category_name." ".$section_name; ?></option>   
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                        <br>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <!-- <input class="primary-btn" type="submit" name="submit" value="Update Profile"> -->
                    <button class="primary-btn" type="submit" name="submit">Update Profile</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-students.php?page=1">Back</a>
                </div>
            </form>
        </div>
        <?php
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
            } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
    </section>


<?php include "partials-admin/footer.php"; ?>