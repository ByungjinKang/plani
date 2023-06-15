<?php
session_start();

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
    echo "<script>var isLoggedIn = true;</script>";
} else {
    echo "<script>var isLoggedIn = false;</script>";
}
?>
<script>
const checkLoginStatus = () => {
  if (isLoggedIn) {
    document.getElementById("login").classList.add("hidden");
    document.getElementById("signup").classList.add("hidden");
    document.getElementById("logout").classList.remove("hidden");
  } else {
    document.getElementById("login").classList.remove("hidden");
    document.getElementById("signup").classList.remove("hidden");
    document.getElementById("logout").classList.add("hidden");
  }
};

document.addEventListener("DOMContentLoaded", () => {
  checkLoginStatus();
});

const login = () => {
  checkLoginStatus();
};

const logout = () => {
  checkLoginStatus();
};
</script>
<nav>
    <a href="main.php">PlanI</a>
    <a href="schedule.php">일정관리</a>
    <div class="nav-right">
      <a id="login" href="login.html" onclick="login()">로그인</a>
      <a id="signup" href="register.html">회원가입</a>
      <a id="logout" href="logoutAction.php" class="hidden" onclick="logout()">로그아웃</a>
    </div>
</nav>