<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Edit Announcement</h2></div>

        <?php
            if(isset($_GET['user'])) {
                $user = $_GET['user'];
                $id = $_GET['id'];

                if($user == "admin") {
                    $sql = "SELECT * FROM ann_admin WHERE id=$id;";
                    $res = mysqli_query($conn, $sql);
                    if($res == TRUE) {
                        $count = mysqli_num_rows($res);
                        if($count == 1) {
                            $row = mysqli_fetch_assoc($res);
                            $id = $row['id'];
                            $ann = $row['announcement'];
                            ?>
        
                            <?php
                        }
                    } else {
                        header("location:".SITEURL."admin/admin-announcement.php?error=stmtfailed");
                    }
                } else if ($user == "student") {
                    $sql = "SELECT * FROM ann_student WHERE id=$id;";
                    $res = mysqli_query($conn, $sql);
                    if($res == TRUE) {
                        $count = mysqli_num_rows($res);
                        if($count == 1) {
                            $row = mysqli_fetch_assoc($res);
                            $id = $row['id'];
                            $ann = $row['announcement'];
                            ?>
        
                            <?php
                        }
                    } else {
                        header("location:".SITEURL."admin/admin-announcement.php?error=stmtfailed");
                    }
                } else if ($user == "teacher") {
                    $sql = "SELECT * FROM ann_teacher WHERE id=$id;";
                    $res = mysqli_query($conn, $sql);
                    if($res == TRUE) {
                        $count = mysqli_num_rows($res);
                        if($count == 1) {
                            $row = mysqli_fetch_assoc($res);
                            $id = $row['id'];
                            $ann = $row['announcement'];
                            ?>
        
                            <?php
                        }
                    } else {
                        header("location:".SITEURL."admin/admin-announcement.php?error=stmtfailed");
                    }
                }
                

            }
        ?>

        <div class="ann-edit">
            <form class="p-20" action="../includes/edit-announcement.inc.php" method="POST">
                <label for="ann">Current Announcements:</label>
                <textarea name="ann" id="ann" cols="30" rows="20"><?php echo $ann; ?></textarea>

                <input type="hidden" name="user" value="<?php echo $user; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button class="primary-btn" type="submit" name="submit">Submit</button>
            </form>
        </div>

        </div>
    </section>

<?php include "partials-admin/footer.php"; ?>

