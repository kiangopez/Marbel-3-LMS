<?php include "partials-admin/header.php"; ?>
<?php
    if(is_numeric($_GET['id'])) {

        $sql_er = "SELECT * FROM subjects_tbl WHERE subject_id =". $_GET['id'];
        $res_er = mysqli_query($conn, $sql_er);
        $count_er = mysqli_num_rows($res_er);

        if($count_er == true) {
    
            $id = $_GET['id'];

            $sql = "SELECT * FROM subjects_tbl WHERE subject_id = $id;";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);

            $subject_name = $row['subject_name'];
            $subject_code = $row['subject_code'];
            $current_image = $row['image_name'];
            $current_category = $row['category_id'];
            $description = $row['description'];

?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Edit Subject</h2></div>
        <br>
        
        <div class="edit-subject form-wrapper">
            <form action="../includes/edit-subject.inc.php" method="POST" enctype="multipart/form-data" class="pt-20">
                            <div class="form-control mb-10">
                                <label for="subj-name">Subject Name:</label>
                                <input type="text" name="subj-name" id="subj-name" value="<?php echo $subject_name ?>">
                            </div>

                            <div class="form-control mb-10">
                                <label for="subj-code">Subject Code:</label>
                                <input type="text" name="subj-code" id="subj-code" value="<?php echo $subject_code ?>">
                            </div>

                            <div class="form-control mb-10">
                                <label for="">Current Banner</label>
                                <img src="<?php echo SITEURL;?>assets/subject_images/<?php echo $current_image; ?>" width="150px">
                            </div>

                            <div class="form-control mb-10">
                                <label>Subject Banner:</label>
                                <input type="file" name="image">
                            </div>
 
                            <div class="form-control form-category mb-10">
                                <label class="text-left" for="subj-cat">Subject Category:</label>
                                <select name="subj-cat">
                                <?php
                                    $sql1 = "SELECT * FROM categories_tbl;";
                                    $res1 = mysqli_query($conn, $sql1);
            
                                    $count1 = mysqli_num_rows($res1);
            
                                    if($count1 > 0) {
                                        while($row1 = mysqli_fetch_assoc($res1)) {
                                            $cat_id = $row1['category_id'];
                                            $cat_name = $row1['category_name'];
                                            ?> 
                                                <option <?php if($current_category == $cat_id) {echo "selected";} ?> value="<?php echo $cat_id;?>"><?php echo $cat_name;?></option>   
                                            <?php
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-control form-description mb-10">
                                <label for="subj-desc">Subject Description</label>
                                <textarea name="description" id="subj-desc" cols="30" rows="10"><?php echo $description ?></textarea>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" value="<?php echo $_SESSION['adminId']; ?>" name="admin_id">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            </div>
                            <div class="space-between">
                                <div class="p-0">
                                    <a class="secondary-btn width-50" href="<?php echo SITEURL;?>admin/manage-subjects.php">Back</a>
                                    <button class="primary-btn" type="submit" name="submit">Update</button>
                                </div>
                                <!-- <div class="p-0">
                                    <a href="" class="danger-btn">Remove</a>
                                </div> -->
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