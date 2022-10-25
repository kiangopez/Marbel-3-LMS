<?php include "partials-admin/header.php"; ?>
<?php
    if(is_numeric($_GET['id'])) {

        $sql_er = "SELECT * FROM term WHERE term_id =". $_GET['id'];
        $res_er = mysqli_query($conn, $sql_er);
        $count_er = mysqli_num_rows($res_er);

        if($count_er == true) {

        $id = $_GET['id'];

        $sql = "SELECT * FROM term WHERE term_id = $id;";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Edit Category</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="../includes/update-term.inc.php" method="POST" class="pt-20">
                <div>
                    <label for="term">Term:</label>
                    <input type="text" name="term" id="term" value="<?php echo $row['session'] ?>" required>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" value="<?php echo $_SESSION['adminId']; ?>" name="admin_id">

                    
                    <div class="p-0 space-between">
                        <div class="p-0">
                            <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-subjects.php">Back</a>
                            <button class="primary-btn" type="submit" name="submit">Update</button>
                        </div>
                    </div>
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