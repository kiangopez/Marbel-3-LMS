<?php include "partials-teacher/header.php"; ?>

<?php
    if(is_numeric($_GET['id'])) {
        $sql_er = "SELECT * FROM subjects_tbl WHERE subject_id =". $_GET['id'];
        $res_er = mysqli_query($conn, $sql_er);
        $count_er = mysqli_num_rows($res_er);

        if($count_er == true) {

        $subj_id = $_GET['id'];
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Add Submission</h2></div>
        

        <br><br>
        <div class="quiz p-20 tbl-50 form-wrapper">
            <form action="../includes/teacher-add-submission.inc.php" method="POST">
                <label for="">Quiz Submission Title</label>
                <input type="text" name="title" required>
                <label for="">Quiz Submission Description</label>
                <input type="text" name="description" required>
                <label for="">Submission End Date</label><br>
                <input type="date" name="end_date" required>
                <br>
                <label for="quarter">Select Period</label><br>
                <select name="quarter" id="quarter" required>
                    <option value=""></option>
                    <option value="1">1st Quarter</option>
                    <option value="2">2nd Quarter</option>
                    <option value="3">3rd Quarter</option>
                    <option value="4">4th Quarter</option>
                </select>
                <br>

                <input type="hidden" name="user_id" value="<?php echo $id;?>">
                <input type="hidden" name="subj_id" value="<?php echo $subj_id;?>">
                <input type="hidden" value="<?php echo $_SESSION['teacherId']; ?>" name="teacher_id">
                <button class="primary-btn" type="submit" name="submit">Save</button>
                <a href="<?php echo SITEURL;?>teacher/submission.php?id=<?php echo $subj_id; ?>" class="secondary-btn btn-20 mt-20">Back</a>
            </form>

            <div class="enroll-btn">
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


<?php include "partials-teacher/footer.php"; ?>
