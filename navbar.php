<?php
session_start();

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
    echo "<script>var isLoggedIn = true;</script>";
} else {
    echo "<script>var isLoggedIn = false;</script>";
}
?>
<script>
function checkLoginStatus() {
    if (isLoggedIn) {
      document.getElementById("login").classList.add("hidden");
      document.getElementById("signup").classList.add("hidden");
      document.getElementById("logout").classList.remove("hidden");
    } else {
      document.getElementById("login").classList.remove("hidden");
      document.getElementById("signup").classList.remove("hidden");
      document.getElementById("logout").classList.add("hidden");
    }
  }
  
  document.addEventListener("DOMContentLoaded", function() {
    checkLoginStatus();
  });
  
  function login() {
    checkLoginStatus();
  }
  
  function logout() {
    checkLoginStatus();
  }
</script>