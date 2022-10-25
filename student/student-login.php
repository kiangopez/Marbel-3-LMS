<?php include "../config/constants.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/login.css" />
    <title>Login | Marbel 3 Elementary School</title>
  </head>
  <body>
  <?php
        if(isset($_SESSION['studentId'])) {
            ?>
            <div class="loggedIn">
                <div class="logged-in-message">
                    <p>You are currently logged in</p>
                </div>
                <div>
                    <a href="<?php echo SITEURL;?>student/student-logout.php?id=<?php echo $_SESSION['studentId']; ?>" class="danger-btn">Logout</a>
                    <a href="<?php echo SITEURL;?>student/home.php" class="secondary-btn">Back</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            
    <div class="login-wrapper">
      <div class="left-login">
        <div class="login-logo">
          <img src="../assets/images/mlogo.png" alt="" />
          <h1>Marbel 3 Elementary School</h1>
        </div>
        <div class="left-bg">
          <img src="../assets/images/kids.png" alt="" />
        </div>
        <div class="book1">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 217.12 106.43">
            <defs>
              <style>
                .cls-1 {
                  fill: #fdf4d7;
                }
                .cls-2 {
                  fill: #c60508;
                }
                .cls-3 {
                  fill: #f6352c;
                }
                .cls-4 {
                  fill: #e4dfbf;
                }
                .cls-5 {
                  fill: #91ba80;
                }
                .cls-6 {
                  fill: #5c2e3b;
                }
                .cls-7 {
                  fill: #903c7a;
                }
                .cls-8 {
                  fill: #309084;
                }
                .cls-9 {
                  fill: #42c9b8;
                }
                .cls-10 {
                  fill: #e4c141;
                }
              </style>
            </defs>
            <title>Asset 71</title>
            <g id="Layer_2" data-name="Layer 2">
              <g id="Layer_1-2" data-name="Layer 1">
                <polygon
                  class="cls-1"
                  points="68.5 88 68.5 104.92 0 79.95 0 62.91 68.5 88"
                />
                <polygon
                  class="cls-2"
                  points="192.77 58.13 192.77 76.33 68.5 106.44 68.5 87.18 192.77 58.13"
                />
                <polygon
                  class="cls-3"
                  points="192.77 58.13 118.58 37.29 0 62.23 68.5 87.18 192.77 58.13"
                />
                <polygon
                  class="cls-2"
                  points="68.5 87.18 68.5 89.63 0 64.08 0 62.23 68.5 87.18"
                />
                <polygon
                  class="cls-2"
                  points="68.5 103.98 68.5 106.44 0 80.88 0 79.04 68.5 103.98"
                />
                <path
                  class="cls-4"
                  d="M68.5,92.74C46.58,84.07,22.28,75.08,0,67.4c21.91,8.67,46.22,17.66,68.5,25.34Z"
                />
                <path
                  class="cls-4"
                  d="M68.5,95.67C46.58,87,22.28,78,0,70.34,21.91,79,46.22,88,68.5,95.67Z"
                />
                <path
                  class="cls-4"
                  d="M68.5,98.6C46.58,89.94,22.28,80.94,0,73.27,21.91,81.94,46.22,90.92,68.5,98.6Z"
                />
                <path
                  class="cls-4"
                  d="M68.5,101.53C46.58,92.87,22.28,83.88,0,76.2c21.91,8.67,46.22,17.66,68.5,25.33Z"
                />
                <path
                  class="cls-5"
                  d="M163.3,72v3.21a3.88,3.88,0,0,1-3,3.78l-30.41,7.3A1.31,1.31,0,0,1,128.3,85V81.58a3.88,3.88,0,0,1,3-3.79l30.39-7.08A1.3,1.3,0,0,1,163.3,72Z"
                />
                <polygon
                  class="cls-5"
                  points="145.8 60.81 104.32 48.44 75.61 54.63 114.82 67.4 145.8 60.81"
                />
                <polygon
                  class="cls-1"
                  points="92.85 74.06 92.85 90.98 24.35 66.01 24.35 48.97 92.85 74.06"
                />
                <polygon
                  class="cls-6"
                  points="217.12 44.19 217.12 62.39 92.85 92.49 92.85 73.24 217.12 44.19"
                />
                <polygon
                  class="cls-7"
                  points="217.12 44.19 142.93 23.35 24.35 48.29 92.85 73.24 217.12 44.19"
                />
                <polygon
                  class="cls-6"
                  points="92.85 73.24 92.85 75.69 24.35 50.14 24.35 48.29 92.85 73.24"
                />
                <polygon
                  class="cls-6"
                  points="92.85 90.04 92.85 92.49 24.35 66.94 24.35 65.1 92.85 90.04"
                />
                <path
                  class="cls-4"
                  d="M92.85,78.8c-21.91-8.67-46.22-17.66-68.5-25.34,21.91,8.67,46.22,17.66,68.5,25.34Z"
                />
                <path
                  class="cls-4"
                  d="M92.85,81.73c-21.91-8.67-46.22-17.66-68.5-25.34,21.91,8.67,46.22,17.66,68.5,25.34Z"
                />
                <path
                  class="cls-4"
                  d="M92.85,84.66C70.94,76,46.63,67,24.35,59.33,46.26,68,70.57,77,92.85,84.66Z"
                />
                <path
                  class="cls-4"
                  d="M92.85,87.59c-21.91-8.66-46.22-17.65-68.5-25.33,21.91,8.67,46.22,17.65,68.5,25.33Z"
                />
                <path
                  class="cls-7"
                  d="M187.66,58v3.21a3.88,3.88,0,0,1-3,3.78l-30.42,7.3a1.31,1.31,0,0,1-1.61-1.27V67.63a3.89,3.89,0,0,1,3-3.78l30.4-7.08A1.3,1.3,0,0,1,187.66,58Z"
                />
                <polygon
                  class="cls-3"
                  points="170.16 46.87 128.67 34.5 99.97 40.68 139.18 53.46 170.16 46.87"
                />
                <polygon
                  class="cls-1"
                  points="68.5 50.71 68.5 67.63 0 42.66 0 25.62 68.5 50.71"
                />
                <polygon
                  class="cls-8"
                  points="192.77 20.84 192.77 39.04 68.5 69.15 68.5 49.89 192.77 20.84"
                />
                <polygon
                  class="cls-9"
                  points="192.77 20.84 118.58 0 0 24.95 68.5 49.89 192.77 20.84"
                />
                <polygon
                  class="cls-8"
                  points="68.5 49.89 68.5 52.34 0 26.79 0 24.95 68.5 49.89"
                />
                <polygon
                  class="cls-8"
                  points="68.5 66.69 68.5 69.15 0 43.59 0 41.75 68.5 66.69"
                />
                <path
                  class="cls-4"
                  d="M68.5,55.45C46.58,46.78,22.28,37.79,0,30.11c21.91,8.67,46.22,17.66,68.5,25.34Z"
                />
                <path
                  class="cls-4"
                  d="M68.5,58.38C46.58,49.72,22.28,40.72,0,33.05,21.91,41.71,46.22,50.7,68.5,58.38Z"
                />
                <path
                  class="cls-4"
                  d="M68.5,61.31C46.58,52.65,22.28,43.65,0,36c21.91,8.67,46.22,17.65,68.5,25.33Z"
                />
                <path
                  class="cls-4"
                  d="M68.5,64.25C46.58,55.58,22.28,46.59,0,38.91c21.91,8.67,46.22,17.66,68.5,25.34Z"
                />
                <polygon
                  class="cls-9"
                  points="163.31 33.05 163.31 40.97 128.3 49.37 128.3 41.2 163.31 33.05"
                />
                <polygon
                  class="cls-10"
                  points="145.8 23.52 104.32 11.15 75.61 17.34 114.82 30.11 145.8 23.52"
                />
              </g>
            </g>
          </svg>
        </div>
        <div class="book2">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 174.11 161.36">
            <defs>
              <style>
                .cls-1 {
                  fill: #fdf4d7;
                }
                .cls-2 {
                  fill: #e4c141;
                }
                .cls-3 {
                  fill: #fbc628;
                }
                .cls-4 {
                  fill: #e4dfbf;
                }
                .cls-5 {
                  fill: #91ba80;
                }
                .cls-6 {
                  fill: #5c2e3b;
                }
                .cls-7 {
                  fill: #903c7a;
                }
                .cls-8 {
                  fill: #4c6637;
                }
                .cls-9 {
                  fill: #f6352c;
                }
              </style>
            </defs>
            <title>Asset 181</title>
            <g id="Layer_2" data-name="Layer 2">
              <g id="Layer_1-2" data-name="Layer 1">
                <polygon
                  class="cls-1"
                  points="113.97 145.17 113.97 160.03 174.11 138.1 174.11 123.15 113.97 145.17"
                />
                <polygon
                  class="cls-2"
                  points="4.87 118.94 4.87 134.93 113.97 161.36 113.97 144.45 4.87 118.94"
                />
                <polygon
                  class="cls-3"
                  points="4.87 118.94 70 100.65 174.11 122.55 113.97 144.45 4.87 118.94"
                />
                <polygon
                  class="cls-2"
                  points="113.97 144.45 113.97 146.6 174.11 124.17 174.11 122.55 113.97 144.45"
                />
                <polygon
                  class="cls-2"
                  points="113.97 159.21 113.97 161.36 174.11 138.92 174.11 137.31 113.97 159.21"
                />
                <path
                  class="cls-4"
                  d="M114,149.33c19.24-7.61,40.58-15.5,60.14-22.24-19.24,7.61-40.58,15.5-60.14,22.24Z"
                />
                <path
                  class="cls-4"
                  d="M114,151.91c19.24-7.61,40.58-15.51,60.14-22.25-19.24,7.61-40.58,15.5-60.14,22.25Z"
                />
                <path
                  class="cls-4"
                  d="M114,154.48c19.24-7.61,40.58-15.5,60.14-22.24-19.24,7.61-40.58,15.5-60.14,22.24Z"
                />
                <path
                  class="cls-4"
                  d="M114,157.06c19.24-7.61,40.58-15.51,60.14-22.25-19.24,7.61-40.58,15.5-60.14,22.25Z"
                />
                <path
                  class="cls-5"
                  d="M30.74,131.11v2.81a3.42,3.42,0,0,0,2.61,3.33l26.71,6.4a1.14,1.14,0,0,0,1.41-1.11v-3a3.4,3.4,0,0,0-2.64-3.32L32.14,130A1.14,1.14,0,0,0,30.74,131.11Z"
                />
                <polygon
                  class="cls-5"
                  points="46.1 121.3 82.52 110.44 107.72 115.87 73.3 127.09 46.1 121.3"
                />
                <polygon
                  class="cls-1"
                  points="60.13 130.76 60.13 145.61 0 123.69 0 108.73 60.13 130.76"
                />
                <polygon
                  class="cls-6"
                  points="169.24 104.53 169.24 120.52 60.13 146.95 60.13 130.04 169.24 104.53"
                />
                <polygon
                  class="cls-7"
                  points="169.24 104.53 104.1 86.24 0 108.14 60.13 130.04 169.24 104.53"
                />
                <polygon
                  class="cls-6"
                  points="60.13 130.04 60.13 132.19 0 109.76 0 108.14 60.13 130.04"
                />
                <polygon
                  class="cls-6"
                  points="60.13 144.79 60.13 146.95 0 124.51 0 122.89 60.13 144.79"
                />
                <path
                  class="cls-4"
                  d="M60.13,134.92C40.9,127.31,19.56,119.42,0,112.68c19.24,7.61,40.58,15.5,60.13,22.24Z"
                />
                <path
                  class="cls-4"
                  d="M60.13,137.5C40.9,129.89,19.56,122,0,115.25c19.24,7.61,40.58,15.5,60.13,22.25Z"
                />
                <path
                  class="cls-4"
                  d="M60.13,140.07C40.9,132.46,19.56,124.57,0,117.83c19.24,7.61,40.58,15.5,60.13,22.24Z"
                />
                <path
                  class="cls-4"
                  d="M60.13,142.64C40.9,135,19.56,127.14,0,120.4c19.24,7.61,40.58,15.5,60.13,22.24Z"
                />
                <path
                  class="cls-7"
                  d="M143.37,116.7v2.81a3.41,3.41,0,0,1-2.62,3.32l-26.7,6.41a1.14,1.14,0,0,1-1.41-1.11v-3a3.4,3.4,0,0,1,2.64-3.32L142,115.58A1.15,1.15,0,0,1,143.37,116.7Z"
                />
                <polygon
                  class="cls-3"
                  points="128 106.89 91.58 96.03 66.38 101.46 100.81 112.68 128 106.89"
                />
                <polygon
                  class="cls-1"
                  points="113.97 112.43 113.97 127.29 174.11 105.36 174.11 90.41 113.97 112.43"
                />
                <polygon
                  class="cls-8"
                  points="4.87 86.21 4.87 102.19 113.97 128.62 113.97 111.72 4.87 86.21"
                />
                <polygon
                  class="cls-5"
                  points="4.87 86.21 70 67.92 174.11 89.81 113.97 111.72 4.87 86.21"
                />
                <polygon
                  class="cls-8"
                  points="113.97 111.72 113.97 113.87 174.11 91.43 174.11 89.81 113.97 111.72"
                />
                <polygon
                  class="cls-8"
                  points="113.97 126.47 113.97 128.62 174.11 106.19 174.11 104.57 113.97 126.47"
                />
                <path
                  class="cls-4"
                  d="M114,116.59c19.24-7.6,40.58-15.5,60.14-22.24-19.24,7.61-40.58,15.5-60.14,22.24Z"
                />
                <path
                  class="cls-4"
                  d="M114,119.17c19.24-7.61,40.58-15.5,60.14-22.24-19.24,7.61-40.58,15.5-60.14,22.24Z"
                />
                <path
                  class="cls-4"
                  d="M114,121.74c19.24-7.6,40.58-15.5,60.14-22.24-19.24,7.61-40.58,15.5-60.14,22.24Z"
                />
                <path
                  class="cls-4"
                  d="M114,124.32c19.24-7.61,40.58-15.51,60.14-22.24-19.24,7.61-40.58,15.5-60.14,22.24Z"
                />
                <polygon
                  class="cls-5"
                  points="30.74 96.93 30.74 103.88 61.47 111.25 61.47 104.08 30.74 96.93"
                />
                <polygon
                  class="cls-3"
                  points="46.1 88.56 82.52 77.7 107.72 83.13 73.3 94.35 46.1 88.56"
                />
                <path
                  class="cls-9"
                  d="M23.89,30.51l17.74,76.36h64.18s-.45,2.86,6.17,2,6-4.66,6-4.66l46.3-34.41L139.93,0l-49,25s-5.71-2.55-8.42,1.2C82.51,26.15,48.69,18.19,23.89,30.51Z"
                />
                <path
                  class="cls-4"
                  d="M34.72,18,26.15,30.81l18,72.61,62.38,2a9.52,9.52,0,0,0,5.79.86c2.82-.67,4.51-3.72,4.51-3.72l44-33.22L138.88,2,127.76,1.2,86.47,31.42Z"
                />
                <path
                  class="cls-1"
                  d="M34.72,18l22.09,74.4s33.82-7.81,53.06,11c0,0,3-20,42.09-34.43L127.76,1.2S102.51,8.12,84.62,27.06C84.62,27.06,64.78,10.82,34.72,18Z"
                />
                <path
                  class="cls-4"
                  d="M84.62,27.06c9.28,25.1,17.73,50.67,25.25,76.36-9.28-25.11-17.73-50.68-25.25-76.36Z"
                />
                <path
                  class="cls-4"
                  d="M84.2,36.41C66.53,22.82,46.06,33,45.86,33.07l-.63-1.23c.21-.11,21.43-10.66,39.81,3.47Z"
                />
                <path
                  class="cls-4"
                  d="M49.82,45.06l-.73-1.17c.18-.11,18.79-11.52,37.27-1.42l-.66,1.21C67.94,34,50,45,49.82,45.06Z"
                />
                <path
                  class="cls-4"
                  d="M54.1,56.45l-.48-1.29c.8-.3,19.76-7.14,34.86-1.3L88,55.14C73.37,49.5,54.29,56.38,54.1,56.45Z"
                />
                <path
                  class="cls-4"
                  d="M58.74,68.89l-.34-1.33c.92-.24,22.68-5.82,33.29-1.58l-.51,1.28C81,63.19,59,68.84,58.74,68.89Z"
                />
                <path
                  class="cls-4"
                  d="M62.31,81.2l-.47-1.29c.88-.32,21.61-7.65,33.68.06l-.74,1.16C83.28,73.79,62.52,81.13,62.31,81.2Z"
                />
                <path
                  class="cls-4"
                  d="M92.73,33.62l-1.18-.73a50.46,50.46,0,0,1,34.26-20.76l.2,1.36A49,49,0,0,0,92.73,33.62Z"
                />
                <path
                  class="cls-4"
                  d="M95.77,42.16l-1-.89c.15-.17,15.11-17.67,34.28-18.12l0,1.37C110.49,25,95.92,42,95.77,42.16Z"
                />
                <path
                  class="cls-4"
                  d="M100.58,51.85l-1-.91c.65-.74,16.1-18.08,33.18-15.76l-.19,1.36C116.16,34.31,100.73,51.67,100.58,51.85Z"
                />
                <path
                  class="cls-4"
                  d="M105.48,63.28l-1-.93c.13-.14,13.54-14.75,32.93-16l.09,1.37C118.64,48.94,105.61,63.13,105.48,63.28Z"
                />
                <path
                  class="cls-4"
                  d="M109.5,76.15l-.94-1c.73-.68,18-16.73,32.91-16.12l-.05,1.38C127.13,59.84,109.67,76,109.5,76.15Z"
                />
              </g>
            </g>
          </svg>
        </div>
        <div class="book3">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 205 124.6">
            <defs>
              <style>
                .cls-1 {
                  fill: #fbc628;
                }
                .cls-2 {
                  fill: #fdf4d7;
                }
                .cls-3 {
                  fill: #e4dfbf;
                }
                .cls-4 {
                  fill: #42c9b8;
                }
              </style>
            </defs>
            <title>Asset 191</title>
            <g id="Layer_2" data-name="Layer 2">
              <g id="Layer_1-2" data-name="Layer 1">
                <path
                  class="cls-1"
                  d="M201.12,109H3.87a3.88,3.88,0,0,1-3.82-4.51L15.61,11.1a3.86,3.86,0,0,1,3.81-3.24H185.57a3.88,3.88,0,0,1,3.82,3.24l15.55,93.35A3.87,3.87,0,0,1,201.12,109Z"
                />
                <path
                  class="cls-2"
                  d="M194,105.26a354.55,354.55,0,0,0-44.27-5.08c-17.48-.9-33,2.6-47.24,5.08-15.12-2.71-31.07-5.63-49-4.61a397.72,397.72,0,0,0-41.91,4.61,5.79,5.79,0,0,1-4.27-2A5.6,5.6,0,0,1,6,98.75L19.93,10.93a5.61,5.61,0,0,1,5.55-4.74,126.32,126.32,0,0,1,77.59,0,122.55,122.55,0,0,1,77,0,5.62,5.62,0,0,1,5.55,4.74l14,87.82A5.63,5.63,0,0,1,194,105.26Z"
                />
                <polygon
                  class="cls-3"
                  points="103.18 100.89 101.81 100.89 101.92 10.56 103.07 10.56 103.18 100.89"
                />
                <polygon
                  class="cls-3"
                  points="93.56 43.3 21.86 43.3 26.33 12.63 94.05 12.63 93.56 43.3"
                />
                <polygon
                  class="cls-3"
                  points="191.31 92.41 112.69 92.41 112.08 55.72 185.95 55.72 191.31 92.41"
                />
                <polygon
                  class="cls-3"
                  points="93.4 53.32 20.4 53.32 20.55 52.31 93.41 52.31 93.4 53.32"
                />
                <polygon
                  class="cls-3"
                  points="93.29 59.86 19.45 59.86 19.6 58.83 93.31 58.83 93.29 59.86"
                />
                <polygon
                  class="cls-3"
                  points="93.18 66.56 18.48 66.56 18.63 65.5 93.2 65.5 93.18 66.56"
                />
                <polygon
                  class="cls-3"
                  points="93.07 73.41 17.48 73.41 17.64 72.33 93.09 72.33 93.07 73.41"
                />
                <polygon
                  class="cls-3"
                  points="92.96 80.43 16.46 80.43 16.62 79.32 92.98 79.32 92.96 80.43"
                />
                <polygon
                  class="cls-3"
                  points="92.84 87.62 15.41 87.62 15.57 86.49 92.86 86.49 92.84 87.62"
                />
                <polygon
                  class="cls-3"
                  points="92.72 94.99 14.34 94.99 14.51 93.83 92.74 93.83 92.72 94.99"
                />
                <polygon
                  class="cls-3"
                  points="179.13 13.5 111.29 13.5 111.28 12.63 179 12.63 179.13 13.5"
                />
                <polygon
                  class="cls-3"
                  points="179.96 19.14 111.39 19.14 111.37 18.25 179.83 18.25 179.96 19.14"
                />
                <polygon
                  class="cls-3"
                  points="180.8 24.91 111.49 24.91 111.47 24 180.67 24 180.8 24.91"
                />
                <polygon
                  class="cls-3"
                  points="181.66 30.81 111.58 30.81 111.57 29.88 181.53 29.88 181.66 30.81"
                />
                <polygon
                  class="cls-3"
                  points="182.54 36.83 111.69 36.83 111.67 35.88 182.41 35.88 182.54 36.83"
                />
                <polygon
                  class="cls-3"
                  points="183.44 43 111.79 43 111.77 42.02 183.3 42.02 183.44 43"
                />
                <polygon
                  class="cls-3"
                  points="184.37 49.3 111.89 49.3 111.88 48.31 184.22 48.31 184.37 49.3"
                />
                <path
                  class="cls-4"
                  d="M138,52.82c-20,25.21-1.87,57.67,9.86,67.16a18.27,18.27,0,0,1-8.09-4.23l3.56,8.85c-15-12.26-32.53-47.52-10.64-74.63a27.27,27.27,0,0,0,4-6.67c5.55-13.17-3.44-27-14.39-34.81a14.17,14.17,0,0,0-6-2.64,15.59,15.59,0,0,0-7.09.34h-6.1c1.75-3.88,9-5.22,14.19-4.46a20.66,20.66,0,0,1,8.93,3.73C141.33,16.15,148,31.63,142.55,45.05A32,32,0,0,1,138,52.82Z"
                />
              </g>
            </g>
          </svg>
        </div>
      </div>
      <div class="right-login">
        <div class="form-wrapper">
          <div class="mobile-logo">
            <img src="../assets/images/mlogo.png" alt="">
          </div>
          <div class="header">
            <h3>Welcome Student!</h3>
            <p>Sign in using your assigned USN number</p>
            <?php
                    if(isset($_SESSION['no-login-message'])) {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                    if(isset($_SESSION['loginError'])) {
                        echo $_SESSION['loginError'];
                        unset($_SESSION['loginError']);
                    }
                ?>
          </div>
          <form action="../includes/student-login.inc.php" method="POST">
            <label for="">Your USN</label>
            <input type="text" name="USN" placeholder="USN" required/>
            <label for="">Your Password</label>
            <input type="password" name="pwd" placeholder="Password" required/>
            <div class="form-btn">
              <button type="submit" name="submit">LOG IN</button>
            </div>
          </form>
          <div class="form-links">
            <a href="<?php echo SITEURL;?>"
              ><svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M9.16659 4.16675L3.33325 10.0001L9.16659 15.8334M3.33325 10.0001H16.6666"
                  stroke="black"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              Back to home</a>
            <a href="<?php echo SITEURL;?>teacher/teacher-login.php">Are you a teacher?</a>
          </div>
        </div>
      </div>
    </div>
    <?php
        }
    ?>
  </body>
</html>
