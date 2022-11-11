<?php include"partials-student/header.php"; ?>

<?php
  if(is_numeric($_GET['id'])) {
    $sql_er = "SELECT * FROM file_submission WHERE submission_id =". $_GET['id'];
    $res_er = mysqli_query($conn, $sql_er);
    $count_er = mysqli_num_rows($res_er);
    $row_er = mysqli_fetch_assoc($res_er);

    if($count_er == true) {
      $sb_id = $_GET['id'];
      $sql = "SELECT * FROM file_submission AS f INNER JOIN subjects_tbl AS s ON f.subject_id = s.subject_id WHERE submission_id = $sb_id;";
      $res = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($res);
      $subj_id = $row['subject_id'];
      $subject_name = $row['subject_name'];
      $subject_code = $row['subject_code'];
      $title = $row['title'];
      $description = $row['sub_description'];
      $end_date = $row['end_date'];
      $count = mysqli_num_rows($res);
    
?>

<div class="dashboard wrapper column" id="dashboard">
    <div class="subject-heading">
    <h2><?php echo $subject_name." ".$subject_code; ?></h2>
      <div class="subject-path">
        <a href="<?php echo SITEURL;?>student/index.php">Dashboard</a>
        <p>My Subjects</p>
        <a href="<?php echo SITEURL;?>student/subject.php?id=<?php echo $subj_id; ?>"><?php echo $subject_code; ?></a>

      </div>
    </div>
    <?php
    $sql1 = "SELECT * FROM student_submission WHERE submission_id = $sb_id AND student_id = ".$_SESSION['studentId'];
    $res1 = mysqli_query($conn, $sql1);
    $count1 = mysqli_num_rows($res1);
    $row1 = mysqli_fetch_assoc($res1);
        if($count1 > 0) {
            // The student wants to edit
            ?>
                <div class="edit-submission-wrapper mt-20">
                    <table>
                        <div class="edit-subm-header">
                            <h4><?php echo $title; ?></h4>
                            asdfasdfasdf
                        </div>
                        <div class="file-types">
                            <p>Accepted File Types: pdf, doc, docx</p>
                        </div>
                    </table>
                    <div class="up-files">
                        <p>File(s) Uploaded:</p>
                        <p><?php echo $row1['file']; ?></p>
                    </div>

                    <form action="<?php echo SITEURL; ?>includes/update-student-submission.inc.php" method="POST" enctype="multipart/form-data">
                        <div class="control">
                            <input type="file" name="files" required>
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['studentId'] ?>">
                            <input type="hidden" name="student_submission_id" value="<?php echo $row1['student_submission_id'] ?>">
                            <input type="hidden" name="sb_id" value="<?php echo $sb_id; ?>">
                            <button class="primary-btn" type="submit" name="submit">Submit</button>
                            <a href="<?php echo SITEURL;?>student/file-upload.php?id=<?php echo $sb_id; ?>" class="secondary-btn file-btn">Cancel</a>
                        </div>
                    </form>
                </div>
                    <?php
                        if(isset($_SESSION['fileUpload'])) {
                            echo $_SESSION['fileUpload'];
                            unset($_SESSION['fileUpload']);
                        }
                    ?>
            <?php
        } else if ($count1 == 0) {
            // The student wants to create submission
            ?>
                <div class="edit-submission-wrapper mt-20">
                    <table>
                        <div class="edit-subm-header">
                            <h4><?php echo $title; ?></h4>
                        </div>
                        <div class="file-types">
                            <p>Accepted File Types: pdf, doc, docx</p>
                        </div>
                    </table>

                    <form action="<?php echo SITEURL; ?>includes/student-submission.inc.php" method="POST" enctype="multipart/form-data">
                        <div class="control">
                            <input type="file" name="files" required>
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['studentId'] ?>">
                            <input type="hidden" name="sb_id" value="<?php echo $sb_id; ?>">
                            <button class="primary-btn" type="submit" name="submit">Submit</button>
                            <a href="<?php echo SITEURL;?>student/file-upload.php?id=<?php echo $sb_id; ?>" class="secondary-btn file-btn">Cancel</a>
                        </div>
                    </form>
                </div>
                    <?php
                        if(isset($_SESSION['fileUpload'])) {
                            echo $_SESSION['fileUpload'];
                            unset($_SESSION['fileUpload']);
                        }
                    ?>
            <?php
        }
    ?>

    <?php
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>student/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
            } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>student/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
</div>

<?php include"partials-student/footer.php"; ?>