<?php include "partials-admin/header.php"; ?>

        <?php
        if(is_numeric($_GET['id'])) {

            $sql_er = "SELECT * FROM section_tbl WHERE section_id =". $_GET['id'];
            $res_er = mysqli_query($conn, $sql_er);
            $count_er = mysqli_num_rows($res_er);
    
            if($count_er == true) {

            $section_id = $_GET['id'];
            $sql = "SELECT * FROM section_tbl WHERE section_id = $section_id";
            $res = mysqli_query($conn, $sql);

            if($res == TRUE) {
                $count = mysqli_num_rows($res);
                
                if($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $section_name = $row['section_name'];
                    $category_id = $row['category_id'];
                    $teacher_id = $row['teacher_id'];
                }
            } else {
                header("location:".SITEURL."admin/manage-students.php");
            }
            
        ?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Update Section</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="../includes/update-section.inc.php" method="POST" class="pt-20">
                <div>
                    <label for="section_name">Section Name:</label>
                    <input type="text" name="section_name" id="section_name" value="<?php echo $section_name; ?>"><br>

                    <label for="sec_cat">Section Category:</label>
                    <select class="chosen-select " name="section_category" id="section_category" required>
                        <?php
                            $sql2 = "SELECT * FROM categories_tbl WHERE category_id = $category_id;";
                            $res2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($res2);
                        ?>
                        <option value="<?php echo $category_id; ?>">Current category: <?php echo $row2['category_name'] ?></option>
                        <script>
                            $(document).ready(function(){
                                $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
                            })
                        </script>
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
                    </select><br><br>

                    <label for="adviser">Adviser:</label>
                    <select class="chosen-select" name="adviser_id" id="" required>
                        <?php
                            $sql3 = "SELECT * FROM teachers_tbl WHERE teacher_id = $teacher_id";
                            $res3 = mysqli_query($conn, $sql3);
                            $row3 = mysqli_fetch_assoc($res3);
                        ?>
                        <option value="<?php echo $teacher_id; ?>">Current Adviser: <?php echo $row3['fname']." ".$row3['lname']; ?></option>
                        <script>
                            $(document).ready(function(){
                                $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
                            })
                        </script>
                        <?php
                        $sql1 = "SELECT * FROM teachers_tbl ORDER BY fname ASC";
                        $res1 = mysqli_query($conn, $sql1);
                        $count1 = mysqli_num_rows($res1);

                        if($count1 > 0) {
                           while($row1 = mysqli_fetch_assoc($res1)) {
                               $teacher_id = $row1['teacher_id'];
                               $fname = $row1['fname'];
                               $mname = $row1['mname'];
                               $lname = $row1['lname'];
                               $full_name = $fname.' '.$mname.' '.$lname;
                               ?>
                                <option value="<?php echo $teacher_id; ?>"><?php echo $full_name;?></option>
                               <?php
                           }
                        }
                    ?>
                    </select><br>

                    
                    <input type="hidden" value="<?php echo $_SESSION['adminId']; ?>" name="admin_id">
                    <input type="hidden" value="<?php echo $section_id; ?>" name="section_id">
                    <button class="primary-btn" type="submit" name="submit">Update Section</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-sections.php">Back</a>
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