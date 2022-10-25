<?php include "partials-student/header.php"; ?>
<section class="dashboard wrapper" id="dashboard">
  <div class="admin-dashboard-wrapper">
    <div class="heading"><h2>Marbel 3 LMS</h2></div>

    <div class="announcement-wrapper">
      <?php
        $sql = "SELECT * FROM ann_student";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count > 0) {
          while($row = mysqli_fetch_assoc($res)) {
            $annid = $row['id'];
            $ann = $row['announcement'];
            ?>
              <div class="announcements">
                <p><?php echo $ann; ?></p>
              </div>
            <?php 
          }
        }
      ?>
    </div>

  </div>
</section>
<?php include "partials-student/footer.php"; ?>
