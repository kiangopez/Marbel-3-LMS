<?php include "config/constants.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/homepage.css" />
    <title>Marbel 3 Elementary School</title>
  </head>
  <body>
    <!-- Hero and nav -->
    <div class="hero wrapper">
      <nav>
        <div class="logo">
          <a href="#"><img src="assets/images/mlogo.png" alt="" /></a>
        </div>
        <ul class="nav-links">
          <li>
            <a href="#login">Login</a>
            <a href="#programs">Programs</a>
            <a href="#about-us">About Us</a>
          </li>
        </ul>
        <div class="burger">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
      </nav>
      <div class="hero-text">
        <h3>Marbel 3 Elementary School</h3>
        <h1>We value your future</h1>
        <p>
          We bring quality education <br />
          and bright future for your little ones
        </p>
        <a href="#programs" class="primary-btn">Learn more</a>
      </div>
    </div>
    <!-- Hero and nav -->

    <!-- Login -->
    <div class="wrapper login" id="login">
      <div class="login-box">
        <p>login as</p>
        <div class="login-cta">
          <a target="_blank" href="<?php echo SITEURL;?>student/student-login.php" class="login-btn">Student</a>
          <a target="_blank" href="<?php echo SITEURL;?>teacher/teacher-login.php" class="login-btn">Teacher</a>
        </div>
      </div>
      <div class="login-header-text">
        <h2>Let's Learn Together</h2>
        <p>
          Learn to love studying with us! Login with your account and get
          started learning now!
        </p>
      </div>
    </div>
    <!-- Login -->

    <!-- Progams -->
    <div class="wrapper programs" id="programs">
      <h2>Programs We Offer</h2>
      <div class="cards">
        <div class="card">
          <svg
            width="45"
            height="45"
            viewBox="0 0 45 45"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle cx="22.5" cy="22.5" r="22.5" fill="#2E2D6B" />
            <path
              d="M14.334 24.0606V28.3278L21.8017 32.403L29.2694 28.3278V24.0606L21.8017 28.1358L14.334 24.0606ZM21.8017 13.2004L10.0668 19.6013L21.8017 26.0022L31.403 20.7641V28.1358H33.5366V19.6013L21.8017 13.2004Z"
              fill="white"
            />
          </svg>
          <h4>Grade 1</h4>
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
        <div class="card">
          <svg
            width="45"
            height="45"
            viewBox="0 0 45 45"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle cx="22.5" cy="22.5" r="22.5" fill="#40BF4C" />
            <path
              d="M14.3341 24.0606V28.3278L21.8017 32.403L29.2694 28.3278V24.0606L21.8017 28.1358L14.3341 24.0606ZM21.8017 13.2004L10.0668 19.6013L21.8017 26.0022L31.403 20.7641V28.1358H33.5366V19.6013L21.8017 13.2004Z"
              fill="white"
            />
          </svg>

          <h4>Grade 2</h4>
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
        <div class="card">
          <svg
            width="45"
            height="45"
            viewBox="0 0 45 45"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle cx="22.5" cy="22.5" r="22.5" fill="#CCCF1F" />
            <path
              d="M15.334 24.0606V28.3278L22.8017 32.403L30.2694 28.3278V24.0606L22.8017 28.1358L15.334 24.0606ZM22.8017 13.2004L11.0668 19.6013L22.8017 26.0022L32.403 20.7641V28.1358H34.5366V19.6013L22.8017 13.2004Z"
              fill="white"
            />
          </svg>

          <h4>Grade 3</h4>
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
    </div>
    <!-- Progams -->

    <!-- About Us -->
    <div class="wrapper about-us" id="about-us">
      <h2>About Us</h2>
      <div class="about-content wrapper">
        <div class="ab-img">
          <img src="assets/images/marbel img.jpg" alt="" />
        </div>
        <div class="ab-text">
          <h4>We create memories</h4>
          <p>
            THE Deped Vision: We dream of Filipinos who passionately love their
            country and whose values and competencies enable them to realize
            their full potential and contribute meaningfully to building the
            nation. As a learner-centered public institution, the Department of
            Education continuously improves itself to better serve its
            stakeholders. <br />
            <br />
            The Deped Mission: To protect and promote the right of every
            Filipino to quality, equitable, culture-based, and complete basic
            education where: Students learn in a child-friendly,
            gender-sensitive, safe, and motivating environment. Teachers
            facilitate learning and constantly nurture every learner.
            Administrators and staff, as stewards of the institution, ensure an
            enabling and supportive environment for effective learning to
            happen. Family, community, and other stakeholders are actively
            engaged and share responsibility for developing life-long learners.
          </p>
        </div>
      </div>
    </div>
    <!-- About Us -->
    <!-- Footer -->
    <footer class="footer">
      <div class="footer-item-1">
        <img src="assets/images/mlogo.png" alt="" />
        <p>Marbel 3 Elementary School</p>
      </div>
      <div class="footer-item-2">
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#login">Login</a></li>
          <li><a href="#programs">Programs Offered</a></li>
          <li><a href="#about-us">About Us</a></li>
        </ul>
      </div>
      <div class="footer-item-3">
        <ul>
          <li>
            <p>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="ionicon"
                viewBox="0 0 512 512"
              >
                <title>Mail</title>
                <rect
                  x="48"
                  y="96"
                  width="416"
                  height="320"
                  rx="40"
                  ry="40"
                  fill="none"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="32"
                />
                <path
                  fill="none"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="32"
                  d="M112 160l144 112 144-112"
                /></svg
              >marbel3es.business@gmail.com
            </p>
          </li>
          <li>
            <p>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="ionicon"
                viewBox="0 0 512 512"
              >
                <title>Call</title>
                <path
                  d="M451 374c-15.88-16-54.34-39.35-73-48.76-24.3-12.24-26.3-13.24-45.4.95-12.74 9.47-21.21 17.93-36.12 14.75s-47.31-21.11-75.68-49.39-47.34-61.62-50.53-76.48 5.41-23.23 14.79-36c13.22-18 12.22-21 .92-45.3-8.81-18.9-32.84-57-48.9-72.8C119.9 44 119.9 47 108.83 51.6A160.15 160.15 0 0083 65.37C67 76 58.12 84.83 51.91 98.1s-9 44.38 23.07 102.64 54.57 88.05 101.14 134.49S258.5 406.64 310.85 436c64.76 36.27 89.6 29.2 102.91 23s22.18-15 32.83-31a159.09 159.09 0 0013.8-25.8C465 391.17 468 391.17 451 374z"
                  fill="none"
                  stroke="currentColor"
                  stroke-miterlimit="10"
                  stroke-width="32"
                /></svg
              >(+63) 927 119 7079
            </p>
          </li>
        </ul>
      </div>
    </footer>
    <!-- Footer -->
    <!-- Copyright -->
    <div class="copyright">
      <p>Copyright © <?php echo date('Y') ?> Marbel 3 Elementary School. All Rights Reserved</p>
    </div>
    <!-- Copyright -->
    <script src="homenav.js"></script>
  </body>
</html>
