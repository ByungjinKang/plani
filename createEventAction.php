<?php
session_start();

if ($_SESSION['isLoggedIn'] !== true) {
    header('Location: login.php');
    exit();
  }

  $loggedInUserId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $servername = "localhost";   
        $username = "root";       
        $password = "1234";       
        $dbname = "plani";

        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $color = $_POST['color'];

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("MySQL 연결 실패: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO events (title, start_datetime, end_datetime, description, location, color, users_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $title, $start, $end, $description, $location, $color, $loggedInUserId);
    
        if ($stmt->execute()) {
            header("Refresh: 1; URL=schedule.php");
            echo "일정이 성공적으로 생성되었습니다.";
        } else {
            header("Refresh: 1; URL=schedule.php");
            echo "일정 생성에 실패했습니다.";
        }
    
        $stmt->close();
        $conn->close();
}
?>