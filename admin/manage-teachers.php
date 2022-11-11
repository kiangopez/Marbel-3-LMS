<?php include "partials-admin/header.php"; ?>
<?php
    if($_SESSION['role'] == "superadmin") {
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Manage Teachers</h2></div>
        <br>
        <div class="p-20 student-header flex">
            <div class="add-btn">
                <a class="primary-btn" href="<?php echo SITEURL;?>admin/add-teachers.php">Add Teacher</a>
            </div>
            <div class="search">
                <form class="flex" action="<?php echo SITEURL;?>admin/teacher-search.php" method="POST">
                    <input type="text" name="teacher_search" placeholder="Search Teacher" required>
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
                <th>URN</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Name</th>
                <th>Email</th>
                <th>Subjects Handled</th>
                <th>Actions</th>
            </tr>

            <?php
            
                $sql = "SELECT * FROM teachers_tbl;";
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

                $sql2 = "SELECT * FROM teachers_tbl LIMIT ". $pageresult . "," . $results_per_page;
                $res2 = mysqli_query($conn, $sql2);

                if($count > 0) {
                    while($row = mysqli_fetch_assoc($res2)) {
                        $id = $row['teacher_id'];
                        $urn = $row['URN'];
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $mname = $row['mname'];
                        $email = $row['email'];
                        ?>
                        <tr>
                            <td><?php echo $urn; ?></td>
                            <td><?php echo $fname; ?></td>
                            <td><?php echo $lname; ?></td>
                            <td><?php echo $mname; ?></td>
                            <td><?php echo $email; ?></td>
                            <td>       
                                <a class="primary-btn" href="<?php echo SITEURL;?>admin/subjects-handled.php?id=<?php echo $id; ?>">View</a>
                            </td>
                            <td>
                                <a class="primary-btn" href="<?php echo SITEURL;?>admin/update-teacher.php?id=<?php echo $id; ?>">Update</a>
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
                    <li><a class="<?php echo $active; ?>" href="<?php echo SITEURL;?>admin/manage-teachers.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                </div>
                <?php
            }
        ?>
        </div>
    </section>
    <?php 
    } else {
      ?>
      <section class="dashboard wrapper column" id="dashboard">
          <div class="error-handler">
              <p>You're not allowed in this page</p> 
              <a class="blue" href="<?php echo SITEURL?>index.php">Return to Home</a>
              <p class="break">Error: Admin account don't match</p>
          </div>
      </section>
  <?php
    }
?>
<?php include "partials-admin/footer.php"; ?>
