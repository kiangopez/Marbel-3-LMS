<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $ann = $_POST['ann']; 
    $user = $_POST['user']; 
    $admin_id = $_POST['admin_id'];


    require_once "functions.inc.php";

    editAnnouncement($conn, $ann, $user, $id, $admin_id);
  
}