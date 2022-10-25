<?php include "partials-tempadmin/header.php"; ?>

        <?php
            if(is_numeric($_GET['id'])) {

                $sql_er = "SELECT * FROM students_tbl WHERE student_id =". $_GET['id'];
                $res_er = mysqli_query($conn, $sql_er);
                $count_er = mysqli_num_rows($res_er);
        
                if($count_er == true) {

                    $student_id = $_GET['id'];

                    $sql = "SELECT ss.student_subject_id, st.student_id, st.USN, st.fname, st.mname, st.lname, s.subject_id ,s.subject_name, s.subject_code, c.category_name 
                        FROM student_subject AS ss
                        INNER JOIN students_tbl AS st
                            ON ss.student_id = st.student_id
                        INNER JOIN subjects_tbl AS s
                            ON ss.subject_id = s.subject_id
                        INNER JOIN categories_tbl AS c
                            ON s.category_id = c.category_id
                        WHERE ss.student_id = $student_id;
                    ";

                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    $sql2 = "SELECT * FROM students_tbl AS s
                        INNER JOIN categories_tbl AS c
                            ON s.category_id = c.category_id
                        WHERE student_id = $student_id;        
                    ";
                    $res2 = mysqli_query($conn, $sql2);
                    
                    $row2 = mysqli_fetch_assoc($res2);
                    $fname = $row2['fname'];
                    $mname = $row2['mname'];
                    $lname = $row2['lname'];
                    $USN = $row2['USN'];
                    $category_name = $row2['category_name'];
                    $full_name = $fname." ".$mname." ".$lname;


            
        ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Student Grades</h2></div>

        <br><br>


        <div class="student-info p-20">
            <table class="tbl-50">
                <div class="assign-btn">
                    <a href="<?php echo SITEURL?>tempadmin/class-card.php?id=<?php echo $student_id; ?>" class="success-btn btn-20 mt-20">Class Card</a>
                </div>

                <tr>
                    <td>Name:</td>
                    <td><?php echo $full_name; ?></td>
                </tr>
                <tr>
                    <td>USN:</td>
                    <td><?php echo $USN; ?></td>
                </tr>
                <tr>
                    <td>Grade:</td>
                    <td><?php echo $category_name; ?></td>
                </tr>
            </table>
        </div>

        <div class="student-info table p-20">
            <table class="tbl-50 text-center">
                <tr>
                    <th>Subjects</th>
                    <th>Actions</th>
                </tr>
                <?php
                    if($count > 0 ) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $student_subject_id = $row['student_subject_id'];
                            $student_id = $row['student_id'];
                            $subject_id = $row['subject_id'];
                            $subject_name = $row['subject_name'];
                            $subject_code = $row['subject_code'];
                            $category_name = $row['category_name'];
                            ?>
                            <tr>
                                <td><?php echo "(".$subject_code.")". " " .$subject_name?></td>
                                <td><a class="primary-btn" href="<?php SITEURL;?>grades.php?id=<?php echo $subject_id;?>&user_id=<?php echo $student_id; ?>">Quizzes</a></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="3">No Subjects Enrolled</td>
                        </tr>
                        <?php
                    }
                ?>
            </table>

            <div class="enroll-btn">
                <a href="<?php echo SITEURL;?>tempadmin/manage-students.php?page=1" class="secondary-btn btn-20 mt-20">Back</a>
            </div>
        </div>
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


<?php include "partials-tempadmin/footer.php"; ?>