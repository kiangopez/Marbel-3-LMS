<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $term = htmlspecialchars($_POST['term']);
    $admin_id = $_POST['admin_id'];

    require_once "functions.inc.php";

    updateTerm($conn, $id, $term, $admin_id);
}