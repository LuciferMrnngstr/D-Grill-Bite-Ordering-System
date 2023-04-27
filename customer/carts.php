<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'My Cart';

    include_once '../classes/cart.class.php';

    $carts = new Cart;

    $num = $carts->checkEmpty($_SESSION['user_id'])[0];

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/topnav.php'; ?>

    <section class="cart">
        <?php
            if($carts->checkEmpty($_SESSION['user_id'])[0] <= 0){
        ?>
                <div class="cart-container empty">
                    <img src="../icons/items/empty.png">
                    <h4>I am empty :(</h4>
                    <p>Looks like you haven't added<br>anything to your cart yet</p>
                    <a href="home.php">Browse</a>
                </div>
        <?php
            }
            else {
        ?>
                <div class="cart-container">
                    <div class="food-wrapper">
                        <?php
                            foreach($carts->render($_SESSION['user_id']) as $cart){
                        ?>
                                <div class="content">
                                    <img src="../icons/items/tortang-talong-menu.png">

                                    <div class="description">
                                        <p class="name">Tortang Talong</p>
                                        <div>
                                            <div class="price-cont">
                                                <span>₱</span>
                                                <h4>4.00</h4>
                                            </div>
                                            <p>Quantity: 3</p>
                                        </div>
                                    </div>

                                    <span class="overlay"></span>
                                    
                                    <div class="food-modal">
                                        <div>
                                            <button class="edit">Edit</button>
                                            <button class="delete">Delete</button>
                                        </div>
                                    </div>

                                    <div class="action">
                                        <span class="dots"></span>
                                        <span class="dots"></span>
                                        <span class="dots"></span>
                                    </div>
                                
                                </div>
                        <?php
                            }
                        ?>
                    </div>

                    <div class="order-summary">

                    </div>

                    <a href="checkout.php" class="proceed-btn">PROCEED TO CHECKOUT</a>
                </div>
        <?php
            }
        ?>
    </section>
</div>

<script src="../script/carts.js"></script>
<?php
    if($_SESSION['logged_in'] != 'null'){
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>