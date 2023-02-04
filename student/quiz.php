<?php include"partials-student/header.php"; ?>

<?php
  if(is_numeric($_GET['id'])) {
    $sql_er = "SELECT * FROM quiz WHERE quiz_id =". $_GET['id'];
    $res_er = mysqli_query($conn, $sql_er);
    $count_er = mysqli_num_rows($res_er);

    if($count_er == true) {
      $quiz_id = $_GET['id'];
      $sql = "SELECT * FROM quiz AS q INNER JOIN subjects_tbl AS s ON q.subject_id = s.subject_id WHERE quiz_id = $quiz_id;";
      $res = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($res);
      $subj_id = $row['subject_id'];
      $subject_name = $row['subject_name'];
      $subject_code = $row['subject_code'];
      $quiz_title = $row['quiz_title'];
      $quiz_description = $row['quiz_description'];
      $time_limit = $row['time_limit'] / 60;
      $count = mysqli_num_rows($res);
    

      $_SESSION['duration'] = $time_limit;
      $_SESSION['start_time'] = date("Y-m-d H:i:s");
      $end_time = $end_time = date('Y-m-d H:i:s', strtotime('+' .$_SESSION['duration']. 'minutes', strtotime($_SESSION['start_time'])));
      $_SESSION['end_time'] = $end_time;
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
                <th>Quiz</th>
                <th>Quiz Notes</th>
                <th>Time Limit</th>
                <th>Final Grade</th>
                <th></th>
            </tr>
            <?php
              $sql3 = "SELECT * FROM quiz_student WHERE quiz_id = $quiz_id AND student_id = $id";
              $res3 = mysqli_query($conn, $sql3);
              $count3 = mysqli_num_rows($res3);
              $row3 = mysqli_fetch_assoc($res3);

              $sql_attempt2 = "SELECT * FROM attempt_tbl AS a WHERE student_id = $id AND quiz_id = $quiz_id";
              $res_attempt2 = mysqli_query($conn, $sql_attempt2);
              $count_attempt = mysqli_num_rows($res_attempt2);

              if(isset($row3['grade'])) {
                if(isset($row3['status'])) {
                  $grade = $row3['grade'];
                  $items = $row3['items'];
                  $status = $row3['status'];
                }
              } else {
                $status = " ";
              }
              if($count_attempt >= 5) {
                $sql_attempt3 = "SELECT grade FROM attempt_tbl AS a WHERE student_id = $id AND quiz_id = $quiz_id ORDER BY grade DESC";
                $res_attempt3 = mysqli_query($conn, $sql_attempt3);
                $row4 = mysqli_fetch_assoc($res_attempt3);
                $final_grade = $row4['grade'];
                
                ?>
                <tr>
                  <td><?php echo $quiz_title; ?></td>
                  <td><?php echo $quiz_description; ?></td>
                  <td><?php echo $time_limit;?> minutes</td>
                  <td><?php echo $final_grade ."/". $items;?> <br></td>
                  <td><p>You have reached the max number of attempts</p></td>
                </tr>
                <?php

              } else if ($status == "attempted"){
                ?>
                <tr>
                    <td><?php echo $quiz_title; ?></td>
                    <td><?php echo $quiz_description; ?></td>
                    <td><?php echo $time_limit;?> minutes</td>
                    <td><?php echo $grade ."/". $items;?> <br></td>
                    <td><a class="blue" href="<?php echo SITEURL;?>student/attempt.php?id=<?php echo $quiz_id; ?>">Continue Attempt</a></td>
                </tr>
                <?php

              } else if ($count_attempt > 6) {
                ?>
                <tr>
                  <td><?php echo $quiz_title ?></td>
                  <td><?php echo $quiz_description; ?></td>
                  <td><?php echo $time_limit;?> minutes</td>
                  <td>-</td>
                <td><a class="blue" href="<?php echo SITEURL;?>student/attempt.php?id=<?php echo $quiz_id; ?>">Attempt Quiz</a></td>
            </tr>
            <?php
              } else {
                ?>
                <tr>
                  <td><?php echo $quiz_title; ?></td>
                  <td><?php echo $quiz_description; ?></td>
                  <td><?php echo $time_limit;?> minutes</td>
                  <td>-</td>
                <td><a class="blue" href="<?php echo SITEURL;?>student/attempt.php?id=<?php echo $quiz_id; ?>">Attempt Quiz</a></td>
            </tr>
            <?php
              }
            ?>
            
        </table>
    </div>
    <?php
      if($status == "submitted") {
        $sql_attempt = "SELECT * FROM attempt_tbl AS a WHERE student_id = $id AND quiz_id = $quiz_id";
        $res_attempt = mysqli_query($conn, $sql_attempt);
        // $count = mysqli_num_rows($res_attempt);
        $att_number = 1;
        ?>
        <div class="attempt-tbl">
          <table class="tbl-full text-center ">
            <tr>
              <th>Attempt No.</th>
              <th>Date attempted</th>
              <th>Score</th>
            </tr>
              <?php
                while($attempt_row = mysqli_fetch_assoc($res_attempt)) {
                  $att_date = $attempt_row['date_attempted'];
                  $attempt_grade = $attempt_row['grade']."/".$attempt_row['items'];
                  ?>
                  <tr>
                    <td><?php echo $att_number++; ?></td>
                    <td><?php echo $att_date; ?></td>
                    <td><?php echo $attempt_grade; ?></td>
                  </tr>
                  <?php
                }
              ?>
          </table>
        </div>
        <?php
      } 
    ?>
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