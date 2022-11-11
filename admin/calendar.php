<?php include "partials-admin/header.php"; ?>
<?php
    if($_SESSION['role'] == "superadmin") {
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>School Calendar</h2></div>
    <br><br>
    <div class="calendar-wrapper">
        <div class="s500" id="calendar"></div>
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

