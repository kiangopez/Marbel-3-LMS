<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <?php
            if(isset($_GET['id'])) {
                $subj_id = $_GET['id'];
                $student_id = $_GET['user_id'];
                $sql = "SELECT * FROM quiz AS q
                LEFT JOIN quiz_student AS qs
                    ON q.quiz_id = qs.quiz_id 
                WHERE q.subject_id = $subj_id
                ORDER BY quarter;";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
            }

            $sql6 = "SELECT * FROM subjects_tbl WHERE subject_id = $subj_id";
            $res6 = mysqli_query($conn, $sql6);
            $row6 = mysqli_fetch_assoc($res6);
        ?>

        <div class="heading p-20"><h2><?php echo "(".$row6['subject_code'].")"." ".$row6['subject_name'] ?></h2></div>

        <br><br>

        

        <div class="quiz-info p-20">
            <div>
                <table class="tbl-50 text-center">
                    <tr>
                        <th>Quarter</th>
                        <th>Quiz</th>
                        <th>Grade</th>
                    </tr>
                    <?php
                        if($count > 0) {
                            while($row = mysqli_fetch_assoc($res)) {
                                $quiz_title = $row['quiz_title'];
                                $quarter = $row['quarter'];
                                $grade = $row['grade'];
                                $items = $row['items'];

                                ?>
                                    <tr>
                                        <td><?php echo $quarter; ?></td>
                                        <td><?php echo $quiz_title; ?></td>
                                        <td><?php echo $grade ." / ". $items; ?></td>
                                    </tr>
                                <?php
                            }

                        } else {
                            ?>
                               <tr>
                                <td colspan="3">No quizzes added</td>
                               </tr> 
                            <?php
                        }
                    ?>
                    <tr>
                        <?php
                            $sql2 = "SELECT SUM(grade) AS total FROM quiz AS q
                            LEFT JOIN quiz_student AS qs
                                ON q.quiz_id = qs.quiz_id
                            WHERE student_id = $student_id AND subject_id = $subj_id;";
                            $res2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($res2);
                        ?>
                        <?php
                            $sql3 = "SELECT SUM(items) AS total_items FROM quiz AS q
                            LEFT JOIN quiz_student AS qs
                                ON q.quiz_id = qs.quiz_id
                            WHERE student_id = $student_id AND subject_id = $subj_id;";
                            $res3 = mysqli_query($conn, $sql3);
                            $row3 = mysqli_fetch_assoc($res3);
                        ?>
                        <td><b>Total:</b></td>
                        <td colspan="2"><?php echo $row2['total'];?>/<?php echo $row3['total_items']; ?></td>
                    </tr>
                </table>
            </div>

            <div class="enroll-btn">
                <a href="<?php echo SITEURL;?>admin/view-grades.php?id=<?php echo $student_id; ?>" class="secondary-btn btn-20 mt-20">Back</a>
            </div>
        </div>
    </section>


<?php include "partials-admin/footer.php"; ?>