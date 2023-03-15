<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Profile';
    $css = 'profile';
    $profile = ' active';

    include_once '../includes/header.php';
    include_once '../includes/top.php';
    include_once '../classes/customer.class.php';

    if(isset($_SESSION['logged_in'])){
        $customers = new Customer;

        $customer = $customers->renderInfo($_SESSION['logged_in']);
    }
?>

<div class="content profile">
<?php
    if($_SESSION['logged_in'] == 'null'){
?>
    <div class="customer-details-cont null-account">
        <div class="customer-container1">
            <img src="../icons/profile.svg">
        </div>
        <div class="customer-container2">
            <div class="order-date-cont">
                <p>PLEASE SIGN IN OR SIGN UP TO CONTINUE</p>
            </div>
            <div class="contact-cont">
                <a href="login/login.php" class="submit-btn">SIGN IN</a>
            </div>
        </div>
    </div>
<?php
    }
    else{
?>
    <div class="customer-details-cont">
        <div class="customer-container1">
            <img src="../icons/profile.svg">
        </div>
        <div class="customer-container2">
            <div class="order-date-cont">
                <p class="cust-name"><?= $customer['last_name'] . ', ' . $customer['first_name'] . ' ' . $customer['last_name']; ?></p>
                <p><?= $customer['cust_type']; ?></p>
            </div>
            <div class="contact-cont">
                <p><?= $customer['email']; ?></p>
                <p><?= $customer['contact_no']; ?></p>
            </div>
        </div>
    </div>
<?php
    }
?>

    <hr>
<?php
    if($_SESSION['logged_in'] != 'null'){
?>
    <a href="#" class="btn-round">Edit Profile Info</a>
    <a href="#" class="btn-round">Rate and Feedback</a>
    <a href="#" class="btn-round">Order</a>
    <a href="#" class="btn-round">History Order</a>
<?php
    }
?>
    <a href="#" class="btn-round">Settings</a>

    <hr>
<?php
    if($_SESSION['logged_in'] != 'null'){ echo '<a href="login/logout.php" class="btn-round">Logout</a>'; }
?>
    <a href="../vendor/login/logout.php" class="btn-round">Vendors</a>
</div>

<?php
    include_once '../includes/navbar.php';
    include_once '../includes/footer.php';
?>