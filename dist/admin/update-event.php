<?php 
$connect = new PDO('mysql:host=localhost;dbname=marbel3lms', 'root', ''); //CHANGE URL

if(isset($_POST['id'])) {
    $sql = "UPDATE events
    SET title=:title, start_event=:start_event, end_event=:end_event 
    WHERE id=:id";

    $stmt = $connect->prepare($sql);
    $stmt->execute(
        array(
            ':title' => $_POST['title'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end'],
            ':id' => $_POST['id']
        )
    );
}