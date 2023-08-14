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
    errorMessage = document.querySelector('.food_details .error'),
    totalPrice = document.querySelector('.input-description .total-cont .price-cont h4');

increaseBtn.onclick = () => {
    checkRange(quantityInput);
    if (quantityInput.value >= 1 && quantityInput.value < 10) {
        quantityInput.value++;
    }
    else {
        quantityInput.value = 1;
    }

    totalPrice.innerHTML = (price.innerHTML * quantityInput.value).toFixed(2);
}

decreaseBtn.onclick = () => {
    checkRange(quantityInput);
    if (quantityInput.value > 1 && quantityInput.value <= 10) {
        quantityInput.value--;
    }
    else {
        quantityInput.value = 1;
    }

    totalPrice.innerHTML = (price.innerHTML * quantityInput.value).toFixed(2);
}

function checkRange(quantityInput) {
    const value = parseInt(quantityInput.value, 10);

    if (isNaN(value) || value < 1 || value > 10) {
        errorMessage.classList.add('active');
        quantityInput.setCustomValidity('Number must be between 1 and 10');
    }
    else {
        errorMessage.classList.remove('active');
        quantityInput.setCustomValidity('');

        if (quantityInput.value > 1 && quantityInput.value <= 10) {
            totalPrice.innerHTML = (price.innerHTML * quantityInput.value).toFixed(2);
        }
    }
}

//add to cart validation
const form = document.querySelector('.food_details .input-description');

form.onsubmit = function (e) {
    if (quantityInput.value >= 1 && quantityInput.value <= 10) {
        return true;
    }

    e.preventDefault();
    // submitBtn.style.backgroundColor = 'grey';
}