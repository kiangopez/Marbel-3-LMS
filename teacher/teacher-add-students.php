<?php include "partials-teacher/header.php"; ?>

    <section class="dashboard" id="dashboard">
        <div class="heading p-20"><h2>Add Student</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="../includes/add-students.inc.php" method="POST" class="pt-20">
                <div>
                    <label for="usn">USN:</label>
                    <input type="number" name="usn" id="usn">

                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" id="fname">
                                
                    <label for="mname">Middle Name:</label>
                    <input type="text" name="mname" id="mname">

                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" id="lname">
                           
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">

                    <label for="pwd">Password:</label>
                    <input type="password" name="pwd" id="pwd">

                    <label for="pwd_repeat">Confirm Password:</label>
                    <input type="password" name="pwd_repeat" id="pwd_repeat">

                    

                    <input class="primary-btn" type="submit" name="submit" value="Add Student">
                </div>
            </form>
        </div>
    </section>

<?php include "partials-teacher/footer.php"; ?>