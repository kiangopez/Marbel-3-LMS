<?php include "../config/constants.php"; ?>
<?php include "student-login-check.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/student.css" />
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
    <title>Marbel LMS</title>
</head>
<body>
  <?php
    $id = $_SESSION['studentId'];
  ?>
    <!-- Top Navbar Starts -->
    <header class="flex">
      <div class="logo">
        <div class="menu flex" id="menu">
          <ion-icon name="menu-outline"></ion-icon>
        </div>
        <h1>Marbel 3 LMS</h1>
      </div>
      <div class="header-items-wrapper">
      <div class="header-pic">
          <?php
            $sql123 = "SELECT * FROM students_tbl WHERE student_id = $id";
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
              if(isset($_SESSION['studentId'])) {
                echo $_SESSION['studentFname'];
                echo " ";
                echo $_SESSION['studentLname'];
                
              }
          ?>
          <ion-icon name="caret-down-outline"></ion-icon></a>
          <div class="dropdown-content">
            <a href="<?php echo SITEURL;?>student/student-profile.php?id=<?php echo $id; ?>">Profile</a>
            <a href="<?php echo SITEURL;?>student/student-logout.php?id=<?php echo $id; ?>">Logout</a>
          </div>
        </div>
      </div>
    </header>
    <!-- Top Navbar Ends -->
    <!-- Side Navbar Starts ONLY CHANGE THIS PART (CREATE NEW FILE) -->
    <nav>
      <div class="wrapper sidebar">
        <ul class="nav-links">
          <li><a href="<?php echo SITEURL;?>student/home.php"><ion-icon name="home-sharp"></ion-icon>Home</a></li>
          <li><a href="<?php echo SITEURL;?>student/index.php"><ion-icon name="speedometer-sharp"></ion-icon>Dashboard</a></li>
          <li><a href="<?php echo SITEURL;?>student/calendar.php"><ion-icon name="calendar-sharp"></ion-icon></ion-icon>Calendar</a></li>
          <?php
            $sql44 = "SELECT * FROM students_tbl WHERE student_id = $id";
            $res44 = mysqli_query($conn, $sql44);
            $row44 = mysqli_fetch_assoc($res44);
            $studentUsn = $row44['USN'];

            $message_query = "SELECT * FROM message where receiver_id = $studentUsn AND read_status = ''";
            $message_res = mysqli_query($conn, $message_query);
            $count_message = mysqli_num_rows($message_res);
            if($count_message > 0) {
              ?>
                <li><a href="<?php echo SITEURL;?>student/chat.php?id=<?php echo $id; ?>"><ion-icon name="chatbubbles-sharp"></ion-icon>Chat <span><?php echo $count_message; ?></span></a></li>
              <?php
            } else {
              ?>
              <li><a href="<?php echo SITEURL;?>student/chat.php?id=<?php echo $id; ?>"><ion-icon name="chatbubbles-sharp"></ion-icon>Chat</a></li>
              <?php
            }
          ?>
          <!-- <li class="label">Subjects</li> -->
          <?php
          /*
            $sql1 = "SELECT * FROM student_subject AS ss
            INNER JOIN students_tbl AS st
              ON ss.student_id = st.student_id
            INNER JOIN subjects_tbl AS sb
              ON ss.subject_id = sb.subject_id
            WHERE ss.student_id = $id;
            ";
            $res1 = mysqli_query($conn, $sql1);
            $count1 = mysqli_num_rows($res1);

            while($row1 = mysqli_fetch_assoc($res1)) {
              $subject_id = $row1['subject_id'];
              $subject_name = $row1['subject_name'];
              ?>
                <li><a href="<?php echo SITEURL;?>student/subject.php?id=<?php echo $subject_id; ?>"><ion-icon name="school-sharp"></ion-icon><?php echo $subject_name; ?></a></li>
              <?php
            }
            */
          ?>
        </ul>
      </div>
    </nav>
    <!-- Side Navbar Ends -->