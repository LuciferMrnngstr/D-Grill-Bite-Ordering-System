// EDIT AND DELETE ACTION
const actionBtns = document.querySelectorAll('.cart-container .content .action'),
    contents = document.querySelectorAll('.wrapper section .content'),
    overlays = document.querySelectorAll('.cart-container .content .overlay');

actionBtns.forEach(actionBtn => {
    actionBtn.onclick = () => {
        contents.forEach(content => {
            content.classList.remove('open-action');
        });

        actionBtn.parentElement.classList.add('open-action');
        // actionBtns.forEach(actionBtn => {
        //     content.classList.remove('open-action');
        // });

        // contents.classList.add('open-action');
    }
});

// actionBtn.onclick = () => {
//     section.classList.add('open-action');
// }

overlays.forEach(overlay => {
    overlay.onclick = () => {
        contents.forEach(content => {
            content.classList.remove('open-action');
        });
        // contents.classList.remove('open-action');
    }
});