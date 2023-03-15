<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'My Cart';
    $css = 'cart';
    $cart_nav = ' active';

    include_once '../includes/header.php';
    include_once '../includes/top.php';
    include_once '../classes/cart.class.php';
?>

<div class="content">
    <?php
        $carts = new Cart;

        foreach($carts->render($_SESSION['logged_in']) as $cart){
    ?>
            <div class="food-product-container">
                <div class="img-container">
                    <img src="../icons/items/<?= $cart['img'] ?>-menu.png">
                </div>

                <div class="food-description-container">
                    <p><?= $cart['name']; ?></p>
                    <p class="item-price"><span>₱</span><?= $cart['price']; ?></p>
                </div>

                <div class="action-container">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
    <?php
        }
    ?>
</div>

<?php
    include_once '../includes/navbar.php';
    include_once '../includes/footer.php';
?>