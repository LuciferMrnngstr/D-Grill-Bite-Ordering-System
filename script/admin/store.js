// BANNER ACTION MODAL
const store = document.querySelector('.wrapper .store'),
    bannerAction = document.querySelector('.store .banner .action'),
    bannerOverlay = document.querySelector('.store .banner .overlay'),
    bannerEditBtn = document.querySelector('.banner .action-modal .edit'),
    banner = document.querySelector('.wrapper .store .banner');

bannerAction.onclick = () => {
    store.classList.add('open-banner-action');
}

bannerOverlay.onclick = () => {
    store.classList.remove('open-banner-action');
}

bannerEditBtn.onclick = () => {
    if (banner.classList.contains('active-edit')) {
        banner.classList.remove('active-edit');
        store.classList.remove('open-banner-action');
        bannerEditBtn.innerHTML = 'Edit Banner';
    }
    else {
        banner.classList.add('active-edit');
        store.classList.remove('open-banner-action');
        bannerEditBtn.innerHTML = 'Cancel Edit';
    }
}

// DISHES ACTION MODAL
const dishesAction = document.querySelector('.store .item-container .action'),
    dishesOverlay = document.querySelector('.store .item-container .overlay'),
    itemEditBtn = document.querySelector('.item-container .action-modal .edit'),
    item = document.querySelector('.wrapper .store .item-container');

dishesAction.onclick = () => {
    store.classList.add('open-dishes-action');
}

dishesOverlay.onclick = () => {
    store.classList.remove('open-dishes-action');
}

itemEditBtn.onclick = () => {
    if (item.classList.contains('active-edit')) {
        item.classList.remove('active-edit');
        store.classList.remove('open-dishes-action');
        itemEditBtn.innerHTML = 'Edit Dish';
    }
    else {
        item.classList.add('active-edit');
        store.classList.remove('open-dishes-action');
        itemEditBtn.innerHTML = 'Cancel Edit';
    }

    // item.classList.add('active-edit');
    // store.classList.remove('open-banner-action');
}