<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Order Info';

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/customer/topnav.php'; ?>

    <section class="order-info">
        <div class="top-content">
            <div class="info">
                <div class="left">
                    <p class="order-status">PREPARING</p>
                    <p class="payment-status">UNPAID</p>
                    <p class="payment-method">Cash (Walk-in)</p>
                </div>

                <div class="right">
                    <div class="details">
                        <p>NO. OF ORDERS:</p>
                        <p>5</p>
                    </div>

                    <div class="details">
                        <p>ORDER ID:</p>
                        <p class="id">12345</p>
                    </div>

                    <div class="order-date">
                        <p class="date">April 09, 2023</p>
                        <p class="label">ORDERED AT</p>
                    </div>
                </div>
            </div>

            <div class="food-items">
                <div class="items">
                    <img src="../icons/items/adobong-atay-menu.png">

                    <div class="description">
                        <p class="name">Tortang Talong</p>
                        <p class="quantity">QUANTITY: 2</p>
                    </div>

                    <div class="price-cont">
                        <span>₱</span>
                        <h4>25.00</h4>
                    </div>                
                </div>
                <div class="items">
                    <img src="../icons/items/adobong-atay-menu.png">

                    <div class="description">
                        <p class="name">Adobong Atay</p>
                        <p class="quantity">QUANTITY: 2</p>
                    </div>

                    <div class="price-cont">
                        <span>₱</span>
                        <h4>25.00</h4>
                    </div>                
                </div>
                <div class="items">
                    <img src="../icons/items/adobong-atay-menu.png">

                    <div class="description">
                        <p class="name">Adobong Atay</p>
                        <p class="quantity">QUANTITY: 2</p>
                    </div>

                    <div class="price-cont">
                        <span>₱</span>
                        <h4>25.00</h4>
                    </div>                
                </div>
                <div class="items">
                    <img src="../icons/items/adobong-atay-menu.png">

                    <div class="description">
                        <p class="name">Adobong Atay</p>
                        <p class="quantity">QUANTITY: 2</p>
                    </div>

                    <div class="price-cont">
                        <span>₱</span>
                        <h4>25.00</h4>
                    </div>                
                </div>
            </div>
        </div>

        <div class="below-content">
            <!-- <p class="instruction">Please refresh the page after recieving the order from the cashier.</p> -->

            <div class="order-summary">
                <h3>ORDER SUMMARY</h3>

                <div class="content">
                    <p class="name">Adobong Atay</p>
                    <p class="times">&times;</p>
                    <p class="quantity">2</p>
                    <div class="price-cont">
                        <span>₱</span>    
                        <h4>50.00</h4>
                    </div>
                </div>

                <div class="total">
                    <p>Grand total:</p>
                    <div class="price-cont">
                        <span>₱</span>
                        <h4>50.00</h4>
                    </div>
                </div>
            </div>    
            
            <!-- <a href="checkouts.php" class="mark">MARK AS RECIEVED</a> -->
        </div> 
    </section>
</div>

<?php
    if($_SESSION['logged_in'] != 'null'){
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>