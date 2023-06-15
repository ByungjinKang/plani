<?php
session_start();

if ($_SESSION['isLoggedIn'] !== true) {
  header('Location: login.html');
  exit();
}

$loggedInUserId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['eventIds'])) {
    header('Location: deleteEvent.html');
    exit();
  }

  $eventIds = $_POST['eventIds'];

  $servername = "localhost";
  $username = "root";
  $password = "1234";
  $dbname = "plani";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
  }

  foreach ($eventIds as $eventId) {
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ? AND users_id = ?");
    $stmt->bind_param("ss", $eventId, $loggedInUserId);
    $stmt->execute();
  }

  $conn->close();

  header('Location: schedule.php');
  exit();
}
?>