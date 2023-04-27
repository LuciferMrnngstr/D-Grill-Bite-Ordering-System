<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Payment Method';

    include_once '../classes/cart.class.php';
    include_once '../classes/customer.class.php';

    $carts = new Cart;
    $customers = new Customer;

    $num = $carts->checkEmpty($_SESSION['user_id'])[0];
    $customer = $customers->renderInfo($_SESSION['logged_in']);

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/customer/topnav.php'; ?>

    <section class="checkout">
        <div class="checkout-container">
            <div class="payment">
                <div class="walkin">
                    <input id="walkin" type="radio" name="payment" value="walk-in" checked>
                    <label for="walkin">Cash (Walk-in Payment)</label>
                </div>
                <div class="gcash">
                    <div class="select">
                        <input id="gcash" type="radio" name="payment" value="gcash">
                        <label for="gcash">GCash (Online Payment)</label>
                    </div>

                    <div class="description">
                        <p>Complete name:</p>
                        <p><?= $customer['last_name'], ', ', $customer['first_name'], ' ', $customer['middle_name'] ?></p>
                    </div>

                    <div class="description">
                        <p>Mobile number:</p>
                        <p><?= $customer['contact_no'] ?></p>
                    </div>

                    <div class="upload">
                        <p>Please attach image(screenshot) of<br>your payment reciept here.</p>
                        <img src="../icons/upload-img.png">
                    </div>

                    <div class="not-available">
                        <p>GCASH PAYMENT METHOD IS NOT YET AVAILABLE :(</p>
                    </div>
                </div>
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
                
                <a href="checkouts.php" class="proceed-btn">PLACE ORDER</a>
            </div>    
        </div>
    </section>
</div>

<?php
    if($_SESSION['logged_in'] != 'null'){
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>