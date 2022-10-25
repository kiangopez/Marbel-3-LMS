<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Manage Subjects</h2></div>
        <?php
            if(isset($_SESSION['check'])) {
                echo $_SESSION['check'];
                unset($_SESSION['check']);
            }
        ?>
        <br>
        <div class="subject-dashboard p-20">
            <div class="categories">
                <div class="categories-heading flex">
                    <h4>Categories</h4>
                    <a class="primary-btn" href="<?php echo SITEURL; ?>admin/create-category.php">Create Category</a>
                </div>
                <div class="categories-tbl-wrapper">
                    <table>
                        <td><p class="text-left">All categories:</p></td>
                        <?php
                            $sql = "SELECT * FROM categories_tbl;";
                            $res = mysqli_query($conn, $sql);
    
                            $count = mysqli_num_rows($res);
                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)) {
                                    $cat_id = $row['category_id'];
                                    $cat_name = $row['category_name'];
                                    ?>
                                    <tr>
                                        <td><p><?php echo $cat_name; ?></p></td>
                                        <td><a class="blue" href="<?php echo SITEURL;?>admin/edit-category.php?id=<?php echo $cat_id; ?>">Edit</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>

            <div class="categories">
                <div class="categories-heading flex">
                    <h4>Subjects</h4>
                    <a class="primary-btn" href="<?php echo SITEURL;?>admin/create-subject.php">Create Subject</a>
                </div>
                <div class="create-subj-wrapper">
                    <table>
                        <td><p class="text-left">Recently added subjects:</p></td>
                        <?php
                            $sql2 = "SELECT * FROM subjects_tbl ORDER BY subject_id DESC LIMIT 4;";
                            $res2 = mysqli_query($conn, $sql2);
    
                            $count = mysqli_num_rows($res2);
                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res2)) {
                                    $subj_id = $row['subject_id'];
                                    $subj_name = $row['subject_name'];
                                    $subj_code = $row['subject_code'];
                                    ?>
                                    <tr>
                                        <td><p>(<b><?php echo $subj_code; ?></b>) <?php echo $subj_name; ?></p></td>
                                        <td>
                                        <a class="blue mr-10" href="<?php echo SITEURL;?>admin/submission.php?id=<?php echo $subj_id; ?>">File Submissions</a>
                                        <a class="blue mr-10" href="<?php echo SITEURL;?>admin/quiz.php?id=<?php echo $subj_id; ?>">Quiz</a>
                                            <a class="blue mr-10" href="<?php echo SITEURL;?>admin/upload-file.php?id=<?php echo $subj_id; ?>&user_id=<?php echo $id; ?>">Upload File</a>
                                            <a class="blue" href="<?php echo SITEURL;?>admin/edit-subject.php?id=<?php echo $subj_id; ?>">Edit</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>

            <div class="all-subj categories">
                <div class="categories-heading flex">
                    <h4>All Subjects</h4>
                    <a class="blue" href="<?php echo SITEURL;?>admin/view-subjects.php?page=1">View all</a>
                </div>
                <div class="all-subj-tbl-wrapper">
                    <table>
                        <?php
                            $sql3 = "SELECT * FROM subjects_tbl ORDER BY category_id;";
                            $res3 = mysqli_query($conn, $sql3);
    
                            $count = mysqli_num_rows($res3);
                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res3)) {
                                    $subj_name = $row['subject_name'];
                                    $subj_code = $row['subject_code'];
                                    $subj_id = $row['subject_id'];
                                    ?>
                                    <tr>
                                        <td><p>(<b><?php echo $subj_code; ?></b>) <?php echo $subj_name; ?></p></td>
                                        <td>
                                            <a class="blue blue-menu mr-10" href="<?php echo SITEURL;?>admin/submission.php?id=<?php echo $subj_id; ?>">File Submissions</a>
                                            <a class="blue blue-menu mr-10" href="<?php echo SITEURL;?>admin/quiz.php?id=<?php echo $subj_id; ?>">Quiz</a>
                                            <a class="blue blue-menu mr-10" href="<?php echo SITEURL;?>admin/upload-file.php?id=<?php echo $subj_id; ?>&user_id=<?php echo $id; ?>">Upload File</a>
                                            <a class="blue blue-menu" href="<?php echo SITEURL;?>admin/edit-subject.php?id=<?php echo $subj_id; ?>">Edit</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>

            <div class="all-subj categories term">
                <div class="categories-heading flex">
                    <h4>Term</h4>
                    <a class="primary-btn mb-10" href="<?php echo SITEURL;?>admin/create-term.php">Add Term</a>
                </div>
                <div class="term-tbl-wrapper">
                    <table>
                        <tr>
                            <th>School Year</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                            $sql3 = "SELECT * FROM term ORDER BY term_id DESC;";
                            $res3 = mysqli_query($conn, $sql3);
    
                            $count = mysqli_num_rows($res3);
                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res3)) {
                                    $session = $row['session'];
                                    $status = $row['status'];
                                    $term_id = $row['term_id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $session; ?></td>
                                        <td class="termstatus">
                                            <?php
                                                if($status == "active") {
                                                    ?>
                                                        <a href="<?php echo SITEURL;?>admin/term-status.php?id=<?php echo $term_id;?>&status=active&user_id=<?php echo $_SESSION['adminId']; ?>" class="success-btn">Active</a>
                                                    <?php
                                                } else if($status == "inactive") {
                                                    ?>
                                                        <a href="<?php echo SITEURL;?>admin/term-status.php?id=<?php echo $term_id;?>&status=inactive&user_id=<?php echo $_SESSION['adminId']; ?>" class="danger-btn">Inactive</a>

                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td><a class="blue" href="<?php echo SITEURL;?>admin/term-edit.php?id=<?php echo $term_id; ?>">Edit</a></td>
                                        <td><a class="blue" href="<?php echo SITEURL;?>admin/term-delete.php?id=<?php echo $term_id;?>&user_id=<?php echo $_SESSION['adminId'] ?> " onclick="javascript: return confirm('Do you want to delete this category?');">Delete</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php include "partials-admin/footer.php"; ?>
