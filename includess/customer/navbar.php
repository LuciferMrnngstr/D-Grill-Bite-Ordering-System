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
        <li>
            <a href="home.php" class="nav-items<?= $home; ?>">
                <div><img src="../icons/navbar/customer/<?php if($home == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/home.svg"></div>
            </a>
            <span class="<?= $home ?>"><?= $page_title; ?></span>
        </li>
        
        <li>
            <a href="#" class="nav-items">
                <div><img src="../icons/navbar/customer/inactive/heart.svg"></div>
            </a>
        </li>

        <li>
            <a href="carts.php" class="nav-items<?= $cart_nav; ?>">
                <div class="cart_nav">
                    <img src="../icons/navbar/customer/<?php if($cart_nav == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/bag.svg">

                    <?php
                        if($_SESSION['logged_in'] != 'null'){
                            if($cart->checkEmpty($_SESSION['user_id'])[0] > 0){
                    ?>
                                <p class="cart_count"><?= $cart->checkEmpty($_SESSION['user_id'])[0]; ?></p>
                    <?php
                            }
                        }
                        else{ // not logged in customer
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
            <a href="profiles.php" class="nav-items<?= $profile . $login; ?>">
                <div><img src="../icons/navbar/customer/<?php if($profile == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/profile.svg"></div>
            </a>
            <span class="<?= $profile . $login; ?>"><?= $page_title; ?></span>
        </li>
    </ul>
</nav>