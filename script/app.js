// const navItems = document.querySelectorAll('.nav-items');

// navItems.forEach(navItem => {
//     navItem.addEventListener('click', () => {
//         navItems.forEach(navItem => {
//             navItem.classList.remove('active');
//         });

//         navItem.classList.add('active');
//     });
// });

const passInput = document.querySelector('#password'),
    showPass = document.querySelector('.show-pass');

if (passInput) {
    showPass.addEventListener('click', () => {
        if (passInput.type == 'password') {
            passInput.type = 'text';
            showPass.style.backgroundImage = "url('../../icons/login/eye.svg')";
        }
        else {
            passInput.type = 'password';
            showPass.style.backgroundImage = "url('../../icons/login/eyeslash.svg')";
        }
    });
}
