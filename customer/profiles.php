<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Profile';
    $profile = 'active';

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/topnav.php'; ?>

    <section class="profile">
        
    </section>

    <?php
        include_once '../includess/navbar.php';
    ?>
</div>
<?php
    if($_SESSION['logged_in'] != 'null'){ //if customer's done signing in
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>