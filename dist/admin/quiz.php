<?php include "partials-admin/header.php"; ?>

<?php
    if(isset($_GET['id'])) {
        $subj_id = $_GET['id'];
    }
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Subject Quizzes</h2></div>

        <br><br>
        <div class="p-20">
            <a href="<?php echo SITEURL;?>admin/add-quiz.php?id=<?php echo $subj_id;?>" class="primary-btn">Add Quiz</a>
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
                    <th>Time Limit</th>
                    <th>Added by</th>
                    <th>Date Added</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM quiz WHERE subject_id = $subj_id ORDER BY quiz_id DESC;";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $quiz_id = $row['quiz_id'];
                            $quiz_title = $row['quiz_title'];
                            $quiz_description = $row['quiz_description'];
                            $date_added = $row['date_added'];
                            $added_by = $row['added_by'];
                            $status = $row['status'];
                            $quarter = $row['quarter'];
                            $time_limit = $row['time_limit'] / 60;
                            ?>
                            <tr>
                                <td><?php echo $quarter; ?></td>
                                <td><?php echo $quiz_title; ?></td>
                                <td><?php echo $quiz_description; ?></td>
                                <td><?php echo $time_limit; ?> minutes</td>
                                <td><?php echo $added_by; ?></td>
                                <td><?php echo $date_added; ?></td>
                                <td>
                                    <?php
                                        if($status == "inactive") {
                                            ?>
                                                <a href="<?php echo SITEURL;?>admin/quiz-status.php?id=<?php echo $quiz_id;?>&status=inactive&subj_id=<?php echo $subj_id; ?>" class="danger-btn">Inactive</a>

                                            <?php
                                        } else if($status == "active"){
                                            ?>
                                                <a href="<?php echo SITEURL;?>admin/quiz-status.php?id=<?php echo $quiz_id;?>&status=active&subj_id=<?php echo $subj_id; ?>" class="success-btn">Active</a>

                                            <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <div class="actions flex">
                                        <a class="success-btn" href="<?php echo SITEURL;?>admin/questions.php?id=<?php echo $quiz_id; ?>">Add Questions</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <td colspan="8">No quiz added</td>
                        <?php
                    }
                ?>
                
            
            </table>

        </div>
        
        <div class="enroll-btn p-20">
            <a href="<?php echo SITEURL;?>admin/manage-subjects.php" class="secondary-btn btn-20 mt-20">Back</a>
        </div>
        
    </div>
    </section>


<?php include "partials-admin/footer.php"; ?>
