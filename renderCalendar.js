var currentDate = new Date();

const renderCalendar = () => {
    const calendar = document.querySelector('.calendar');
    const header = calendar.querySelector('.header');
    const daysContainer = calendar.querySelector('.days');
    
    header.textContent = '';
    daysContainer.innerHTML = '';
    
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const date = new Date(year, month);
    
    header.textContent = date.toLocaleString('default', { month: 'long' }) + ' ' + year;
    
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const firstDayIndex = new Date(year, month, 1).getDay();
    
    if (firstDayIndex > 0) {
        const prevMonth = new Date(year, month, 0);
        const prevMonthDays = prevMonth.getDate();
        for (let i = firstDayIndex - 1; i >= 0; i--) {
            const dayElement = createDayElement(prevMonthDays - i, 'other-month');
            daysContainer.appendChild(dayElement);
        }
    }
    
    for (let day = 1; day <= daysInMonth; day++) {
        const dayElement = createDayElement(day);
        daysContainer.appendChild(dayElement);
    }
    
    const remainingSlots = 42 - (firstDayIndex + daysInMonth);
    for (let i = 1; i <= remainingSlots; i++) {
        const dayElement = createDayElement(i, 'other-month');
        daysContainer.appendChild(dayElement);
    }
    
    const today = new Date();
    if (today.getFullYear() === year && today.getMonth() === month) {
        const todayElement = daysContainer.querySelector(`.day[data-day="${today.getDate()}"]`);
        if (todayElement) {
            todayElement.classList.add('today');
        }
    }
};

const createDayElement = (day, className) => {
    const dayElement = document.createElement('div');
    dayElement.textContent = day;
    dayElement.classList.add('day');
    if (className) {
        dayElement.classList.add(className);
    }
    dayElement.setAttribute('data-day', day);
    return dayElement;
};

const prevMonth = () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
};

const nextMonth = () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
};

const goToday = () => {
    currentDate = new Date();
    renderCalendar();
};

renderCalendar();