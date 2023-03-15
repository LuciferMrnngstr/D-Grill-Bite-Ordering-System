<div class="top">
    <?php
        if($page_title == 'My Cart' || $css == 'food_details' || $page_title == 'Meraki | Payment' || $page_title == 'Order Details'){
    ?>
            <a href="<?php if($page_title == 'Meraki | Payment') echo 'cart.php'; else if($page_title == 'Order Details') echo 'order.php'; else echo 'home.php'; ?>" class="back-btn">Go Back</a>
            <p><?php if($page_title == 'Meraki | Payment') echo 'PAYMENT METHOD'; else echo $page_title; ?></p>
    <?php
            if(!isset($_SESSION['logged_in'])){
                echo '<a href="../login/login.php" class="submit-btn">Sign in</a>';
            }
            else{
                echo '<a href="#"><img src="../icons/notification.svg"></a>';
            }
        }
        else{
            if($page_title == 'Home' || $css == 'vendor_home'){
                echo '<p>Welcome!</p>';
            }
            else if($css == 'food_details' || $css == 'order_details'){
                echo '<a href="home.php" class="back-btn">Go Back</a>';
            }
            else{
                echo '<p>' . $page_title . '</p>';
            }

            if($page_title == 'Order Details'){
                echo '<h1>ORDER</h1>';
            }
            else{
                echo '<img src="../icons/logo/logo.svg" class="logo">';
            }

            if(!isset($_SESSION['logged_in'])){
                echo '<a href="login/login.php" class="submit-btn">Sign in</a>';
            }
            else{
                if($css == 'food_details'){
                    echo '<a href="#"><img src="../icons/items/heart-empty.svg"></a>';
                }
                else{
                    echo '<a href="#"><img src="../icons/notification.svg"></a>';
                }
            }
        }
    ?>
</div>