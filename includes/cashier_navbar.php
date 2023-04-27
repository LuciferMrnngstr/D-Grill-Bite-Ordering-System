<?php
    if($page_title == 'Meraki | Login'){
        include_once '../../classes/cart.class.php';    
    }
    else{
        include_once '../classes/cart.class.php';
    }
    
    $cart = new Cart;
?>

<nav class="bottom-nav">
    <ul>
        <li>
            <a href="<?php if($page_title == 'Meraki | Login'){ echo '../'; } ?>home.php" class="nav-items<?= $home; ?>">
                <div><img src="<?php if($page_title == 'Meraki | Login'){ echo '../'; } ?>../icons/navbar/<?php if($home == ' active'){ echo 'active'; } else { echo 'inactive'; } ?>/home.svg"></div>
            </a>
            <span class="<?= $home; ?>"><?= $page_title; ?></span>
        </li>
        <li>
            <a href="cart.php" class="nav-items<?= $cart_nav; ?>">
                <div class="cart_nav">
                    <img src="<?php if($page_title == 'Meraki | Login'){ echo '../'; } ?>../icons/navbar/<?php if($cart_nav == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/bag.svg">
<?php
            if($cart->checkEmpty($_SESSION['user_id'])[0] > 0){
?>
                <p class="cart_count"><?= $cart->checkEmpty($_SESSION['user_id'])[0]; ?></p>
<?php
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
    </ul>
</nav>