<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Add Student</h2></div>
        <br>
        
        <div class="form-wrapper">
            <div class="add-student">
                <form action="../includes/add-students.inc.php" method="POST" class="pt-20">
                    <div>
                        <?php
                            $random = rand(1000,9999);
                            $student_usn = $random.date('Y');
                        ?>
                        <label for="usn">USN:</label>
                        <input type="number" name="usn" id="usn" value="<?php echo $student_usn; ?>" readonly>

                        <label for="fname">First Name:</label>
                        <input type="text" name="fname" id="fname" required>
                                    
                        <label for="mname">Middle Name:</label>
                        <input type="text" name="mname" id="mname" required>

                        <label for="lname">Last Name:</label>
                        <input type="text" name="lname" id="lname" required>
                        
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required>

                        <label class="text-left" for="student-cat">Student Category:</label>
                        <select name="student_cat">
                            <?php
                                $sql = "SELECT * FROM categories_tbl;";
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['category_id'];
                                        $cat_name = $row['category_name'];
                                        ?> 
                                            <option value="<?php echo $id; ?>"><?php echo $cat_name; ?></option>   
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                        <br>

                        <label class="text-left" for="">Section:</label>
                        <select name="section">
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

                        


                        <label for="pwd">Password:</label>
                        <input type="password" name="pwd" id="pwd" required>

                        <label for="pwd_repeat">Confirm Password:</label>
                        <input type="password" name="pwd_repeat" id="pwd_repeat" required>                

                        <input type="hidden" value="<?php echo $_SESSION['adminId']; ?>" name="admin_id">


                        <button class="primary-btn" type="submit" name="submit">Add Student</button>
                        <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-students.php?page=1">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
    </script>

<?php include "partials-admin/footer.php"; ?>