<?php include "partials-teacher/header.php"; ?>

<?php
    if(is_numeric($_GET['id'])) {
        $sql_er = "SELECT * FROM quiz WHERE quiz_id =". $_GET['id'];
        $res_er = mysqli_query($conn, $sql_er);
        $count_er = mysqli_num_rows($res_er);
        if($count_er == true) {
            $quiz_id = $_GET['id'];

            $sql1 = "SELECT * FROM quiz WHERE quiz_id = $quiz_id";
            $res1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $subject_id = $row1['subject_id'];
    
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Add Questions</h2></div>
        

        <br><br>
        <div class="quiz p-20 tbl-50 form-wrapper">
            <form action="../includes/teacher-add-question.inc.php" method="POST">
                <div class="form-control p-0">
                    <label for="question">Question</label>
                    <textarea name="question" id="question" required></textarea>
                </div>
                
                <div class="form-control p-0">
                    <label for="qtype">Question type</label>
                    <select name="question_type" id="qtype" required>
                    <option value=""></option>
                    <?php
                        $sql = "SELECT * FROM question_type";
                        $res = mysqli_query($conn, $sql);
        
                        while($row = mysqli_fetch_assoc($res)) {
                            $question_type_id = $row['question_type_id'];
                            $question_type = $row['question_type'];
                        ?>
                        <option value="<?php echo $question_type_id; ?>"><?php echo $question_type; ?></option>
                        <?php
                    }
                ?>
                    </select>
                </div>
                <div class="form-control p-0">
                    <div id="opt11" class="p-0">
                        <div class="flex p-0 gap-20 input-quiz">
                            <label for="">A:</label> <input type="text" name="ans1"> <input name="answer" value="A" type="radio"><br><br>
                        </div>
                        <div class="flex p-0 gap-20 input-quiz">
                            <label for="">B:</label> <input type="text" name="ans2"> <input name="answer" value="B" type="radio"><br><br>
                        </div>
                        <div class="flex p-0 gap-20 input-quiz">
                            <label for="">C:</label> <input type="text" name="ans3"> <input name="answer" value="C" type="radio"><br><br>
                        </div>
                        <div class="flex p-0 gap-20 input-quiz">
                            <label for="">D:</label> <input type="text" name="ans4"> <input name="answer" value="D" type="radio"><br><br>
                        </div>
                    </div>
                    
                    <div id="opt12" class="p-0 radio">
                        <input name="correct" value="True" type="radio"> <label for="">True</label><br /><br />
                        <input name="correct"  value="False" type="radio"> <label for="">False</label><br /><br />
                    </div>
                </div>

                <input type="hidden" name="quiz_id" value="<?php echo $quiz_id;?>">
                <input type="hidden" name="subj_id" value="<?php echo $subj_id;?>">
                <button class="primary-btn" type="submit" name="submit" >Save</button>
                <a href="<?php echo SITEURL;?>teacher/questions.php?id=<?php echo $quiz_id; ?>" class="secondary-btn btn-20 mt-20">Back</a>
            </form>

            <div class="enroll-btn">
            </div>
        </div>
        </div>
        <?php
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>teacher/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
            } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>teacher/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
    ?>
    </section>

<?php include "partials-teacher/footer.php"; ?>