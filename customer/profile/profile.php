<?php
    session_start();

    include_once '../../tools/variables.php';
    $page_title = 'Profile';
    $css = 'profile';
    $profile = ' active';

    include_once '../../includes/header.php';
    include_once '../../includes/top.php';
?>

<div class="content">
    <div class="customer-details-cont">
        <div class="customer-container1">
            <img src="../../icons/profile.svg">
        </div>
        <div class="customer-container2">
            <div class="order-date-cont">
                <p class="cust-name">Abdulla, Julkipli N.</p>
                <p>STUDENT</p>
            </div>
            <div class="contact-cont">
                <p>xt202003618@wmsu.edu.ph</p>
                <p>09123456789</p>
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

    <a href="../login/logout.php" class="btn-round">Logout</a>
</div>

<?php
    include_once '../../includes/navbar.php';
    include_once '../../includes/footer.php';
?>