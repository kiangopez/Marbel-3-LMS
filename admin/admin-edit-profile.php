<?php include"partials-admin/header.php"; ?>
    <?php
    if($_GET['id'] == $_SESSION['adminId']) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM admin_tbl WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            if($res == TRUE) {
                $count = mysqli_num_rows($res);
                
                if($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $uid = $row['username'];
                    $current_image = $row['image_name'];
                }
            } else {
                header("location:".SITEURL."admin/manage-admin.php");
            }
            
        ?>
<section class="dashboard wrapper column" id="dashboard">
    <div class="heading p-20"><h2>Edit Profile</h2></div>



    <div class="form-wrapper">
        <form action="../includes/update-profile-admin.inc.php" method="POST" enctype="multipart/form-data" class="pt-20">
            <div class="form-control">
                <label>Current Profile Picture:</label>
                <?php 
                    if($current_image == "") {
                        echo "No image uploaded <br>";
                    } else {
                        ?>
                            <img src="<?php echo SITEURL;?>assets/user_images/<?php echo $current_image; ?>" width="150px">
                        <?php
                    }
                ?>
                <br>
            </div>

            <div class="form-control">
                <label>Profile Picture:</label>
                <input type="file" name="image">
                <br>
            </div>

            <div class="form-control">
                <label for="uid">Username:</label>
                <input type="text" name="uid" id="uid" value="<?php echo $uid; ?>" readonly>               
            </div>

            <div class="form-control">
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>">               
            </div>
            
            <div class="form-control">  
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <div class="p-0">
                    <button class="primary-btn" type="submit" name="submit">Update Profile</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>admin/admin-profile.php?id=<?php echo $id; ?>">Back</a>
                </div>
            </div>
        </form>
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