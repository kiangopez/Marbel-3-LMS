<?php include "partials-admin/header.php"; ?>
<?php
    if($_SESSION['role'] == "superadmin") {
?>
<section class="dashboard wrapper" id="dashboard">
  <div class="admin-dashboard-wrapper">
    <div class="heading p-20"><h2>Marbel 3 LMS</h2></div>

    <div class="announcement-wrapper p-20">
      <?php
        $sql = "SELECT * FROM ann_admin";
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
<?php include "partials-admin/footer.php"; ?>
