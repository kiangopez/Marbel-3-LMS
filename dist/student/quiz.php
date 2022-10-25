<?php include"partials-student/header.php"; ?>

<?php
  if(isset($_GET['id'])) {
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
  }

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
                <th>Grade</th>
                <th></th>
            </tr>
            <?php
              $sql3 = "SELECT * FROM quiz_student WHERE quiz_id = $quiz_id AND student_id = $id";
              $res3 = mysqli_query($conn, $sql3);
              $count3 = mysqli_num_rows($res3);
              $row3 = mysqli_fetch_assoc($res3);
              if(isset($row3['grade'])) {
                $grade = $row3['grade'];
                $items = $row3['items'];
              }
              if($count3 > 0) {
                ?>
                <tr>
                  <td><?php echo $quiz_title; ?></td>
                  <td><?php echo $quiz_description; ?></td>
                  <td><?php echo $time_limit;?> minutes</td>
                  <td><?php echo $grade ."/". $items;?> <br></td>
                  <td><p>You already took this quiz</p></td>
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

   

    </div>
</div>

<?php include"partials-student/footer.php"; ?>