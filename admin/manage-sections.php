<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Manage Sections</h2></div>
        <?php
            if(isset($_SESSION['addCategory'])) {
                echo $_SESSION['addCategory'];
                unset($_SESSION['addCategory']);
            }
        ?>
        <br>
        <div class="add-btn p-20">
            <a class="primary-btn" href="<?php echo SITEURL;?>admin/add-section.php">Add Section</a>
        </div>
        <div class="section">
            <table class="tbl-full text-center">
                <tr>
                    <th>Grade Level</th>
                    <th>Section Name</th>
                    <th># of Students</th>
                    <th>Adviser</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql = "SELECT * 
                    FROM section_tbl AS s
                    LEFT JOIN categories_tbl AS c
                        ON s.category_id = c.category_id
                    LEFT JOIN teachers_tbl AS t
                        ON s.teacher_id = t.teacher_id;
                    ";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    
                    if($count <= 0) {
                        ?>
                            <tr>
                                <td colspan="5">No Sections Added</td>
                            </tr>
                        <?php
                    } else {
                        while($row = mysqli_fetch_assoc($res)) {
                            $section_id = $row['section_id'];
                            ?>
                                <tr>
                                    <td><?php echo $row['category_name'];?></td>
                                    <td><?php echo $row['section_name'];?></td>
                                    <td>
                                        <?php
                                            $sql1 = "SELECT * FROM students_tbl WHERE section_id = $section_id;";
                                            $res1 = mysqli_query($conn, $sql1);
                                            $count1 = mysqli_num_rows($res1);
                                            echo $count1;
                                        ?>
                                    </td>
                                    <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/view-section.php?id=<?php echo $section_id; ?>" class="primary-btn">View</a>
                                        <a href="<?php echo SITEURL;?>admin/update-section.php?id=<?php echo $section_id; ?>" class="primary-btn">Update</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    
                ?>
            </table>
        </div>

    </section>
<?php include "partials-admin/footer.php"; ?>
