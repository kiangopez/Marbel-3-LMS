<?php include "../config/constants.php"; ?>
<?php include "../admin/partials-admin/admin-login-check.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/admin.css" />
  <link rel="stylesheet" href="../assets/print.css" />
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
  <title>Admin Dashboard</title>
</head>
<body>
    <!-- Top Navbar Starts -->
    <header class="flex" id="nav-header">
      <div class="logo">
        <div class="menu flex" id="menu">
          <ion-icon name="menu-outline"></ion-icon>
        </div>
        <h1>Admin Dashboard</h1>
      </div>
      <?php
      if(isset($_SESSION['adminId'])) {
            $id = $_SESSION['adminId'];
        }
      ?>

      <div class="header-items-wrapper">
        <div class="header-pic">
          <?php
            $sql123 = "SELECT * FROM admin_tbl WHERE id = $id";
            $res123 = mysqli_query($conn, $sql123);
            $row123 = mysqli_fetch_assoc($res123);
            $minipic = $row123['image_name'];
          ?>
          <img src="../assets/user_images/<?php echo $minipic; ?>" alt="Profile Picture" >
        </div>
        
        <div class="header-items">
            <a href="#">
              <?php
                if(isset($_SESSION['adminUid'])) {
                  echo $_SESSION['adminUid'];
                }

            ?>  
            <ion-icon name="caret-down-outline"></ion-icon></a>
            <div class="dropdown-content">
              <a href="<?php echo SITEURL;?>admin/admin-profile.php?id=<?php echo $id; ?>">Profile</a>
              <a href="<?php echo SITEURL;?>admin/admin-logout.php">Logout</a>
            </div>
        </div>
      </div>
    </header>
    <!-- Top Navbar Ends -->
    <!-- Side Navbar Starts -->
    <nav id="nav-sidebar">
      <div class="wrapper sidebar">
        <ul class="nav-links">
          <li><a href="<?php echo SITEURL;?>admin/home.php"><ion-icon name="home-sharp"></ion-icon>Home</a></li>
          <li><a href="<?php echo SITEURL;?>admin/index.php"><ion-icon name="speedometer-sharp"></ion-icon>Dashboard</a></li>
          <?php
            $sql44 = "SELECT * FROM admin_tbl WHERE id = $id";
            $res44 = mysqli_query($conn, $sql44);
            $row44 = mysqli_fetch_assoc($res44);
            $studentUsn = $row44['id'];

            $message_query = "SELECT * FROM message where receiver_id = $studentUsn AND read_status = ''";
            $message_res = mysqli_query($conn, $message_query);
            $count_message = mysqli_num_rows($message_res);
            if($count_message > 0) {
              ?>
                <li><a href="<?php echo SITEURL;?>admin/chat.php?id=<?php echo $id; ?>"><ion-icon name="chatbubbles-sharp"></ion-icon>Chat <span><?php echo $count_message; ?></span></a></li>
              <?php
            } else {
              ?>
              <li><a href="<?php echo SITEURL;?>admin/chat.php?id=<?php echo $id; ?>"><ion-icon name="chatbubbles-sharp"></ion-icon>Chat</a></li>
              <?php
            }
          ?>
          <li class="label">Menu</li>
          <li><a href="<?php echo SITEURL;?>admin/manage-subjects.php"><ion-icon name="document-sharp"></ion-icon>Manage Subjects</a></li>
          <li><a href="<?php echo SITEURL;?>admin/manage-admin.php"><ion-icon name="document-sharp"></ion-icon>Manage Admin</a></li>
          <li><a href="<?php echo SITEURL;?>admin/manage-students.php?page=1"><ion-icon name="document-sharp"></ion-icon>Manage Students</a></li>
          <li><a href="<?php echo SITEURL;?>admin/manage-teachers.php?page=1"><ion-icon name="document-sharp"></ion-icon>Manage Teachers</a></li>
          <li><a href="<?php echo SITEURL;?>admin/admin-announcement.php"><ion-icon name="megaphone-sharp"></ion-icon>Announcements</a></li>
          <li><a href="<?php echo SITEURL;?>admin/calendar.php"><ion-icon name="calendar-sharp"></ion-icon></ion-icon>School Calendar</a></li>
        </ul>
      </div>
    </nav>
    <!-- Side Navbar Ends -->

    <?php
      if(isset($_POST['submit'])) {
        $student_cat = $_POST['student_cat'];
        $subject_name = $_POST['subject_name'];
        $subject_id = $_POST['subject_id'];

        // Get the current school year term
        $sql_term = "SELECT * FROM term WHERE status = 'active'";
        $res_term = mysqli_query($conn, $sql_term);
        $row_term = mysqli_fetch_assoc($res_term);
        $current_term = $row_term['session'];

        // Get the adviser
        $sql_teacher_s = "SELECT * FROM teacher_subject WHERE subject_id = $subject_id";
        $res_teacher_s = mysqli_query($conn, $sql_teacher_s);
        $row_teacher_s = mysqli_fetch_assoc($res_teacher_s);
        $teacher_id = $row_teacher_s['teacher_id'];

        // Get the adviser name
        $sql_teacher = "SELECT * FROM teachers_tbl WHERE teacher_id = $teacher_id";
        $res_teacher = mysqli_query($conn, $sql_teacher);
        $row_teacher = mysqli_fetch_assoc($res_teacher);
        $adviser_name = $row_teacher['fname']." ".$row_teacher['mname']." ".$row_teacher['lname'];
      }
    ?>
    <!-- Main Template -->
    <div class="teacher-report-card">
          <div id="close-btn" class="close-btn-grades secondary-btn btn">
            <a href="<?php echo SITEURL;?>admin/view-students.php?subj_id=<?php echo $subject_id; ?>">Back</a>
          </div>
          <div class="trc-header">
            <div class="trc-img">
              <img src="../assets/images/mlogo.png" alt="">
            </div>
            <div class="trc-text">
              <p>Marbel 3 <br> Elementary School</p>
              <p>Korondal City, <br> South Cotabato</p>
              <h1>Subject Report Card</h1>
            </div>
          </div>

          <div class="trc-details">
            <p>S.Y. <?php echo $current_term; ?></p>
            <p>Grade & Section: <?php echo $student_cat; ?></p>
            <p>Subject: <b><?php echo $subject_name; ?></b></p>
          </div>

          <table class="trc-table">
            <tr>
              <th>#</th>
              <th>LRN</th>
              <th>Student</th>
              <th>Q1</th>
              <th>Q2</th>
              <th>Q3</th>
              <th>Q4</th>
            </tr>
              <?php
                $sql_student = "SELECT * FROM students_tbl AS s INNER JOIN student_subject AS ss ON s.student_id = ss.student_id WHERE ss.subject_id = $subject_id ORDER BY lname ASC";
                $res_student = mysqli_query($conn, $sql_student);
                $count_student = mysqli_num_rows($res_student);
                $num = 1;
                if($count_student > 0) {
                    while($row_student = mysqli_fetch_assoc($res_student)) {
                      $full_name = $row_student['fname']." ".$row_student['mname']." ".$row_student['lname'];
                      $lrn = $row_student['USN'];
                      $student_id = $row_student['student_id'];
                        ?>
                        <tr>
                          <td><?php echo $num++; ?></td>
                          <td><?php echo $lrn; ?></td>
                          <td><?php echo $full_name; ?></td>
                          <?php
                              // SUBMISSIONS FIRST QUARTER
                              $sqls = "SELECT SUM(grade) AS stotal FROM student_submission AS submission
                              LEFT JOIN file_submission AS file
                                  ON file.submission_id = submission.submission_id
                              WHERE subject_id = $subject_id AND quarter = 1 AND student_id = $student_id;";
                              $ress = mysqli_query($conn, $sqls);
                              $rows = mysqli_fetch_assoc($ress);

                              $sqlst = "SELECT SUM(items) AS stotal_items FROM student_submission AS submission
                              LEFT JOIN file_submission AS file
                                  ON file.submission_id = submission.submission_id
                              WHERE subject_id = $subject_id AND quarter = 1 AND student_id = $student_id;";
                              $resst = mysqli_query($conn, $sqlst);
                              $rowst = mysqli_fetch_assoc($resst);
                              // QUIZZES FIRST QUARTER
                              $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                              LEFT JOIN quiz_student AS qs
                                  ON q.quiz_id = qs.quiz_id
                              WHERE student_id = $student_id AND subject_id = $subject_id AND quarter = 1;";
                              $res4 = mysqli_query($conn, $sql4);
                              $row4 = mysqli_fetch_assoc($res4);

                              $total_grade = $row4['total'] + $rows['stotal'];

                              $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                              LEFT JOIN quiz_student AS qs
                                  ON q.quiz_id = qs.quiz_id
                              WHERE student_id = $student_id AND subject_id = $subject_id AND quarter = 1;";
                              $res5 = mysqli_query($conn, $sql5);
                              while($row5 = mysqli_fetch_assoc($res5)) {
                                  $total_items = $row5['total_items'] + $rowst['stotal_items'];
                                  if($total_items == 0) {
                                      $total_items = 1;
                                  }
                                  $total = round(($total_grade / $total_items) * 100);
                                  ?>
                                  <td class="text-center"><?php echo $total; ?></td>
                                  <?php
                              }
                            ?>
                          <?php
                          // SUBMISSIONS
                              $sqls5 = "SELECT SUM(grade) AS stotal FROM student_submission AS submission
                              LEFT JOIN file_submission AS file
                                  ON file.submission_id = submission.submission_id
                              WHERE subject_id = $subject_id AND quarter = 2 AND student_id = $student_id;;";
                              $ress5 = mysqli_query($conn, $sqls5);
                              $rows5 = mysqli_fetch_assoc($ress5);

                              $sqlst5 = "SELECT SUM(items) AS stotal_items FROM student_submission AS submission
                              LEFT JOIN file_submission AS file
                                  ON file.submission_id = submission.submission_id
                              WHERE subject_id = $subject_id AND quarter = 2 AND student_id = $student_id;;";
                              $resst5 = mysqli_query($conn, $sqlst5);
                              $rowst5 = mysqli_fetch_assoc($resst5);
                              // QUIZZES 
                              $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                              LEFT JOIN quiz_student AS qs
                                  ON q.quiz_id = qs.quiz_id
                              WHERE student_id = $student_id AND subject_id = $subject_id AND quarter = 2;";
                              $res4 = mysqli_query($conn, $sql4);
                              $row4 = mysqli_fetch_assoc($res4);

                              $total_grade = $row4['total'] + $rows5['stotal'];

                              $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                              LEFT JOIN quiz_student AS qs
                                  ON q.quiz_id = qs.quiz_id
                              WHERE student_id = $student_id AND subject_id = $subject_id AND quarter = 2;";
                              $res5 = mysqli_query($conn, $sql5);
                              while($row5 = mysqli_fetch_assoc($res5)) {
                                  $total_items = $row5['total_items'] + $rowst5['stotal_items'];
                                  if($total_items == 0) {
                                      $total_items = 1;
                                  }
                                  $total = round(($total_grade / $total_items) * 100);
                                  ?>
                                  <td class="text-center"><?php echo $total; ?></td>
                                  <?php
                              }
                          ?>
                          <?php
                              // SUBMISSIONS
                              $sqls4 = "SELECT SUM(grade) AS stotal FROM student_submission AS submission
                              LEFT JOIN file_submission AS file
                                  ON file.submission_id = submission.submission_id
                              WHERE subject_id = $subject_id AND quarter = 3 AND student_id = $student_id;;";
                              $ress4 = mysqli_query($conn, $sqls4);
                              $rows4 = mysqli_fetch_assoc($ress4);

                              $sqlst4 = "SELECT SUM(items) AS stotal_items FROM student_submission AS submission
                              LEFT JOIN file_submission AS file
                                  ON file.submission_id = submission.submission_id
                              WHERE subject_id = $subject_id AND quarter = 3 AND student_id = $student_id;;";
                              $resst4 = mysqli_query($conn, $sqlst4);
                              $rowst4 = mysqli_fetch_assoc($resst4);
                              // QUIZZES 
                              $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                              LEFT JOIN quiz_student AS qs
                                  ON q.quiz_id = qs.quiz_id
                              WHERE student_id = $student_id AND subject_id = $subject_id AND quarter = 3;";
                              $res4 = mysqli_query($conn, $sql4);
                              $row4 = mysqli_fetch_assoc($res4);

                              $total_grade = $row4['total'] + $rows4['stotal'];

                              $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                              LEFT JOIN quiz_student AS qs
                                  ON q.quiz_id = qs.quiz_id
                              WHERE student_id = $student_id AND subject_id = $subject_id AND quarter = 3;";
                              $res5 = mysqli_query($conn, $sql5);
                              while($row5 = mysqli_fetch_assoc($res5)) {
                                  $total_items = $row5['total_items'] + $rowst4['stotal_items'];
                                  if($total_items == 0) {
                                      $total_items = 1;
                                  }
                                  $total = round(($total_grade / $total_items) * 100);
                                  ?>
                                  <td class="text-center"><?php echo $total; ?></td>
                                  <?php
                              }
                          ?>
                          <?php
                              // SUBMISSIONS
                              $sqls3 = "SELECT SUM(grade) AS stotal FROM student_submission AS submission
                              LEFT JOIN file_submission AS file
                                  ON file.submission_id = submission.submission_id
                              WHERE subject_id = $subject_id AND quarter = 4 AND student_id = $student_id;;";
                              $ress3 = mysqli_query($conn, $sqls3);
                              $rows3 = mysqli_fetch_assoc($ress3);

                              $sqlst3 = "SELECT SUM(items) AS stotal_items FROM student_submission AS submission
                              LEFT JOIN file_submission AS file
                                  ON file.submission_id = submission.submission_id
                              WHERE subject_id = $subject_id AND quarter = 4 AND student_id = $student_id;;";
                              $resst3 = mysqli_query($conn, $sqlst3);
                              $rowst3 = mysqli_fetch_assoc($resst3);
                              // QUIZZES 
                              $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                              LEFT JOIN quiz_student AS qs
                                  ON q.quiz_id = qs.quiz_id
                              WHERE student_id = $student_id AND subject_id = $subject_id AND quarter = 4;";
                              $res4 = mysqli_query($conn, $sql4);
                              $row4 = mysqli_fetch_assoc($res4);

                              $total_grade = $row4['total'] + $rows3['stotal'];

                              $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                              LEFT JOIN quiz_student AS qs
                                  ON q.quiz_id = qs.quiz_id
                              WHERE student_id = $student_id AND subject_id = $subject_id AND quarter = 4;";
                              $res5 = mysqli_query($conn, $sql5);
                              while($row5 = mysqli_fetch_assoc($res5)) {
                                  $total_items = $row5['total_items'] + $rowst3['stotal_items'];
                                  if($total_items == 0) {
                                      $total_items = 1;
                                  }
                                  $total = round(($total_grade / $total_items) * 100);
                                  ?>
                                  <td class="text-center"><?php echo $total; ?></td>
                                  <?php
                              }
                          ?>
                        </tr>
                        <?php
                    }
                } else {
                    // no student
                }
              ?>


          </table>

          <div class="trc-remarks">
            <div class="trc-head">
              <p class="upc top-border"><b>Dr. Enrique Pimplepopper</b></p>
              <p>Principal</p>
            </div>
            <div class="trc-adviser">
              <p class="upc top-border"><b><?php echo $adviser_name; ?></b></p>
              <p>Class Adviser</p>
            </div>
          </div>
        </div>
        

        <div class="grade-time"><?php echo $date = date('M d, Y, D H:i:s'); ?></div>
    <!-- Main Template Ends -->
    <script type="text/javascript">
      window.onload = addPageNumbers;

      function addPageNumbers() {
        var totalPages = Math.ceil(document.body.scrollHeight / 1123);  //842px A4 pageheight for 72dpi, 1123px A4 pageheight for 96dpi, 
        for (var i = 1; i <= totalPages; i++) {
          var pageNumberDiv = document.createElement("div");
          var pageNumber = document.createTextNode("Page " + i + " of " + totalPages);
          pageNumberDiv.style.position = "absolute";
          pageNumberDiv.style.top = "calc((" + i + " * (297mm - 0.5px)) - 40px)"; //297mm A4 pageheight; 0,5px unknown needed necessary correction value; additional wanted 40px margin from bottom(own element height included)
          pageNumberDiv.style.height = "16px";
          pageNumberDiv.appendChild(pageNumber);
          document.body.insertBefore(pageNumberDiv, document.getElementById("content"));
          pageNumberDiv.style.left = "calc(100% - (" + pageNumberDiv.offsetWidth + "px + 20px))";
        }
      }
      </script>

<!-- Footer Starts -->
<footer class="flex" id="footer">
    <div class="footer-links">
      <a>All Rights Reserved 2022</a>
    </div>
    <div class="footer-text">Marbel 3 Elementary School</div>
  </footer>
  <!-- Footer Ends -->
    <script src="../assets/chosen/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="../assets/script.js"></script>
    <script type="text/javascript" src="../assets/fullcalendarsc.js"></script>
    <script type="text/javascript" src="../assets/add-quiz.js"></script>
</body>
</html>