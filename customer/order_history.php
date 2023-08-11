<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Order History';

    include_once '../classes/order.class.php';
    include_once '../classes/order_item.class.php';

    $orders = new Order;
    $order_items = new OrderItem;
    
    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/customer/topnav.php'; ?>

    <section class="order-history">
        <?php
            //if order history is empty
            if($orders->countCustOrderHistory($_SESSION['user_id'])[0] < 1){
                echo '<div class="empty"><h1>Order history is empty.</h1></div>';
            }
            else{
        ?>
                <div class="order-container">
                    <div class="item-wrappers">
                        <?php
                            foreach($orders->renderOrderHistoryStatus() as $status){
                                foreach($orders->renderOrdersCust($_SESSION['user_id'], $status['order_status']) as $order){
                        ?>
                                    <a href="order_info.php?order_id=<?= $order['order_id'] ?>" class="items <?= $status['order_status'] . ' ' .  $order['payment_status']?>">
                                        <p class="status"><?= strtoupper($order['order_status']) ?></p>
                                        
                                        <div class="details">
                                            <p><?= $order['total_order'] ?> order</p>
                                            <p><?= $order['date'] ?></p>
                                            <p class="payment-status"><?= strtoupper($order['payment_status']) ?></p>
                                        </div>
                                        
                                        <div class="price-cont">
                                            <span>₱</span>
                                            <h4><?= $order['grand_total'] ?></h4>
                                        </div>
                                    </a>
                                    
                        <!-- <a href="#" class="items claimed paid">
                            <p class="status">CLAIMED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                                <p class="payment-status">PAID</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items claimed">
                            <p class="status">CLAIMED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                                <p class="payment-status">UNPAID</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items">
                            <p class="status">CANCELLED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items claimed">
                            <p class="status">CLAIMED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                                <p class="payment-status">UNPAID</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items">
                            <p class="status">CANCELLED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items claimed">
                            <p class="status">CLAIMED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                                <p class="payment-status">UNPAID</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items">
                            <p class="status">CANCELLED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items claimed">
                            <p class="status">CLAIMED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                                <p class="payment-status">UNPAID</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items">
                            <p class="status">CANCELLED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items claimed">
                            <p class="status">CLAIMED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                                <p class="payment-status">UNPAID</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a>

                        <a href="#" class="items">
                            <p class="status">CANCELLED</p>
                            
                            <div class="details">
                                <p>1 order</p>
                                <p>April 09, 2023</p>
                            </div>
                            
                            <div class="price-cont">
                                <span>₱</span>
                                <h4>24.00</h4>
                            </div>
                        </a> -->
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
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