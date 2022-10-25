<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $term = htmlspecialchars($_POST['term']); 
    $admin_id = $_POST['admin_id'];

    require_once "functions.inc.php";

    createTerm($conn, $term, $admin_id);
  
}