<?php include "partials-admin/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Create Category</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="../includes/create-category.inc.php" method="POST" class="pt-20">
                <div>
                    <label for="cat-name">Category Name:</label>
                    <input type="text" name="cat-name" id="cat-name">

                    <label for="cat-code">Category Code:</label>
                    <input type="text" name="cat-code" id="cat-code">
                    
 
                    <button class="primary-btn" type="submit" name="submit">Create Category</button>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-subjects.php">Back</a>
                </div>
            </form>
        </div>
    </section>


<?php include "partials-admin/footer.php"; ?>