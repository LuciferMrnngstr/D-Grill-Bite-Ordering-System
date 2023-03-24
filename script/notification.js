const wrapper = document.querySelector('.wrapper'),
    notifBtn = document.querySelector('.wrapper .top button'),
    overlay = document.querySelector('.wrapper .top .overlay');

notifBtn.onclick = () => {
    wrapper.classList.add('active-modal');
}

overlay.onclick = () => {
    wrapper.classList.remove('active-modal');
}