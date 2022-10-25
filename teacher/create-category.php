<?php include "partials-teacher/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Create Category</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="" method="POST" class="pt-20">
                <div>
                    <label for="cat-name">Category Name:</label>
                    <input type="text" name="cat-name" id="cat-name">

                    <label for="cat-code">Category Code:</label>
                    <input type="text" name="cat-code" id="cat-code">
                    
 
                    <input class="primary-btn" type="submit" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </section>


<?php include "partials-teacher/footer.php"; ?>