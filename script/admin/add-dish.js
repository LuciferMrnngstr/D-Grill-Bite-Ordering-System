const content = document.querySelector('.wrapper .add-edit-dish'),
    action = document.querySelector('.wrapper .add-edit-dish .action'),
    overlay = document.querySelector('.wrapper .add-edit-dish .overlay'),
    deleteBtn = document.querySelector('.add-edit-dish .action-modal .delete'),
    cancelDeleteBtn = document.querySelector('.add-edit-dish .confirmation-modal .cancel');

action.onclick = () => {
    content.classList.add('open-action');
}

overlay.onclick = () => {
    content.classList.remove('open-action');
    content.classList.remove('open-confirmation');
    content.classList.remove('open-save-modal');
}

deleteBtn.onclick = () => {
    content.classList.remove('open-action');
    content.classList.add('open-confirmation');
}

cancelDeleteBtn.onclick = () => {
    content.classList.remove('open-confirmation');
}

// Save Dish
const submitBtn = document.querySelector('.add-edit-dish .bottom-button .buynow_btn'),
    cancelSaveBtn = document.querySelector('.add-edit-dish .save-modal .cancel');

submitBtn.onclick = () => {
    content.classList.add('open-save-modal');
}

cancelSaveBtn.onclick = () => {
    content.classList.remove('open-save-modal');
}