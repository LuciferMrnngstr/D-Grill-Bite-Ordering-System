<?php
    session_start();
    $_SESSION['user_type'] = "customer"; //for navbar use and also in other pages
    if(!isset($_SESSION['logged_in'])){
        $_SESSION['logged_in'] = 'null'; //if user haven't logged in yet
    }

    include_once '../tools/variables.php';
    $page_title = 'Home';
    $css = 'home';
    $home = ' active';

    // popup added to cart   
    if(isset($_SESSION['addedToCart'])){
        $addedToCart = $_SESSION['addedToCart'];
    }
    else{
        $addedToCart = '';
    }

    include_once '../includes/header.php';
    include_once '../includes/top2.php';
    include_once '../classes/food.class.php';
?>

<?php
    if(!empty($addedToCart)){
        echo '<div class="message home active" onclick="this.remove();"><p>' . $addedToCart .'</p></div>';
        unset($_SESSION['addedToCart']);
    }
?>

<div class="content">
    <div class="row1">
        <span class="background"></span>

        <div class="search-container">
            <input type="text" name="search" placeholder="Search food or beverage">
            <a href="#">
                <img src="../icons/search.svg">
            </a>
        </div>

        <div class="filter-container">
            <button class="btn2">
                <img src="../icons/filter/favorites.svg">
            </button>

            <button class="btn2">
                <img src="../icons/filter/vegetable.svg">
            </button>

            <button class="btn2">
                <img src="../icons/filter/fish.svg">
            </button>

            <button class="btn2">
                <img src="../icons/filter/drinks.svg">
            </button>

            <button class="btn2">
                <img src="../icons/filter/cutlery.svg">
            </button>
        </div>
    </div>

    <div class="banner-container">
        <div class="img">
            <img src="../icons/banners/banner.png">
            <a href="#">Order Now</a>
        </div>
    </div>

    <div class="title-with-line-cont">
        <h1>ALL DISHES</h1>
        <hr>
    </div>

    <div class="item-container">

        <?php
            $foods = new Food;

            foreach($foods->render() as $food){
        ?>
                <a href="food_details.php?id=<?= $food['food_id']; ?>" class="items">
                    <img class="item-img" src="../icons/items/<?= $food['img'] ?>-menu.png">
                    <div class="item-desc">
                        <div class="item-name-cont">
                            <p class="item-name"><?= $food['name']; ?></p>
                        </div>
                        <div class="price-cont">
                            <span>₱</span>
                            <h4 class="price"><?= $food['price']; ?></h4>
                        </div>
                        <div class="item-rates">
                            <div>
                                <img src="../icons/items/heart.svg">
                                <p><?= $food['likes']; ?></p>
                            </div>
                            <div>
                                <img src="../icons/items/star.svg">
                                <p><?= $food['rates']; ?></p>
                            </div>
                        </div>
                    </div>
                </a>
        <?php
            }
        ?>

    </div>
</div>

<?php
    include_once '../includes/navbar.php';
    include_once '../includes/footer.php';
?>