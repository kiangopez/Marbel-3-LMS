<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Add Teacher</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="../includes/add-teachers.inc.php" method="POST" class="pt-20">
                <div>
                    <?php
                        $random = rand(1000,9999);
                        $teacher_urn = $random.date('Y');
                    ?>
                    <label for="urn">URN:</label>
                    <input type="number" name="urn" id="urn" value="<?php echo $teacher_urn; ?>" readonly>

                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" id="fname" required>
                                
                    <label for="mname">Middle Name:</label>
                    <input type="text" name="mname" id="mname" required>

                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" id="lname" required>
                           
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>

                    <label for="pwd">Password:</label>
                    <input type="password" name="pwd" id="pwd" required>

                    <label for="pwd_repeat">Confirm Password:</label>
                    <input type="password" name="pwd_repeat" id="pwd_repeat" required>

                    <input type="hidden" value="<?php echo $_SESSION['adminId']; ?>" name="admin_id">                    

                    <button class="primary-btn" type="submit" name="submit">Add Teacher</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-teachers.php?page=1">Back</a>
                </div>
            </form>
        </div>
    </section>
    <script>
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
    </script>

<?php include "partials-admin/footer.php"; ?>

