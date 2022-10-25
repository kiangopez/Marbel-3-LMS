<?php include "../config/constants.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/teacher.css" />
    <title>Teacher Login</title>
</head>
<body>
    <?php
        if(isset($_SESSION['teacherId'])) {
            ?>
            <div class="loggedIn">
                <div class="logged-in-message">
                    <p>You are currently logged in</p>
                </div>
                <div>
                    <a href="<?php echo SITEURL;?>teacher/teacher-logout.php?id=<?php echo $_SESSION['teacherId']; ?>" class="danger-btn">Logout</a>
                    <a href="<?php echo SITEURL;?>teacher/home.php" class="secondary-btn">Back</a>
                </div>
            </div>
            <?php
        } else {
            ?>
                <div class="form-login">
                    <h1>Welcome Teacher!</h1>
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
                    
                    <form action="../includes/teacher-login.inc.php" method="POST">
                        <div>
                            <input type="text" name="URN" placeholder="Input your URN" required>
                            <input type="password" name="pwd" placeholder="Password" required>
                        </div>
                        <div>
                            <button type="submit" name="submit">Login</button>
                        </div>
                    </form>
                </div>
            <?php
        }
    ?>
    
    
    
</body>
</html>