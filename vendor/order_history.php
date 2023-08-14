<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Order History';
    $dashboard = 'active';

    include_once '../classes/order.class.php';
    include_once '../classes/order_item.class.php';

    $ordersClass = new Order;
    $order_items = new OrderItem;
    
    include_once '../includes/header.php';
?>

<div class="wrapper">
    <?php include_once '../includes/vendor/topnav.php'; ?>

    <section class="order-historyV">
        <div class="order-container">
            <div class="sales-report">
                <h1>Sales Report</h1>

                <div class="report">
                    <div class="indicator">
                        <h1>Today's Summary</h1>
                        <hr>
                    </div>

                    <div class="price-cont">
                        <span>₱</span>
                        <h4><?= $ordersClass->getSalesReport('today')[0] ?></h4>
                    </div>
                </div>

                <div class="report">
                    <div class="indicator">
                        <h1>This Week's Summary</h1>
                        <hr>
                    </div>

                    <div class="price-cont">
                        <span>₱</span>
                        <h4><?= $ordersClass->getSalesReport('week')[0] ?></h4>
                    </div>
                </div>

                <div class="report">
                    <div class="indicator">
                        <h1>This Month's Summary</h1>
                        <hr>
                    </div>

                    <div class="price-cont">
                        <span>₱</span>
                        <h4><?= $ordersClass->getSalesReport('month')[0] ?></h4>
                    </div>
                </div>
            </div>

        <?php
            //if order history is empty
            if($ordersClass->countCustOrderHistory('all')[0] < 1){
                echo '<div class="empty"><h1>Order history is empty.</h1></div>';
            }
            else{
        ?>
                    <div class="item-wrappers">
                        <h1>Order History</h1>

                        <?php
                            foreach($ordersClass->renderOrderHistoryStatus() as $status){
                                foreach($ordersClass->renderOrdersCustAll($status['order_status']) as $order){
                        ?>
                                    <a href="order_info.php?order_user_id=<?= $order['user_id'] ?>&order_id=<?= $order['order_id'] ?>&status=<?= $order['order_status'] ?>" class="items <?= $status['order_status'] . ' ' .  $order['payment_status']?>">
                                        <p class="status"><?= strtoupper($order['order_status']) ?></p>
                                        
                                        <div class="details">
                                            <p><?= $order['total_order'] ?> order</p>
                                            <p><?= $order['date'] ?></p>
                                            <p class="payment-status"><?= strtoupper($order['payment_status']) ?></p>
                                        </div>
                                        
                                        <div class="price-cont">
                                            <span>₱</span>
                                            <h4><?= $order['discounted_total'] ?></h4>
                                        </div>
                                    </a>
                        <?php
                                }
                            }
                        ?>
                    </div>
        <?php
            }
        ?>
        </div>
    </section>

    <?php
        include_once '../includes/vendor/navbar.php';
    ?>
</div>

<?php
    if($_SESSION['logged_in'] != 'null'){
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includes/footer.php';
?>