<?php
    session_start();

    include_once '../tools/variables.php';
    include_once '../classes/food.class.php';
    include_once '../classes/cart.class.php';
    include_once '../classes/add_on.class.php';

    $food = new Food;
    $add_ons = new Add_on;

    if($food->fetch($_GET['id'])){
        $data = $food->fetch($_GET['id']);
    }

    $page_title = $data['name'];
    $css = 'food_details';

    include_once '../includes/header.php';
    include_once '../includes/top2.php';

    if(isset($_POST['submit'])){
        $cart = new Cart;
        $user_id = $_SESSION['user_id'];
        $logged_in = $_SESSION['logged_in'];
        $quantity = htmlentities($_POST['quantity']);
        $food_id = $_GET['id'];
        $food_name = $data['name'];
        $food_price = $data['price'];
        $food_img = $data['img'];

        if(isset($_SESSION['logged_in'])){ // if logged in variable is set
            for($i=0; $i<$quantity; $i++){ //for loop, so that the quantity of food product willl be how many times the food will be stored into database
                if($cart->addToCart($logged_in, $user_id, $food_id, $food_name, $food_price, $food_img)){
                    $_SESSION['addedToCart'] = 'Added to Cart';
                }
            }
        }

        header('location: home.php');
    }
    
?>

<div class="content">
    <div class="img-container">
        <img src="../icons/items/<?= $data['img']; ?>.png">
    </div>

    <div class="desc-container">
        <h3>
            <?= $data['name']; ?>
        </h3>

        <div class="price-cont">
            <span>₱</span>
            <h4 class="price"><?= $data['price']; ?></h4>
        </div>

        <div class="food-description">
            <p>
                <?= $data['description']; ?>
            </p>
        </div>

        <div class="item-rates">
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

        <div class="title-with-line-cont">
            <h1>REVIEWS</h1>
            <hr>
        </div>

        <div class="submit-btn-container">
            <button class="submit-btn" id="add-to-cart">ADD TO CART</button>
        </div>
    </div>

    <span class="overlay"></span>

    <form method="post" class="desc-container open">
        <h3>
            <?= $data['name']; ?>
        </h3>
        <div class="price-cont">
            <span>₱</span>
            <h4 class="price" id="food-price"><?= $data['price']; ?></h4>
        </div>

        <div class="food-input-info">
<?php
    if($add_ons->count($_GET['id'])[0] > 0){
?>
            <div class="title-with-line-cont">
                <h1>OPTION</h1>
                <hr>
            </div>
            <div class="adds-on-container">
<?php
        foreach($add_ons->renderOption($_GET['id']) as $add_on){
            echo '<div class="btn2">' . $add_on['name'] . '</div>';
        }
?>
            </div>
<?php
    }
?>
            <div class="quantity-cont">
                <label for="quantity">QUANTITY</label>
                <div class="input-cont">
                    <div class="btn2" id="decrease">-</div>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="5">
                    <div class="btn2" id="increase">+</div>
                </div>
            </div>
        </div>

        <div class="sub-total-cont">
            <h6>TOTAL PRICE</h6>
            <div class="price-cont">
                <span>₱</span>
                <h4 class="price" id="sub-total" name="sub-total"><?= $data['price']; ?></h4>
            </div>
        </div>

        <div class="submit-btn-container">
            <input type="submit" name="submit" class="submit-btn" value="ADD TO CART">
        </div>
    </form>
</div>

<script src="../script/food-details.js"></script>

<?php
    include_once '../includes/footer.php';
?>