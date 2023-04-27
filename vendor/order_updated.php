<?php
    session_start();

    include_once '../../tools/variables.php';
    $page_title = 'Order Updated';
    $css = 'order_updated';
    $home = ' active';

    include_once '../../includes/header.php';
    include_once '../../includes/top.php';
    include_once '../../classes/food.class.php';
?>

    <div class="content">
        <div class="customer-details-cont">
            <div class="customer-container1">
                <img src="../../icons/profile.svg">
                <p class="cust-name">Abdulla, Julkipli N.</p>
                <p>STUDENT</p>
            </div>
            <div class="customer-container2">
                <div class="contact-cont">
                    <p>xt202003618@wmsu.edu.ph</p>
                    <p>09123456789</p>
                </div>
                <div class="order-date-cont">
                    <p class="label">ORDERED AT</p>
                    <p>8:37am | November 11, 2022</p>
                    <p class="label">FOR</p>
                    <p>12:00pm | November 11, 2022</p>
                </div>
            </div>
        </div>

        <div class="food-items-container">
            <div class="top-cont">
                <div class="more-btn">
                    <img src="../../icons/more.svg">
                </div>
            </div>

            <hr>

            <div class="food">
                <div class="food-product">
                    <img src="../../icons/items/adobong-atay-menu.png">
                    <div class="food-desc-cont">
                        <p>Adobong Atay</p>
                        <p>With Boiled Egg</p>
                    </div>
                </div>
                <p class="price"><span>₱</span>35.00</p>
            </div>
            
            <div class="food">
                <div class="food-product">
                    <img src="../../icons/items/adobong-atay-menu.png">
                    <div class="food-desc-cont">
                        <p>Adobong Atay</p>
                        <p>With Boiled Egg</p>
                    </div>
                </div>
                <p class="price"><span>₱</span>35.00</p>
            </div>

            <hr>

            <div class="bottom-cont">
                <p>TOTAL:</p>
                <p class="price"><span>₱</span>70.00</p>
            </div>

        </div>

        <a href="#" class="btn-round">MARK AS DONE</a>
    </div>

<?php
    include_once '../../includes/footer.php';
?>