<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Orders';

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/customer/topnav.php'; ?>

    <section class="orders">
        <div class="empty"><h1>No order has been made yet.</h1></div>

        <div class="order-container">
            <div class="item-wrappers pending">
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