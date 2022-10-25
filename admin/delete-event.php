<?php

if(isset($_POST['id'])) {
    $connect = new PDO('mysql:host=localhost;dbname=marbel3lms', 'root', ''); //CHANGE URL

    $sql = "DELETE FROM events WHERE id=:id;";

    $stmt = $connect->prepare($sql);
    $stmt->execute(
        array(
            ':id' => $_POST['id']
        )
    );
}