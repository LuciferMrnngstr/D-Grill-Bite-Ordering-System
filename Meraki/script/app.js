const navItems = document.querySelectorAll('.nav-items');

navItems.forEach(navItem => {
    navItem.addEventListener('click', () => {
        navItems.forEach(navItem => {
            navItem.classList.remove('active');
        });

        navItem.classList.add('active');
    });
});