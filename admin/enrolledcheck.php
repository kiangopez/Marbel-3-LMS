<?php

if(isset($_POST['submit'])) {
    if(!empty($_POST['subj_id'])) {

    $checked_count = count($_POST['subj_id']);
    echo "You have selected following ".$checked_count." option(s): <br/>";

    foreach($_POST['subj_id'] as $selected) {
        // place the sql insert here?
        echo "<p>".$selected ."</p>";
        }
    }
    else {
        echo "<b>Please Select Atleast One Option.</b>";
    }
}