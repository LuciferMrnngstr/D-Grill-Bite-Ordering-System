// // food description activate
// const addToCartBtn = document.querySelector('.submit-btn-container #add-to-cart'),
//     container = document.querySelector('.container'),
//     overlay = document.querySelector('.container .overlay');

// addToCartBtn.onclick = () => {
//     container.classList.add('active-modal');
// };

// overlay.onclick = () => {
//     container.classList.remove('active-modal');
// };

// // increment and decrement quantity and update total price
// const inputQuantity = document.querySelector('.food-input-info #quantity'),
//     increaseBtn = document.querySelector('.food-input-info #increase'),
//     decreaseBtn = document.querySelector('.food-input-info #decrease'),
//     foodPrice = document.querySelector('.desc-container #food-price'),
//     subTotal = document.querySelector('.sub-total-cont #sub-total');

// subTotal.innerHTML = foodPrice.innerHTML;

// // Decrease quantity value
// decreaseBtn.onclick = () => {
//     if (inputQuantity.value > 1 && inputQuantity.value <= 5) {
//         inputQuantity.value--;
//         subTotal.innerHTML = (foodPrice.innerHTML * inputQuantity.value).toFixed(2);
//     }
// };

// // Increae quantity value
// increaseBtn.onclick = () => {
//     if (inputQuantity.value >= 1 && inputQuantity.value < 5) {
//         inputQuantity.value++;
//         subTotal.innerHTML = (foodPrice.innerHTML * inputQuantity.value).toFixed(2);
//     }
// };