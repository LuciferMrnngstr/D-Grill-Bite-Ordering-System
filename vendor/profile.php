<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Profile';
    $profile = 'active';

    include_once '../classes/vendor.class.php';

    //redirect to logout page if user haven't logged in yet or not an admin
    if(!isset($_SESSION['logged_in']) || !isset($_SESSION['user_id']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'vendor'){
        header('location: login/logout.php');
    }

    $vendors = new Vendor;
    $vendor = $vendors->renderInfo($_SESSION['logged_in']);

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/vendor/topnav.php'; ?>

    <section class="profile logged-in">
        <div class="customer">
            <img src="../icons/uploads/profile/profile.svg">
            <div class="info">
                <h3><?= $vendor['last_name'] . ', ' . $vendor['first_name'] . ' ' . $vendor['middle_name'] ?></h3>
                <p class="email"><?= $vendor['email'] ?></p>
                <p class="contact"><?= $vendor['contact_no'] ?></p>
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
            <a href="../customer/login/logout.php">Customer</a>
        </div>
    </section>

    <?php
        include_once '../includess/vendor/navbar.php';
    ?>
</div>

<script src="../script/notification.js"></script>

<?php
    include_once '../includess/footer.php';
?>