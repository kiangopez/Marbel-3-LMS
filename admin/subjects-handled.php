<?php include "partials-admin/header.php"; ?>

    <?php
        if(is_numeric($_GET['id'])) {
            $sql_er = "SELECT * FROM teachers_tbl WHERE teacher_id =". $_GET['id'];
            $res_er = mysqli_query($conn, $sql_er);
            $count_er = mysqli_num_rows($res_er);
    
            if($count_er == true) {

                $teacher_id = $_GET['id'];

                $sql = "SELECT ts.teacher_subject_id, t.teacher_id, t.URN, t.fname, t.mname, t.lname, s.subject_id, s.subject_name, s.subject_code, c.category_id, c.category_name FROM teacher_subject AS ts 
                    INNER JOIN teachers_tbl AS t 
                        ON ts.teacher_id = t.teacher_id 
                    INNER JOIN subjects_tbl AS s
                        ON ts.subject_id = s.subject_id
                    INNER JOIN categories_tbl AS c
                        ON s.category_id = c.category_id
                    WHERE ts.teacher_id = $teacher_id";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                $sql2 = "SELECT * FROM teachers_tbl WHERE teacher_id = $teacher_id";
                $res2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($res2);
                $fname = $row2['fname'];
                $mname = $row2['mname'];
                $lname = $row2['lname'];
                $email = $row2['email'];
                $full_name = $fname . " " . $mname . " " . $lname;
    ?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Subjects Handled</h2></div>
        <br>

            <div class="table-wrapper">
                <table class="tbl-50 student-info text-center p-20">
                    <tr>
                        <td>
                            <p class="p-20">Name:</p>
                        </td>
                        <td>
                            <p class="p-20"><?php echo $full_name; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <p class="p-20"><?php echo $email; ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
            
        ?>

        <br><br>
        <div class="tbl-wrapper p-20">
            <table class="tbl-full text-center">
                <a href="<?php echo SITEURL;?>admin/teacher-assign.php?id=<?php echo $teacher_id; ?>" class="primary-btn btn-20">Assign</a>
                <tr>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Subject Level</th>
                    <th>Actions</th>
                </tr>
                <?php
                    if($count > 0) {
                         while($row = mysqli_fetch_assoc($res)) {
                            $teacher_subject_id = $row['teacher_subject_id'];
                            $teacher_id = $row['teacher_id'];
                            $URN = $row['URN'];
                            $fname = $row['fname'];
                            $mname = $row['mname'];
                            $lname = $row['lname'];
                            $subject_id = $row['subject_id'];
                            $subject_code = $row['subject_code'];
                            $category_name = $row['category_name'];
                            $subject_name = $row['subject_name'];
                            $full_name = $fname . " " . $mname . " " . $lname;
                            ?>
                                <tr>
                                    <td><?php echo $subject_name;?></td>
                                    <td><?php echo $subject_code; ?></td>
                                    <td><?php echo $category_name; ?></td> 
                                    <td>
                                        <form action="../includes/unenroll-teacher-subject.inc.php" method="POST">
                                            <input type="hidden" name="teacher_subject_id" value="<?php echo $teacher_subject_id; ?>">
                                            <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">
                                            <input type="hidden" value="<?php echo $_SESSION['adminId']; ?>" name="admin_id">

                                            <button onclick="javascript: return confirm('Do you want to unassign this subject?');" class="danger-btn" type="submit" name="submit">Unassign</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                         }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">No Subjects Assigned</td>
                        </tr>
                        <?php
                    }
                ?>

            </table>
        </div>
        <div class="enroll-btn mt-20 p-20">
            <a href="<?php echo SITEURL;?>admin/manage-teachers.php?page=1" class="secondary-btn btn-20 mt-20">Back</a>
        <div>



    </div>
        <!-- Unassign Modal -->
        <div class="modal" id="deletemodal">
        <span class="close">&times;</span>
        <form action"" method="POST">
            <div class="modal-body">
                <h4>Unassign the subject?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal">Cancel</button>
                <button type="submit">Yes</button>
            </div>
        </form>
    </div>
        <!-- Unassign Modal -->
    </div>
    <?php
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
            } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
    </section>




<?php include "partials-admin/footer.php"; ?>