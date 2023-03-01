<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Profile';
    $css = 'profile';
    $profile = ' active';

    include_once '../includes/header.php';
    include_once '../includes/top.php';
    include_once '../classes/customer.class.php';

    $customers = new Customer;

    $customer = $customers->renderInfo($_SESSION['logged_in']);
?>

<div class="content">
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

    <hr>

    <a href="#" class="btn-round">Edit Profile Info</a>
    <a href="#" class="btn-round">Rate and Feedback</a>
    <a href="#" class="btn-round">Order</a>
    <a href="#" class="btn-round">History Order</a>
    <a href="#" class="btn-round">Settings</a>

    <hr>

    <a href="login/logout.php" class="btn-round">Logout</a>
    <a href="../vendor/login/logout.php" class="btn-round">Vendors</a>
</div>

<?php
    include_once '../includes/navbar.php';
    include_once '../includes/footer.php';
?>