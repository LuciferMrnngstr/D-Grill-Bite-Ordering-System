const proceedBtn = document.querySelector('.content .submit-btn'),
    container = document.querySelector('.container'),
    overlay = document.querySelector('.container .overlay');

proceedBtn.onclick = () => {
    container.classList.add('active-modal');
}

overlay.onclick = () => {
    container.classList.remove('active-modal');
}