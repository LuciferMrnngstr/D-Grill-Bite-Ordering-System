const section = document.querySelector('.wrapper .order-info'),
    claimBtn = document.querySelector('.order-info .below-content .mark'),
    cancelOrder = document.querySelector('.order-info .below-content .mark-paid'),
    overlay = document.querySelector('.order-info .overlay'),
    cancelBtn1 = document.querySelector('.order-info .confirmation-modal.confirm1 .cancel'),
    cancelBtn2 = document.querySelector('.order-info .confirmation-modal.confirm2 .cancel');


// Open confirmation uppon click
if (cancelOrder) {
    cancelOrder.onclick = () => {
        section.classList.add('open-confirm-1');
    }
}

claimBtn.onclick = () => {
    section.classList.add('open-confirm-2');
}

// Close confirmation uppon click
overlay.onclick = () => {
    section.classList.remove('open-confirm-1');
    section.classList.remove('open-confirm-2');
}

cancelBtn1.onclick = () => {
    section.classList.remove('open-confirm-1');
}

cancelBtn2.onclick = () => {
    section.classList.remove('open-confirm-2');
}