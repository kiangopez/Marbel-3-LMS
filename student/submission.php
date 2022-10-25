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

    <div class="quiz-wrapper mt-20">
        <table class="tbl-full text-center">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Final Submission Date</th>
                <th>Grade</th>
                <th>Upload File</th>
            </tr>
            <?php
                $sql3 = "SELECT * FROM student_submission WHERE submission_id = $sb_id AND student_id = $id";
                $res3 = mysqli_query($conn, $sql3);
                $count3 = mysqli_num_rows($res3);
                $row3 = mysqli_fetch_assoc($res3);
                if(isset($row3['grade'])) {
                    $grade = $row3['grade'];
                    $items = $row3['items'];
                    ?>
                        <tr>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $description; ?></td>
                            <td><?php echo $end_date; ?></td>
                            <td>
                                <?php
                                    // Grade Section
                                    $sql1 = "SELECT * FROM student_submission WHERE submission_id = $sb_id AND student_id = ".$_SESSION['studentId'];
                                    $res1 = mysqli_query($conn, $sql1);
                                    $row1 = mysqli_fetch_assoc($res1);
                                    $count1 = mysqli_num_rows($res1);
                                    if($row1['grade'] == 0) {
                                        echo "-";
                                    } else {
                                        echo $row1['grade']."/".$row1['items'];
                                    }
                                ?>
                            </td>
                            <td><a class="primary-btn" href="<?php echo SITEURL;?>student/file-upload.php?id=<?php echo $sb_id; ?>">Upload File</a></td>
                        </tr>
                    <?php
                } else {
                    ?>
                        <tr>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $description; ?></td>
                            <td><?php echo $end_date; ?></td>
                            <td>-</td>
                            <td><a class="primary-btn" href="<?php echo SITEURL;?>student/file-upload.php?id=<?php echo $sb_id; ?>">Upload File</a></td>
                        </tr>
                    <?php
                }
                ?>
            

        </table>
        <a class="secondary-btn" href="<?php echo SITEURL;?>student/subject.php?id=<?php echo $subj_id; ?>">Back</a>
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

<?php include "partials-student/footer.php"; ?>