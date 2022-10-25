<?php include "partials-admin/header.php"; ?>

<?php
    if(is_numeric($_GET['id'])) {
        $sql_er = "SELECT * FROM subjects_tbl WHERE subject_id =". $_GET['id'];
        $res_er = mysqli_query($conn, $sql_er);
        $count_er = mysqli_num_rows($res_er);

        if($count_er == true) {

        $subj_id = $_GET['id'];
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Subject Quizzes</h2></div>

        <br><br>
        <div class="p-20">
            <a href="<?php echo SITEURL;?>admin/add-submission.php?id=<?php echo $subj_id;?>" class="primary-btn">Add Submission</a>
        </div>
        <?php
            if(isset($_SESSION['addQuiz'])) {
                echo $_SESSION['addQuiz'];
                unset($_SESSION['addQuiz']);
            }
            if(isset($_SESSION['quizStatus'])) {
                echo $_SESSION['quizStatus'];
                unset($_SESSION['quizStatus']);
            }
        ?>
        <div class="quiz-table p-20">
            <table class="text-center tbl-full">
                <tr>
                    <th>Quarter Period</th>
                    <th>Quiz Title</th>
                    <th>Description</th>
                    <th>Added by</th>
                    <th>Date Added</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Student Submissions</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM file_submission WHERE subject_id = $subj_id ORDER BY submission_id DESC;";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            // Variables
                            $status = $row['status'];
                            $sb_id = $row['submission_id'];
                            ?>
                            <tr>
                                <td><?php echo $row['quarter']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['sub_description']; ?></td>
                                <td><?php echo $row['added_by']; ?></td>
                                <td><?php echo $row['date_added']; ?></td>
                                <td><?php echo $row['end_date']; ?></td>
                                <td>
                                    <?php
                                        if($status == "inactive") {
                                            ?>
                                                <a href="<?php echo SITEURL;?>admin/submission-status.php?id=<?php echo $sb_id;?>&status=inactive&subj_id=<?php echo $subj_id; ?>&user_id=<?php echo $_SESSION['adminId']; ?>" class="danger-btn">Inactive</a>

                                            <?php
                                        } else if($status == "active"){
                                            ?>
                                                <a href="<?php echo SITEURL;?>admin/submission-status.php?id=<?php echo $sb_id;?>&status=active&subj_id=<?php echo $subj_id; ?>&user_id=<?php echo $_SESSION['adminId']; ?>" class="success-btn">Active</a>

                                            <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <div class="actions flex">
                                        <a class="success-btn" href="<?php echo SITEURL;?>admin/view-submissions.php?id=<?php echo $sb_id; ?>">View</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <td colspan="8">No quiz submissions added</td>
                        <?php
                    }
                ?>
                
            
            </table>

        </div>
        
        <div class="enroll-btn p-20">
            <a href="<?php echo SITEURL;?>admin/manage-subjects.php" class="secondary-btn btn-20 mt-20">Back</a>
        </div>
        
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
