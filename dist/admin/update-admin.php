<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Update Admin</h2></div>
        <br>
        <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM admin_tbl WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            if($res == TRUE) {
                $count = mysqli_num_rows($res);
                
                if($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
            } else {
                header("location:".SITEURL."admin/manage-admin.php");
            }
            
        ?>
        
        <div class="form-wrapper">
            <form action="../includes/update-admin.inc.php" method="POST" class="pt-20">
                <div>
                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name" value="<?php echo $full_name ?>">
                                
                    <label for="uid">Username:</label>
                    <input type="text" name="uid" id="uid" value="<?php echo $username ?>" readonly>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <button class="primary-btn" type="submit" name="submit">Update Profile</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-admin.php">Back</a>
                </div>
            </form>
        </div>
    </section>


<?php include "partials-admin/footer.php"; ?>