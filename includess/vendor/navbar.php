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
            <a href="order_historys.php" class="nav-items<?= $dashboard; ?>">
                <div><img src="../icons/navbar/admin/<?php if($dashboard == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/dashboard.svg"></div>
            </a>
            <span class="<?= $dashboard ?>"><?= $page_title; ?></span>
        </li>
        
        <li>
            <a href="orders.php" class="nav-items<?= $orders ?>">
                <div><img src="../icons/navbar/admin/<?php if($orders == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/orders.svg"></div>
            </a>
            <span class="<?= $orders ?>"><?= $page_title ?></span>
        </li>

        <li>
            <a href="store.php" class="nav-items<?= $store; ?>">
                <div><img src="../icons/navbar/admin/<?php if($store == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/store.svg"></div>
            </a>
            <span class="<?= $store ?>"><?= $page_title; ?></span>
        </li>

        <li>
            <a href="profiles.php" class="nav-items<?= $profile . $login; ?>">
                <div><img src="../icons/navbar/admin/<?php if($profile == 'active'){ echo 'active'; } else { echo 'inactive'; } ?>/profile.svg"></div>
            </a>
            <span class="<?= $profile . $login; ?>"><?= $page_title; ?></span>
        </li>
    </ul>
</nav>