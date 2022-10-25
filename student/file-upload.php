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

    <div class="submission-wrapper mt-20">
        <table class="tbl-full">
            <div class="subm-header">
                <h4><?php echo $title; ?></h4>
            </div>
            <tr>
                <td>Description</td>
                <td><?php echo $description; ?></td>
            </tr>
            <tr>
                <td>Due Date</td>
                <td><?php echo $end_date; ?></td>
            </tr>
            <tr>
                <td>Files Submitted</td>
                <td>
                    <?php
                        $sql1 = "SELECT * FROM student_submission WHERE submission_id = $sb_id AND student_id = ".$_SESSION['studentId'];
                        $res1 = mysqli_query($conn, $sql1);
                        $row1 = mysqli_fetch_assoc($res1);
                        $count1 = mysqli_num_rows($res1);
                        if($count1 > 0) {
                            $student_submission_id = $row1['student_submission_id'];
                            echo $row1['file'];
                        } else {
                            echo "-";
                        }
                    ?>
                </td>
            </tr>
            <tr class="text-center">
                <td colspan="2">
                    <?php 
                        if($count1 > 0) {
                            ?>
                                <a href="<?php echo SITEURL;?>student/edit-submission.php?id=<?php echo $sb_id;?>" class="primary-btn">Edit Submission</a>  <!-- Gawa ng edit and remove submission page  -->
                                <a href="<?php echo SITEURL;?>student/remove-submission.php?id=<?php echo $student_submission_id;?>&s_id=<?php echo $sb_id; ?>" class="primary-btn" onclick="javascript: return confirm('Do you want to remove this submission?');">Remove Submission</a>
                            <?php
                        } else {
                            ?>
                                <a href="<?php echo SITEURL;?>student/edit-submission.php?id=<?php echo $sb_id;?>" class="primary-btn">Add Submission</a>
                            <?php
                        }
                    ?>
                </td>
            </tr>
            <td class="n-b">
                <a href="<?php echo SITEURL;?>student/submission.php?id=<?php echo $sb_id; ?>" class="secondary-btn file-btn up-btn">Back</a>
            </td>
        </table>
    </div>
    </div>
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