<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>All Subjects</h2></div>

        <br><br>
        <div class="p-20 view-all-subj">
            <table class="tbl-full text-center">
                <tr>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Grade Level</th>
                </tr>
                <?php
                    $sql = "SELECT s.subject_name, s.subject_code, s.category_id, c.category_name 
                        FROM subjects_tbl AS s 
                        INNER JOIN categories_tbl AS c 
                        ON s.category_id = c.category_id 
                        ORDER BY c.category_id ASC; ";
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

                    $sql2 = "SELECT s.subject_name, s.subject_code, s.category_id, c.category_name 
                    FROM subjects_tbl AS s 
                    INNER JOIN categories_tbl AS c 
                    ON s.category_id = c.category_id 
                    ORDER BY c.category_id ASC
                    LIMIT ". $pageresult . "," . $results_per_page;
                    $res2 = mysqli_query($conn, $sql2);

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res2)) {
                            $id = $row['category_id'];
                            $subject_name = $row['subject_name'];
                            $subject_code = $row['subject_code'];
                            $category_name = $row['category_name'];
                            ?>
                            <tr>
                                <td><?php echo $subject_name; ?></td>
                                <td><?php echo $subject_code; ?></td>
                                <td><?php echo $category_name; ?></td>
                            </tr>
                            <?php
                        }
                    }
                ?>

            </table>
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
                    <li><a class="<?php echo $active; ?>" href="<?php echo SITEURL;?>admin/view-subjects.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                </div>
                <?php
            }
        ?>
        </div>
            <div class="enroll-btn">
            <a href="<?php echo SITEURL;?>admin/manage-subjects.php" class="secondary-btn btn-20 mt-20">Back</a>
        <div>
        </div>


        </div>
    </section>


<?php include "partials-admin/footer.php"; ?>