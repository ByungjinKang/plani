<?php
$servername = "localhost";   
$username = "root";       
$password = "1234";       
$dbname = "plani";    

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("MySQL 연결 실패: " . $conn->connect_error);
}

$sql = "INSERT INTO Users (id, name, email, contact) VALUES ('$id', '$name', '$email', '$contact')";
if ($conn->query($sql) === TRUE) {
  header("Refresh: 1; URL=main.php");
  echo "회원가입이 완료되었습니다.";
} else {
  echo "오류: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>