<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Assign Subjects</h2></div>

        <br><br>
        <div class="p-20">
            <form action="../includes/student-assign.inc.php" method="POST">
                <table class="tbl-full text-center">
                    <tr>
                        <th>Subject Name</th>
                        <th>Subject Code</th>
                        <th>Subject Category</th>
                        <th></th>
                    </tr>
                    <?php
                        $student_id = $_GET['id'];

                        $sql = "SELECT s.subject_name, s.subject_code, s.category_id, c.category_name, s.subject_id 
                                FROM subjects_tbl AS s 
                                INNER JOIN categories_tbl AS c ON s.category_id = c.category_id 
                                ORDER BY c.category_id ASC; ";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count > 0) {
                            while($row = mysqli_fetch_assoc($res)) {
                                $category_id = $row['category_id'];
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
                                    <div class="form-controller">
                                        <input type="checkbox" name="subject_id[]" value="<?php echo $subject_id; ?>">
                                    </div>
                                </td>
                            </tr>
                                <?php
                            }
                        }
                    ?>

                </table>
                <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                <div class="enroll-subj p-0 flex">
                    <button class="primary-btn" type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>


        </div>
    </section>


<?php include "partials-admin/footer.php"; ?>