<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $ann = $_POST['ann']; 
    $user = $_POST['user']; 

    require_once "functions.inc.php";

    createAnnouncement($conn, $ann, $user);
  
}