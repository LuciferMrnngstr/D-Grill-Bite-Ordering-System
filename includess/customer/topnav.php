<?php
    include_once '../classes/cart.class.php';

    $cart = new Cart;
?>

<div class="top">
    <div class="row1">
        <?php
            if($page_title == 'Home' || $page_title == 'Profile'){
                echo '<header>Welcome!</header>';
        
                echo '<img class="logo" src="../icons/mix/logo.svg">';
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
            else{
                include_once '../classes/notification.class.php';
                $notifications = new Notification;

                // Mark all notification as read when mark as read button clicked
                if(isset($_POST['mark_read'])){
                    if($notifications->markRead($_SESSION['user_id'], 'all')){
                        header('Refresh:0');
                    }
                }
        ?>
                <div class="right">
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
        <?php
            }
        ?>
    </div>  

    <?php 
        if(isset($_SESSION['user_id']) && isset($notifications)){
    ?>
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
    <?php
        }
    ?>
</div>