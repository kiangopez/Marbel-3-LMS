<?php include "partials-teacher/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Student Finder</h2></div>
        <br>

        <br> <br>

        <table class="tbl-full text-center">
            <tr>
                <th>URN</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Name</th>
                <th>Email</th>
                <th>Enrolled Subjects</th>
                <th>View Grades</th>
            </tr>

            <?php
                if(isset($_POST['submit'])) {
                    
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
    
                    $sql = "SELECT * FROM students_tbl WHERE USN LIKE '%$search%' OR fname LIKE'%$search%' OR lname LIKE'%$search%' OR mname LIKE'%$search%';";
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $id = $row['student_id'];
                            $usn = $row['USN'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $mname = $row['mname'];
                            $email = $row['email'];
                            ?>
                            <tr>
                            <td><?php echo $usn; ?></td>
                            <td><?php echo $fname; ?></td>
                            <td><?php echo $lname; ?></td>
                            <td><?php echo $mname; ?></td>
                            <td><?php echo $email; ?></td>
                            <td>       
                                <a class="primary-btn" href="<?php echo SITEURL;?>teacher/enrolled-subjects.php?id=<?php echo $id; ?>">View</a>
                            </td>
                            <td>       
                                <a class="primary-btn" href="<?php echo SITEURL;?>teacher/view-grades.php?id=<?php echo $id; ?>">View</a>
                            </td>
                        </tr>
                        <?php
                        }
                    } else {
                        ?>
                            <td colspan="8">No Student Found</td>
                        <?php
                    }
                    
                }
                
            ?>
        </table>
        <div class="enroll-btn">
            <a href="<?php echo SITEURL;?>teacher/student-evaluation.php?page=1" class="secondary-btn btn-20 mt-20">Back</a>
        <div>

    </section>
<?php include "partials-teacher/footer.php"; ?>
