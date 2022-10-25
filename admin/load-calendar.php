<?php
$connect = new PDO('mysql:host=localhost;dbname=marbel3lms', 'root', ''); //CHANGE URL


$data = array();

$sql = "SELECT * FROM events ORDER BY id;";

$stmt = $connect->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll();

foreach($res as $row) {
    $data[] = array(
        'id' => $row["id"],
        'title' => $row["title"],
        'start' => $row["start_event"],
        'end' => $row["end_event"]
    );
}

echo json_encode($data);
?>