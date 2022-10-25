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
        <div class="heading p-20"><h2>Upload Subject Files</h2></div>

        <br><br>


        <div class="subject-info p-20">
            <table class="tbl-50">
                <tr>
                    <td>Subject name:</td>
                    <td><?php echo $subject_name; ?></td>
                </tr>
                <tr>
                    <td>Subject code:</td>
                    <td><?php echo $subject_code; ?></td>
                </tr>
                <tr>
                    <td>Grade:</td>
                    <td><?php echo $category_name; ?></td>
                </tr>
            </table>
            <div class="upload-file">
                <div class="upload-header">
                    <p>File Upload</p>
                </div> 
                <form action="../includes/upload-file-teacher.inc.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="files" required>
                    <input type="hidden" name="subject_id" value="<?php echo $id;?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                    <button class="primary-btn" type="submit" name="submit">Upload File</button>
                    <?php
                        if(isset($_SESSION['fileUpload'])) {
                            echo $_SESSION['fileUpload'];
                            unset($_SESSION['fileUpload']);
                        }
                        if(isset($_SESSION['fileRemove'])) {
                            echo $_SESSION['fileRemove'];
                            unset($_SESSION['fileRemove']);
                        }
                    ?>
                </form>
            </div>
        </div>
        <hr>
        <br>
        <div class="uploads p-20">
            <table class="text-center tbl-full">
                <tr>
                    <th>File name</th>
                    <th>Uploaded by</th>
                    <th>Date Uploaded</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql1 = "SELECT * FROM files WHERE subject_id = $id AND status = 'active' ORDER BY file_id DESC";
                    $res1 = mysqli_query($conn, $sql1);
                    $count = mysqli_num_rows($res1);
                    if($count > 0) {
                        while($row1 = mysqli_fetch_assoc($res1)) {
                            $file_id = $row1['file_id'];
                            $filename = $row1['filename'];
                            $uploaded_by = $row1['uploaded_by'];
                            $upload_date = $row1['upload_date'];
                            ?>
                            <tr>
                                <td><?php echo $filename; ?></td>
                                <td><?php echo $uploaded_by; ?></td>
                                <td><?php echo $upload_date; ?></td>
                                <td>
                                    <div class="actions flex">
                                        <form action="../includes/teacher-download-file.inc.php" method="POST">
                                            <input type="hidden" name="file_id" value="<?php echo $file_id; ?>">
                                            <input type="hidden" name="subject_id" value="<?php echo $id; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <button class="success-btn" type="submit" name="submit">Download</button>
                                        </form>
                                        <form action="../includes/teacher-remove-file.inc.php" method="POST">
                                            <input type="hidden" name="file_id" value="<?php echo $file_id; ?>">
                                            <input type="hidden" name="subject_id" value="<?php echo $id; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <button onclick="javascript: return confirm('Do you want to delete this file?');" class="danger-btn" type="submit" name="submit">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                            <td colspan="4">No Files Added</td>
                        <?php
                    }
                ?>  
            </table>

        </div>
        <div class="enroll-btn mt-20 p-20">
            <a href="<?php echo SITEURL;?>teacher/manage-subject.php" class="secondary-btn btn-20 mt-20">Back</a>
        </div>
        </div>
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
