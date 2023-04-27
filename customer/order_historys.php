<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Order History';

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/customer/topnav.php'; ?>

    <section class="order-history">
        <div class="empty"><h1>Order history is empty.</h1></div>

        <div class="order-container">
            <div class="item-wrappers">
                <a href="#" class="items claimed paid">
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
                </a>
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