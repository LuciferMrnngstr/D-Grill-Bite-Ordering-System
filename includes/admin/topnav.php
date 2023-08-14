<?php
    include_once '../classes/cart.class.php';

    $cart = new Cart;
?>

<div class="top">
    <div class="row1">
        <?php
            if($page_title == 'Dashboard'){
                echo '<header>Welcome!</header>';
        
                echo '<img class="logo" src="../icons/mix/logo.svg">';
            }
            else if($page_title == 'Profile' || $page_title == 'Store' || $page_title == 'Orders' || $page_title == 'Order History'){
                echo '<img src="../icons/mix/logo.svg">';
                
                echo '<header class="poppins">' . $page_title .'</header>';
            }
            else{
                if($page_title == 'Payment Method'){
                    echo '<a href="cart.php" class="back-btn"><img src="../icons/topnav/arrowleft.svg"></a>';
                }
                else if($page_title == 'Order Info'){
                    echo '<a href="order.php" class="back-btn"><img src="../icons/topnav/arrowleft.svg"></a>';
                }
                else{
                    echo '<a href="store.php" class="back-btn"><img src="../icons/topnav/arrowleft.svg"></a>';
                }  
        
                echo '<header class="food_name">' . $page_title . '</header>';
            }
        
        ?>

        <!-- Right corner of top navbar -->
        <div class="right">
            <?php
                if($page_title !== 'My Cart'){
            ?>
                    <a href="cart.php">
                        <img src="../icons/topnav/cart.svg">
                        <?php
                            if($cart->checkEmpty($_SESSION['user_id'])[0] > 0){
                                echo '<p class="cart_count">' . $cart->checkEmpty($_SESSION['user_id'])[0] . '</p>';
                            }
                        ?>
                    </a>
            <?php
                }

                include_once '../classes/notification.class.php';
                include_once '../classes/order.class.php';
                $notifications = new Notification;
                $order = new Order;

                // Mark all notification as read when mark as read button clicked
                if(isset($_POST['mark_read'])){
                    if($notifications->markRead($_SESSION['user_id'], 'all')){
                        header('Refresh:0');
                    }
                }
            ?>

            <button class="notif">
                <img src="../icons/topnav/notification.svg">

                <?php
                    // Shows unread notifications when there is
                    if($notifications->countUnread($_SESSION['user_id'])[0] > 0){
                        echo '<div class="unread_count"><span>' . $notifications->countUnread($_SESSION['user_id'])[0] . '</span></div>'; 
                    }
                ?>
            </button>
        </div>
    </div>  

    <!-- Notification overlay -->
    <span class="overlay"></span>
    
    <!-- Notification container -->
    <div class="modal-box notification">
    <form class="content <?php if($notifications->getAll($_SESSION['user_id']) === 'empty') echo 'empty' ?>" method="post">
            <?php
                if($notifications->getAll($_SESSION['user_id']) === 'empty'){
                    echo '<header>No notification as of now.</header>';
                }
                else{
                    foreach($notifications->getAll($_SESSION['user_id']) as $notification){
                        if($notification['type'] === 'place order' || $notification['type'] === 'update order'){

                            $href = 'order_info.php?order_id=' . $notification['order_id'] . '&notif_id=' . $notification['notif_id'] . '&read=' . $notification['notif_read'];
                            $img = '../icons/notification/orders.svg';
                        }
                        else if($notification['type'] === 'create dish' || $notification['type'] === 'edit dish' || $notification['type'] === 'delete dish'){
                            $href = 'food_details.php?food_id=' . $notification['food_id'] . '&notif_id=' . $notification['notif_id'] . '&read=' . $notification['notif_read'];
                            $img = '../icons/notification/cutlery.svg';
                        }
            ?>
                        <a href="<?= $href; ?>" class="<?php if($notification['notif_read'] == 1) echo 'read' ?>">
                            <img src="<?= $img ?>">
                            
                            <p><?= $notification['content'] ?><br></p>
                        </a>
            <?php
                    }
                }
            ?>

            <input type="submit" name="mark_read" value="Mark all as read">
        </form>
    </div>
</div>