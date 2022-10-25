<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Add Admin</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="../includes/add-admin.inc.php" method="POST" class="pt-20">
                <div>
                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name" required>
                                
                    <label for="uid">Username:</label>
                    <input type="text" name="uid" id="uid" required>
                                
                    <label for="pwd">Password:</label>
                    <input type="password" name="pwd" id="pwd" required>

                    <label for="pwd_repeat">Confirm Password:</label>
                    <input type="password" name="pwd_repeat" id="pwd_repeat" required>

                    <button class="primary-btn" type="submit" name="submit">Add admin</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-admin.php">Back</a>
                </div>
            </form>
        </div>
    </section>

<?php include "partials-admin/footer.php"; ?>