<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Create Term</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="../includes/create-term.inc.php" method="POST" class="pt-20">
                <div>
                    <label for="term">School Year:</label>
                    <input type="text" name="term" id="term" required>
                    
                    <input type="hidden" value="<?php echo $id; ?>" name="admin_id">
                    <button class="primary-btn" type="submit" name="submit">Submit</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-subjects.php">Back</a>
                </div>
            </form>
        </div>
    </section>


<?php include "partials-admin/footer.php"; ?>