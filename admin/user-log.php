<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>User Activity Log</h2></div>
        <br>

    <div class="user-log">
        <table class="tbl-full text-center">
            <tr>
                <th>Date</th>
                <th>User</th>
                <th>Action Category</th>
                <th>Action Details</th>
            </tr>
            <?php 

                $sql1 = "SELECT * FROM user_log;";
                $res1 = mysqli_query($conn, $sql1);

                $count = mysqli_num_rows($res1);

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

                $sql = "SELECT * FROM user_log ORDER BY user_log_id DESC LIMIT ". $pageresult . "," . $results_per_page;
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr>
                                <td><?php echo $row['activity_date']; ?></td>
                                <td>
                                    <?php echo $row['username']; ?>
                                    <br>
                                    <p class="blue"><?php echo $row['role']; ?></p>
                                </td>
                                <td><?php echo $row['action']; ?></td>
                                <td><?php echo $row['action_details']; ?></td>
                            </tr>
                        <?php
                    }

                } else {
                    ?>
                        <tr>
                            <td colspan="4">No records available</td>
                        </tr>
                    <?php
                }
            ?>
        </table>
    </div>
    <div class="pagination-wrapper-log">
        <?php
            $link = "";
            $limit = 6  ; // May be what you are looking for

            if ($number_of_pages >=1 && $page <= $number_of_pages) {
                $counter = 1;
                $link = "";
                if ($page > ($limit/2)) {
                    $link .= " <a class='logpagination' href=\"?page=1\">1 </a> ... ";
                }

                for ($x = $page; $x <= $number_of_pages; $x++) {
                    if($counter < $limit) {
                        if($_GET['page'] == $page) {
                            $active = '';
                        } else {
                            $active = '';
                        }
                        $link .= "<a class='logpagination "."$active"."' href=\"?page=" .$x."\">".$x." </a>";
                        $counter++;
                    }
                }

                if ($page < $number_of_pages - ($limit/2)) { 
                    $link .= "... " . "<a class='logpagination' href=\"?page=" .$number_of_pages."\">".$number_of_pages." </a>"; 
                }
            }
                if($_GET['page'] == 1) {

                } else {
                    ?>
                        <a class="userlog-btn" href="<?php echo SITEURL;?>admin/user-log.php?page=<?php echo $_GET['page'] - 1;?>">Prev</a>
                    <?php
                }
            ?> 
            <?php
            echo $link;
                if($_GET['page'] == $number_of_pages) {

                } else {
                    ?>
                        <a class="userlog-btn" href="<?php echo SITEURL;?>admin/user-log.php?page=<?php echo $_GET['page'] + 1; ?>">Next</a>
                    <?php
                }
            ?>
            <?php
        ?>
    </div>
    <div class="text-center mt-20">
        <p>Page <?php echo $_GET['page']?> of <?php echo $number_of_pages; ?></p>
    </div>
    
</section>
<?php include "partials-admin/footer.php"; ?>