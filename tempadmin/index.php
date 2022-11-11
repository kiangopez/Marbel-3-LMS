<?php include "partials-tempadmin/header.php"; ?>
<?php
    if($_SESSION['role'] == "admin") {
?>
<section class="dashboard wrapper" id="dashboard">
  <div class="admin-dashboard-wrapper p-20">
    <div class="left-content">
      <div class="heading"><h2>Dashboard</h2></div>
      <div class="card-holder">
        <div class="cards flex">
          <?php
            $sql = "SELECT * FROM teachers_tbl;";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
          ?>
          <p href="#"><?php echo $count; ?> Teachers</p>
        </div>
        <div class="cards flex">
          <?php
            $sql2 = "SELECT * FROM students_tbl;";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
          ?>
          <p href="#"><?php echo $count2; ?> Students</p>
        </div>
        <div class="cards flex">
          <?php
            $sql3 = "SELECT * FROM subjects_tbl;";
            $res3 = mysqli_query($conn, $sql3);
            $count3 = mysqli_num_rows($res3);
          ?>
          <p href="#"><?php echo $count3; ?> Subjects</p>
        </div>
      </div>

      <div class="dashboard-table">
        <div class="teacher-table">
          <table class="tbl-full text-center">
            <tr>
              <th>Teachers</th>
            </tr>
            <?php
              $sql6 = "SELECT * FROM teachers_tbl LIMIT 10;";
              $res6 = mysqli_query($conn, $sql6);
              $count6 = mysqli_num_rows($res6);

              if($count6 > 0) {
                while($row6 = mysqli_fetch_assoc($res6)) {
                  $fname3 = $row6['fname'];
                  $mname3 = $row6['mname'];
                  $lname3 = $row6['lname'];
                  $email3 = $row6['email'];
                  $full_name4 = $fname3." ".$mname3." ".$lname3;
                  ?> 
                  <tr>
                    <td><?php echo $full_name4; ?></td>
                  </tr>
                  <?php
                }
              }
            ?>
          </table>
        </div>

        <div class="student-table">
          <table class="tbl-full text-center">
            <tr>
              <th>Student</th>
              <th>Grade Level</th>
            </tr>
            <?php
              $sql5 = "SELECT * FROM students_tbl AS s
              INNER JOIN categories_tbl AS c
                ON s.category_id = c.category_id
              LIMIT 10;";
              $res5 = mysqli_query($conn, $sql5);
              $count5 = mysqli_num_rows($res5);

              if($count5 > 0) {
                while($row5 = mysqli_fetch_assoc($res5)) {
                  $fname2 = $row5['fname'];
                  $mname2 = $row5['mname'];
                  $lname2 = $row5['lname'];
                  $full_name3 = $fname2." ".$mname2." ".$lname2;
                  $category = $row5['category_name'];
                  ?> 
                  <tr>
                    <td><?php echo $full_name3; ?></td>
                    <td><?php echo $category; ?></td>
                  </tr>
                  <?php
                }
              }
            ?>
          </table>
        </div>

        <div class="subject-table">
          <table class="tbl-full text-center">
            <tr>
              <th>Subject Code</th>
              <th>Subject Name</th>
            </tr>
            <?php
              
              $sql4 = "SELECT * FROM subjects_tbl ORDER BY category_id LIMIT 10;";
              $res4 = mysqli_query($conn, $sql4);
              $count4 = mysqli_num_rows($res4);
                    
              if($count3 > 0) {
                while($row4 = mysqli_fetch_assoc($res4)) {
                  $subj_name2 = $row4['subject_name'];
                  $subj_code2 = $row4['subject_code'];
                  ?> 
                  <tr>
                    <td><?php echo $subj_name2; ?></td>
                    <td><?php echo $subj_code2; ?></td>
                  </tr>
                  <?php
                }
              }
            ?>
          </table>
        </div>


      </div>
    </div>
  </div>

  <!-- <div class="right-content">
    <div class="content-box">Timeline</div>

    <div class="content-box">Calendar</div>

    <div class="content-box">Upcoming Events</div>
  </div> -->
</section>

<?php 
    } else {
      ?>
      <section class="dashboard wrapper column" id="dashboard">
          <div class="error-handler">
              <p>You're not allowed in this page</p> 
              <a class="blue" href="<?php echo SITEURL?>index.php">Return to Home</a>
              <p class="break">Error: Admin account don't match</p>
          </div>
      </section>
  <?php
    }
?>
<?php include "partials-tempadmin/footer.php"; ?>