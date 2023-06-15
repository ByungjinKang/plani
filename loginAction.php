<?php
session_start();

$servername = "localhost";   
$username = "root";       
$password = "1234";       
$dbname = "plani";


$id = $_POST['id'];
$name = $_POST['name'];


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE id='$id' AND name='$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;

    header("Refresh: 1; URL=main.php");
    echo "로그인이 완료되었습니다. 환영합니다!";
} else {
    header("Refresh: 1; URL=login.html");
    echo "아이디와 이름이 일치하지 않습니다.";
}

$conn->close();
?>