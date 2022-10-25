<?php include "partials-teacher/header.php"; ?>
<div class="dashboard wrapper" id="dashboard">
  <?php
    if(isset($_SESSION['teacherId'])) {
      $teacher_id = $_SESSION['teacherId'];
    }
  ?>
<div class="left-content p-20">
    <div class="heading"><h2>Dashboard</h2></div>
      <div class="hero flex">
        <h2>Welcome Teacher!</h2>
        <img src="../assets/images/studying2.svg" alt="" />
      </div>
      <!-- <div class="sort">
        <select name="sort" id="sort">
          <option value="">Sort by</option>
          <option value="">Alphabetical</option>
          <option value="">Recent</option>
        </select>
      </div> -->
      <div class="card-holder flex text-center">
        <?php
          $sql = "SELECT * FROM teacher_subject AS ts
          INNER JOIN teachers_tbl AS t
            ON ts.teacher_id = t.teacher_id
          INNER JOIN subjects_tbl AS s
            ON  ts.subject_id = s.subject_id
          WHERE ts.teacher_id = $teacher_id;
          ";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);

          if($count > 0){
            while($row = mysqli_fetch_assoc($res)) {
              $subject_name = $row['subject_name'];
              $subject_code = $row['subject_code'];
              $subject_id = $row['subject_id'];
              ?>
              <div class="cards flex">
                <a href="<?php echo SITEURL;?>teacher/manage-subject.php"><span><?php echo $subject_code."</span> ".$subject_name; ?></a>
              </div>        
              <?php
            }
          }

        ?>
      </div>
    </div>
    
    <!-- <div class="right-content">
      <div class="content-box">
        Timeline
      </div>

      <div class="content-box">
        Calendar
      </div>

      <div class="content-box">
        Upcoming Events
      </div>
    </div> -->
</div>
<?php include "partials-teacher/footer.php"; ?>