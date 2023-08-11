<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Order Info';

    if(!isset($_GET['order_id']) || !isset($_SESSION['user_id']) || !isset($_GET['order_user_id'])){
        header('location: order.php');
    }

    include_once '../classes/order.class.php';
    include_once '../classes/order_item.class.php';
    include_once '../classes/notification.class.php';

    $orders = new Order;
    $order_items = new OrderItem;
    $notifications = new Notification;

    $order_info = $orders->renderOrder($_GET['order_id'], $_GET['order_user_id']);

    if(isset($_POST['prepare'])){
        if($orders->updatePrepare($order_info['order_id'])){
            if($notifications->updateOrderStatus($_SESSION['user_type'], $_SESSION['user_id'], $_SESSION['logged_in'], $order_info['order_id'], 'prepare')){
                header('location: order.php');
            }
        }
    }
    else if(isset($_POST['ready'])){
        if($orders->updatePickup($order_info['order_id'])){
            if($notifications->updateOrderStatus($_SESSION['user_type'], $_SESSION['user_id'], $_SESSION['logged_in'], $order_info['order_id'], 'ready to pickup')){
                header('location: order.php');
            }
        }
    }
    else if(isset($_POST['release'])){
        if($notifications->updateOrderStatus($_SESSION['user_type'], $_SESSION['user_id'], $_SESSION['logged_in'], $order_info['order_id'], 'release')){
            header('location: order.php');
        }
    }
    else if(isset($_POST['paid'])){
        if($orders->updatePaid($order_info['order_id'])){
            //refresh the page after updating the paid status
            if($notifications->updateOrderStatus($_SESSION['user_type'], $_SESSION['user_id'], $_SESSION['logged_in'], $order_info['order_id'], 'paid')){
                header('Refresh:0');
            }
        }
    }

    include_once '../includess/header.php';

    // Notification read update
    if(isset($_GET['notif_id']) && isset($_GET['read']) && ($_GET['read'] == 0)){
        $notifications->markRead($_GET['notif_id'], 'solo');
    }
?>

<div class="wrapper">
    <?php include_once '../includess/vendor/topnav.php'; ?>

    <form class="order-info" method="post">
        <div class="top-content">
            <div class="info">
                <div class="left">
                    <p class="order-status <?= $order_info['order_status'] ?>"><?= strtoupper($order_info['order_status']) ?></p>
                    <p class="payment-status <?= $order_info['payment_status'] ?>"><?= strtoupper($order_info['payment_status']) ?></p>
                    <p class="payment-method"><?= $order_info['payment_method'] ?></p>
                </div>

                <div class="right">
                    <div class="details">
                        <p><?= $order_info['last_name'] . ', ' . $order_info['first_name'] . ' ' . $order_info['last_name'] ?></p>
                    </div>

                    <div class="details" style="justify-content: center">
                        <p><?= $order_info['contact_no'] ?></p>
                    </div>

                    <div class="details">
                        <p>NO. OF ORDERS:</p>
                        <p><?= $order_info['total_order'] ?></p>
                    </div>

                    <div class="details">
                        <p>ORDER ID:</p>
                        <p class="id"><?= $order_info['order_id'] ?></p>
                    </div>

                    <div class="order-date">
                        <p class="date"><?= $order_info['date'] ?></p>
                        <p class="date"><?= $order_info['time'] ?></p>
                        <p class="label">ORDERED AT</p>
                    </div>
                </div>
            </div>

            <div class="food-items">
                <?php
                    foreach($order_items->render($_GET['order_id'], $_GET['order_user_id']) as $order_item){
                ?>
                        <div class="items">
                            <img src="../icons/uploads/dishes/<?= $order_item['img'] ?>">

                            <div class="description">
                                <p class="name"><?= $order_item['name'] ?></p>
                                <p class="quantity">QUANTITY: <?= $order_item['quantity'] ?></p>
                            </div>

                            <div class="price-cont">
                                <span>₱</span>
                                <h4><?= $order_item['price'] ?></h4>
                            </div>                
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>

        <div class="below-content">
            <!-- <p class="instruction">Please refresh the page after recieving the order from the cashier.</p> -->

            <div class="order-summary">
                <h3>ORDER SUMMARY</h3>
                <?php
                    $grandTotal = 0; //grand total declaration

                    foreach($order_items->render($_GET['order_id'], $_GET['order_user_id']) as $order_item){
                ?>
                        <div class="content">
                            <p class="name"><?= $order_item['name'] ?></p>
                            <p class="times">&times;</p>
                            <p class="quantity"><?= $order_item['quantity'] ?></p>
                            <div class="price-cont">
                                <span>₱</span>    
                                <h4><?= sprintf("%0.2f", $order_item['price'] * $order_item['quantity']) ?></h4>
                            </div>
                        </div>
                <?php
                        $grandTotal += ($order_item['price'] * $order_item['quantity']);
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
            
            <?php
                if($_GET['status'] === 'pending'){
                    echo '<button type="button" class="mark">PREPARE ORDER</button>';
                }
                else if($_GET['status'] === 'preparing'){
                    echo '<button type="button" class="mark">MARK AS READY TO PICKUP</button>';
                }
                else if($_GET['status'] === 'ready for pickup'){
                    if($order_info['payment_status'] === 'unpaid'){
                        echo '<button type="button" class="mark-paid">MARK AS PAID</button>';
                    }
                    echo '<button type="button" class="mark">RELEASE ORDER</button>';
                }
                else if(($_GET['status'] === 'claimed' || $_GET['status'] === 'released') && $order_info['payment_status'] === 'unpaid'){
                    echo '<button type="button" class="mark-paid">MARK AS PAID</button>';
                }
            ?>
        </div>

        <span class="overlay"></span>

        <div class="confirmation-modal confirm1">
            <div class="content">
                <p>Are you sure you want to mark this order as paid?</p>
                <div class="buttons">
                    <input type="submit" class="save" name="paid" value="Proceed">
                    <button type="button" class="cancel">Cancel</button>
                </div>    
            </div>    
        </div>

        <div class="confirmation-modal confirm2">
            <div class="content">
                <p>Are you sure you want to proceed with this action?</p>
                <div class="buttons">
                    <!-- For updatig the order status -->
                    <input type="submit" class="save" 
                    name="<?php 
                    if($_GET['status'] === 'pending'){ echo 'prepare'; } 
                    else if($_GET['status'] === 'preparing'){ echo 'ready'; }
                    else if($_GET['status'] === 'ready for pickup'){ echo 'release'; }
                    ?>" 
                    value="Proceed">
                    
                    <button type="button" class="cancel">Cancel</button>
                </div>    
            </div>    
        </div>
    </form>
</div>

<script src="../script/notification.js"></script>
<script src="../script/admin/order-info.js"></script>

<?php
    include_once '../includess/footer.php';
?>