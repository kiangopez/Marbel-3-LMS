<?php include"partials-admin/header.php"; ?>
    <?php
        if($_GET['id'] == $_SESSION['adminId']) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM admin_tbl WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            if($res == TRUE) {
                $count = mysqli_num_rows($res);

                if($count == 1) {
                    $rows = mysqli_fetch_assoc($res);
                    $full_name = $rows['full_name'];
                    $username = $rows['username'];
                    $image_name = $rows['image_name'];
                }
            }
    ?>
<section class="dashboard wrapper column" id="dashboard">
    <div class="heading p-20"><h2>Profile Page</h2></div>
    
    <?php
        if(isset($_SESSION['updatePassword'])) {
            echo $_SESSION['updatePassword'];
            unset($_SESSION['updatePassword']);
        }
    ?>

    <div class="profile-wrapper mt-20 p-20">
        <div class="left-profile">
            <div class="profile-image">
            <?php 
                if($image_name == "") {
                    ?>
                        <img src="../assets/images/default_image.png">
                    <?php
                } else {
                    ?>
                        <img src="../assets/user_images/<?php echo $image_name; ?>" alt="Profile Picture">
                    <?php
                }
            ?>
            </div>
            <div class="profile-name">
                <p><?php echo $full_name?></p>
            </div>
            <div class="student-details text-center">
                <p>Username: <?php echo $username; ?></p>
            </div>
            <a href="<?php echo SITEURL;?>admin/admin-edit-profile.php?id=<?php echo $id; ?>" class="primary-btn">Edit Profile</a>
            <div class="password">
                <a class="blue" href="<?php echo SITEURL;?>admin/change-password.php?id=<?php echo $id; ?>">Change password</a>
            </div>
            
        </div>
    </div>
    <?php
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
        ?>
</section>
<?php include"partials-admin/footer.php"; ?>