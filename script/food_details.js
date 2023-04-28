const buyNowBtn = document.querySelector('.food_details .buttons .buynow_btn'),
    addCartBtn = document.querySelector('.food_details .buttons .addcart_btn'),
    submitBtn = document.querySelector('.food_details .input-description input[type="submit"]'),
    section = document.querySelector('.wrapper section'),
    overlay = document.querySelector('.food_details .overlay');

buyNowBtn.onclick = () => {
    section.classList.add('active-food-details');
    submitBtn.value = buyNowBtn.innerHTML;
}

addCartBtn.onclick = () => {
    section.classList.add('active-food-details');
    submitBtn.value = addCartBtn.innerHTML;
}

overlay.onclick = () => {
    section.classList.remove('active-food-details');
    quantityInput.value = 1;
    totalPrice.innerHTML = price.innerHTML;
}

//input quantity code
const price = document.querySelector('.input-description .price h4'),
    increaseBtn = document.querySelector('.input-description .input-quantity #increase'),
    decreaseBtn = document.querySelector('.input-description .input-quantity #decrease'),
    quantityInput = document.querySelector('.input-description .input-quantity #quantity'),
    totalPrice = document.querySelector('.input-description .total-cont .price-cont h4');

increaseBtn.onclick = () => {
    if (quantityInput.value >= 1 && quantityInput.value < 5) {
        quantityInput.value++;
        totalPrice.innerHTML = (price.innerHTML * quantityInput.value).toFixed(2);
    }
}

decreaseBtn.onclick = () => {
    if (quantityInput.value > 1 && quantityInput.value <= 5) {
        quantityInput.value--;
        totalPrice.innerHTML = (price.innerHTML * quantityInput.value).toFixed(2);
    }
}

//add to cart validation
const form = document.querySelector('.food_details .input-description');

form.onsubmit = function (e) {
    if (quantityInput.value >= 1 && quantityInput.value <= 5) {
        return true;
    }

    e.preventDefault();
    // submitBtn.style.backgroundColor = 'grey';
}