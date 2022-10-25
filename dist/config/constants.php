<?php
session_start();

DEFINE('SITEURL', 'http://localhost/marbel-lms/');
DEFINE('LOCALHOST', 'localhost');
DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_NAME', 'marbel3lms');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());