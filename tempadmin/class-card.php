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

                $GLOBALS['gwa'] = 0;
            
        ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Student Report Card</h2></div>

        <br>

        <div class="p-20 mb-20">
            <a target="blank" href="<?php echo SITEURL;?>tempadmin/class-card-print.php?id=<?php echo $student_id; ?>" class="primary-btn">Print</a>
        </div>

        <div class="student-info p-20">
            <table class="tbl-50">
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
        <!-- Create a new grading table with q1,q2,q3,q4  -->
        <!-- Compute the grades above, input the grades in sql and display it in a while loop -->
        <?php
            $sql3 = "SELECT * FROM student_subject AS ss
            INNER JOIN subjects_tbl AS s
                ON ss.subject_id = s.subject_id
            WHERE ss.student_id = $student_id
            ";

            $res3 = mysqli_query($conn, $sql3); 
            $count = mysqli_num_rows($res3);
        ?>
        <div class="student-info class-card table p-20">
            <table class="tbl-50">
                <tr>
                    <th>Subjects</th>
                    <th>Q1</th>
                    <th>Q2</th>
                    <th>Q3</th>
                    <th>Q4</th>
                    <th>Final</th>
                    <th>Remarks</th>
                </tr>
                <?php
                    while($row3 = mysqli_fetch_assoc($res3)) {
                        $subject_name = $row3['subject_name'];
                        $subject_code = $row3['subject_code'];
                        $subj_id = $row3['subject_id'];
                        ?>
                            <tr>
                                <td><b><?php echo $subject_code."</b> ".$subject_name; ?></td>
                                <?php
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 1;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 1;";
                                    $res5 = mysqli_query($conn, $sql5);
                                    while($row5 = mysqli_fetch_assoc($res5)) {
                                        $total_items = $row5['total_items'];
                                        if($total_items == 0) {
                                            $total_items = 1;
                                        }
                                        $total = round(($total_grade / $total_items) * 100);
                                        ?>
                                        <td class="text-center"><?php echo $total; ?></td>
                                        <?php
                                    }
                                ?>
                                <?php
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 2;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 2;";
                                    $res5 = mysqli_query($conn, $sql5);
                                    while($row5 = mysqli_fetch_assoc($res5)) {
                                        $total_items = $row5['total_items'];
                                        if($total_items == 0) {
                                            $total_items = 1;
                                        }
                                        $total = round(($total_grade / $total_items) * 100);
                                        ?>
                                        <td class="text-center"><?php echo $total; ?></td>
                                        <?php
                                    }
                                ?>
                                <?php
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 3;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 3;";
                                    $res5 = mysqli_query($conn, $sql5);
                                    while($row5 = mysqli_fetch_assoc($res5)) {
                                        $total_items = $row5['total_items'];
                                        if($total_items == 0) {
                                            $total_items = 1;
                                        }
                                        $total = round(($total_grade / $total_items) * 100);
                                        ?>
                                        <td class="text-center"><?php echo $total; ?></td>
                                        <?php
                                    }
                                ?>
                                <?php
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 4;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 4;";
                                    $res5 = mysqli_query($conn, $sql5);
                                    while($row5 = mysqli_fetch_assoc($res5)) {
                                        $total_items = $row5['total_items'];
                                        if($total_items == 0) {
                                            $total_items = 1;
                                        }
                                        $total = round(($total_grade / $total_items) * 100);
                                        ?>
                                        <td class="text-center"><?php echo $total; ?></td>
                                        <?php
                                    }
                                ?>
                                <?php
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id;";
                                    $res5 = mysqli_query($conn, $sql5);
                                    while($row5 = mysqli_fetch_assoc($res5)) {
                                        $total_items = $row5['total_items'];
                                        if($total_items == 0) {
                                            $total_items = 1;
                                        }
                                        $total = round(($total_grade / $total_items) * 100);
                                        ?>
                                        <td class="text-center"><?php echo $total; ?></td>
                                        <?php
                                    }
                                ?>   
                                <?php
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id;";
                                    $res5 = mysqli_query($conn, $sql5);
                                    while($row5 = mysqli_fetch_assoc($res5)) {
                                        $total_items = $row5['total_items'];
                                        if($total_items == 0) {
                                            $total_items = 1;
                                        }
                                        $total = round(($total_grade / $total_items) * 100, 2);
                                        if($total >= 75 ) {
                                            $remark = "PASSED";
                                        } else {
                                            $remark = "FAILED";
                                        }
                                        $gwa += $total;
                                        $average = $gwa / $count;
                                        ?>
                                        <td class="text-center"><?php echo $remark; ?></td>
                                        <?php
                                    }
                                ?>   
                                
                            </tr>
                        <?php
                    }
                ?>
            </table>
            <div class="gwa">
                GWA: <?php echo $average; ?>
            </div>
            <div class="enroll-btn">
                <a href="<?php echo SITEURL;?>tempadmin/view-grades.php?id=<?php echo $student_id; ?>" class="secondary-btn">Back</a>
            </div>
        </div>
        </div>
        <?php
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>tempadmin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
            } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>tempadmin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
    </section>


<?php include "partials-tempadmin/footer.php"; ?>