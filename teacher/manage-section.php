<?php include "partials-teacher/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Manage Sections</h2></div>
        <?php
            if(isset($_SESSION['addCategory'])) {
                echo $_SESSION['addCategory'];
                unset($_SESSION['addCategory']);
            }
            $teacher_id = $_SESSION['teacherId'];
        ?>
        <br>
        <div class="section">
            <table class="tbl-full text-center">
                <tr>
                    <th>Grade Level</th>
                    <th>Section Name</th>
                    <th># of Students</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql = "SELECT * 
                        FROM section_tbl AS s
                        LEFT JOIN categories_tbl AS c
                            ON s.category_id = c.category_id
                        LEFT JOIN teachers_tbl AS t
                            ON s.teacher_id = t.teacher_id
                        WHERE s.teacher_id = $teacher_id
                        ORDER BY category_name";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $full_name = $row['fname']." ".$row['mname']." ".$row['lname'];
                            $section_name = $row['section_name'];
                            $section_id = $row['section_id'];
                            $category_name = $row['category_name'];
                            ?>
                                <tr>
                                    <td><?php echo $category_name; ?></td>
                                    <td><?php echo $section_name; ?></td>
                                    <td>
                                        <?php
                                            $sql1 = "SELECT * FROM students_tbl WHERE section_id = $section_id;";
                                            $res1 = mysqli_query($conn, $sql1);
                                            $count1 = mysqli_num_rows($res1);
                                            echo $count1;
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>teacher/view-section.php?id=<?php echo $section_id; ?>" class="primary-btn">View</a>
                                    </td>
                                </tr>
                            <?php
                        }

                    } else {
                        ?>
                            <tr>
                                <td colspan="4">No Sections Available</td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
        </div>

    </section>
<?php include "partials-teacher/footer.php"; ?>
