<?php 
include "../config/constants.php";

if(isset($_POST['submit'])) {
    $section_name = htmlspecialchars($_POST['section_name']); 
    $section_category = htmlspecialchars($_POST['section_category']); 
    $adviser_id = htmlspecialchars($_POST['adviser_id']); 
    $admin_id = $_POST['admin_id'];
    require_once "functions.inc.php";

    createSection($conn, $section_name, $section_category, $adviser_id, $admin_id);
}