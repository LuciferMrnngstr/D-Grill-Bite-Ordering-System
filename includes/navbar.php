<?php

?>

<nav class="bottom-nav">
    <ul>
        <li>
            <a href="../home/home.php" class="nav-items<?= $home; ?>">
                <div><img src="<?php if(isset($_SESSION['user_type']) == 'vendor'){ echo '../../icons/navbar/vendor/orders.svg'; }
                    else{ echo '../../icons/navbar/home.svg'; } ?>"></div>
            </a>
        </li>
        <li>
            <a href="#" class="nav-items">
                <div><img src="<?php if(isset($_SESSION['user_type']) == 'vendor'){ echo '../../icons/navbar/vendor/shop.svg'; }
                    else{ echo '../../icons/navbar/heart.svg'; } ?>"></div>
            </a>
        </li>
        <li>
            <a href="../cart/cart.php" class="nav-items<?= $cart_nav; ?>">
                <div><img src="<?php if(isset($_SESSION['user_type']) == 'vendor'){ echo '../../icons/navbar/vendor/history.svg'; }
                    else{ echo '../../icons/navbar/bag.svg'; } ?>"></div>
            </a>
        </li>
        <li>
            <a href="../login/logout.php" class="nav-items<?= $login . $register; ?>">
                <div><img src="<?php if(isset($_SESSION['user_type']) == 'vendor'){ echo '../../icons/navbar/vendor/setting.svg'; }
                    else{ echo '../../icons/navbar/profile.svg'; } ?>"></div>
            </a>
        </li>
    </ul>
</nav>