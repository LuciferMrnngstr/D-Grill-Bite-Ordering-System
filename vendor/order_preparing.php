<?php
    session_start();

    if(isset($_GET['customer_id']) && isset($_GET['status'])){
        $_SESSION['customer_id'] = $_GET['customer_id'];
        $_SESSION['status'] = $_GET['status'];
    }

    if(!isset($_SESSION['customer_id']) && !isset($_SESSION['status'])){
        header('location: order.php');
    }

    include_once '../tools/variables.php';
    $page_title = 'Order Details';
    $css = 'order_preparing';
    $home = ' active';

    include_once '../includes/header.php';
    include_once '../includes/top.php';
    include_once '../classes/order.class.php';
    include_once '../classes/order_item.class.php';

    $order = new Order;
    $order_items = new OrderItem;

    if($order_items->checkEmpty($_SESSION['customer_id'], $_SESSION['status'])[0] == 0){
        header('location: order.php');
    }

    $customer = $order->custDetail($_SESSION['customer_id'], $_SESSION['status'], 'vendor');
?>

    <form class="content" method="post">
        <div class="preparing-container">
            <p>preparing Faseeh Aukasa's orders</p>
        </div>

        <div class="food-items-container">
            <!-- <div class="top-cont">
                <input type="checkbox" id="checkbox-all" class="check-box">
                <label for="checkbox-all">Select all</label>
                <div class="more-btn">
                    <img src="../icons/more.svg">
                </div>
            </div> -->

            <hr>

            <?php
                foreach($order_items->render($_SESSION['customer_id'], $_SESSION['order_id'], $_SESSION['status']) as $order_item){
                    if(isset($_POST['done'])){
                        if($order->updatePickup($order_item['order_id'])){
                            header('location: order.php');
                        }
                    }
            ?>
        
                    <div class="food">
                        <!-- <input type="checkbox" id="checkbox" class="check-box" name="available"> -->
                        <input type="hidden" name="food_id" value="<?= $order_item['food_id'] ?>">
                        <div class="food-product">
                            <img src="../icons/items/<?= $order_item['img']; ?>-menu.png">
                            <div class="food-desc-cont">
                                <p class="name"><?= $order_item['name']; ?></p>
                                <!-- <p class="adds-on">With Boiled Egg</p> -->
                            </div>
                        </div>
                        <div class="price-cont">
                            <span>₱</span>
                            <h4 class="price"><?= $order_item['price']; ?></h4>
                        </div>
                    </div>

            <?php
                    $grand_total = $order_item['grand_total'];
                }
            ?>
            
            <hr>
            
            <div class="bottom-cont">
                <p>TOTAL:</p>
                <div class="price-cont">
                    <span>₱</span>
                    <h4 class="price"><?= $grand_total; ?></h4>
                </div>
            </div>
        </div>

        <div class="action-container">
            <input type="submit" class="prepare btn-round first-btn" name="done" value="MARK AS DONE">
        </div>
    </form>

<?php
    include_once '../includes/footer.php';
?>