<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Customers';
    $css = 'admin';
    $customers = ' active';

    include_once '../includes/header.php';
    include_once '../includes/admin-top.php';
    include_once '../classes/food.class.php';
?>
<h4 style="margin-top: 12px; margin-left: 3px">CUSTOMERS</h4>

<div class="content">
    
    <div class="content-container">
        <div class="search-bar" style="position: relative;">
            <input type="text" placeholder="Search Name" style="padding-right: 30px;">
            <img src="../icons/Search.svg" alt="Icon" style="position: absolute; top: 50%; right: 30px; transform: translateY(-50%);" height="15px" width="15px">
            
            <div class="dropdown">
                <img class="dropbtn" onclick="showFilter()" src="../icons/filter.svg" alt="Icon" style="margin-top: 16px; position: absolute; top: 50%; right: 10px; transform: translateY(-50%);" height="15px" width="15px">
                <div id="filterDropdown" class="dropdown-content">
                    <a href="#">Paid</a>
                    <a href="#">Pending</a>
                    <a href="#">Unpayed</a>
                </div>
            </div>
        </div>
        <div class="table-container">
            <div class="table-header">
                <div class="customer-name-column" style="min-width: 50%">CUSTOMER NAME</div>
                <div class="amount-column" style="min-width: 30%">AMOUNT</div>
                <div class="status-column dropdown" style="min-width: 20%;">
                    <a style="color: black" class="dropbtn" onclick="filterStatus()">PAYMENT STATUS</a>
                    <div id="statusDropdown" class="dropdown-content" style="margin-top: 73px;">
                        <a href="#">ORDER STATUS</a>
                    </div>
                </div>
            </div>
            <div class="table-rows">
                <button class="table-data">
                    <div class="name-data" style="min-width: 50%">1. Xela Silorio</div>
                    <div class="amount-data" style="min-width: 30%; text-align:center">50.00</div>
                    <div class="status-data dropdown" style="min-width: 20%;">
                        <img class="dropbtn" onclick="showPayment(this)" src="../icons/check-circle-fill.svg" height="25px" width="25px">    
                        <div id="paymentDropdown" class="dropdown-content" style="margin: 0; border-radius: 10px; min-width: 75px;">
                            <a>Paid</a>
                            <a>Not Paid</a>
                        </div>
                    </div>
                </button>
                <button class="table-data">
                    <div class="name-data" style="min-width: 50%">2. Marvin Waro</div>
                    <div class="amount-data" style="min-width: 30%; text-align:center">70.00</div>
                    <div class="status-data dropdown" style="min-width: 20%;">
                        <img class="dropbtn" onclick="showPayment(this)" src="../icons/check-circle.svg" height="25px" width="25px">    
                        <div id="paymentDropdown" class="dropdown-content" style="margin: 0; border-radius: 10px; min-width: 75px;">
                            <a>Paid</a>
                            <a>Not Paid</a>
                        </div>
                    </div>
                </button>
                <button class="table-data">
                    <div class="name-data" style="min-width: 50%">3. Rose Tarroza</div>
                    <div class="amount-data" style="min-width: 30%; text-align:center">100.00</div>
                    <div class="status-data dropdown" style="min-width: 20%;">
                        <img class="dropbtn" onclick="showPayment(this)" src="../icons/clock.svg" height="25px" width="25px">    
                        <div id="paymentDropdown" class="dropdown-content" style="margin: 0; border-radius: 10px; min-width: 75px;">
                            <a>Paid</a>
                            <a>Not Paid</a>
                        </div>
                    </div>
                </button>
                
                
            </div>
        </div>
    </div>

</div>

<?php
    include_once '../includes/admin-navbar.php';
    include_once '../includes/admin-footer.php';
?>