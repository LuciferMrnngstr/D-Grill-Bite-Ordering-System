<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Customers';
    $css = 'admin';
    $store = ' active';

    include_once '../includes/header.php';
    include_once '../includes/admin-top.php';
    include_once '../classes/food.class.php';
?>
<h4 style="margin-top: 12px; margin-left: 3px">STORE</h4>

<div class="content">
    
    <div class="content-container">
        <div class="search-bar sales-report-search" style="position: relative;">
            <h4>SALES REPORT</h4>
            <input type="text" placeholder="Search Sales" style="padding-right: 30px;">
            <img src="../icons/Search.svg" alt="Icon" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%);" height="15px" width="15px">
        </div>
        <div class="filter-date">
            <div class="filter-text">
                <div class="current-filter dropdown" style="float: left">
                    Today
                    <img class="dropbtn" onclick="showDateFilter()" src="../icons/caret-down-fill.svg" width="12px" height="12px" style="margin-top: 2  px; margin-left: 2px">

                    <div id="dateDropdown" class="dropdown-content" style="margin-top:80px ; width: 100px; left: 0">
                        <a href="#">This Week</a>
                        <a href="#">This Month</a>
                        <a href="#">This Year</a>
                    </div>
                </div>
                <div class="date">December 14</div>
            </div>
        </div>
        <div class="table-container sales-report-container">
            <!-- Table Header -->
            <div class="table-header sales-report-header">
                <div class="items-column" style="min-width: 50%; padding-bottom: 5px; text-align:left; margin-left: 7px">ITEMS</div>
                <div class="quantity-column" style="min-width: 20%; padding-bottom: 5px">QUANTITY</div>
                <div class="amount-column" style="min-width: 30%; padding-bottom: 5px">AMOUNT</a>
                </div>
            </div>

            <!-- Table Rows -->
            <div class="table-rows sales-report-rows">
                <div class="table-data sales-report-data">
                    <div class="name-data" style="min-width: 50%">Combo Meal 1</div>
                    <div class="amount-data" style="min-width: 20%; text-align:center">69</div>
                    <div class="status-data dropdown" style="min-width: 30%;">&#8369 2,415.00</div>
                </div>
                <div class="table-data sales-report-data">
                    <div class="name-data" style="min-width: 50%">Coke Mismo</div>
                    <div class="amount-data" style="min-width: 20%; text-align:center">40</div>
                    <div class="status-data dropdown" style="min-width: 30%;">&#8369 1,000.00</div>
                </div>
                <div class="table-data sales-report-data">
                    <div class="name-data" style="min-width: 50%">Tortang Talong</div>
                    <div class="amount-data" style="min-width: 20%; text-align:center">20</div>
                    <div class="status-data dropdown" style="min-width: 30%;">&#8369 600.00</div>
                </div>
                <div class="table-data sales-report-data">
                    <div class="name-data" style="min-width: 50%">Chicken Curry</div>
                    <div class="amount-data" style="min-width: 20%; text-align:center">12</div>
                    <div class="status-data dropdown" style="min-width: 30%;">&#8369 420.00</div>
                </div>
                <div class="table-data sales-report-data">
                    <div class="name-data" style="min-width: 50%">Fried Fish</div>
                    <div class="amount-data" style="min-width: 20%; text-align:center">19</div>
                    <div class="status-data dropdown" style="min-width: 30%;">&#8369 380.00</div>
                </div>
            </div>

            <!-- Table Summary -->
            <div class="table-summary">
                TOTAL SALES
                <h4>&#8369  54, 384.00</h4>
            </div>
        </div>
    </div>

</div>

<?php
    include_once '../includes/admin-navbar.php';
    include_once '../includes/admin-footer.php';
?>