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
    $time_limit_in_seconds = $row['time_limit'];
  }

  $sql5 = "SELECT * FROM quiz_student WHERE student_id = $id AND quiz_id = $quiz_id";
  $res5 = mysqli_query($conn, $sql5);
  $count = mysqli_fetch_assoc($res5);

    if($count > 0) {
    } else {
        $sql6 = "INSERT INTO quiz_student (quiz_id, student_id, quiz_time) VALUES ($quiz_id, $id, $time_limit_in_seconds)";
        $res6 = mysqli_query($conn, $sql6);
    }
  ?>
  <script type="text/javascript">
      setInterval(() => {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.open("GET", "response.php", false);
          xmlhttp.send(null);
          document.getElementById("timer").innerHTML = xmlhttp.responseText;
      }, 1000);
  </script>
  
  <div class="dashboard wrapper column" id="dashboard">
    <div class="subject-heading">
    <h2><?php echo $subject_name." ".$subject_code; ?></h2>
    <div class="subject-path">
        <a href="<?php echo SITEURL;?>student/index.php">Dashboard</a>
        <p>My Subjects</p>
        <a href="<?php echo SITEURL;?>student/subject.php?id=<?php echo $subj_id; ?>"><?php echo $subject_code; ?></a> / <a href="<?php echo SITEURL;?>student/quiz.php?id=<?php echo $quiz_id; ?>"><?php echo $quiz_title; ?></a>
    </div>
    </div>
  
    <div class="attempt-details">
        <p>Time Remaining: <div id="timer"></div></p>
    </div>
    <form action="../includes/submit-attempt.inc.php" method="POST">
        <div class="attempt-wrapper mt-20 p-0">
            <div class="question-wrapper"> <!--question-wrapper-->
            <?php 
                $sql1 = "SELECT * FROM quiz_question WHERE quiz_id = $quiz_id;";
                $res1 = mysqli_query($conn, $sql1);
                
                $items = 1;
                $numbering = 0;

                while($row1 = mysqli_fetch_assoc($res1)) {
                    $question_text = $row1['question_text'];
                    $question_type_id = $row1['question_type_id'];
                    $quiz_question_id = $row1['quiz_question_id'];
                    ?>
                <div class="question p-20">
                    <p><?php echo $items.". ".$question_text; ?></p>
                </div> <!--question end-->
                    <?php
                    if($question_type_id == "2") {
                        ?>
                            <div class="choices p-0">
                                <div>
                                    <input type="radio" name="q-<?php echo $row1['quiz_question_id'];?>" value="True"> True 
                                </div>
                                <div>
                                    <input type="radio" name="q-<?php echo $row1['quiz_question_id'];?>" value="False"> False 
                                </div>
                            </div> <!--Choices end-->
                        <?php
                    } else if ($question_type_id == "1") {
                        $sql2 = "SELECT * FROM answer WHERE quiz_question_id = $quiz_question_id";
                        $res2 = mysqli_query($conn, $sql2);
                        
                        while($row2 = mysqli_fetch_assoc($res2)) {
                            $choices = $row2['choices'];
                            $answer_text = $row2['answer_text'];

                            if($choices == 'A') {
                                ?>
                                <div class="choices p-0">
                                    <div>
                                        <input type="radio" name="q-<?php echo $row1['quiz_question_id'];?>" value="A"> <label for=""><?php echo $answer_text; ?></label>
                                    </div>
                                <?php
                            } else if ($choices == 'B') {
                                ?>
                                    <div>
                                        <input type="radio" name="q-<?php echo $row1['quiz_question_id'];?>" value="B"> <label for=""><?php echo $answer_text; ?></label>
                                    </div>
                                <?php
                            } else if ($choices == 'C') {
                                ?>
                                    <div>
                                        <input type="radio" name="q-<?php echo $row1['quiz_question_id'];?>" value="c"> <label for=""><?php echo $answer_text; ?></label>
                                    </div>
                                <?php
                            } else if ($choices == 'D') {
                                ?>
                                    <div>
                                        <input type="radio" name="q-<?php echo $row1['quiz_question_id'];?>" value="D"> <label for=""><?php echo $answer_text; ?></label>
                                    </div>  
                                </div>  
                                    <?php
                            }
                        }
                    }
                    $items++;
                    $numbering++;
                ?>
                    <input type="hidden" name="x-<?php echo $numbering;?>" value="<?php echo $quiz_question_id;?>">
                    <input type="hidden" name="x" value="<?php echo $numbering; ?>">
                    <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
                    <input type="hidden" name="student_id" value="<?php echo $id; ?>">
                <?php
                }
            ?>
            </div> <!--question-wrapper end-->


        </div> <!--attempt-wrapper end-->
        <div class="submit-attempt text-right">
            <button class="primary-btn" name="submit" type="submit">Submit Quiz</button>
        </div>
    </form>
  
</div> <!--dashboard wrapper end-->

<?php include"partials-student/footer.php"; ?>