<?php include "partials-teacher/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>My Subjects</h2></div>
        <br>
        <div class="subjects p-20">
            <table class="tbl-full text-center">
                <tr>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql = "SELECT ts.teacher_id, ts.subject_id, s.subject_name, s.subject_code, s.subject_id, c.category_name 
                    FROM teacher_subject AS ts
                    INNER JOIN teachers_tbl AS t
                      ON ts.teacher_id = t.teacher_id
                    INNER JOIN subjects_tbl AS s
                      ON ts.subject_id = s.subject_id
                    INNER JOIN categories_tbl AS c
                      ON c.category_id = s.category_id
                    WHERE ts.teacher_id = $id;
                    ";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $subject_name = $row['subject_name'];
                            $subject_code = $row['subject_code'];
                            $category_name = $row['category_name'];
                            $subject_id = $row['subject_id'];
                            ?>
                                <tr>
                                    <td><?php echo $subject_name; ?></td>
                                    <td><?php echo $subject_code; ?></td>
                                    <td><?php echo $category_name; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>teacher/submission.php?id=<?php echo $subject_id;?>" class="secondary-btn">File Submission</a>
                                        <a href="<?php echo SITEURL;?>teacher/quiz.php?id=<?php echo $subject_id;?>" class="success-btn">Add Quiz</a>
                                        <a href="<?php echo SITEURL;?>teacher/upload-file.php?subj_id=<?php echo $subject_id;?>&user_id=<?php echo $id; ?>" class="primary-btn">Upload File</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    } else {
                        ?>
                            <tr>
                                <td colspan="4">No subjects assigned</td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
            
        </div>
    </section>
<?php include "partials-teacher/footer.php"; ?>
