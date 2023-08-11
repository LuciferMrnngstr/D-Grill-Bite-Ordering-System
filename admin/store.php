<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Store';
    $store = 'active';

    include_once '../includess/header.php'; //Header
    include_once '../classes/food.class.php'; //Food class
?>

<div class="wrapper">
    <?php
        include_once '../includess/admin/topnav.php'; //Top navbar

        if(!empty($addedToCart)){ //Popup added to cart 
            echo '<div class="alert active" onclick="this.remove();"><p>' . $addedToCart . '</p></div>';
            unset($_SESSION['addedToCart']);
        }
    ?>

    <section class="store">
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
            <!-- action dot -->
            <div class="action">
                <span class="dots"></span>
                <span class="dots"></span>
                <span class="dots"></span>
            </div>

            <span class="overlay"></span>

            <div class="action-modal">
                <div>
                    <button class="edit">Edit Banner</button>
                    <button class="delete">Add Banner</button>
                </div>
            </div>

            <div class="content">
                <img class="banner-item" src="../icons/uploads/banners/banner.png">
                <a href="#" class="edit-btn"><img src="../icons/mix/edit.svg"></a>
                <a href="#" class="order-now-btn">Order Now</a>
            </div>
        </div>

        <div class="indicator">
            <h1>ALL DISHES</h1>
            <hr>
        </div>

        <div class="item-container">
            <!-- action dot -->
            <div class="action">
                <span class="dots"></span>
                <span class="dots"></span>
                <span class="dots"></span>
            </div>

            <span class="overlay"></span>

            <div class="action-modal">
                <div>
                    <button class="edit">Edit Dish</button>
                    <a href="dish-info.php" class="delete">Add Dish</a>
                </div>
            </div>

            <?php
                foreach($foods->render() as $food){
            ?>

            <div class="items-wrapper">
                <a href="dish-info.php?food_id=<?= $food['food_id'] ?>" class="edit-btn"><img src="../icons/mix/edit.svg"></a>
                
                <a href="food_details.php?food_id=<?= $food['food_id']; ?>" class="items">
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
            </div>

            <?php
                }
            ?>
        </div>
<?php
        }
?>
    </section>
    
    <?php
        include_once '../includess/admin/navbar.php';
    ?>
</div>

<script src="../script/notification.js"></script>
<script src="../script/admin/store.js"></script>

<?php
    include_once '../includess/footer.php';
?>