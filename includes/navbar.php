<?php

?>

<nav class="bottom-nav">
    <ul>
        <li>
            <a href="<?php if($page_title == 'Meraki | Login'){ echo '../'; } ?>home.php" class="nav-items<?= $home; ?>">
                <div><img src="<?php if(isset($_SESSION['user_type']) == 'vendor'){ echo '../icons/navbar/vendor/orders.svg'; }
                    else if($page_title == 'Meraki | Login'){ echo '../../icons/navbar/home.svg'; } else{ echo '../icons/navbar/home.svg'; } ?>"></div>
            </a>
        </li>
        <li>
            <a href="#" class="nav-items">
                <div><img src="<?php if(isset($_SESSION['user_type']) == 'vendor'){ echo '../icons/navbar/vendor/shop.svg'; }
                    else if($page_title == 'Meraki | Login'){ echo '../../icons/navbar/heart.svg'; } else{ echo '../icons/navbar/heart.svg'; } ?>"></div>
            </a>
        </li>
        <li>
            <a href="cart.php" class="nav-items<?= $cart_nav; ?>">
                <div><img src="<?php if(isset($_SESSION['user_type']) == 'vendor'){ echo '../icons/navbar/vendor/history.svg'; }
                    else if($page_title == 'Meraki | Login'){ echo '../../icons/navbar/bag.svg'; } else{ echo '../icons/navbar/bag.svg'; } ?>"></div>
            </a>
        </li>
        <li>
            <a href="profile.php" class="nav-items<?= $profile . $login . $register; ?>">
                <div><img src="<?php if(isset($_SESSION['user_type']) == 'vendor'){ echo '../icons/navbar/vendor/setting.svg'; }
                    else if($page_title == 'Meraki | Login'){ echo '../../icons/navbar/profile.svg'; } else{ echo '../icons/navbar/profile.svg'; } ?>"></div>
            </a>
        </li>
    </ul>
</nav>