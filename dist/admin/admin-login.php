<?php include "../config/constants.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/admin.css" />
    <title>Login Admin Panel</title>
</head>
<body>
    <?php
        if(isset($_SESSION['adminId'])) {
            ?>
            <div class="loggedIn">
                <div class="logged-in-message">
                    <p>You are currently logged in</p>
                </div>
                <div>
                    <a href="<?php echo SITEURL;?>admin/admin-logout.php?id=<?php echo $_SESSION['adminId']; ?>" class="danger-btn">Logout</a>
                    <a href="<?php echo SITEURL;?>admin/home.php" class="secondary-btn">Back</a>
                </div>
            </div>
            <?php
        } else {
            ?>
                <div class="form-login">
                    <h1>Admin Login</h1>
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
                    
                    <form action="../includes/admin-login.inc.php" method="POST">
                        <input type="text" name="uid" placeholder="Username" required>
                        <input type="password" name="pwd" placeholder="Password" required>
                        <button clas="primary-btn" type="submit" name="submit">Submit</button>
                    </form>
                </div>
            <?php
        }
    ?>
    
    
</body>
</html>