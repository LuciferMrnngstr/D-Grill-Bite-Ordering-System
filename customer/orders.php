<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Orders';

    include_once '../classes/order.class.php';
    include_once '../classes/order_item.class.php';

    $orders = new Order;
    $order_item = new OrderItem;

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/customer/topnav.php'; ?>

    <section class="orders">
        <?php
            //if order is empty
            if($orders->countCustOrder($_SESSION['user_id'])[0] < 1){
                echo '<div class="empty"><h1>No order has been made yet.</h1></div>';
            }
            else{
        ?>
                <div class="order-container">
                    <?php
                        foreach($orders->renderStatus() as $status){
                    ?>
                            <div class="item-wrappers <?= $status['order_status'] ?>">
                                <?php
                                    foreach($orders->renderOrdersCust($_SESSION['user_id'], $status['order_status']) as $order){
                                ?>
                                        <a href="order_info.php?order_id=<?= $order['order_id'] ?>" class="items">
                                            <p class="status"><?= strtoupper($order['order_status']) ?></p>

                                            <div class="details">
                                                <p><?= $order['total_order'] ?> order</p>
                                                <p><?= $order['date'] ?></p>
                                                <p><?= $order['time'] ?></p>
                                            </div>

                                            <div class="price-cont">
                                                <span>₱</span>
                                                <h4><?= $order['grand_total'] ?></h4>
                                            </div>
                                        </a>
                                <?php
                                    }
                                ?>
                            </div>
                    <?php 
                        }
                    ?>
                </div>

                    <!-- <div class="item-wrappers pending">
                        <a href="order_info.php" class="items">
                            <p class="status">PENDING</p>

                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                            </div>

                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items">
                            <p class="status">PENDING</p>

                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                            </div>

                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>
                    </div>

                    <div class="item-wrappers preparing">
                        <a href="#" class="items">
                            <p class="status">PREPARING</p>

                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                            </div>

                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>
                    </div>

                    <div class="item-wrappers ready">
                        <a href="#" class="items">
                            <p class="status">READY FOR PICKUP</p>

                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                            </div>

                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>
                    </div> -->
        <?php
            }
        ?>
    </section>
</div>

<?php
    if($_SESSION['logged_in'] != 'null'){
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>