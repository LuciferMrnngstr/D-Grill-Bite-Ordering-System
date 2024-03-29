<div class="top">
    <div class="row1">
        <?php
            if($page_title == 'Home' || $page_title == 'Profile'){
                echo '<header>Welcome!</header>';
        
                echo '<img class="logo" src="../icons/logo/logo.svg">';
            }
            else{
                if($page_title == 'Payment Method'){
                    echo '<a href="cart.php" class="back-btn"><img src="../icons/topnav/arrowleft.svg"></a>';
                }
                else if($page_title == 'Order Info'){
                    echo '<a href="orders.php" class="back-btn"><img src="../icons/topnav/arrowleft.svg"></a>';
                }
                else{
                    echo '<a href="home.php" class="back-btn"><img src="../icons/topnav/arrowleft.svg"></a>';
                }  
        
                echo '<header class="food_name">' . $page_title . '</header>';
            }
        
            //Right corner of top navbar
            if($_SESSION['logged_in'] == 'null'){ //if customer didn't sign-in yet
                echo '<a class="sign-in-btn" href="login/login.php">Sign In</a>';
            }
            else{ //else will replace to a notification
                echo '<div class="right"><button class="notif"><img src="../icons/topnav/notification.svg"></button></div>';
            }
        ?>
    </div>  
    
    <!-- Notification overlay -->
    <span class="overlay"></span>
    
    <!-- Notification container -->
    <div class="modal-box notification">
        <div class="content empty">
            <header>No notification as of now.</header>
        </div>
    </div>
    
    <?php
        if($_SESSION['logged_in'] != 'null'){
            if($page_title == 'My Cart' || $page_title == 'Orders' || $page_title == 'Order History'){
    ?>
            <nav>
                <ul>
                    <li class="link <?php if($page_title == 'My Cart') echo 'active' ?>"><a href="cart.php">Cart</a></li>
                    <li class="link <?php if($page_title == 'Orders') echo 'active' ?>"><a href="orders.php">Orders</a></li>
                    <li class="link <?php if($page_title == 'Order History') echo 'active' ?>"><a href="order_history.php">Order History</a></li>
                </ul>
            </nav>
    <?php
            }
        }
    ?>
</div>