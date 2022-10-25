<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Add Announcement</h2></div>

        <?php
            if(isset($_GET['user'])) {
                $user = $_GET['user'];
                $name = "";
                if($user == "admin") {
                    $name == "ann_admin";
                } else if ($user == "student") {
                    $name == "ann_student";
                } else if ($user == "teacher") {
                    $name == "ann_teacher";
                }
                
                $sql = "SELECT * FROM $name;";
                $res = mysqli_query($conn, $sql);
            }
        ?>

        <div class="ann-edit">
            <form class="p-20" action="../includes/create-announcement.inc.php" method="POST">
                <label for="ann">Current Announcements:</label>
                <textarea name="ann" id="ann" cols="30" rows="20"></textarea>

                <input type="hidden" name="user" value="<?php echo $user; ?>">
                <button class="primary-btn" type="submit" name="submit">Submit</button>
            </form>
        </div>

        <div class="p-20">
            <a class="secondary-btn" href="<?php echo SITEURL;?>admin/admin-announcement.php">Back</a>
        </div>
            
    </section>

<?php include "partials-admin/footer.php"; ?>
