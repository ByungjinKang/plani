const calendarContainer = document.createElement('div');
calendarContainer.classList.add('calendar-container');

// 12개의 달력 생성
for (let i = 0; i < 12; i++) {
  const calendarDiv = document.createElement('div');
  calendarDiv.classList.add('calendar');
  
  const headerDiv = document.createElement('div');
  headerDiv.classList.add('header');
  
  const weekdaysDiv = document.createElement('div');
  weekdaysDiv.classList.add('weekdays');
  
  const daysDiv = document.createElement('div');
  daysDiv.classList.add('days');
  
  // 요일 추가
  const weekdayNames = ['일', '월', '화', '수', '목', '금', '토'];
  for (let j = 0; j < weekdayNames.length; j++) {
    const dayDiv = document.createElement('div');
    dayDiv.classList.add('day');
    dayDiv.textContent = weekdayNames[j];
    weekdaysDiv.appendChild(dayDiv);
  }
  
  // 요소들을 계층 구조에 추가
  calendarDiv.appendChild(headerDiv);
  calendarDiv.appendChild(weekdaysDiv);
  calendarDiv.appendChild(daysDiv);
  
  // 달력 컨테이너에 달력 추가
  calendarContainer.appendChild(calendarDiv);
}

// 달력을 3행 4열로 배열하여 표시
const rows = 3;
const cols = 4;

for (let i = 0; i < rows; i++) {
  const rowDiv = document.createElement('div');
  rowDiv.classList.add('calendar-row');
  
  for (let j = 0; j < cols; j++) {
    const index = i * cols + j;
    if (index < 12) {
      const calendarDiv = calendarContainer.children[index];
      rowDiv.appendChild(calendarDiv);
    }
  }
  
  // <body> 요소에 행 추가
  document.body.appendChild(rowDiv);
}
