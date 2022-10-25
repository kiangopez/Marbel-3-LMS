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
            if(is_numeric($_GET['id'])) {

                $sql_er = "SELECT * FROM students_tbl WHERE student_id =". $_GET['id'];
                $res_er = mysqli_query($conn, $sql_er);
                $count_er = mysqli_num_rows($res_er);
        
                if($count_er == true) {

                    $student_id = $_GET['id'];

                    $sql = "SELECT ss.student_subject_id, st.student_id, st.USN, st.fname, st.mname, st.lname, s.subject_id ,s.subject_name, s.subject_code, c.category_name 
                        FROM student_subject AS ss
                        INNER JOIN students_tbl AS st
                            ON ss.student_id = st.student_id
                        INNER JOIN subjects_tbl AS s
                            ON ss.subject_id = s.subject_id
                        INNER JOIN categories_tbl AS c
                            ON s.category_id = c.category_id
                        WHERE ss.student_id = $student_id;
                    ";

                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    

                    $sql2 = "SELECT * FROM students_tbl AS s
                        INNER JOIN categories_tbl AS c
                            ON s.category_id = c.category_id
                        INNER JOIN section_tbl AS st
                            ON st.section_id = s.section_id
                        WHERE student_id = $student_id;        
                    ";
                    $res2 = mysqli_query($conn, $sql2);
                    
                    $row2 = mysqli_fetch_assoc($res2);
                    $fname = $row2['fname'];
                    $mname = $row2['mname'];
                    $lname = $row2['lname'];
                    $USN = $row2['USN'];
                    $category_name = $row2['category_name'];
                    $section_name = $row2['section_name'];
                    $full_name = $fname." ".$mname." ".$lname;

                    $GLOBALS['gwa'] = 0;

                    if($count > 0) {
                        
                    
                        ?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Student Report Card</h2></div>
        <div class="prints">
            <button onclick="window.print();" class="primary-btn" id="print-btn">Print</button>
            <button id="close-btn" type="button" class="danger-btn" onclick="window.open('', '_self', ''); window.close();">Close</button>
        </div>
        <div class="student-info p-20">
            <p>Name: <?php echo $full_name; ?></p>
            <p>USN: <?php echo $USN; ?></p>
            <p>Grade & Section: <?php echo $category_name." ".$section_name ; ?></p>
            <p>Date: <?php echo date('M d Y'); ?></p>
            <?php
                $sqlsy = "SELECT * FROM term WHERE status = 'active';";
                $ressy = mysqli_query($conn, $sqlsy);
                $rowsy = mysqli_fetch_assoc($ressy);
            ?>
            <p>SY: <?php echo $rowsy['session']; ?></p>
        </div>
        <!-- Create a new grading table with q1,q2,q3,q4  -->
        <!-- Compute the grades above, input the grades in sql and display it in a while loop -->
        <?php
            $sql3 = "SELECT * FROM student_subject AS ss
            INNER JOIN subjects_tbl AS s
                ON ss.subject_id = s.subject_id
            WHERE ss.student_id = $student_id
            ";

            $res3 = mysqli_query($conn, $sql3); 
            $count = mysqli_num_rows($res3);
        ?>
        <div class="student-info class-card table p-20">
            <table class="tbl-50">
                <tr>
                    <th>Learning Areas</th>
                    <th>Q1</th>
                    <th>Q2</th>
                    <th>Q3</th>
                    <th>Q4</th>
                    <th>Final</th>
                    <th>Remarks</th>
                </tr>
                <?php
                    while($row3 = mysqli_fetch_assoc($res3)) {
                        $subject_name = $row3['subject_name'];
                        $subject_code = $row3['subject_code'];
                        $subj_id = $row3['subject_id'];
                        ?>
                            <tr>
                                <td><b><?php echo $subject_code."</b> ".$subject_name; ?></td>
                                <?php
                                    // SUBMISSIONS
                                    $sqls = "SELECT SUM(grade) AS stotal FROM student_submission AS submission
                                    LEFT JOIN file_submission AS file
                                        ON file.submission_id = submission.submission_id
                                    WHERE subject_id = $subj_id AND quarter = 1 AND student_id = $student_id;;";
                                    $ress = mysqli_query($conn, $sqls);
                                    $rows = mysqli_fetch_assoc($ress);

                                    $sqlst = "SELECT SUM(items) AS stotal_items FROM student_submission AS submission
                                    LEFT JOIN file_submission AS file
                                        ON file.submission_id = submission.submission_id
                                    WHERE subject_id = $subj_id AND quarter = 1 AND student_id = $student_id;;";
                                    $resst = mysqli_query($conn, $sqlst);
                                    $rowst = mysqli_fetch_assoc($resst);
                                    // QUIZZES 
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 1;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'] + $rows['stotal'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 1;";
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
                                    WHERE subject_id = $subj_id AND quarter = 2 AND student_id = $student_id;;";
                                    $ress5 = mysqli_query($conn, $sqls5);
                                    $rows5 = mysqli_fetch_assoc($ress5);

                                    $sqlst5 = "SELECT SUM(items) AS stotal_items FROM student_submission AS submission
                                    LEFT JOIN file_submission AS file
                                        ON file.submission_id = submission.submission_id
                                    WHERE subject_id = $subj_id AND quarter = 2 AND student_id = $student_id;;";
                                    $resst5 = mysqli_query($conn, $sqlst5);
                                    $rowst5 = mysqli_fetch_assoc($resst5);
                                    // QUIZZES 
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 2;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'] + $rows5['stotal'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 2;";
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
                                    WHERE subject_id = $subj_id AND quarter = 3 AND student_id = $student_id;;";
                                    $ress4 = mysqli_query($conn, $sqls4);
                                    $rows4 = mysqli_fetch_assoc($ress4);

                                    $sqlst4 = "SELECT SUM(items) AS stotal_items FROM student_submission AS submission
                                    LEFT JOIN file_submission AS file
                                        ON file.submission_id = submission.submission_id
                                    WHERE subject_id = $subj_id AND quarter = 3 AND student_id = $student_id;;";
                                    $resst4 = mysqli_query($conn, $sqlst4);
                                    $rowst4 = mysqli_fetch_assoc($resst4);
                                    // QUIZZES 
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 3;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'] + $rows4['stotal'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 3;";
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
                                    WHERE subject_id = $subj_id AND quarter = 4 AND student_id = $student_id;;";
                                    $ress3 = mysqli_query($conn, $sqls3);
                                    $rows3 = mysqli_fetch_assoc($ress3);

                                    $sqlst3 = "SELECT SUM(items) AS stotal_items FROM student_submission AS submission
                                    LEFT JOIN file_submission AS file
                                        ON file.submission_id = submission.submission_id
                                    WHERE subject_id = $subj_id AND quarter = 4 AND student_id = $student_id;;";
                                    $resst3 = mysqli_query($conn, $sqlst3);
                                    $rowst3 = mysqli_fetch_assoc($resst3);
                                    // QUIZZES 
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 4;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'] + $rows3['stotal'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id AND quarter = 4;";
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
                                <?php
                                    // SUBMISSIONS
                                    $sqls2 = "SELECT SUM(grade) AS stotal FROM student_submission AS submission
                                    LEFT JOIN file_submission AS file
                                        ON file.submission_id = submission.submission_id
                                    WHERE subject_id = $subj_id AND student_id = $student_id;";
                                    $ress2 = mysqli_query($conn, $sqls2);
                                    $rows2 = mysqli_fetch_assoc($ress2);

                                    $sqlst1 = "SELECT SUM(items) AS stotal_items FROM student_submission AS submission
                                    LEFT JOIN file_submission AS file
                                        ON file.submission_id = submission.submission_id
                                    WHERE subject_id = $subj_id AND student_id = $student_id;";
                                    $resst1 = mysqli_query($conn, $sqlst1);
                                    $rowst2 = mysqli_fetch_assoc($resst1);
                                    // QUIZZES 
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'] + $rows2['stotal'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id;";
                                    $res5 = mysqli_query($conn, $sql5);
                                    while($row5 = mysqli_fetch_assoc($res5)) {
                                        $total_items = $row5['total_items'] + $rowst2['stotal_items'];
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
                                    $sqls1 = "SELECT SUM(grade) AS stotal FROM student_submission AS submission
                                    LEFT JOIN file_submission AS file
                                        ON file.submission_id = submission.submission_id
                                    WHERE subject_id = $subj_id AND student_id = $student_id;";
                                    $ress1 = mysqli_query($conn, $sqls1);
                                    $rows1 = mysqli_fetch_assoc($ress1);

                                    $sqlst1 = "SELECT SUM(items) AS stotal_items FROM student_submission AS submission
                                    LEFT JOIN file_submission AS file
                                        ON file.submission_id = submission.submission_id
                                    WHERE subject_id = $subj_id AND student_id = $student_id;";
                                    $resst1 = mysqli_query($conn, $sqlst1);
                                    $rowst1 = mysqli_fetch_assoc($resst1);

                                    // QUIZZES
                                    $sql4 = "SELECT SUM(grade) AS total FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id;";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row4 = mysqli_fetch_assoc($res4);

                                    $total_grade = $row4['total'] + $rows1['stotal'];

                                    $sql5 = "SELECT SUM(items) AS total_items FROM quiz AS q
                                    LEFT JOIN quiz_student AS qs
                                        ON q.quiz_id = qs.quiz_id
                                    WHERE student_id = $student_id AND subject_id = $subj_id;";
                                    $res5 = mysqli_query($conn, $sql5);

                                    while($row5 = mysqli_fetch_assoc($res5)) {
                                        $total_items = $row5['total_items'] + $rowst1['stotal_items'];
                                        if($total_items == 0) {
                                            $total_items = 1;
                                        }
                                        $total = round(($total_grade / $total_items) * 100, 2);
                                        if($total >= 75 ) {
                                            $remark = "PASSED";
                                        } else {
                                            $remark = "FAILED";
                                        }
                                        $gwa += $total;
                                        $average = $gwa / $count;
                                        ?>
                                        <td class="text-center"><?php echo $remark; ?></td>
                                        <?php
                                    }
                                ?>   
                                </tr>
                                <?php
                    }

                ?>
            </table>
            <div class="gwa">
                <p>General Average: <?php echo round($average,2); ?></p>
            </div>
            <div class="signatures">
                <div class="teacher">
                    <p>Dwayne Johnson</p>
                    <hr>
                    <p><b>Head Teacher</b></p>
                </div>
                <?php
                    $sql_t = "SELECT *
                    FROM students_tbl AS s
                    INNER JOIN section_tbl AS st
                        ON s.section_id =  st.section_id
                    INNER JOIN teachers_tbl AS t
                        ON st.teacher_id = t.teacher_id
                    WHERE student_id = $student_id;
                    ";
                    $res_t = mysqli_query($conn, $sql_t);
                    $row_t = mysqli_fetch_assoc($res_t);
                ?>
                <div class="teacher">
                    <p><?php echo $row_t['fname']." ".$row_t['mname']." ".$row_t['lname']; ?></p>
                    <hr>
                    <p><b>Adviser</b></p>
                </div>
            </div>
            <div class="enroll-btn " id="back-btn">
                <a href="<?php echo SITEURL;?>admin/view-grades.php?id=<?php echo $student_id; ?>" class="secondary-btn">Back</a>
            </div>
        </div>
        <?php 
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>No Enrolled Subjects</p> 
                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                </div>
                <div class="enroll-btn">
                    <a href="<?php echo SITEURL;?>admin/view-grades.php?id=<?php echo $student_id; ?>" class="secondary-btn">Back</a>
                </div>
            </section>
            <?php
        }
        ?>
        </div>
        <?php
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
            } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
    </section>


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