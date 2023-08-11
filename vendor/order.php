<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Orders';
    $orders = 'active';

    include_once '../classes/order.class.php';

    $orderClass = new Order;

    if(isset($_GET['show-all']) && ($_GET['show-all'] === 'pending' || $_GET['show-all'] === 'preparing' || $_GET['show-all'] === 'ready for pickup')){
        // validation, to avoid errors and bugs
        $show_all = true;
        $show = $_GET['show-all'];
    }
    else{
        $show_all = false;
    }

    include_once '../includess/header.php'; //Header
?>

<div class="wrapper">
    <?php
        include_once '../includess/vendor/topnav.php'; //Top navbar
    ?>

    <section class="order">
    <div class="top-sect">
            <div class="search">
                <input type="text" name="search" placeholder="Search customer id">
                <a href="#">
                    <img src="../icons/mix/search.svg">
                </a>
            </div>
            
            <div class="sort-btn">Pending</div>
        </div>

        <div class="order-container">
            <?php
                // the all argument means that it will count all of the customer orders
                if($orderClass->countCustOrder('all')[0] <= 0) {
                    echo '<div class="empty"><h1>No pending or to be prepare orders as of now.</h1></div>';
                }
                else if($show_all === false){
                    foreach($orderClass->renderStatus() as $status){
                        if($status['order_status'] != 'released'){
            ?>
                            <div class="indicator">
                                <h1><?= strtoupper($status['order_status']) ?></h1>
                                <hr>
                            </div>

                            <div class="item-wrappers <?= $status['order_status'] ?>">
                                <div class="links-wrapper">
                                    <?php
                                        foreach($orderClass->renderOrdersVendor($status['order_status'], $show_all) as $order){
                                    ?>
                                            <!-- order_user_id variable is for storing the user who made the order -->
                                            <a href="order_info.php?order_user_id=<?= $order['user_id'] ?>&order_id=<?= $order['order_id'] ?>&status=<?= $order['order_status'] ?>" class="items">
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
                                    if($orderClass->countStatus($status['order_status'])[0] > 2){
                                        echo '<a href="order.php?show-all=' . $status['order_status'] . '" class="show-all">Show all</a>';
                                    }
                                ?>
                            </div>
            <?php
                        }
                    }
                }
                else{
            ?>
                    <div class="indicator">
                        <h1><?= strtoupper($show) ?></h1>
                        <hr>
                    </div>

                    <div class="item-wrappers <?= $show ?> show">
                        <div class="links-wrapper">
                            <?php
                                foreach($orderClass->renderOrdersVendor($show, $show_all) as $order){
                            ?>
                                    <a href="order_info.php?order_user_id=<?= $order['user_id'] ?>&order_id=<?= $order['order_id'] ?>&status=<?= $order['order_status'] ?>" class="items">
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
                        
                        <a href="order.php" class="show-all">Show less</a>
                    </div>
            <?php
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