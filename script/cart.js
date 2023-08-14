// OPEN ITEM EDIT AND DELETE ACTION DOTS
const actionBtns = document.querySelectorAll('.cart-container .content .action'),
    items = document.querySelectorAll('.wrapper .cart .content'),
    overlays = document.querySelectorAll('.cart-container .content .overlay');

actionBtns.forEach(actionBtn => {
    actionBtn.onclick = () => {
        items.forEach(item => {
            item.classList.remove('open-action');
        });

        actionBtn.parentElement.classList.add('open-action');
    }
});

overlays.forEach(overlay => {
    overlay.onclick = () => {
        items.forEach(item => {
            item.classList.remove('open-action');
        });
    }
});



const container = document.querySelector('.wrapper .cart'),
    overlay2 = document.querySelector('.cart .overlay2'),
    cancelBtns = document.querySelectorAll('.cart .cancel');

overlay2.onclick = () => {
    container.classList.remove('open-edit');
    container.classList.remove('open-delete');
}

cancelBtns.forEach(cancelBtn => {
    cancelBtn.onclick = () => {
        container.classList.remove('open-edit');
        container.classList.remove('open-delete');
    }
});

//DELETE ACTION
const deleteBtns = document.querySelectorAll('.cart-container .content .delete'),
    deleteInputId = document.querySelector('.cart .delete-modal input'),
    modalText = document.querySelector('.cart .delete-modal p');

deleteBtns.forEach(deleteBtn => {
    deleteBtn.onclick = () => {
        items.forEach(item => {
            item.classList.remove('open-action'); // close action all modals
        });

        deleteInputId.value = deleteBtn.id;
        modalText.innerHTML = 'Are you sure you want to remove ' + deleteBtn.getAttribute('data-name') + ' from your cart?'

        container.classList.add('open-delete'); // open delete modal
    }
});

// EDIT ACTION
const editBtns = document.querySelectorAll('.cart-container .content .edit'),
    cartID = document.querySelector('.cart .edit-modal .cart-id'),
    editName = document.querySelector('.cart .edit-modal .name'),
    editQuantity = document.querySelector('.cart .edit-modal #quantity'),
    editTotalPriceInput = document.querySelector('.cart .edit-modal .total-price'),
    editTotalPriceText = document.querySelector('.cart .edit-modal h4'),
    decreaseBtn = document.querySelector('.cart .edit-modal #decrease'),
    increaseBtn = document.querySelector('.cart .edit-modal #increase'),
    errorMessage = document.querySelector('.cart .error');

editBtns.forEach(editBtn => {
    editBtn.onclick = () => {
        items.forEach(item => {
            item.classList.remove('open-action'); // close action all modals

            if (item.id === editBtn.getAttribute('data-id')) { // find the data by loop id search
                // storing info into variable
                itemName = document.querySelector('.cart-container #' + item.id + ' .name').innerHTML;
                itemPrice = document.querySelector('.cart-container #' + item.id + ' h4').innerHTML;
                itemQuantity = document.querySelector('.cart-container #' + item.id + ' .quantity').value;
            }
        });

        cartID.value = editBtn.getAttribute('cart-id');
        editName.innerHTML = itemName;
        editQuantity.value = itemQuantity;
        editTotalPriceInput.value = itemPrice * itemQuantity;
        editTotalPriceText.innerHTML = editTotalPriceInput.value;

        container.classList.add('open-edit'); // open edit modal
    }
});

// decrease button and decrease quantity
decreaseBtn.onclick = () => {
    // if (editQuantity.value > 1 && editQuantity.value <= 10) {
    if (editQuantity.value > 1 && editQuantity.value <= 10) {
        editQuantity.value--;
        editTotalPriceInput.value = itemPrice * editQuantity.value;
        editTotalPriceText.innerHTML = editTotalPriceInput.value;
    }
}

// increase button and increase quantity
increaseBtn.onclick = () => {
    // if (editQuantity.value >= 1 && editQuantity.value < 10) {
    if (editQuantity.value >= 1 && editQuantity.value < 10) {
        editQuantity.value++;
        editTotalPriceInput.value = itemPrice * editQuantity.value;
        editTotalPriceText.innerHTML = editTotalPriceInput.value;
    }
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

        if (editQuantity.value >= 1 && editQuantity.value <= 10) {
            editTotalPriceInput.value = itemPrice * editQuantity.value;
            editTotalPriceText.innerHTML = editTotalPriceInput.value;
        }
    }
}