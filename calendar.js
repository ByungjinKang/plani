  window.addEventListener('load', () => {
    document.getElementById('weekTable').style.display = 'block';
    document.getElementById('monthTable').style.display = 'none';
    updateTableView('week');
  });

  document.getElementById('monthViewBtn').addEventListener('click', () => {
    document.getElementById('weekTable').style.display = 'none';
    document.getElementById('monthTable').style.display = 'block';
    updateTableView('month');
  });

  document.getElementById('weekViewBtn').addEventListener('click', () => {
    document.getElementById('weekTable').style.display = 'block';
    document.getElementById('monthTable').style.display = 'none';
    updateTableView('week');
  });

  const updateTableView = (viewMode) => {
    if (viewMode === 'week') {
      let today = new Date();
      today.setHours(0, 0, 0, 0);

      const createTable = (startDate) => {
        const table = document.getElementById('scheduleTable');
        const dateRangeText = document.getElementById('dateRangeText');
        const days = ['일', '월', '화', '수', '목', '금', '토'];

        const endDate = new Date(startDate.getTime() + 6 * 24 * 60 * 60 * 1000);
        dateRangeText.textContent = `${startDate.getFullYear()}년 ${startDate.getMonth() + 1}월 ${startDate.getDate()}일 - ${endDate.getFullYear()}년 ${endDate.getMonth() + 1}월 ${endDate.getDate()}일`;

        for (let i = 1; i <= 7; i++) {
          const dayElement = document.getElementById(`day${i}`);
          const day = new Date(startDate.getTime() + (i - 1) * 24 * 60 * 60 * 1000);
          dayElement.textContent = `${days[day.getDay()]} ${day.getMonth() + 1}.${day.getDate()}`;
        }

        const tbody = table.getElementsByTagName('tbody')[0];
        tbody.innerHTML = '';

        for (let i = 0; i < 24; i++) {
          const row = document.createElement('tr');
          for (let j = 0; j <= 7; j++) {
            const cell = document.createElement(j === 0 ? 'th' : 'td');
            if (j === 0) {
              cell.textContent = `${i.toString().padStart(2, '0')}:00`;
            }
            row.appendChild(cell);
          }
          tbody.appendChild(row);
        }
      };

      const getEventsWeek = () => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'getEvents.php', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            const events = JSON.parse(xhr.responseText);
            const table = document.getElementById('scheduleTable');
            const tbody = table.getElementsByTagName('tbody')[0];

            for (let i = 0; i < events.length; i++) {
              const event = events[i];
              const startTime = new Date(event.start);
              const endTime = new Date(event.end);

              if (startTime.getDate() === endTime.getDate()) {
                const startCellIndex = startTime.getDay();
                const endCellIndex = endTime.getDay();

                for (let j = startCellIndex; j <= endCellIndex; j++) {
                  const row = tbody.getElementsByTagName('tr')[startTime.getHours()];
                  const cell = row.getElementsByTagName('td')[j];
                  cell.style.backgroundColor = event.color;
                  cell.style.color = 'white';

                  if (j === startCellIndex) {
                    cell.textContent = `${startTime.getHours()}:${startTime.getMinutes()} ${event.title}`;
                  }

                  if (j !== startCellIndex) {
                    cell.style.display = 'none';
                  }
                }
              }
            }
          }
        };
        xhr.send();
      };

      createTable(today);
      getEventsWeek();

      document.getElementById('prevBtn').addEventListener('click', () => {
        const prevWeek = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
        today = prevWeek;
        createTable(prevWeek);
      });

      document.getElementById('nextBtn').addEventListener('click', () => {
        const nextWeek = new Date(today.getTime() + 7 * 24 * 60 * 60 * 1000);
        today = nextWeek;
        createTable(nextWeek);
      });

      document.getElementById('todayBtn').addEventListener('click', () => {
        today = new Date();
        today.setHours(0, 0, 0, 0);
        getEventsWeek();
        createTable(today);
      });
      
    } else if (viewMode === 'month') {
      const createMonthCalendar = (year, month) => {
        const date = new Date(year, month - 1, 1);
        const firstDay = date.getDay();
        const lastDate = new Date(year, month, 0).getDate();
        const prevMonthLastDate = new Date(year, month - 1, 0).getDate();

        document.getElementById('monthLabel').textContent = `${year}년 ${month}월`;

        const calendarBody = document.getElementById('monthBody');
        calendarBody.innerHTML = '';

        let day = 1;
        let hasPrevMonthDates = false;
        let hasNextMonthDates = false;

        for (let week = 0; week < 6; week++) {
          const row = document.createElement('tr');
          for (let weekday = 0; weekday < 7; weekday++) {
            const cell = document.createElement('td');

            if (week === 0 && weekday < firstDay) {
              cell.textContent = prevMonthLastDate - (firstDay - weekday - 1);
              cell.classList.add('prev-month');
              hasPrevMonthDates = true;
            } else if (day > lastDate) {
              const nextMonthDay = day - lastDate;
              cell.textContent = nextMonthDay;
              cell.classList.add('next-month');
              hasNextMonthDates = true;
              day++;
            } else {
              cell.textContent = day++;
            }

            row.appendChild(cell);
          }
          calendarBody.appendChild(row);
        }

        if (hasPrevMonthDates) {
          calendarBody.classList.add('has-prev-month');
        } else {
          calendarBody.classList.remove('has-prev-month');
        }

        if (hasNextMonthDates) {
          calendarBody.classList.add('has-next-month');
        } else {
          calendarBody.classList.remove('has-next-month');
        }
      };

      const getEventsMonth = () => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'getEvents.php', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            const events = JSON.parse(xhr.responseText);
            const calendarBody = document.getElementById('monthBody');
            const cells = calendarBody.getElementsByTagName('td');

            for (let i = 0; i < events.length; i++) {
              const event = events[i];
              const eventDate = new Date(event.start);
              const eventDay = eventDate.getDate();

              for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (parseInt(cell.textContent) === eventDay) {
                  const eventDiv = document.createElement('div');
                  eventDiv.classList.add('event');
                  eventDiv.textContent = event.title;
                  eventDiv.style.backgroundColor = event.color;
                  eventDiv.style.color = 'white';

                  cell.appendChild(eventDiv);
                  break;
                }
              }
            }
          }
        };
        xhr.send();
      };

      let currentDate = new Date();
      let currentYear = currentDate.getFullYear();
      let currentMonth = currentDate.getMonth() + 1;
      createMonthCalendar(currentYear, currentMonth);
      getEventsMonth();

      document.getElementById('prevBtn').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth === 0) {
          currentYear--;
          currentMonth = 12;
        }
        createMonthCalendar(currentYear, currentMonth);
      });

      document.getElementById('nextBtn').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth === 13) {
          currentYear++;
          currentMonth = 1;
        }
        createMonthCalendar(currentYear, currentMonth);
      });

      document.getElementById('todayBtn').addEventListener('click', () => {
        currentYear = currentDate.getFullYear();
        currentMonth = currentDate.getMonth() + 1;
        createMonthCalendar(currentYear, currentMonth);
        getEventsMonth();
      });
    }

    document.getElementById('addEventBtn').addEventListener('click', () => {
      location.href = 'createEvent.html';
    });

    document.getElementById('deleteEventBtn').addEventListener('click', () => {
      location.href = 'deleteEvent.php';
    });
  };