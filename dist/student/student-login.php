<?php include "../config/constants.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/student.css" />
    <title>Student Login</title>
</head>
<body>
    <?php
        if(isset($_SESSION['studentId'])) {
            ?>
            <div class="loggedIn">
                <div class="logged-in-message">
                    <p>You are currently logged in</p>
                </div>
                <div>
                    <a href="<?php echo SITEURL;?>student/student-logout.php?id=<?php echo $_SESSION['studentId']; ?>" class="danger-btn">Logout</a>
                    <a href="<?php echo SITEURL;?>student/home.php" class="secondary-btn">Back</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="form-login">
                <h1>Welcome Student!</h1>
                <?php
                    if(isset($_SESSION['no-login-message'])) {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                    if(isset($_SESSION['loginError'])) {
                        echo $_SESSION['loginError'];
                        unset($_SESSION['loginError']);
                    }
                ?>
                
                <form action="../includes/student-login.inc.php" method="POST">
                    <div>
                        <input type="text" name="USN" placeholder="Input your USN" required>
                        <input type="password" name="pwd" placeholder="Password" required>
                    </div>
                    <div>
                        <button class="primary-btn" type="submit" name="submit">Login</button>
                    </div>
                </form>
            </div>
            <?php
        }
    ?>
    

</body>
</html>