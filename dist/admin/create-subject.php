<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Create Subject</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="../includes/create-subject.inc.php" method="POST" enctype="multipart/form-data" class="pt-20">
                <div class="create-subj">
                    <label for="subj-name">Subject Name:</label>
                    <input type="text" name="subj-name" id="subj-name">

                    <label for="subj-code">Subject Code:</label>
                    <input type="text" name="subj-code" id="subj-code">
                    
                    <label>Subject Banner:</label>
                    <input type="file" name="image" id="">

                    <label class="text-left" for="subj-cat">Subject Category:</label>
                    <select name="subj-cat">
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
 
                    <label for="subj-desc">Subject Description</label>
                    <textarea name="description" id="subj-desc" cols="30" rows="10"></textarea>

                    <div class="p-0">
                        <button class="primary-btn width-50" type="submit" name="submit">Create Subject</button>
                        <a class="secondary-btn width-50" href="<?php echo SITEURL;?>admin/manage-subjects.php">Back</a>
                    </div>

                </div>
            </form>
        </div>
    </section>


<?php include "partials-admin/footer.php"; ?>