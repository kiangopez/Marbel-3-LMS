<?php include "partials-admin/header.php"; ?>

        <?php
            if(isset($_GET['id'])) {
                $user = htmlspecialchars($_GET['user']);
                $id = $_GET['id'];

                if($user == "admin") {
                    if(is_numeric($_GET['id'])) {
                        $sql = "SELECT * FROM ann_admin WHERE id=$id;";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == true) {
                        if($res == TRUE) {
                            $count = mysqli_num_rows($res);
                            if($count == 1) {
                                $row = mysqli_fetch_assoc($res);
                                $id = $row['id'];
                                $ann = $row['announcement'];
                                ?>
                                    <section class="dashboard wrapper column" id="dashboard">
                                        <div class="heading p-20"><h2>Edit Announcement</h2></div>


                                        <div class="ann-edit">
                                            <form class="p-20" action="../includes/edit-announcement.inc.php" method="POST">
                                                <label for="ann">Current Announcements:</label>
                                                <textarea name="ann" id="ann" cols="30" rows="20"><?php echo $ann; ?></textarea>

                                                <input type="hidden" name="user" value="<?php echo $user; ?>">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="hidden" value="<?php echo $_SESSION['adminId']; ?>" name="admin_id">
                                                <button class="primary-btn" type="submit" name="submit">Submit</button>
                                            </form>
                                        </div>

                                        </div>
                                    </section>
                                    
                                <?php
                            }
                        } else {
                            header("location:".SITEURL."admin/admin-announcement.php?error=stmtfailed");
                        }
                    } else {
                        ?>
                        <section class="dashboard wrapper column" id="dashboard">
                            <div class="error-handler">
                                <p>You're not allowed in this page</p> 
                                <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                            </div>
                        </section>
                        <?php
                    }

                    } else {
                        ?>
                            <section class="dashboard wrapper column" id="dashboard">
                                <div class="error-handler">
                                    <p>You're not allowed in this page</p> 
                                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                                </div>
                            </section>
                    <?php include "partials-admin/footer.php"; ?>

                        <?php
                        exit();
                    }
                    
                } else if ($user == "student") {
                    if(is_numeric($_GET['id'])) {
                        $sql = "SELECT * FROM ann_student WHERE id=$id;";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == true) {
                        if($res == TRUE) {
                            $count = mysqli_num_rows($res);
                            if($count == 1) {
                                $row = mysqli_fetch_assoc($res);
                                $id = $row['id'];
                                $ann = $row['announcement'];
                                ?>
                                    <section class="dashboard wrapper column" id="dashboard">
                                        <div class="heading p-20"><h2>Edit Announcement</h2></div>


                                        <div class="ann-edit">
                                            <form class="p-20" action="../includes/edit-announcement.inc.php" method="POST">
                                                <label for="ann">Current Announcements:</label>
                                                <textarea name="ann" id="ann" cols="30" rows="20"><?php echo $ann; ?></textarea>

                                                <input type="hidden" name="user" value="<?php echo $user; ?>">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="hidden" value="<?php echo $_SESSION['adminId']; ?>" name="admin_id">
                                                <button class="primary-btn" type="submit" name="submit">Submit</button>
                                            </form>
                                        </div>

                                        </div>
                                    </section>
                                    
                                <?php
                            }
                        } else {
                            header("location:".SITEURL."admin/admin-announcement.php?error=stmtfailed");
                        }
                    } else {
                        ?>
                        <section class="dashboard wrapper column" id="dashboard">
                            <div class="error-handler">
                                <p>You're not allowed in this page</p> 
                                <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                            </div>
                        </section>
                        <?php
                    }

                    } else {
                        ?>
                            <section class="dashboard wrapper column" id="dashboard">
                                <div class="error-handler">
                                    <p>You're not allowed in this page</p> 
                                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                                </div>
                            </section>
                    <?php include "partials-admin/footer.php"; ?>

                        <?php
                        exit();
                    }
                } else if ($user == "teacher") {
                    if(is_numeric($_GET['id'])) {
                        $sql = "SELECT * FROM ann_teacher WHERE id=$id;";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($res);
                    if($row == true) {
                        if($res == TRUE) {
                            $count = mysqli_num_rows($res);
                            if($count == 1) {
                                $row = mysqli_fetch_assoc($res);
                                $id = $row['id'];
                                $ann = $row['announcement'];
                                ?>
                                    <section class="dashboard wrapper column" id="dashboard">
                                        <div class="heading p-20"><h2>Edit Announcement</h2></div>


                                        <div class="ann-edit">
                                            <form class="p-20" action="../includes/edit-announcement.inc.php" method="POST">
                                                <label for="ann">Current Announcements:</label>
                                                <textarea name="ann" id="ann" cols="30" rows="20"><?php echo $ann; ?></textarea>

                                                <input type="hidden" name="user" value="<?php echo $user; ?>">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="hidden" value="<?php echo $_SESSION['adminId']; ?>" name="admin_id">
                                                <button class="primary-btn" type="submit" name="submit">Submit</button>
                                            </form>
                                        </div>

                                        </div>
                                    </section>
                                    
                                <?php
                            }
                        } else {
                            header("location:".SITEURL."admin/admin-announcement.php?error=stmtfailed");
                        }
                    } else {
                        ?>
                        <section class="dashboard wrapper column" id="dashboard">
                            <div class="error-handler">
                                <p>You're not allowed in this page</p> 
                                <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                            </div>
                        </section>
                        <?php
                    }

                    } else {
                        ?>
                            <section class="dashboard wrapper column" id="dashboard">
                                <div class="error-handler">
                                    <p>You're not allowed in this page</p> 
                                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                                </div>
                            </section>
                    <?php include "partials-admin/footer.php"; ?>

                        <?php
                        exit();
                    }
                }
                

            }
        ?>
        
   

<?php include "partials-admin/footer.php"; ?>

