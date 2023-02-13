const navItems = document.querySelectorAll('.nav-items');

navItems.forEach(navItem => {
    navItem.addEventListener('click', () => {
        navItems.forEach(navItem => {
            navItem.classList.remove('active');
        });

        navItem.classList.add('active');
    });
});

// add to cart
const addToCartBtn = document.querySelector('#add-to-cart');
const descContainer = document.querySelector('.desc-container.open');

addToCartBtn.addEventListener('click', () => {
    descContainer.classList.add('active');
});