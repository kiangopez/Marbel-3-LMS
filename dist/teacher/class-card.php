<?php include "partials-teacher/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Student Report Card</h2></div>

        <br><br>

        <?php
            if(isset($_GET['id'])) {
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


            }
        ?>

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
        ?>
        <div class="student-info table p-20">
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
                        ?>
                            <tr>
                                <td><?php echo $subject_name; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php
                    }
                ?>

            </table>

        </div>
        <div class="enroll-btn mt-20 p-20">
            <a href="<?php echo SITEURL;?>teacher/view-grades.php?id=<?php echo $student_id; ?>" class="secondary-btn">Back</a>
        </div>


        </div>
    </section>


<?php include "partials-teacher/footer.php"; ?>