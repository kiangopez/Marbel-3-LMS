<?php include"partials-teacher/header.php"; ?>
    <?php
        if($_GET['id'] == $_SESSION['teacherId']) {
            $id = $_GET['id'];
    ?>
<section class="dashboard wrapper column" id="dashboard">
    <div class="heading p-20"><h2>Change Password</h2></div>
    <p class="p-20">Password should contain atleast 6 and a max of 16 characters.</p>
    <div class="p-20 pwd-class">
        <?php
            if(isset($_SESSION['pwd-error'])) {
                echo $_SESSION['pwd-error'];
                unset($_SESSION['pwd-error']);
            }
        ?>
    </div>
    <div class="form-wrapper">
        <form action="../includes/update-password-teacher.inc.php" method="POST" class="pt-20">

            <div class="form-control">
                <label for="current_password">Current Password: </label>
                <input type="password" name="current_password" id="current_password">               
            </div>

            <div class="form-control">
                <label for="new_password">New Password: </label>
                <input type="password" name="new_password" id="new_password">               
            </div>

            <div class="form-control">
                <label for="confirm_password">Confirm Password: </label>
                <input type="password" name="confirm_password" id="confirm_password">               
            </div>

            <div class="form-control">  
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="p-0">
                    <button class="primary-btn" type="submit" name="submit">Submit</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>teacher/teacher-profile.php?id=<?php echo $id; ?>">Back</a>
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
                    <a class="blue" href="<?php echo SITEURL?>teacher/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
</section>
<?php include"partials-teacher/footer.php"; ?>