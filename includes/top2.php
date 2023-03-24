<div class="top2">
    <div class="row1">
<?php
    // left side and middle
    if($page_title == 'Home'){
        echo '<p>Welcome!</p>';

        echo '<img src="../icons/logo/logo.svg" class="logo">'; //displays logo
    }
    else{
        echo '<a href="home.php" class="back-btn">Go Back</a>';

        echo '<p>'.$page_title.'</p>'; //displays page title
    }

    //right side
    if($_SESSION['logged_in'] == 'null'){ //if customer didn't sign-in yet
        echo '<a href="login/login.php" class="submit-btn">Sign in</a>';
    } //else will replace to a notification
    else{
        echo '<a href="#" class="notif"><img src="../icons/notification.svg"></a>';
    }
?>
    </div>

<?php
    // for cart, order, and order history
    if($page_title == 'My Cart' || $page_title == 'Order' || $page_title == 'Order History'){
?>
        <nav class="top-nav">
            <ul>
                <li class="link <?php if($page_title == 'My Cart') echo 'active' ?>"><a href="cart.php">CART</a></li>
                <li class="link <?php if($page_title == 'Order') echo 'active' ?>"><a href="order.php">ORDER</a></li>
                <li class="link <?php if($page_title == 'Order History') echo 'active' ?>"><a href="order_history.php">ORDER HISTORY</a></li>
            </ul>
        </nav>
<?php
    }
?>
</div>