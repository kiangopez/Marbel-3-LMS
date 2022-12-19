<?php include "../config/constants.php"; ?>
<?php include "teacher-login-check.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/teacher.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css"
    integrity="sha512-KXkS7cFeWpYwcoXxyfOumLyRGXMp7BTMTjwrgjMg0+hls4thG2JGzRgQtRfnAuKTn2KWTDZX4UdPg+xTs8k80Q=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../assets/chosen/chosen.min.css">

   <!-- ✅ load Ion Icons ✅ -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
    <!-- ✅ load jQuery ✅ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- ✅ load moment.js ✅ -->
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  ></script>

  <!-- ✅ load FullCalendar ✅ -->
  <script
      src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"
      integrity="sha512-o0rWIsZigOfRAgBxl4puyd0t6YKzeAw9em/29Ag7lhCQfaaua/mDwnpE2PVzwqJ08N7/wqrgdjc2E0mwdSY2Tg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <title>Teacher's Portal | Marbel</title>
</head>
<body>
  <?php
    $id = $_SESSION['teacherId'];

  ?>
    <!-- Top Navbar Starts -->
    <header class="flex">
      <div class="logo">
        <div class="menu flex" id="menu">
          <ion-icon name="menu-outline"></ion-icon>
        </div>
        <h1>Teacher's Portal</h1>
      </div>
      <div class="header-items-wrapper">
      <div class="header-pic">
          <?php
            $sql123 = "SELECT * FROM teachers_tbl WHERE teacher_id = $id";
            $res123 = mysqli_query($conn, $sql123);
            $row123 = mysqli_fetch_assoc($res123);
            $minipic = $row123['image_name'];

            if($minipic == "") {
              ?>
                <img src="../assets/images/default_image.png" alt="">
              <?php
            } else {
              ?>
                <img src="../assets/user_images/<?php echo $minipic; ?>">
              <?php
            }
          ?>
        </div>
        <div class="header-items">
              <?php
                if(isset($_SESSION["teacherId"])) {
                  echo $_SESSION["teacherFname"];
                  echo " ";
                  echo $_SESSION["teacherLname"];
                }
              ?>
          <ion-icon name="caret-down-outline"></ion-icon></a>
          <div class="dropdown-content">
            <a href="<?php echo SITEURL;?>teacher/teacher-profile.php?id=<?php echo $id; ?>">Profile</a>
            <a href="<?php echo SITEURL;?>teacher/teacher-logout.php?id=<?php echo $id; ?>">Logout</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Top Navbar Ends -->
    <!-- Side Navbar Starts -->
    <nav>
      <div class="wrapper sidebar">
        <ul class="nav-links">
          <li><a href="<?php echo SITEURL;?>teacher/home.php"><ion-icon name="home-sharp"></ion-icon>Home</a></li>
          <li><a href="<?php echo SITEURL;?>teacher/index.php"><ion-icon name="speedometer-sharp"></ion-icon>Dashboard</a></li>
          <li><a href="<?php echo SITEURL;?>teacher/calendar.php"><ion-icon name="calendar-sharp"></ion-icon></ion-icon>Calendar</a></li>
          <?php
            $sql44 = "SELECT * FROM teachers_tbl WHERE teacher_id = $id";
            $res44 = mysqli_query($conn, $sql44);
            $row44 = mysqli_fetch_assoc($res44);
            $studentUsn = $row44['URN'];

            $message_query = "SELECT * FROM message where receiver_id = $studentUsn AND read_status = ''";
            $message_res = mysqli_query($conn, $message_query);
            $count_message = mysqli_num_rows($message_res);
            if($count_message > 0) {
              ?>
                <li><a href="<?php echo SITEURL;?>teacher/chat.php?id=<?php echo $id; ?>"><ion-icon name="chatbubbles-sharp"></ion-icon>Chat <span><?php echo $count_message; ?></span></a></li>
              <?php
            } else {
              ?>
              <li><a href="<?php echo SITEURL;?>teacher/chat.php?id=<?php echo $id; ?>"><ion-icon name="chatbubbles-sharp"></ion-icon>Chat</a></li>
              <?php
            }
          ?>
          <li><a href="<?php echo SITEURL;?>teacher/manage-subject.php"><ion-icon name="document-sharp"></ion-icon>Manage Subjects</a></li>
          <li><a href="<?php echo SITEURL;?>teacher/manage-section.php"><ion-icon name="document-sharp"></ion-icon>My Sections</a></li>
          <li><a href="<?php echo SITEURL;?>teacher/student-evaluation.php?page=1"><ion-icon name="ribbon-sharp"></ion-icon>Student Evaluation</a></li>
        </ul>
      </div>
    </nav>
    <!-- Side Navbar Ends -->