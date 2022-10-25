<?php include "partials-teacher/header.php"; ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Create Subject</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="" method="POST" class="pt-20">
                <div class="create-subj">
                    <label for="subj-name">Subject Name:</label>
                    <input type="text" name="subj-name" id="subj-name">

                    <label for="subj-code">Subject Code:</label>
                    <input type="text" name="subj-code" id="subj-code">
                    
                    <label for="subj-banner">Subject Banner:</label>
                    <input type="file" name="subj-banner" id="">

                    <label class="text-left" for="subj-cat">Subject Category:</label>
                    <select name="subj-cat" id="">
                        <option value="">Kinder</option>
                        <option value="">Grade 1</option>
                        <option value="">Grade 2</option>
                        <option value="">Grade 3</option>
                    </select>
 
                    <label for="subj-desc">Subject Description</label>
                    <textarea name="subj-desc" id="subj-desc" cols="30" rows="10"></textarea>

                    <input class="primary-btn" type="submit" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </section>


<?php include "partials-teacher/footer.php"; ?>