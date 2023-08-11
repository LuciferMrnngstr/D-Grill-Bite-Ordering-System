const notifBtn = document.querySelector('.top2 .row1 .notif'),
    container = document.querySelector('.container'),
    overlay = document.querySelector('.container .overlay');

notifBtn.onclick = () => {
    if (container.className === 'container') {
        container.classList.add('active-modal');
    }
    else {
        container.classList.remove('active-modal');
    }
}

overlay.onclick = () => {
    container.classList.remove('active-modal');
}
