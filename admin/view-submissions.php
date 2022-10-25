<?php include "partials-admin/header.php"; ?>

<?php
    if(is_numeric($_GET['id'])) {
        $sql_er = "SELECT * FROM file_submission WHERE submission_id =". $_GET['id'];
        $res_er = mysqli_query($conn, $sql_er);
        $count_er = mysqli_num_rows($res_er);

        if($count_er == true) {

        $sb_id = $_GET['id'];
        $row_er = mysqli_fetch_assoc($res_er);
        $subject_id = $row_er['subject_id'];
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Student Submissions</h2></div>

        <?php
            if(isset($_SESSION['grade'])) {
                echo $_SESSION['grade'];
                unset($_SESSION['grade']);
            }
        ?>

        <br><br>
        <div class="submissions-table p-20">
            <table class="text-center tbl-full">
                <tr>
                    <th>LRN</th>
                    <th>Student Name</th>
                    <th>File</th>
                    <th>Grade</th>
                    <th>Add Grade</th>
                </tr>
                <?php
                    $sql = "SELECT * 
                        FROM student_submission AS submission
                        INNER JOIN students_tbl AS students
                            ON submission.student_id = students.student_id
                        WHERE submission_id = $sb_id;
                    ";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            // Variables
                            $student_submission_id = $row['student_submission_id'];
                            $student_id = $row['student_id'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $file = $row['file'];
                            $grade = $row['grade'];
                            $items = $row['items'];
                            $usn = $row['USN'];
                            ?>
                            <tr>
                                <td><?php echo $usn; ?></td>
                                <td><?php echo $fname." ".$lname; ?></td>
                                <td class="">
                                    <form action="../includes/admin-download-submission.inc.php" method="POST">
                                        <p><?php echo $file;?></p>
                                        <input type="hidden" name="student_submission_id" value="<?php echo $student_submission_id; ?>">
                                        <input type="hidden" name="sb_id" value="<?php echo $sb_id; ?>">
                                        <button class="success-btn" type="submit" name="submit">Download</button>
                                    </form>
                                </td>
                                <td><?php echo $grade."/".$items; ?></td>
                                <td>
                                    <form action="../includes/admin-submission-grade.inc.php" method="POST">
                                        <input type="number" name="grade" placeholder="" min=1 max=10>
                                        <input type="hidden" name="sb_id" value="<?php echo $sb_id; ?>">
                                        <input type="hidden" name="student_submission_id" value="<?php echo $student_submission_id; ?>">
                                        <button class="primary-btn" type="submit" name="submit">Save</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <td colspan="5">No submissions available</td>
                        <?php
                    }
                ?>
                
            
            </table>

        </div>
        
        <div class="enroll-btn p-20">
            <a href="<?php echo SITEURL;?>admin/submission.php?id=<?php echo $subject_id; ?>" class="secondary-btn btn-20 mt-20">Back</a>
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
