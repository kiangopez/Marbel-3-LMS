<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $ann = $_POST['ann']; 
    $user = $_POST['user']; 

    require_once "functions.inc.php";

    editAnnouncement($conn, $ann, $user, $id);
  
}