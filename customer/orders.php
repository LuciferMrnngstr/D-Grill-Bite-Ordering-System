<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Order';

    include_once '../includess/header.php';
?>

<div class="wrapper">
    <?php include_once '../includess/topnav.php'; ?>

    <section class="cart">

    </section>
</div>

<?php
    if($_SESSION['logged_in'] != 'null'){
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includess/footer.php';
?>