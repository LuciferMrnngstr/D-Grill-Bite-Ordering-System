<?php
    include_once '../classes/cart.class.php';

    // if(isset($_SESSION['logged_in'])){
    //     $customer_id = $_SESSION['logged_in'];
    // }
    // else{
    //     $customer_id = 'NULL';
    // }

    $cart = new Cart;
?>

<nav class="bottom-nav">
    <ul>
<?php
    if($_SESSION['user_type'] == 'customer'){
?>
        <li>
            <a href="home.php" class="nav-items<?= $home; ?>">
                <div><img src="../icons/navbar/<?php if($home == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/home.svg"></div>
                <!-- <div><img src="../icons/navbar/<?php if($home == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/home.svg"></div> -->
            </a>
            <span class="<?= $home ?>"><?= $page_title; ?></span>
        </li>
        <li>
            <a href="#" class="nav-items">
                <div><img src="<?php if($page_title == 'Meraki | Login'){ echo '../'; } ?>../icons/navbar/inactive/heart.svg"></div>
            </a>
        </li>
        <li>
            <a href="cart.php" class="nav-items<?= $cart_nav; ?>">
                <div class="cart_nav">
                    <img src="<?php if($page_title == 'Meraki | Login'){ echo '../'; } ?>../icons/navbar/<?php if($cart_nav == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/bag.svg">
<?php
            if($_SESSION['logged_in'] != 'null'){
                if($cart->checkEmpty($_SESSION['user_id'])[0] > 0){
?>
                    <p class="cart_count"><?= $cart->checkEmpty($_SESSION['user_id'])[0]; ?></p>
<?php
                }
            }
            else{
                if(isset($_SESSION['cart'])){
                    $count = 0;

                    foreach($_SESSION['cart'] as $value){
                        $count++;
                    }
                    if($count > 0){
?>
                    <p class="cart_count"><?= $count; ?></p>
<?php
                    }
                }
            }
?>
                </div>
            </a>
        </li>
        <li>
            <a href="profile.php" class="nav-items<?= $profile . $login; ?>">
                <div><img src="<?php if($page_title == 'Meraki | Login'){ echo '../'; } ?>../icons/navbar/<?php if($profile == ' active' || $login == ' active'){ echo 'active'; } else { echo 'inactive'; } ?>/profile.svg"></div>
            </a>
            <span class="<?= $profile . $login; ?>"><?= $page_title; ?></span>
        </li>
<?php
    }
    else{
?>
        <li>
            <a href="<?php if($page_title == 'Meraki | Login'){ echo '../'; } ?>home.php" class="nav-items<?= $home; ?>">
                <div><img src="../icons/navbar/vendor/orders.svg"></div>
            </a>
        </li>
        <li>
            <a href="#" class="nav-items">
                <div><img src="../icons/navbar/vendor/shop.svg../icons/navbar/heart.svg"></div>
            </a>
        </li>
        <li>
            <a href="cart.php" class="nav-items<?= $cart_nav; ?>">
                <div><img src="../icons/navbar/vendor/history.svg"></div>
            </a>
        </li>
        <li>
            <a href="profile.php" class="nav-items<?= $profile . $login . $register; ?>">
                <div><img src="../icons/navbar/vendor/setting.svg"></div>
            </a>
        </li>
<?php
    }
?>
    </ul>
</nav>