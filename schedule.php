<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles1.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css' />
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/locale/ko.js'></script>
  <title>플랜-아이</title>
</head>
<body>
 <?php include 'navbar.php' ?>
  <nav>
    <a href="main.php">PlanI</a>
    <a href="schedule.php">일정관리</a>
    <div class="nav-right">
      <a id="login" href="login.html" onclick="login()">로그인</a>
      <a id="signup" href="register.html">회원가입</a>
      <a id="logout" href="logoutAction.php" class="hidden" onclick="logout()">로그아웃</a>
    </div>
  </nav>
  <div id='calendar'></div>
  <button id="createEventButton">일정 추가</button>
<script>
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      events: './api/events.php', // 백엔드에서 일정 데이터를 가져올 API 엔드포인트
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      locale: 'ko', // 한국어 설정
      defaultView: 'agendaWeek',
      editable: true,
      dayClick: function(date, jsEvent, view) {
        window.location.href = 'createEvent.html?date=' + date.format();
      }
    });

      $('#createEventButton').click(function() {
        window.location.href = 'createEvent.html';
    });
  });
</script>
</body>
</html>