<?php
    session_start();

    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'vendor'){
        header('location: ../customer/home.php');
    }

    unset($_SESSION['customer_id'], $_SESSION['customer_id']);

    include_once '../tools/variables.php';
    $page_title = 'Meraki | Orders';
    $css = 'vendor_home';
    $home = ' active';

    include_once '../includes/header.php';
    include_once '../includes/top.php';
    include_once '../classes/order.class.php';

    $orders = new Order;
?>

<div class="content">
    <div class="heading">
        <h3>ORDERS</h3>
        <button class="btn3">PENDING</button>
        <button class="btn4"><img src="../icons/search.svg"></button>
    </div>

    <!-- Render all orders -->
    <?php
        if($orders->countCustOrder('all')[0] > 0){ //count all orders
            foreach($orders->renderStatus() as $status){
    ?>
                <div class="title-with-line-cont">
                    <h1><?= strtoupper($status['status']); ?></h1>
                    <hr>
                </div>
            <?php
                foreach($orders->custDetail('', $status['status'], 'vendor') as $order){
                    if($status['status'] == 'pending'){ //directory for pending orders
                        echo '<a href="order_pending.php?customer_id='.$order['customer_id'].'&order_id='.$order['order_id'].'&status='.$order['status'].'" class="order-items '.$status['status'].'">';
                    }
                    else if($status['status'] == 'preparing'){ //directory for preparing orders
                        echo '<a href="order_preparing.php?customer_id='.$order['customer_id'].'&order_id='.$order['order_id'].'&status='.$order['status'].'" class="order-items '.$status['status'].'">';
                    }
                    else if($status['status'] == 'ready for pickup'){ //directory for pickup orders
                        echo '<a href="order_ready.php?customer_id='.$order['customer_id'].'&order_id='.$order['order_id'].'&status='.$order['status'].'" class="order-items '.$status['status'].'">';
                    }
            ?>
                            <div class="cont1">
                                <p><?= $order['last_name'] . ', ' . $order['first_name'] . ' ' . $order['middle_name']; ?></p>
                                <p><?= strtoupper($order['cust_type']); ?></p>
                            </div>
                            <div class="cont2">
                                <!-- Displays number of order per customer -->
                                <p><?= $order['quantity']; if($order['quantity'] == 1) echo ' order'; else echo ' orders'; ?></p>
                                <p>FOR: 02-14-2023</p>
                                <p>8:37 AM</p>
                            </div>
                            <div class="price-cont">
                                <span>₱</span>
                                <h4 class="price"><?= $order['grand_total']; ?></h4>
                            </div>
                        </a>
    <?php
                }
            }
        }
        else{
            echo 'no order for today';
        }
    ?>
</div>

<?php
    include_once '../includes/vendor_nav.php';
    include_once '../includes/footer.php';
?>