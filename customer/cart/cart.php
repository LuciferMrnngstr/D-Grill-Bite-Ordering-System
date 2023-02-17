<?php
    session_start();

    include_once '../../tools/variables.php';
    $page_title = 'My Cart';
    $css = 'cart';
    $cart_nav = ' active';

    include_once '../../includes/header.php';
    include_once '../../includes/top.php';
    include_once '../../classes/cart.class.php';
    include_once '../../classes/order.class.php';
?>

<form method="post" class="content">
    <?php
        $carts = new Cart;
        $order = new Order;
        
        $total_price = 0;
        
        if(isset($_SESSION['logged_in'])){
            $customer_id = $_SESSION['logged_in'];
        }
        else{
            $customer_id = 'NULL';
        }

        foreach($carts->render($customer_id) as $cart){
            $total_price = $total_price + $cart['sub_total'];
            if(isset($_POST['submit'])){
                $order->addOrder($cart['cart_id'], $total_price);
            }
    ?>
        <div class="food-product-container">
            <div class="img-container">
                <img src="../../icons/items/<?= $cart['img'] ?>-menu.png">
            </div>
               
            <div class="food-description-container">
                <p><?= $cart['name']; ?></p>
                <div class="price-qntty-cont">
                    <p class="item-price"><span>₱</span><?= $cart['price']; ?></p>
                    <p><?= $cart['quantity']; ?> orders</p>
                </div>
            </div>

            <div class="action-container">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    <?php
        }
    ?>

    <input type="submit" name="submit" class="submit-btn" value="SUBMIT ORDER">
</form>

<?php
    include_once '../../includes/navbar.php';
    include_once '../../includes/footer.php';
?>