<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Manage Students</h2></div>
        <br>
        <div class="p-20 student-header flex">
            <div class="add-btn">
                <a class="primary-btn" href="<?php echo SITEURL;?>admin/add-students.php">Add Student</a>
            </div>
            <div class="search">
                <form class="flex" action="<?php echo SITEURL;?>admin/student-search.php" method="POST">
                    <input type="text" name="student_search" placeholder="Search Student" required>
                    <button class="primary-btn" type="submit" name="submit">Search</button>
                </form>
            </div>
        </div>
        <br> <br>
        <?php 
            if(isset($_SESSION['adds'])) {
                echo $_SESSION['adds']; 
                unset($_SESSION['adds']);
            }
        ?>
    <div class="manage-table-wrapper">
        <table class="tbl-full text-center">
            <tr>
                <th>USN</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Name</th>
                <th>Email</th>
                <th>Enrolled Subjects</th>
                <th>View Grades</th>
                <th>Actions</th>
            </tr>

            <?php
            
                $sql = "SELECT * FROM students_tbl;";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $results_per_page = 8;
                $number_of_pages = ceil($count/$results_per_page);

                // Determine which page number the visitor on
                if(!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                // Determine the sql LIMIT starting the number for the results on the displaying page
                $pageresult = ($page - 1) * $results_per_page;

                $sql2 = "SELECT * FROM students_tbl LIMIT ". $pageresult . "," . $results_per_page;
                $res2 = mysqli_query($conn, $sql2);
                
                if($count > 0) {
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        $id = $row2['student_id'];
                        $usn = $row2['USN'];
                        $fname = $row2['fname'];
                        $lname = $row2['lname'];
                        $mname = $row2['mname'];
                        $email = $row2['email'];
                        ?>
                        <tr>
                        <td><?php echo $usn; ?></td>
                        <td><?php echo $fname; ?></td>
                        <td><?php echo $lname; ?></td>
                        <td><?php echo $mname; ?></td>
                        <td><?php echo $email; ?></td>
                        <td>       
                            <a class="primary-btn" href="<?php echo SITEURL;?>admin/enrolled-subjects.php?id=<?php echo $id; ?>">View</a>
                        </td>
                        <td>       
                            <a class="primary-btn" href="<?php echo SITEURL;?>admin/view-grades.php?id=<?php echo $id; ?>">View</a>
                        </td>
                        <td>
                            <a class="primary-btn" href="<?php echo SITEURL;?>admin/update-student.php?id=<?php echo $id; ?>">Update</a>
                        </td>
                    </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7">No Data Available</td>
                    </tr>
                    <?php
                }
                
            ?>
        </table>
    </div>
        <div class="pagination-wrapper">
        <?php


            // Display the link of the page
            for($page = 1; $page <= $number_of_pages; $page++) {
                if($_GET['page'] == $page) {
                    $active = 'pagination-active';
                } else {
                    $active = '';
                }
                ?> 
                <div class="pagination">
                    <li><a class="<?php echo $active; ?>" href="<?php echo SITEURL;?>admin/manage-students.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                </div>
                <?php
            }
        ?>
        </div>
    </section>
<?php include "partials-admin/footer.php"; ?>
