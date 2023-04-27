<?php
    session_start();

    if(!isset($_SESSION['user_type']) || !isset($_SESSION['logged_in'])){
        session_destroy();
        header('location: home.php');
    }

    if(!isset($_GET['food_id']) || empty($_GET['food_id'])){
        header('location: home.php');       
    }

    include_once '../classes/food.class.php';
    include_once '../classes/cart.class.php';
    include_once '../classes/add_on.class.php';
    include_once '../tools/variables.php';

    $food = new Food;
    $add_ons = new Add_on;
    $cart = new Cart;
    
    if($food->fetch($_GET['food_id'])){
        $data = $food->fetch($_GET['food_id']);
    }
    
    $page_title = $data['name'];

    if(isset($_POST['submit'])){
        if($_SESSION['logged_in'] == 'null'){
            $user_id = 'null';
        }
        else{
            $user_id = $_SESSION['user_id'];
        }

        $logged_in = $_SESSION['logged_in'];
        $food_id = $_GET['food_id'];
        $food_name = $data['name'];
        $food_price = $data['price'];
        $food_img = $data['img'];
        $quantity = htmlentities($_POST['quantity']);

        $cart->addToCart($logged_in, $user_id, $food_id, $food_name, $food_price, $food_img, $quantity);

        if($_POST['submit'] === 'Buy now'){
            header('location: checkout.php');
        }
        else{
            header('location: home.php');
        }
    }

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/customer/topnav.php'; ?>

    <section class="food_details">
        <img class="food_img" src="../icons/items/<?= $data['img'] ?>.png">

        <div class="description">
            <header><?= $data['name'] ?></header>

            <div class="price-cont">
                <span>₱</span>
                <h4><?= $data['price'] ?></h4>
            </div>

            <div class="popularity">
                <div>
                    <img src="../icons/items/heart.svg">
                    <p>
                        <?= $data['likes']; ?> likes
                    </p>
                </div>
                <div>
                    <img src="../icons/items/star.svg">
                    <p>
                        <?= $data['rates']; ?> rates
                    </p>
                </div>
                <div>
                    <img src="../icons/items/dollar.svg">
                    <p>
                        <?= $data['sold']; ?> sold
                    </p>
                </div>
            </div>

            <p class="food_description"><?= $data['description'] ?></p>

            <?php
                if($_SESSION['logged_in'] != 'null') echo '<div class="heart"><img src="../icons/items/heart-empty.svg"></div>';
            ?>
        </div>

        <div class="indicator">
            <h1>REVIEWS</h1>
            <hr>
        </div>

        <div class="reviews">
            <div class="empty"><h1>No comments yet.</h1><p>Be the first one to comment.</p></div>
        </div>

        <div class="buttons">
            <button class="addcart_btn">Add to cart</button>
            <button class="buynow_btn">Buy now</button>
        </div>

        <span class="overlay"></span>

        <form class="modal-box input-description" method="post">
            <header><?= $data['name'] ?></header>

            <div class="price-cont price">
                <span>₱</span>
                <h4><?= $data['price'] ?></h4>
            </div>

            <div class="desc-container">
                <p>Quantity</p>
                <div class="input-quantity">
                    <button type="button" id="decrease">-</button>
                    <input type="number" id="quantity" name="quantity" value="1">
                    <button type="button" id="increase">+</button>
                </div>
            </div>

            <div class="desc-container total-cont">
                <p class="total">Total price:</p>
                <div class="price-cont">
                    <span>₱</span>
                    <h4><?= $data['price'] ?></h4>
                </div>
            </div>

            <input type="submit" name="submit" value="">
        </form>
    </section>
</div>

<script src="../script/food_details.js"></script>
<?php
    if($_SESSION['logged_in'] != 'null'){ //if customer's done signing in
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>