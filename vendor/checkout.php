<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Payment Method';

    include_once '../classes/cart.class.php';
    include_once '../classes/customer.class.php';
    include_once '../classes/order.class.php';
    include_once '../classes/order_item.class.php';
    include_once '../classes/notification.class.php';

    $carts = new Cart;
    $customers = new Customer;
    $order = new Order;
    $order_item = new OrderItem;
    $notification = new Notification;

    $customer = $customers->renderInfo($_SESSION['logged_in']);

    if($carts->checkEmpty($_SESSION['user_id'])[0] < 1){ // if cart is empty or no items
        header('location: home.php'); // head here
    }

    if(isset($_POST['submit'])){
        $first = true; // get the first iteration and create an order id
        foreach($carts->render($_SESSION['user_id']) as $cart){
            if($first){
                $order->addOrder($_SESSION['user_id'], $_POST['total-order'], $_POST['grand-total']);

                $first = false; // set to false so that it will not iterate the whole array
            }

            $order_item->addOrderItems($_SESSION['user_id'], $cart['food_id'], $cart['quantity']);
        }

        $carts->remove($_SESSION['user_id'], 'all'); // empty cart after making an order
        $notification->placeOrder($_SESSION['user_type'], $_SESSION['user_id'], $_SESSION['logged_in']); //Create notification

        header ('location: store.php');
    }

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


            <form class="below" method="post">
                <div class="order-summary">
                    <h3>ORDER SUMMARY</h3>
                    
                    <?php
                        $grandTotal = 0; //grand total declaration
                        $totalOrder = 0; //total order declaration

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
                            $totalOrder += $cart['quantity'];
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
                
                <!-- Get the grand quantity of the items in the cart -->
                <input type="hidden" name="total-order" value="<?= $totalOrder ?>">
                <!-- Get the grand quantity of the items in the cart -->
                <input type="hidden" name="grand-total" value="<?= $grandTotal ?>">
                
                <input type="submit" class="proceed-btn" name="submit" value="PLACE ORDER">
            </form>    
        </div>
    </section>
</div>

<?php
    if($_SESSION['logged_in'] != 'null'){
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>