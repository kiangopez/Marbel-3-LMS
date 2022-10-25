<?php 
$connect = new PDO('mysql:host=localhost;dbname=marbel3lms', 'root', ''); //CHANGE URL

if(isset($_POST["title"])) {
    $sql = "INSERT INTO events (title, start_event, end_event)
    VALUES (:title, :start_event, :end_event);";

    $stmt = $connect->prepare($sql);
    $stmt->execute(
        array(
            ':title' => $_POST['title'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end']
        )
    );
}

?>