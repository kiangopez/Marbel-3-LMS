<?php include"partials-student/header.php"; ?>

<?php
  if(isset($_GET['id'])) {
    $subj_id = $_GET['id'];
    $sql = "SELECT * FROM subjects_tbl AS s
      INNER JOIN files AS f
        ON s.subject_id = f.subject_id
      WHERE s.subject_id = $subj_id AND status = 'active';
    ";
    $res = mysqli_query($conn, $sql);
    
    $sql2 = "SELECT * FROM subjects_tbl WHERE subject_id = $subj_id;";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);
    $description = $row2['description'];
    $subject_name = $row2['subject_name'];
    $subject_code = $row2['subject_code'];
  }
?>

<div class="dashboard wrapper column" id="dashboard">
    <div class="subject-heading">
      <h2><?php echo $subject_name." ".$subject_code; ?></h2>
      <div class="subject-path">
        <a href="<?php echo SITEURL;?>student/index.php">Dashboard</a>
        <p>My Subjects</p>
        <a href=""><?php echo $row2['subject_code'] ?></a>
      </div>
    </div>

    <div class="flex subject-page">
      <h2>"<?php echo $description; ?>"</h2>
    </div>

    <div class="subject-wrapper">

      <div class="week">
        <div class="week-heading">
          <h4>Subject Modules</h4>
        </div>
        <div class="week-content">
          <?php
            while($row = mysqli_fetch_assoc($res)) {
              $file_name = $row['filename'];
              $file_id = $row['file_id'];
              ?>
                <div class="week-content-wrapper">
                  <a href="<?php echo SITEURL;?>student/download.php?id=<?php echo $file_id; ?>&subj_id=<?php echo $subj_id; ?>"><ion-icon name="document-text-sharp"></ion-icon><?php echo $file_name; ?></a>
                </div>
              <?php
            }
          ?>
        </div>
      </div>

      <div class="week">
        <div class="week-heading">
          <h4>Quizzes</h4>
        </div>
        <div class="week-content">
        <?php
          $sql3 = "SELECT * FROM quiz WHERE subject_id = $subj_id AND status = 'active';";
          $res3 = mysqli_query($conn, $sql3);
          
          while($row3 = mysqli_fetch_assoc($res3)) {
            $quiz_title = $row3['quiz_title'];
            $quiz_id = $row3['quiz_id'];
            ?>
              <div class="week-content-wrapper">
                <a href="<?php echo SITEURL;?>student/quiz.php?id=<?php echo $quiz_id; ?>"><ion-icon name="alarm-sharp"></ion-icon><?php echo $quiz_title; ?></a>
              </div>
            <?php
          }
        ?>
        </div>
      </div>

      <div class="week">
        <div class="week-heading">
          <h4>File Submissions</h4>
        </div>
        <div class="week-content">
        <?php
          $sql3 = "SELECT * FROM file_submission WHERE subject_id = $subj_id AND status = 'active';";
          $res3 = mysqli_query($conn, $sql3);
          
          while($row3 = mysqli_fetch_assoc($res3)) {
            $title = $row3['title'];
            $sb_id = $row3['submission_id'];
            ?>
              <div class="week-content-wrapper">
                <a href="<?php echo SITEURL;?>student/submission.php?id=<?php echo $sb_id; ?>"><ion-icon name="alarm-sharp"></ion-icon><?php echo $title; ?></a>
              </div>
            <?php
          }
        ?>
        </div>
      </div>

    </div>
</div>

<?php include"partials-student/footer.php"; ?>