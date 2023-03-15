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

// food description activate
const addToCartBtn = document.querySelector('.submit-btn-container #add-to-cart'),
    descContainer = document.querySelector('.desc-container.open');

if (addToCartBtn) {
    addToCartBtn.addEventListener('click', () => {
        descContainer.classList.add('active');
    });
}

// increment and decrement quantity and update total price
const inputQuantity = document.querySelector('.food-input-info #quantity'),
    increaseBtn = document.querySelector('.food-input-info #increase'),
    decreaseBtn = document.querySelector('.food-input-info #decrease'),
    foodPrice = document.querySelector('.desc-container #food-price'),
    subTotal = document.querySelector('.sub-total-cont #sub-total');

if (inputQuantity) {
    subTotal.innerHTML = foodPrice.innerHTML;

    // Decrease quantity value
    decreaseBtn.addEventListener('click', () => {
        if (inputQuantity.value > 1 && inputQuantity.value <= 5) {
            inputQuantity.value--;
            subTotal.innerHTML = (foodPrice.innerHTML * inputQuantity.value).toFixed(2);
        }
    });

    // Increae quantity value
    increaseBtn.addEventListener('click', () => {
        if (inputQuantity.value >= 1 && inputQuantity.value < 5) {
            inputQuantity.value++;
            subTotal.innerHTML = (foodPrice.innerHTML * inputQuantity.value).toFixed(2);
        }
    });
}
