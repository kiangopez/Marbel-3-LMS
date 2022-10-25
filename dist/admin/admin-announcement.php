<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Announcements</h2></div>
        <br>

        <div class="ann-wrapper p-20">
            <div class="active-ann text-center">
                <div class="ann-heading">
                    <h3>Admin</h3>
                    <a class="primary-btn" href="<?php echo SITEURL;?>admin/add-announcement.php?user=admin">Add</a>
                </div>
                <?php
                    $sql = "SELECT * FROM ann_admin;";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $annid = $row['id'];
                            $ann = $row['announcement'];
                            ?>
                            <div class="ann-container">
                                <div class="ann-content text-left pall-20">
                                    <?php echo $ann; ?>
                                </div>
                                <div class="ann-link">
                                    <a class="blue" href="<?php echo SITEURL;?>admin/edit-announcement.php?user=admin&id=<?php echo $annid; ?>">Edit</a>
                                    <a class="blue" href="<?php echo SITEURL;?>admin/ann-delete.php?user=admin&id=<?php echo $annid; ?>" onclick="javascript: return confirm('Do you want to delete this announcement?');">Delete</a>
                                </div>
                            </div>

                            <?php
                        } 
                    } else {
                        ?>
                            <div class="ann-container">
                                <div class="ann-content text-center pall-20 ">
                                    <p>No Announcement added</p>
                                </div>
                            </div>
                        <?php
                    }          
                ?>
            </div>

            <div class="active-ann text-center">
                <div class="ann-heading">
                    <h3>Student</h3>
                    <a class="primary-btn" href="<?php echo SITEURL;?>admin/add-announcement.php?user=student">Add</a>
                </div>
                <?php
                    $sql = "SELECT * FROM ann_student;";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $annid = $row['id'];
                            $ann = $row['announcement'];
                            ?>
                            <div class="ann-container">
                                <div class="ann-content text-left pall-20">
                                    <?php echo $ann; ?>
                                </div>
                                <div class="ann-link">
                                    <a class="blue" href="<?php echo SITEURL;?>admin/edit-announcement.php?user=student&id=<?php echo $annid; ?>">Edit</a>
                                    <a class="blue" href="<?php echo SITEURL;?>admin/ann-delete.php?user=student&id=<?php echo $annid; ?>" onclick="javascript: return confirm('Do you want to delete this announcement?');">Delete</a>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        ?>
                            <div class="ann-container">
                                <div class="ann-content text-center pall-20 ">
                                    <p>No Announcement added</p>
                                </div>
                            </div>
                        <?php
                    }        
                ?>
            </div>
            
            <div class="active-ann text-center">
                <div class="ann-heading">
                    <h3>Teacher</h3>
                    <a class="primary-btn" href="<?php echo SITEURL;?>admin/add-announcement.php?user=teacher">Add</a>
                </div>
                <?php
                    $sql = "SELECT * FROM ann_teacher;";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $annid = $row['id'];
                            $ann = $row['announcement'];
                            ?>
                            <div class="ann-container">
                                <div class="ann-content text-left pall-20">
                                    <?php echo $ann; ?>
                                </div>
                                <div class="ann-link">
                                    <a class="blue" href="<?php echo SITEURL;?>admin/edit-announcement.php?user=teacher&id=<?php echo $annid; ?>">Edit</a>
                                    <a class="blue" href="<?php echo SITEURL;?>admin/ann-delete.php?user=teacher&id=<?php echo $annid; ?>" onclick="javascript: return confirm('Do you want to delete this announcement?');">Delete</a>
                                </div>
                            </div>

                            <?php
                        } 
                    } else {
                        ?>
                            <div class="ann-container">
                                <div class="ann-content text-center pall-20 ">
                                    <p>No Announcement added</p>
                                </div>
                            </div>
                        <?php
                    }          
                ?>
            </div>
        </div>

    </section>
<?php include "partials-admin/footer.php"; ?>
