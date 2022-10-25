<?php include "config/constants.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Marbel 3 Primary School</title>
  </head>
  <body>
    <!-- Navbar Starts -->
    <div class="wrapper">
      <nav>
        <div class="logo">
          <a href="<?php echo SITEURL;?>index.php"><img src="assets/images/mlogo.png" alt="Marbel 3 Logo"></a>
          <a href="<?php echo SITEURL;?>index.php">M3ES</a>
        </div>
        <ul class="nav-links">
          <li><a href="#login">Login</a></li>
          <li><a href="#programs">Programs Offered</a></li>
          <!-- <li><a href="#about">About</a></li> -->
        </ul>
      </nav>
    </div>
    <!-- Navbar Ends -->
    <!-- Banner Starts -->
    <div class="hero-image">
      <div class="hero-text">
        <h1>Marbel 3 <br> <span>Elementary School</span> </h1>
        <h4>School is a place to grow</h4>
      </div>
    </div>
    <!-- Banner Ends -->
    <!-- Login Starts -->
    <section class="login wrapper" id="login">
      <div class="login-container">
        <div class="login-header">
          <p>Login to Marbel LMS</p>
        </div>
        <div class="login-btns">
          <a target="_blank" href="<?php echo SITEURL;?>teacher/teacher-login.php">Login as Teacher</a>
          <a target="_blank" href="<?php echo SITEURL;?>student/student-login.php">Login as Student</a>
        </div>
      </div>
    </section>
    <!-- Login Ends -->
    <!-- Programs Starts -->
    <section class="programs" id="programs">
      <div class="programs-header text-center" >
        <h2>Programs Offered</h2>
      </div>
      <div class="programs-list-container">
        <div class="list">
          <div class="list-header">Grade 4</div>
          <ul>
            <li>Filipino</li>
            <li>Math</li>
            <li>Science</li>
            <li>English</li>
            <li>ESP</li>
            <li>EPP</li>
            <li>Araling Panlipunan</li>
            <li>MAPEH</li>
          </ul>
        </div>

        <div class="list">
          <div class="list-header">Grade 5</div>
          <ul>
            <li>Filipino</li>
            <li>Math</li>
            <li>Science</li>
            <li>English</li>
            <li>ESP</li>
            <li>EPP</li>
            <li>Araling Panlipunan</li>
            <li>MAPEH</li>
          </ul>
        </div>

        <div class="list">
          <div class="list-header">Grade 6</div>
          <ul>
            <li>Filipino</li>
            <li>Math</li>
            <li>Science</li>
            <li>English</li>
            <li>ESP</li>
            <li>EPP</li>
            <li>Araling Panlipunan</li>
            <li>MAPEH</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Programs Ends -->
    <!-- About Starts -->
    <!-- <section class="about" id="about">
      <div class="about-header">
        <h2>About us</h2>
      </div>
      <div class="about-text">
        We, Marbel 3 Elementary School is based Koronadal, South Cotabato. What distinguishes a great school from a good school? I believe that clarity of purpose, exceptional teachers, and demonstrated outcomes are hallmarks of great schools. A great school is a place with a deep commitment to student learning, where faculty nourish the intellectual, moral, emotional, and social growth of every student. It is a place where students, teachers, and parents embark together on an academic journey with clear and well-defined objectives. It is filled with the joy of discovery and the excitement of personal challenge and growth. It is a community dedicated to developing strength of character and excellence in all dimensions of its students' lives. And it is a place that has a distinctive and lasting impact.
      </div>
      <div class="about-text">
      At M3ES, we believe that intellectual development, love of learning, and strength of character are complementary, and equally essential, educational goals. With a firm commitment to our core values and a rigorous academic program, we prepare students to lead lives of purpose, achievement, and generosity of spirit.
      </div>
      <div class="about-text">
      Since its founding, M3ES has steadfastly believed that developing a student’s character is as important as educating for intellectual growth. Informed by values, students learn to use their intellect and skills productively and in service to others. The school has identified the following five core values as the ethical and moral guideposts that enable all of us in the Potomac community to develop good judgment and live principled lives:
      </div>
      <div class="about-text">
        source: The Potomac School
      </div>
    </section> -->
    <!-- About Ends -->
    <!-- Footer Starts -->
    <footer>
      <p>Marbel 3 Elementary School</p>
      <p>All Rights Reserved <?php echo date('Y') ?></p>
    </footer>
    <!-- Footer Ends -->
  </body>
</html>
