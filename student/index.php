<?php include "partials-student/header.php"; ?>
  <section class="dashboard wrapper" id="dashboard">
    <div class="left-content">
      <div class="heading"><h2>Dashboard</h2></div>
        <div class="hero flex">
          <h2>Welcome Students!</h2>
          <img src="../assets/images/studying2.svg" alt="" />
        </div>
        <!-- <div class="sort">
          <select name="sort" id="sort">
            <option value="">Sort by</option>
            <option value="">Alphabetical</option>
            <option value="">Recent</option>
          </select>
        </div> -->
        <div class="card-holder flex">
          <?php
             $sql = "SELECT * FROM student_subject AS ss
             INNER JOIN students_tbl AS st
               ON ss.student_id = st.student_id
             INNER JOIN subjects_tbl AS sb
               ON ss.subject_id = sb.subject_id
             WHERE ss.student_id = $id;
             ";
             $res = mysqli_query($conn, $sql);
             $count = mysqli_num_rows($res);

            while($row = mysqli_fetch_assoc($res)) {
              $subject_id = $row['subject_id'];
              $subject_name = $row['subject_name'];
              $subject_code = $row['subject_code'];
              ?>
              <div class="cards flex">
                <a href="<?php echo SITEURL;?>student/subject.php?id=<?php echo $subject_id; ?>"><span><?php echo $subject_code."</span> ".$subject_name; ?></a>
              </div>
              <?php
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
    
  </section>
<?php include "partials-student/footer.php"; ?>
