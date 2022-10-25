<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $ann = htmlspecialchars($_POST['ann']); 
    $user = $_POST['user']; 
    $admin_id = $_POST['admin_id'];

    require_once "functions.inc.php";

    createAnnouncement($conn, $ann, $user, $admin_id);
  
}