<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Profile';
    $profile = 'active';

    include_once '../classes/customer.class.php';

    if(isset($_SESSION['logged_in'])){
        $customers = new Customer;

        $customer = $customers->renderInfo($_SESSION['logged_in']);
    }

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/customer/topnav.php'; ?>

    <section class="profile">
        <div class="customer">
            <img src="../icons/profile.svg">
            <div class="info">
                <h3><?= $customer['last_name'] . ', ' . $customer['first_name'] . ' ' . $customer['middle_name'] ?></h3>
                <p class="email"><?= $customer['email'] ?></p>
                <p class="contact"><?= $customer['contact_no'] ?></p>
            </div>
        </div>

        <div class="middle-section">
            <a href="#">Edit Profile Info</a>
            <a href="#">Settings</a>
            <a href="#">Rate and feedback</a>
            <a href="#">Help and support</a>
        </div>

        <div class="last-section">
            <a href="./login/logout.php" class="logout">Log out</a>
            <a href="../admin/login/logout.php">Admin</a>
            <a href="../vendor/login/logout.php">Vendor</a>
        </div>
    </section>

    <?php
        include_once '../includess/customer/navbar.php';
    ?>
</div>
<?php
    if($_SESSION['logged_in'] != 'null'){ //if customer's done signing in
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>