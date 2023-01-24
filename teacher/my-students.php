<?php include "partials-teacher/header.php"; ?>

        <?php
            if($_GET['user_id'] == $_SESSION['teacherId'] && is_numeric($_GET['subj_id'])) {
                $id = $_GET['subj_id'];
                $user_id = $_GET['user_id'];
                $sql = "SELECT s.subject_id, s.subject_name, s.subject_code, s.category_id, c.category_name 
                FROM subjects_tbl AS s
                INNER JOIN categories_tbl AS c
                    ON s.category_id = c.category_id
                WHERE s.subject_id = $id;
                ";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);
                $count_er = mysqli_num_rows($res);

                if($count_er == true) {

                    $subject_name = $row['subject_name'];
                    $subject_code = $row['subject_code'];
                    $category_name = $row['category_name'];
            
        ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>My Students</h2></div>
        <br>
        <div class="p-20">
            <form action="generate-grades.php" method="POST">
                <label for="">Select Section</label>
                        <select name="student_cat">
                            <?php
                                $sql = "SELECT * FROM section_tbl AS s INNER JOIN categories_tbl AS c ON s.category_id = c.category_id WHERE teacher_id = $user_id ORDER BY category_name";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $section_id = $row['section_id'];
                                        $section_name = $row['section_name'];
                                        $category_name = $row['category_name'];
                                        ?> 
                                            <option value="<?php echo $category_name." ".$section_name; ?>"><?php echo $category_name." ".$section_name; ?></option>   
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                <input type="hidden" name="subject_name" value="<?php echo $subject_code." ".$subject_name; ?>">
                <input type="hidden" name="subject_id" value="<?php echo $id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <button type="submit" name="submit">Generate Grade</button>
            </form>
        </div>
        <div class="my-students">
            <table class="tbl-full text-center p-20">
                <tr>
                    <th>Student Name</th>
                    <th>Student's Section</th>
                </tr>

                <?php
                    $sql1 = "SELECT * FROM students_tbl AS s
                    INNER JOIN student_subject AS ss
                        ON s.student_id = ss.student_id
                    INNER JOIN section_tbl as st
                        ON s.section_id = st.section_id
                    WHERE ss.subject_id = $id";
                    
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_num_rows($res1);

                    if($count1 > 0) {
                        while($row1 = mysqli_fetch_assoc($res1)) {
                            $full_name = $row1['fname']." ".$row1['mname']." ".$row1['lname'];
                            ?>
                                <tr>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $row1['section_name']; ?></td>
                                </tr>
                            <?php
                        }
                    } else {
                        ?>
                            <tr>
                                <td colspan="2">No Student Found</td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
            <div class="enroll-btn p-20">
                <a href="<?php echo SITEURL;?>teacher/manage-subject.php" class="secondary-btn btn-20 mt-20">Back</a>
            </div>
        </div>
        <br><br>


      
    <?php
    } else {
        ?>
            <section class="dashboard column wrapper" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>teacher/home.php">Return to Homepage</a>
                </div>
            </section>
        <?php
    }
    } else {
            ?>
            <section class="dashboard column wrapper" id="dashboard">
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
