<?php
    session_start();
    if(isset($_SESSION['user_type'])){
        if($_SESSION['user_type'] != 'customer'){
            session_destroy();
        }
    }

    $_SESSION['user_type'] = "customer"; //for navbar use and also in other pages
    if(!isset($_SESSION['logged_in'])){
        $_SESSION['logged_in'] = 'null'; //if user haven't logged in yet
    }

    include_once '../tools/variables.php';
    $page_title = 'Home';
    $home = 'active';

    //Popup added to cart   
    if(isset($_SESSION['addedToCart'])){
        $addedToCart = $_SESSION['addedToCart'];
    }
    else{
        $addedToCart = '';
    }

    include_once '../includes/header.php'; //Header
    include_once '../classes/food.class.php'; //Food class
?>

<div class="wrapper">
    <?php
        include_once '../includes/customer/topnav.php'; //Top navbar

        if(!empty($addedToCart)){ //Popup added to cart 
            echo '<div class="alert active" onclick="this.remove();"><p>' . $addedToCart . '</p></div>';
            unset($_SESSION['addedToCart']);
        }

        if(isset($_GET['sm'])){
            echo '<div class="pop active s"><p>' . $_GET['sm'] . '</p></div>';
        }
    ?>

    <section class="home">
        <div class="filter">
            <div class="content">
                <div class="search">
                    <input type="text" name="search" placeholder="Search food or beverage">
                    <a href="#">
                        <img src="../icons/mix/search.svg">
                    </a>
                </div>

                <div class="filter-btns">
                    <button>
                        <img src="../icons/filter/favorites.svg">
                    </button>

                    <button>
                        <img src="../icons/filter/vegetable.svg">
                    </button>

                    <button>
                        <img src="../icons/filter/fish.svg">
                    </button>

                    <button>
                        <img src="../icons/filter/drinks.svg">
                    </button>

                    <button>
                        <img src="../icons/filter/cutlery.svg">
                    </button>
                </div>
            </div>
        </div>

<?php
        $foods = new Food;

        if($foods->checkEmpty()[0] <= 0) {
            echo '<div class="empty"><h1>Sorry, no available food as of now.</h1></div>';
        } 
        else {
?>
        <div class="banner">
            <div class="content">
                <img class="banner-item" src="../icons/uploads/banners/banner.png">
                <a class="order-now-btn"href="#">Order Now</a>
            </div>
        </div>

        <div class="indicator">
            <h1>ALL DISHES</h1>
            <hr>
        </div>

        <div class="item-container">
            <?php
                foreach($foods->render() as $food){
            ?>

            <a href="food_details.php?food_id=<?= $food['food_id']; ?>" class="items <?php if($food['availability'] === 'unavailable') echo 'unavailable' ?>">
                <span class="label">item unavailable</span>
            
                <img class="img" src="../icons/uploads/dishes/<?= $food['img'] ?>">

                <div class="item-desc">
                    <div class="name-cont">
                        <p><?= $food['name'] ?></p>
                    </div>

                    <div class="price-cont">
                        <span>₱</span>
                        <h4><?= $food['price'] ?></h4>
                    </div>

                    <div class="rates">
                        <div>
                            <img src="../icons/mix/heart.svg">
                            <p><?= $food['likes'] ?></p>
                        </div>
                        <div>
                            <img src="../icons/mix/star.svg">
                            <p><?= $food['rates'] ?></p>
                        </div>
                    </div>
                </div>
            </a>

            <?php
                }
            ?>
        </div>
<?php
        }
?>
    </section>
    
    <?php
        include_once '../includes/customer/navbar.php';
    ?>
    <script src="../script/pop.js"></script>
</div>

<?php
    if($_SESSION['logged_in'] != 'null'){ //if customer's done signing in
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includes/footer.php';
?>