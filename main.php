<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles1.css">
  <title>플랜-아이</title>
</head>
<body>
 <?php include 'navbar.php'; ?>
  <div class="container">
    <h1>Plan-I</h1>
    <p>일정관리 서비스 Plan-I입니다.</p>
    
    <?php
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
        $id = $_SESSION['id'];
        echo "<p class='highlight'>로그인되었습니다. 환영합니다, $id 님!</p>";
    } else {
        echo "<p class='highlight'>로그인 후 서비스를 이용할 수 있습니다.</p>";
    }
    ?>
</body>
</html>
