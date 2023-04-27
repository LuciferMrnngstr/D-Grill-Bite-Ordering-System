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
    <?php include_once '../includess/customer/topnav.php'; ?>

    <section class="cart">
        <?php
            if($carts->checkEmpty($_SESSION['user_id'])[0] <= 0){
        ?>
                <div class="empty">
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
                                    <img src="../icons/items/<?= $cart['img'] ?>-menu.png">

                                    <div class="description">
                                        <p class="name"><?= $cart['name'] ?></p>
                                        <div>
                                            <div class="price-cont">
                                                <span>₱</span>
                                                <h4><?= $cart['price'] ?></h4>
                                            </div>
                                            <p>Quantity: <?= $cart['quantity'] ?></p>
                                        </div>
                                    </div>

                                    <div class="action">
                                        <span class="dots"></span>
                                        <span class="dots"></span>
                                        <span class="dots"></span>
                                    </div>

                                    <span class="overlay"></span>
                                    
                                    <div class="food-action-modal">
                                        <div>
                                            <button class="edit">Edit</button>
                                            <button class="delete">Delete</button>
                                        </div>
                                    </div>
                                
                                </div>
                        <?php
                            }
                        ?>
                    </div>

                    <div class="below">
                        <div class="order-summary">
                            <h3>ORDER SUMMARY</h3>
                            
                            <?php
                                $grandTotal = 0; //grand total declaration

                                foreach($carts->render($_SESSION['user_id']) as $cart){
                            ?>
                                    <div class="content">
                                        <p class="name"><?= $cart['name'] ?></p>
                                        <p class="times">&times;</p>
                                        <p class="quantity"><?= $cart['quantity'] ?></p>
                                        <div class="price-cont">
                                            <span>₱</span>    
                                            <h4><?= sprintf("%0.2f", $cart['price'] * $cart['quantity']) ?></h4>
                                        </div>
                                    </div>
                            <?php
                                    $grandTotal += ($cart['price'] * $cart['quantity']);
                                }
                            ?>
                            <div class="total">
                                <p>Grand total:</p>
                                <div class="price-cont">
                                    <span>₱</span>
                                    <h4><?= sprintf("%0.2f", $grandTotal) ?></h4>
                                </div>
                            </div>
                        </div>    
                        
                        <a href="checkouts.php" class="proceed-btn">PROCEED TO CHECKOUT</a>
                    </div>    
                </div>
        <?php
            }
        ?>

        <span class="overlay2"></span>

        <div class="edit-modal">
            <div class="content">
                <p class="name">Tortang Talong</p>
                <div class="quantity">
                    <p>Quantity: </p>
                    <div class="input-quantity">
                        <button type="button" id="decrease">-</button>
                        <input type="number" id="quantity" name="quantity" value="1">
                        <button type="button" id="increase">+</button>
                    </div>    
                </div>
                <div class="total">
                    <p>Total price:</p>
                    <div class="price-cont">
                        <span>₱</span>
                        <h4>4.00</h4>        
                    </div>
                </div>
                <div class="buttons">    
                    <button class="cancel">Cancel</button>
                    <button class="save">Save</button>
                </div>
            </div>
        </div>    

        <div class="delete-modal">
            <div class="content">
                <p>Are you sure you want to remove this item from your cart?</p>
                <div class="buttons">
                    <button class="save">Delete</button>
                    <button class="cancel">Cancel</button>
                </div>    
            </div>    
        </div>
    </section>
</div>

<script src="../script/carts.js"></script>
<?php
    if($_SESSION['logged_in'] != 'null'){
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>