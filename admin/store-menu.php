<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Customers';
    $css = 'admin';
    $store= ' active';

    include_once '../includes/header.php';
    include_once '../includes/admin-top.php';
    include_once '../classes/food.class.php';
?>
<h4 style="margin-top: 12px; margin-left: 3px">STORE</h4>

<div class="content">
    <div class="content-container">
        <a href="./food-management.php"><button class="store-button food-mgmnt-btn" >
            <img src="../icons/food-management.svg" height="70px" width="70px">
            <h3>FOOD MANAGEMENT</h3> 
        </button></a>
        <a href="./sales-report.php"><button class="store-button sp-btn">
            <img src="../icons/sales-report.svg" height="70px" width="70px">
            <h3>SALES REPORT</h3>
        </button></a>
        <button class="store-button sp-btn">
            <img src="../icons/reviews.svg" height="70px" width="70px">
            <h3>REVIEWS</h3>
        </button>
    </div>
</div>

<?php
    include_once '../includes/admin-navbar.php';
    include_once '../includes/admin-footer.php';
?>