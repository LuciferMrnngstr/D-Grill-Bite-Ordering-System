<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Order Info';

    if(!isset($_GET['order_id']) || !isset($_SESSION['user_id'])){
        header('location: home.php');
    }

    include_once '../classes/order.class.php';
    include_once '../classes/order_item.class.php';

    $orders = new Order;
    $order_items = new OrderItem;

    $order_info = $orders->renderOrder($_GET['order_id'], $_GET['customer_id']);

    if(isset($_POST['prepare'])){
        if($orders->updatePrepare($order_info['order_id'])){
            header('location: orders.php');
        }
    }
    else if(isset($_POST['ready'])){
        if($orders->updatePickup($order_info['order_id'])){
            header('location: orders.php');
        }
    }
    else if(isset($_POST['paid'])){
        if($orders->updatePaid($order_info['order_id'])){
            header('Refresh:0');
        }
    }
    else if(isset($_POST['release'])){
        if($orders->releaseOrder($order_info['order_id'])){
            header('location: orders.php');
        }
    }

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/customer/topnav.php'; ?>

    <section class="order-info">
        <div class="top-content">
            <div class="info">
                <div class="left">
                    <p class="order-status <?= $order_info['order_status'] ?>"><?= strtoupper($order_info['order_status']) ?></p>
                    <p class="payment-status <?= $order_info['payment_status'] ?>"><?= strtoupper($order_info['payment_status']) ?></p>
                    <p class="payment-method"><?= $order_info['payment_method'] ?></p>
                </div>

                <div class="right">
                    <div class="details">
                        <p><?= $order_info['last_name'] . ', ' . $order_info['first_name'] . ' ' . $order_info['last_name'] ?></p>
                    </div>

                    <div class="details" style="justify-content: center">
                        <p><?= $order_info['contact_no'] ?></p>
                    </div>

                    <div class="details">
                        <p>NO. OF ORDERS:</p>
                        <p><?= $order_info['total_order'] ?></p>
                    </div>

                    <div class="details">
                        <p>ORDER ID:</p>
                        <p class="id"><?= $order_info['order_id'] ?></p>
                    </div>

                    <div class="order-date">
                        <p class="date"><?= $order_info['date'] ?></p>
                        <p class="date"><?= $order_info['time'] ?></p>
                        <p class="label">ORDERED AT</p>
                    </div>
                </div>
            </div>

            <div class="food-items">
                <?php
                    foreach($order_items->render($_GET['order_id'], $_GET['customer_id']) as $order_item){
                ?>
                        <div class="items">
                            <img src="../icons/items/<?= $order_item['img'] ?>-menu.png">

                            <div class="description">
                                <p class="name"><?= $order_item['name'] ?></p>
                                <p class="quantity">QUANTITY: <?= $order_item['quantity'] ?></p>
                            </div>

                            <div class="price-cont">
                                <span>₱</span>
                                <h4><?= $order_item['price'] ?></h4>
                            </div>                
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>

        <form class="below-content" method="post">
            <!-- <p class="instruction">Please refresh the page after recieving the order from the cashier.</p> -->

            <div class="order-summary">
                <h3>ORDER SUMMARY</h3>
                <?php
                    $grandTotal = 0; //grand total declaration

                    foreach($order_items->render($_GET['order_id'], $_GET['customer_id']) as $order_item){
                ?>
                        <div class="content">
                            <p class="name"><?= $order_item['name'] ?></p>
                            <p class="times">&times;</p>
                            <p class="quantity"><?= $order_item['quantity'] ?></p>
                            <div class="price-cont">
                                <span>₱</span>    
                                <h4><?= sprintf("%0.2f", $order_item['price'] * $order_item['quantity']) ?></h4>
                            </div>
                        </div>
                <?php
                        $grandTotal += ($order_item['price'] * $order_item['quantity']);
                    }
                ?>

                <div class="total">
                    <p>Grand total:</p>
                    <div class="price-cont">
                        <span>₱</span>
                        <h4><?= sprintf("%0.2f", $grandTotal) ?></h4>
                    </div>
                </div>
            </div>    
            
            <?php
                if($_GET['status'] === 'pending'){
                    echo '<input type="submit" class="mark" name="prepare" value="PREPARE ORDER">';
                }
                else if($_GET['status'] === 'preparing'){
                    echo '<input type="submit" class="mark" name="ready" value="MARK AS READY TO PICKUP">';
                }
                else if($_GET['status'] === 'ready for pickup'){
                    if($order_info['payment_status'] === 'unpaid'){
                        echo '<input type="submit" class="mark-paid" name="paid" value="MARK AS PAID">';
                    }
                    echo '<input type="submit" class="mark" name="release" value="RELEASE ORDER">';
                }
            ?>
        </form> 
    </section>
</div>

<?php
    if($_SESSION['logged_in'] != 'null'){
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>