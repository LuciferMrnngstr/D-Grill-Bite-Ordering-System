const pswrd = document.querySelector('.form input[type="password"]'),
    toggleBtn = document.querySelector('.form .field .toggle');

toggleBtn.onclick = () => {
    if (pswrd.type == 'password') {
        pswrd.type = 'text';
        toggleBtn.classList.add('active');
    }
    else {
        pswrd.type = 'password';
        toggleBtn.classList.remove('active');
    }
}