<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles1.css">
  <title>플랜-아이</title>
</head>
<body>
  <?php
  session_start();
  
  if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
      echo "<script>var isLoggedIn = true;</script>";
  } else {
      echo "<script>var isLoggedIn = false;</script>";
  }
  ?>
  <script src="/navbar.js"></script>
  <nav>
    <a href="main.php">PlanI</a>
    <a href="schedule.php">일정관리</a>
    <div class="nav-right">
      <a id="login" href="login.html" onclick="login()">로그인</a>
      <a id="signup" href="register.html">회원가입</a>
      <a id="logout" href="logoutAction.php" class="hidden" onclick="logout()">로그아웃</a>
    </div>
  </nav>
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
