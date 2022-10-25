<?php
include "../config/constants.php";
?>
    <script>
        $("#submit-msg").hide();
    </script>
<?php

$from_time1 = date("Y-m-d H:i:s");
$to_time1 = $_SESSION["end_time"];

$timefirst = strtotime($from_time1);
$timesecond = strtotime($to_time1);

$dif = $timesecond - $timefirst;
echo gmdate("H:i:s", $dif);

if($dif == 0 || $dif < 0) {
    ?>
    <script>
    $("#attempt-box").hide();
    $("#timer").hide();
    $("#submit-msg").show();
    $("#submit-msg p").text("Time is up please submit the quiz");
    </script>
    <?php
} else {
}

?>