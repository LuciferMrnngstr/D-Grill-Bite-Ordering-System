const section = document.querySelector('.wrapper .order-info'),
    releaseBtn = document.querySelector('.order-info .below-content .mark'),
    markAsPaid = document.querySelector('.order-info .below-content .mark-paid'),
    overlay = document.querySelector('.order-info .overlay'),
    cancelBtn1 = document.querySelector('.order-info .confirmation-modal.confirm1 .cancel'),
    cancelBtn2 = document.querySelector('.order-info .confirmation-modal.confirm2 .cancel');


// Open confirmation uppon click
if (markAsPaid) {
    markAsPaid.onclick = () => {
        section.classList.add('open-confirm-1');
    }
}

// Add discount
const discount = document.querySelector('.order-info  .below-content .add-discount-btn'),
    cancelBtn3 = document.querySelector('.order-info .discount-modal .buttons .cancel'),
    totalPrice = document.querySelector('.order-info .discount-modal .total-h4'),
    discountAmount = document.querySelector('.order-info .discount-modal .discount-h4'),
    discountInput = document.querySelector('.order-info .discount-modal #discount-input'),
    grandTotal = document.querySelector('.order-info .discount-modal .grand-h4'),
    grandInput = document.querySelector('.order-info .discount-modal #grand-input'),
    errorMessage = document.querySelector('.order-info .error');

if (discount) {
    discount.onclick = () => {
        section.classList.add('add-discount');
    }
}

function updateDiscount(discount) {
    const value = (discount.value / 100) * totalPrice.innerHTML;

    if (isNaN(value) || value < 0 || value > 100) {
        errorMessage.classList.add('active');
        discount.setCustomValidity('Number must be between 0 and 100');
    }
    else {
        errorMessage.classList.remove('active');
        discount.setCustomValidity('');

        discountInput.value = value.toFixed(2);
        discountAmount.innerHTML = discountInput.value;

        grandInput.value = (totalPrice.innerHTML - discountAmount.innerHTML).toFixed(2);
        grandTotal.innerHTML = grandInput.value;
    }
}

cancelBtn3.onclick = () => {
    section.classList.remove('add-discount');
}

// --------------------------

releaseBtn.onclick = () => {
    section.classList.add('open-confirm-2');
}

// Close confirmation uppon click
overlay.onclick = () => {
    section.classList.remove('open-confirm-1');
    section.classList.remove('open-confirm-2');
    section.classList.remove('add-discount');
}

cancelBtn1.onclick = () => {
    section.classList.remove('open-confirm-1');
}

cancelBtn2.onclick = () => {
    section.classList.remove('open-confirm-2');
}