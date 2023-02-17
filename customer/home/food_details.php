<?php
    session_start();

    include_once '../../tools/variables.php';
    include_once '../../classes/food.class.php';
    include_once '../../classes/cart.class.php';

    $food = new Food;

    if($food->fetch($_GET['id'])){
        $data = $food->fetch($_GET['id']);
    }

    $page_title = $data['name'];
    $css = 'food_details';

    include_once '../../includes/header.php';
    include_once '../../includes/top.php';

    if(isset($_POST['submit'])){
        $cart = new Cart;
        $sub_total = $data['price'] * $_POST['quantity'];
        $customer_id = $_SESSION['logged_in'];

        if($cart->addToCart($customer_id, $_GET['id'], $_POST['quantity'], $sub_total)){
            header('location: home.php');
        }
    }
    
?>

<div class="content">
    <div class="img-container">
        <img src="../../icons/items/<?= $data['img']; ?>.png">
    </div>

    <div class="desc-container">
        <h3><?= $data['name']; ?></h3>
        <h4><span>₱</span><?= $data['price']; ?></h4>

        <div class="food-description">
            <p><?= $data['description']; ?></p>
        </div>

        <div class="item-rates">
            <div>
                <img src="../../icons/items/heart.svg">
                <p><?= $data['likes']; ?> likes</p>
            </div>
            <div>
                <img src="../../icons/items/star.svg">
                <p><?= $data['rates']; ?> rates</p>
            </div>
            <div>
                <img src="../../icons/items/dollar.svg">
                <p><?= $data['sold']; ?> sold</p>
            </div>
        </div>

        <div class="title-with-line-cont">
            <h1>REVIEWS</h1>
            <hr>
        </div>

        <!-- <label for="quantity">Quantity: </label>
        <input type="number" id="quantity" name="quantity" min="1" max="20" required> -->
        <div class="submit-btn-container">
            <button class="submit-btn" id="add-to-cart">Add to Cart</button>
        </div>
    </div>

    <form method="post" class="desc-container open">
        <h3><?= $data['name']; ?></h3>
        <h4><span>₱</span><?= $data['price']; ?></h4>

        <div class="food-input-info">
            <div class="title-with-line-cont">
                <h1>OPTION</h1>
                <hr>
            </div>

            <div class="title-with-line-cont">
                <h1>QUANTITY</h1>
                <hr>
            </div>
            <input type="number" name="quantity" value="1" min="1" max="5">
        </div>

        <div class="submit-btn-container">
            <input type="submit" name="submit" class="submit-btn" value="Add to Cart">
        </div>
    </form>
</div>

<?php
    include_once '../../includes/footer.php';
?>