<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Order';
    $css = 'order_status.customer';

    include_once '../includes/header.php';
    include_once '../includes/top2.php';
    include_once '../classes/order.class.php';
    include_once '../classes/order_item.class.php';

    $order = new Order;
    $order_items = new OrderItem;
        
    if(isset($_SESSION['logged_in'])){
        $customer_id = $_SESSION['user_id'];
    }
    else{
        $customer_id = 'NULL';
    }

?>

<div class="content customer">
    <div class="customer-details-cont">
        <div class="row1">
            <div>
                <p>ORDER STATUS</p>
                <p class="status"><?= strtoupper($_GET['status']); ?></p>
            </div>
            <div>
                <p>ORDERED AT</p>
                <p class="date"><?= $order_items->renderDate($_GET['order_id'])['date']; ?></p>
            </div>
        </div>
    </div>

    <div class="food-items-container">

        <hr>

        <?php
            foreach($order_items->render($customer_id, $_GET['order_id']) as $order_item){
                if(isset($_POST['prepare'])){
                    if($order->updatePrepare($order_item['order_id'])){
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
            }
        ?>
        
        <hr>
    </div>

    <div class="order-summary-container">
        <h3>ORDER SUMMARY</h3>

        <?php
            $i = 0; //FOR INCREMENT, USED TO DISPLAY SINCE I DON'T KNOW HOW TO COMBINE 2 SELECT STATEMENTS WITH DIFFERENT COLUMN :)
            $quantity = $order_items->renderSummary($customer_id, $_GET['status'], $_GET['order_id'], 'quantity');

            foreach($order_items->renderSummary($customer_id, $_GET['status'], $_GET['order_id'], 'names') as $order_item){
        ?>
        
            <div class="summary-row">
                <div class="description">
                    <div class="food-name">
                        <p><?= $order_item['name']; ?></p>
                    </div>
                    <p>&times;</p>
                    <p><?= $quantity[$i][0]; ?></p>
                </div>
                <div class="price-cont">
                    <span>₱</span>
                    <h4 class="price"><?= $sub_total = $order_item['price'] * $quantity[$i][0]; ?></h4>
                </div>
            </div>

        <?php
                $i++;
            }
        ?>

        <hr>

        <div class="summary-row">
            <div class="description">
                <h4>Grand Total:</h4>
            </div>
            <div class="price-cont">
                <span>₱</span>
                <h4 class="price"><?= $order_item['grand_total']; ?></h4>
            </div>
        </div>
    </div>

</div>
  
<?php
    include_once '../includes/footer.php';
?>