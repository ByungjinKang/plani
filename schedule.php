<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styles1.css">
  <link rel="stylesheet" type="text/css" href="styles3.css">
  <title>플랜-아이</title>
</head>
<body>
<?php include 'navbar.php'; ?>
  <br>
  <div id="dateRange"></div>
  <button id="prevBtn" class="btn">&lt;</button>
  <button id="nextBtn" class="btn">&gt;</button>
  <button id="todayBtn" class="btn">오늘</button>
  <button id="monthViewBtn" class="btn">월</button>
  <button id="weekViewBtn" class="btn">주</button>
  <br><br>
  <div id="weekTable">
  <table id="scheduleTable">
    <thead>
      <tr>
        <th colspan="8" id="dateRangeText"></th>
      </tr>
      <tr>
        <th>시간</th>
        <th id="day1"></th>
        <th id="day2"></th>
        <th id="day3"></th>
        <th id="day4"></th>
        <th id="day5"></th>
        <th id="day6"></th>
        <th id="day7"></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  </div>

  <div id="monthTable">
  <table class="monthTable">
    <thead>
      <tr>
        <th colspan="7" id="monthLabel"></th>
      </tr>
      <tr>
        <th>일</th>
        <th>월</th>
        <th>화</th>
        <th>수</th>
        <th>목</th>
        <th>금</th>
        <th>토</th>
      </tr>
    </thead>
    <tbody id="monthBody">
    
    </tbody>
  </table>
  </div>

  <button id="addEventBtn" class="btn">일정 추가</button>
  <button id="deleteEventBtn" class="btn">일정 삭제</button>

  <script src="calendar.js"></script>
</body>
</html>