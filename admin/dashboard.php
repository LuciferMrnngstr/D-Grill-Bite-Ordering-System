<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Dashboard';
    $css = 'admin';
    $dashboard = ' active';

    include_once '../includes/header.php';
    include_once '../includes/admin-top.php';
    include_once '../classes/food.class.php';
?>
    <h4 style="margin-top: 12px; margin-left: 3px">DASHBOARD</h4>
<div class="content">
    
    <div class="content-container">
        <div class="dashboard-container">
            <div class="order-container">
                <h4>ORDERS</h4>
                <div class="container-box">
                    <div class="box-content">
                        <img src="../icons/double-up.svg" height="25px" width="25px">
                        <h1>25</h1>
                        <h5>TOTAL<br>TODAY</h5>
                    </div>
                </div>
            </div>

            <div class="siteview-container">
                <h4>SITE VIEWS</h4>
                <div class="container-box">
                    <div class="box-content">
                        <img src="../icons/double-up.svg" height="25px" width="25px">
                        <h1>30</h1>
                        <h5>TOTAL<br>TODAY</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-container">
            <div class="favorites-container">
                <h4>MOST FAVORITE</h4>
                <div class="container-box">
                    <div class="box-content">
                        <div class="img-container" style="border-radius: 50%; width: 80px; height: 80px"></div>
                        <div class="favorite-text">
                            <div class="favorite-name-price" style="min-width: 60%; font-size: 14px; text-align:left">
                                <h5>Chicken Liver Adobo</h5>
                                <h5 class="price-text">&#8369 35.00</h5>
                            </div>
                            <div class="orders-text" style="min-width: 30%; font-size: 12px; text-align:right">
                                <h5>147<br>PEOPLE PLACED IN<br>FAVORITES</h5>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-container">
            <div class="average-container">
                <h4>AVERAGE ORDER VALUE</h4>
                <div class="container-box">
                    <div class="box-content">
                        <img src="../icons/double-up.svg" height="25px" width="25px">
                        <h5>PHP 35.00</h5>
                    </div>
                </div>
            </div>

            <div class="sales-container">
                <h4>TOTAL SALES</h4>
                <div class="container-box">
                    <div class="box-content">
                        <img src="../icons/double-up.svg" height="25px" width="25px">
                        <h5 style="margin-top: 17px">PHP 1678.00<br><div style="font-size:10px">Today</div></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
    include_once '../includes/admin-navbar.php';
    include_once '../includes/footer.php';
?>