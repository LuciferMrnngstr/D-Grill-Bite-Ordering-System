<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'My Cart';

    include_once '../classes/cart.class.php';

    $carts = new Cart;

    $num = $carts->checkEmpty($_SESSION['user_id'])[0];

    include_once '../includess/header.php';

    if(isset($_POST['delete']) && isset($_POST['delete_id'])){
        if($carts->remove($_POST['delete_id'], 'single')){
            header('location: cart.php?delete-message="success"');
        }
    }
    else if (isset($_POST['edit']) && isset($_POST['cart-id']) && isset($_POST['quantity'])){
        if($carts->updateQuantity(htmlentities($_POST['cart-id']), $_SESSION['user_id'], htmlentities($_POST['quantity']))){
            header('location: cart.php?edit-message="success"');
        }
    }
?>

<div class="wrapper">
    <?php include_once '../includess/customer/topnav.php'; ?>

    <form class="cart" method="post">
        <?php
            if($carts->checkEmpty($_SESSION['user_id'])[0] <= 0){
        ?>
                <div class="empty">
                    <img src="../icons/mix/empty.png">
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
                                <div class="content" id="item<?= $cart['cart_id'] ?>">
                                    <img src="../icons/uploads/dishes/<?= $cart['img'] ?>">

                                    <div class="description">
                                        <p class="name"><?= $cart['name'] ?></p>
                                        <div>
                                            <div class="price-cont">
                                                <span>₱</span>
                                                <h4><?= $cart['price'] ?></h4>
                                            </div>
                                            <p>Quantity: <?= $cart['quantity'] ?></p>

                                            <!-- for edit quantity -->
                                            <input type="hidden" class="quantity" value="<?= $cart['quantity'] ?>">
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
                                            <button type="button" class="edit" data-id="item<?= $cart['cart_id'] ?>" cart-id="<?= $cart['cart_id'] ?>">Edit</button>
                                            <button type="button" class="delete" id="<?= $cart['cart_id'] ?>" data-name="<?= $cart['name'] ?>">Delete</button>
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
                        
                        <a href="checkout.php" class="proceed-btn">PROCEED TO CHECKOUT</a>
                    </div>    
                </div>
        <?php
            }
        ?>

        <span class="overlay2"></span>

        <div class="edit-modal">
            <div class="content">
                <input type="hidden" class="cart-id" name="cart-id">
                <p class="name">Item Name</p>
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
                        <input type="hidden" class="total-price" name="total-price">  
                    </div>
                </div>
                <div class="buttons">    
                    <button type="button" class="cancel">Cancel</button>
                    <button type="submit" class="save" name="edit">Save</button>
                </div>
            </div>
        </div>    

        <div class="delete-modal">
            <div class="content">
                <input type="hidden" name="delete_id">
                <p>Are you sure you want to remove this item from your cart?</p>
                <div class="buttons">
                    <button type="submit" class="save" name="delete">Delete</button>
                    <button type="button" class="cancel">Cancel</button>
                </div>    
            </div>    
        </div>
    </form>
</div>

<script src="../script/cart.js"></script>
<?php
    if($_SESSION['logged_in'] != 'null'){
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>