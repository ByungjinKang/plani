<?php
session_start();
$loggedInUserId = $_SESSION['id'];

$servername = 'localhost';
$username = 'root';
$password = '1234';
$dbname = 'plani';

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$sql = "SELECT * FROM events WHERE users_id = '$loggedInUserId'";
$result = $conn->query($sql);


$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $event = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $row['start_datetime'],
            'end' => $row['end_datetime'],
            'description' => $row['description'],
            'location' => $row['location'],
            'color' => $row['color'],
        );
        $events[] = $event;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($events);
?>