<?php include "partials-admin/header.php"; ?>

<?php
    if(isset($_GET['id'])) {
        $quiz_id = $_GET['id'];

        $sql = "SELECT * FROM quiz WHERE quiz_id = $quiz_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $subj_id = $row['subject_id'];
    }
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Quiz Questions</h2></div>

        <br><br>
        <div class="p-20">
            <a class="primary-btn" href="<?php echo SITEURL;?>admin/add-questions.php?id=<?php echo $quiz_id; ?>">Add Question</a>
        </div>
        <?php
            if(isset($_SESSION['addQuestion'])) {
                echo $_SESSION['addQuestion'];
                unset($_SESSION['addQuestion']);
            }
            if(isset($_SESSION['deleteQuestion'])) {
                echo $_SESSION['deleteQuestion'];
                unset($_SESSION['deleteQuestion']);
            }
        ?>
        <div class="questions p-20">
            <table class="text-center tbl-full">
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Question Type</th>
                    <th>Answer</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql1 = "SELECT * FROM quiz_question AS q INNER JOIN question_type AS qt ON q.question_type_id = qt.question_type_id WHERE quiz_id = $quiz_id";
                    $res1 = mysqli_query($conn, $sql1);
                    $count = mysqli_num_rows($res1);
                    $numbering = 1;
                    if($count > 0) {
                        while($row1 = mysqli_fetch_assoc($res1)) {
                            $quiz_question_id = $row1['quiz_question_id'];
                            $question_text = $row1['question_text'];
                            $date_added = $row1['date_added'];
                            $question_type = $row1['question_type'];
                            $answer = $row1['answer'];
                            ?>
                            <tr>
                                <td><?php echo $numbering; ?></td>
                                <td><?php echo $question_text; ?></td>
                                <td><?php echo $question_type; ?></td>
                                <td><?php echo $answer; ?></td>
                                <td><?php echo $date_added; ?></td>
                                <td>
                                    <div class="actions flex">
                                        <a href="<?php echo SITEURL?>admin/delete-question.php?id=<?php echo $quiz_question_id;?>&quiz_id=<?php echo $quiz_id; ?>" onclick="javascript: return confirm('Do you want to delete this question?');" class="danger-btn">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $numbering++;
                        }
                    } else {
                        ?>
                        <td colspan="6">No questions added</td>
                        <?php
                    }
                ?>
                
                
            
            </table>

        </div>
        <div class="enroll-btn p-20">
            <a href="<?php echo SITEURL;?>admin/quiz.php?id=<?php echo $subj_id; ?>" class="secondary-btn btn-20 mt-20">Back</a>
        </div>


        </div>
    </section>


<?php include "partials-admin/footer.php"; ?>
