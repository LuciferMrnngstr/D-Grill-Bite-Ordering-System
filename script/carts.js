// OPEN ITEM EDIT AND DELETE ACTION DOTS
const actionBtns = document.querySelectorAll('.cart-container .content .action'),
    contents = document.querySelectorAll('.wrapper section .content'),
    overlays = document.querySelectorAll('.cart-container .content .overlay');

actionBtns.forEach(actionBtn => {
    actionBtn.onclick = () => {
        contents.forEach(content => {
            content.classList.remove('open-action');
        });

        actionBtn.parentElement.classList.add('open-action');
    }
});

overlays.forEach(overlay => {
    overlay.onclick = () => {
        contents.forEach(content => {
            content.classList.remove('open-action');
        });
    }
});



const container = document.querySelector('.wrapper section'),
    overlay2 = document.querySelector('section .overlay2'),
    cancelBtns = document.querySelectorAll('section .cancel');

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

// EDIT ACTION
const editBtns = document.querySelectorAll('.cart-container .content .edit');

editBtns.forEach(editBtn => {
    editBtn.onclick = () => {
        contents.forEach(content => {
            content.classList.remove('open-action');
        });

        container.classList.add('open-edit');
    }
});


//DELETE ACTION
const deleteBtns = document.querySelectorAll('.cart-container .content .delete');

deleteBtns.forEach(deleteBtn => {
    deleteBtn.onclick = () => {
        contents.forEach(content => {
            content.classList.remove('open-action');
        });

        container.classList.add('open-delete');
    }
});