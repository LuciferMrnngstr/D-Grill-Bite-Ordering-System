const topNav = document.querySelector('.wrapper .top'),
    notifBtn = document.querySelector('.top .right .notif'),
    notifOverlay = document.querySelector('.wrapper .top .overlay');

notifBtn.onclick = () => {
    topNav.classList.add('active-notif');
}

notifOverlay.onclick = () => {
    topNav.classList.remove('active-notif');
}