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
        $time_limit = $row['time_limit'] / 60; // Time in minutes
        $time_limit_in_seconds = $row['time_limit']; // Time in seconds
  

        $sql_ad = "SELECT * FROM students_tbl WHERE student_id =".$_SESSION['studentId'];
        $res_ad = mysqli_query($conn, $sql_ad);
        $row_ad = mysqli_fetch_assoc($res_ad);
        $user_name = $row_ad['fname']." ".$row_ad['lname'];
        $role = "Student";

        date_default_timezone_set('Asia/Manila');
        $date_today = date('d-m-y h:i:s');

        $action_details = $user_name." started an attempt on a quiz in ".$subject_name." (".$subject_code.").";

        $sql_user_log = "INSERT INTO user_log (username, activity_date, action, action_details, role, user_usn) VALUES ('$user_name' , '$date_today', 'Started an attempt on a quiz', '$action_details', '$role', '$id');";
        $res_user_log = mysqli_query($conn, $sql_user_log);

        $sql5 = "SELECT * FROM quiz_student WHERE student_id = $id AND quiz_id = $quiz_id";
        $res5 = mysqli_query($conn, $sql5);
        $count = mysqli_fetch_assoc($res5);

        if($count > 0) {
        } else {
            $sql6 = "INSERT INTO quiz_student (quiz_id, student_id, quiz_time, status) VALUES ($quiz_id, $id, $time_limit_in_seconds, 'attempted')";
            $res6 = mysqli_query($conn, $sql6);
        }

  ?>
  <script type="text/javascript">
    $(document).ready(() => {
        var timer = 1;
        $("#attempt-box").hide();
        $("#submit-msg").hide();
        setInterval(() => {
            var timer = jQuery("#timer").text();
            $("#timer").load(`timer.ajax.php?quiz_id=${<?php echo $quiz_id; ?>}`);
            if(timer == 0){
                $("#attempt-box").hide();
                $("#timer").hide();
                // $("#submit-msg").show();
                // $("#submit-msg p").text("Time is up please submit the quiz");
            } else {
                $("#attempt-box").show();
                $("#timer").show();
                $("#submit-msg").hide();
            }
        }, 1000);	

    });

    </script>
<!-- <script type="text/javascript">
    $(document).ready(function(){
    setInterval(() => {
        let timer = jQuery("#timer").text();
        $("#timer").load(`timer.ajax.php?quiz_id=${<?php echo $quiz_id; ?>}`);
        console.log(timer)
        if(timer == 0){
            $("#attempt-box").hide();
            $("#timer").hide();
            $("#submit-msg").show();
            $("#submit-msg p").text("Time is up please submit the quiz");
        }
    }, 1000);
    });
</script> -->
<!-- <script type="text/javascript">
    $(document).ready(function(){
    setInterval(() => {
        $("#timer").load("response.php");
    }, 1000);
    });
</script> -->
  
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
    <form action="../includes/submit-attempt.inc.php" method="POST" id="quizForm" onsubmit="setFormSubmitting()">
        <div class="attempt-wrapper mt-20 p-0" id="attempt-box">
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
                    <input type="hidden" name="subject_name" value="<?php echo $subject_name; ?>">
                    <input type="hidden" name="subject_code" value="<?php echo $subject_code; ?>">
                <?php
                }
            ?>
            </div> <!--question-wrapper end-->


        </div> <!--attempt-wrapper end-->
        <!-- <div class="submit-msg" id="submit-msg">
            <p>Time is up. Please submit the attempt.</p>
        </div> -->
        <div class="submit-attempt text-right">
            <button class="primary-btn quiz-submit-cta" id="submit-cta" type="button">Submit Quiz</button>
        </div>
        <div class="confirmation" id="confirmation">
            <div class="confirmation-wrapper">
                <div class="text">
                    <p>Are you sure you want to submit this attempt?</p>
                </div>
                <div class="btn-cta">
                    <button class="secondary-btn" type="button" id="cancel-sub">Cancel</button>
                    <button class="primary-btn" name="submit" type="submit" id="submit-quiz">Submit Attempt</button>
                </div>
            </div>
        </div>
    </form>

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
</div> <!--dashboard wrapper end-->

<script>
    const submitId = document.getElementById("submit-cta");
    const conf = document.getElementById("confirmation");
    const cancel = document.getElementById("cancel-sub");

    submitId.addEventListener("click", () => {
    conf.classList.add("conf-active");

    cancel.addEventListener("click", () => {
        conf.classList.remove("conf-active");
    });
    });



    var formSubmitting = false;
    var setFormSubmitting = function() { formSubmitting = true; };

    window.onload = function() {
        window.addEventListener("beforeunload", function (e) {
            if (formSubmitting) {
                return undefined;
            }

            var confirmationMessage = 'It looks like you have been editing something. '
                                    + 'If you leave before saving, your changes will be lost.';
            
            (e || window.event).returnValue = confirmationMessage; //Gecko + IE
            return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
        });
    };


    $(document).ready(function() {
    function disableBack() { window.history.forward() }

    window.onload = disableBack();
    window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
});
</script>

<?php include"partials-student/footer.php"; ?>