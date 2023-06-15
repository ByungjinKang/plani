<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles2.css">
  <title>플랜-아이</title>
</head>
<body>
<div class="container">
  <form action="deleteEventAction.php" method="post">
    <label for="eventIds">삭제할 일정 선택:</label><br>

    <?php
      session_start();

      if ($_SESSION['isLoggedIn'] !== true) {
          header('Location: login.html');
          exit();
        }
      $loggedInUserId = $_SESSION['id'];

      $servername = "localhost";
      $username = "root";
      $password = "1234";
      $dbname = "plani";

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("MySQL 연결 실패: " . $conn->connect_error);
      }

      $sql = "SELECT id, title FROM events WHERE users_id = '$loggedInUserId'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<input type="checkbox" name="eventIds[]" value="' . $row['id'] . '"> ' . $row['title'] . '<br>';
        }
      } else {
        echo "삭제할 일정이 없습니다.";
      }

      $conn->close();
    ?>
    <br>
    <input type="submit" value="일정 삭제">
  </form>
  </div>
</body>
</html>