<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Orders';
    $orders = 'active';

    include_once '../classes/order.class.php';
    include_once '../classes/order_item.class.php';

    $orderClass = new Order;
    $order_item = new OrderItem;

    include_once '../includess/header.php'; //Header
?>

<div class="wrapper">
    <?php
        include_once '../includess/vendor/topnav.php'; //Top navbar
    ?>

    <section class="orders">
        <div class="top-sect">
            <div class="search">
                <input type="text" name="search" placeholder="Search customer id">
                <a href="#">
                    <img src="../icons/search.svg">
                </a>
            </div>
            
            <div class="sort-btn">Pending</div>
        </div>

        <div class="order-container">
            <?php
                foreach($orderClass->renderStatus() as $status){
                    if($status['order_status'] != 'released'){
            ?>
                        <div class="indicator">
                            <h1><?= strtoupper($status['order_status']) ?></h1>
                            <hr>
                        </div>

                        <div class="item-wrappers <?= $status['order_status'] ?>">
                            <?php
                                foreach($orderClass->renderOrdersVendor($status['order_status']) as $order){
                            ?>
                                    <a href="order_info.php?customer_id=<?= $order['user_id'] ?>&order_id=<?= $order['order_id'] ?>&status=<?= $order['order_status'] ?>" class="items">
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
                }
            ?>
        </div>
    </section>
    
    <?php
        include_once '../includess/vendor/navbar.php';
    ?>
</div>

<script src="../script/notification.js"></script>
<script src="../script/admin/store.js"></script>

<?php
    include_once '../includess/footer.php';
?>