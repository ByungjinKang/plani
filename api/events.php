<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "plani";

// 데이터베이스 연결 설정
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 일정 데이터 가져오기
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

// 일정 데이터를 JSON 형식으로 변환하여 반환
header('Content-Type: application/json');
if ($result->num_rows > 0) {
    $events = array();
    while ($row = $result->fetch_assoc()) {
        $event = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $row['start_datetime'],
            'end' => $row['end_datetime'],
            'description' => $row['description'],
            'location' => $row['location'],
            'color' => $row['color']
        );
        $events[] = $event;
    }
    echo json_encode($events);
} else {
    echo json_encode(array());
}

$conn->close();
?>