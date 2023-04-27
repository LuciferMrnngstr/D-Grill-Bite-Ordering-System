<?php

?>

<nav class="bottom-nav">
    <ul>
        <li>
            <a href="../admin/dashboard.php" class="nav-items<?= $dashboard; ?>">
                <div><img src="<?php if(isset($dashboard)){ echo '../icons/admin-navbar/dashboard-active.svg'; }
                        else{ echo '../icons/admin-navbar/dashboard.svg'; } ?>"></div>
            </a>
        </li>
        <li>
            <a href="../admin/customers.php" class="nav-items<?= $customers; ?>">
                <div><img src="<?php if(isset($customers)){ echo '../icons/admin-navbar/customers-active.svg'; }
                        else{ echo '../icons/admin-navbar/customers.svg'; } ?>"></div>
            </a>
        </li>
        <li>
            <a href="../admin/store-menu.php" class="nav-items<?= $store; ?>">
            <div><img src="<?php if(isset($store)){ echo '../icons/admin-navbar/store-active.svg'; }
                        else{ echo '../icons/admin-navbar/store.svg'; } ?>"></div>
            </a>
        </li>
        <li>
            <a href="login/login.php" class="nav-items<?= $login . $register; ?>">
                <img src="../icons/admin-navbar/settings.svg">   
            </a>
        </li>
    </ul>
</nav>