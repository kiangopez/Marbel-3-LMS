<?php
   include "../config/constants.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/login.css" />
    <title>Forgot Password | Marbel 3 Elementary School</title>
  </head>
  <body>

<div class="first-wrapper">
   <form action="" method="POST" id="first_form">
      <a class="back" href="<?php echo SITEURL;?>teacher/teacher-login.php">back</a>
      <div class="form-heading">
         <h1>Forgot Password</h1>
      </div>

      <div class="first-notif">
         <?php
            if(isset($_SESSION['forgot-message'])) {
               echo $_SESSION['forgot-message'];
               unset($_SESSION['forgot-message']);
            }
         ?>
      </div>

      <input type="text" name="username" placeholder="URN">
      <input type="email" name="email" placeholder="Email">
      <button type="submit" name="submit">Enter</button>
   </form>
</div>

<?php

if(isset($_POST['submit'])) {
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);

   if($username == "" || $email == "") {
      $_SESSION['forgot-message'] = "<p>Please fill up all fields</p>";
      header("Refresh:0");
      exit();
   }

   $sql = "SELECT * FROM teachers_tbl WHERE URN = $username AND email = '$email'";
   $res = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($res);
   $count = mysqli_num_rows($res);

   if($count == 0) {
      $_SESSION['forgot-message'] = "<p>Wrong URN or email</p>";
      header("Refresh:0");
      exit();
   } else {
      // Accounts match
      $id = $row['teacher_id'];
      // header("location:".SITEURL."teacher/reset-password.php?id=$id");
      ?>
         <script>
            const first = document.getElementById("first_form").style.display = "none";
            const firstWrapper = document.querySelector(".first-wrapper").style.display = "none";
         </script>

      <div class="second-wrapper">
         <form action="forgot-password.inc.php" method="POST" class="pt-20">

            <div class="form-heading">
               <h1>Reset Password</h1>
            </div>

            <div class="first-notif">
               <?php
                  if(isset($_SESSION['forgot-message'])) {
                     echo $_SESSION['forgot-message'];
                     unset($_SESSION['forgot-message']);
                  }
               ?>
            </div>

            <div class="form-control">
               <!-- <label for="new_password">New Password: </label> -->
               <input type="password" name="new_password" id="new_password" placeholder="Password">               
            </div>

            <div class="form-control">
               <!-- <label for="confirm_password">Confirm Password: </label> -->
               <input type="password" name="confirm_password" id="confirm_password"  placeholder="Confirm password">               
            </div>

            <div class="form-control">  
               <input type="hidden" name="id" value="<?php echo $id; ?>">
               <div class="split">
                  <button type="submit" name="submit">Submit</button>
                  <button class="cancel" type="submit" name="cancel">Cancel</button>
               </div>
            </div>
         </form>
      </div>
      <?php
   }
}

?>
  </body>
</html>