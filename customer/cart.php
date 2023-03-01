<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'My Cart';
    $css = 'cart';

    include_once '../includes/header.php';
    include_once '../includes/top2.php';
    include_once '../classes/cart.class.php';
    include_once '../classes/order.class.php';

    $carts = new Cart;
    $order = new Order;
        
    if(isset($_SESSION['logged_in'])){
        $customer_id = $_SESSION['logged_in'];
    }
    else{
        $customer_id = 'NULL';
    }
    
    $grand_total = 0;
    $totalItem = $carts->checkEmpty($customer_id);
    
    // popup removed from cart   
    if(isset($_SESSION['itemRemoved'])){
        $itemRemoved = $_SESSION['itemRemoved'];
    }
    else{
        $itemRemoved = '';
    }

    if(isset($_GET['remove'])){
        if($carts->remove($_GET['remove'], 'manual')){
            $_SESSION['itemRemoved'] = 'Food Removed from Cart';
            header('location: cart.php');
        }
    }

    if($totalItem[0] == 0){
?>
        <div class="content empty">

            <?php
                if(!empty($itemRemoved)){
                    echo '<div class="message active" onclick="this.remove();">' . $itemRemoved .'<p></p></div>';
                    unset($_SESSION['itemRemoved']);
                }
            ?>

            <img src="../icons/items/empty.png">
            <h4>I am empty :(</h4>
            <p>Looks like you haven't added<br>anything to your cart yet</p>
            <a href="home.php" class="btn-round">Browse</a>
        </div>        

<?php
        }
    else{
?>
        <div class="content">
            <div class="food-wrapper">
<?php
                if(!empty($itemRemoved)){
                    echo '<div class="message active" onclick="this.remove();">' . $itemRemoved .'<p></p></div>';
                    unset($_SESSION['itemRemoved']);
                }

                foreach($carts->render($customer_id) as $cart){
?>
                        <div class="food-product-container">
                            <div class="img-container">
                                <img src="../icons/items/<?= $cart['img']?>-menu.png">
                            </div>
                            
                            <div class="food-description-container">
                                <input type="hidden" name="cart_id" value="<?= $cart['cart_id']; ?>">
                                <p><?= $cart['name']; ?></p>
                                <div class="price-cont">
                                    <span>₱</span>
                                    <h4 class="price"><?= $cart['price']; ?></h4>
                                </div>
                            </div>

                            <a href="cart.php?remove=<?= $cart['cart_id']; ?>" class="action-container" 
                                onclick="return confirm('remove item from the cart?');">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
<?php
                }
?>
            </div>

            <div class="order-summary-container">
                <h3>ORDER SUMMARY</h3>

                <?php
                    $i = 0; //FOR INCREMENT, USED TO DISPLAY SINCE I DON'T KNOW HOW TO COMBINE 2 SELECT STATEMENTS WITH DIFFERENT COLUMN :)
                    $quantity = $carts->renderSummary('quantity', $customer_id);

                    foreach($carts->renderSummary('names',$customer_id) as $cart){
                ?>
                
                    <div class="summary-row">
                        <div class="description">
                            <div class="food-name">
                                <p><?= $cart['name']; ?></p>
                            </div>
                            <p>&times;</p>
                            <p><?= $quantity[$i][0]; ?></p>
                        </div>
                        <div class="price-cont">
                            <span>₱</span>
                            <h4 class="price"><?= $sub_total = $cart['price'] * $quantity[$i][0]; ?></h4>
                        </div>
                    </div>

                <?php
                        $grand_total = $grand_total + $sub_total;
                        $i++;
                    }
                ?>

                <!-- <div class="summary-row">
                    <div class="description">
                        <div class="food-name">
                            <p>Adobong Atay</p>
                            <p class="adds-on">with boiled egg</p>
                        </div>
                        <p>x</p>
                        <p>4</p>
                    </div>
                    <div class="price-cont">
                        <span>₱</span>
                        <h4 class="price">3.00</h4>
                    </div>
                </div> -->

                <hr>

                <div class="summary-row">
                    <div class="description">
                        <h4>Grand Total:</h4>
                    </div>
                    <div class="price-cont">
                        <span>₱</span>
                        <h4 class="price"><?= $grand_total; ?></h4>
                    </div>
                </div>
            </div>

            <a href="checkout.php" class="submit-btn">PROCEED TO CHECKOUT</a>
        </div>
<?php
    }
    
    include_once '../includes/footer.php';
?>