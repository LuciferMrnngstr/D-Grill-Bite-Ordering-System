<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Meraki | Payment';
    $css = 'cart';
    $cart_nav = ' active';

    include_once '../includes/header.php';
    include_once '../includes/top.php';
    include_once '../classes/cart.class.php';
    include_once '../classes/order.class.php';
    include_once '../classes/order_item.class.php';

    $carts = new Cart;
    $order = new Order;
    $order_item = new OrderItem;
        
    if(isset($_SESSION['logged_in'])){
        $customer_id = $_SESSION['logged_in'];
    }
    else{
        $customer_id = 'NULL';
    }

    $grand_total = 0;
    $totalItem = $carts->checkEmpty($_SESSION['user_id']);

    // popup removed from cart   
    if(isset($_SESSION['itemRemoved'])){
        $itemRemoved = $_SESSION['itemRemoved'];
    }
    else{
        $itemRemoved = '';
    }

    if($totalItem[0] == 0){
        header('location: cart.php');
    }
    else{
?>
        <form method="post" class="content checkout">
<?php
            // For counting number of items in cart
            $count = 0;

            foreach($carts->render($_SESSION['user_id']) as $cart){
                // $grand_total = $grand_total + $cart['sub_total'];
                if(isset($_POST['submit'])){
                    if(isset($_POST['payment'])){
                        $count ++; //Start counting of items

                        //Add items to order
                        if($count == 1){
                            $order->addOrder($_SESSION['user_id'], $totalItem[0], $_POST['grand_total']);
                        }

                        $order_item->addOrderItems($_SESSION['user_id'], $cart['food_id']);

                        //Updating cart
                        if($totalItem[0] == $count){
                            $carts->remove($_SESSION['user_id'], 'all');
                            header('location: checkout.php');
                        }
                    }
                }
            }
?>
            <div class="payment-wrapper">
                <div class="walk-in-option-container">
                    <input type="radio" name="payment" value="walk-in" checked>
                    <p>Cash (Walk-in Payment)</p>
                </div>
                <div class="gcash-option-container">
                    <div class="gcash-option">
                        <input type="radio" name="payment" value="gcash">
                        <p>GCash (Online Payment)</p>
                    </div>
                    <div class="cust-info">
                        <p>Complete Name: </p>
                        <p>Faseeh K. Aukasa</p>
                    </div>
                    <div class="cust-info">
                        <p>Contact No.: </p>
                        <p>09123456789</p>
                    </div>
                    <div class="screen-shot-container">
                        <p>Please attach image(screenshot) of<br>your payment reciept here.</p>
                        <img src="../icons/upload-img.png">
                    </div>
                    <div class="not-available">
                        <p>GCASH PAYMENT METHOD IS NOT YET AVAILABLE :(</p>
                    </div>
                </div>
            </div>

            <div class="order-summary-container">
                <h3>ORDER SUMMARY</h3>

                <?php
                    $i = 0; //FOR INCREMENT, USED TO DISPLAY SINCE I DON'T KNOW HOW TO COMBINE 2 SELECT STATEMENTS WITH DIFFERENT COLUMN :)
                    $quantity = $carts->renderSummary('quantity', $_SESSION['user_id']);

                    foreach($carts->renderSummary('names', $_SESSION['user_id']) as $cart){
                ?>
                
                    <div class="summary-row">
                        <div class="description">
                            <div class="food-name">
                                <p><?= $cart['name']; ?></p>
                            </div>
                            <p>x</p>
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

                <hr>

                <div class="summary-row">
                    <div class="description">
                        <h4>Grand Total:</h4>
                    </div>
                    <div class="price-cont">
                        <span>₱</span>
                        <h4 class="price"><?= $grand_total; ?></h4>
                        <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                    </div>
                </div>
            </div>

            <input type="submit" name="submit" class="submit-btn" value="PLACE ORDER">
        </form>
<?php
    }

    include_once '../includes/footer.php';
?>