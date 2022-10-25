<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Add Section</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="../includes/add-section.inc.php" method="POST" class="pt-20">
                <div>
                    <label for="section_name">Section Name:</label>
                    <input type="text" name="section_name" id="section_name"><br>

                    <label for="sec_cat">Section Category:</label>
                    <select class="chosen-select " name="section_category" id="section_category" required>
                        <option value="">Select Category below</option>
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
                        <option value="">Select Adviser</option>
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
                    <button class="primary-btn" type="submit" name="submit">Create Section</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-sections.php">Back</a>
                </div>
            </form>
        </div>
    </section>


<?php include "partials-admin/footer.php"; ?>