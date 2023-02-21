<?php
    session_start();

    include_once '../../tools/variables.php';
    $page_title = 'Meraki | Orders';
    $css = 'vendor_home';
    $home = ' active';

    include_once '../../includes/header.php';
    include_once '../../includes/top.php';
    include_once '../../classes/food.class.php';
?>

<div class="content">
    <div class="heading">
        <h3>ORDERS</h3>
        <button class="btn3">PENDING</button>
        <button class="btn4"><img src="../../icons/search.svg"></button>
    </div>

    <div class="title-with-line-cont">
        <h1>PENDING</h1>
        <hr>
    </div>

    <div class="order-items pending">
        <div class="cont1">
            <p>Abdulla, Julkipli N.</p>
            <p>STUDENT</p>
        </div>
        <div class="cont2">
            <p>3 orders</p>
            <p>FOR: 02-14-2023</p>
            <p>8:37 AM</p>
        </div>
        <div class="cont3"><span>₱</span>35.00</div>
    </div>

    <div class="order-items pending">
        <div class="cont1">
            <p>Aukasa, Faseeh Z.</p>
            <p>STUDENT</p>
        </div>
        <div class="cont2">
            <p>4 orders</p>
            <p>FOR: 02-15-2023</p>
            <p>12:37 PM</p>
        </div>
        <div class="cont3"><span>₱</span>45.00</div>
    </div>

    <div class="title-with-line-cont">
        <h1>TO PREPARE</h1>
        <hr>
    </div>

    <div class="order-items to-prepare">
        <div class="cont1">
            <p>Dagohoy, Mary Jane I.</p>
            <p>FACULTY</p>
        </div>
        <div class="cont2">
            <p>2 orders</p>
            <p>FOR: 02-17-2023</p>
            <p>3:00 PM</p>
        </div>
        <div class="cont3"><span>₱</span>30.00</div>
    </div>

    <div class="title-with-line-cont">
        <h1>READY FOR PICK-UP</h1>
        <hr>
    </div>

    <div class="order-items pickup">
        <div class="cont1">
            <p>Abdulwahab, Fharshana K.</p>
            <p>FACULTY</p>
        </div>
        <div class="cont2">
            <p>3 orders</p>
            <p>FOR: 02-18-2023</p>
            <p>5:00 PM</p>
        </div>
        <div class="cont3"><span>₱</span>40.00</div>
    </div>
</div>

<?php
    include_once '../../includes/navbar.php';
    include_once '../../includes/footer.php';
?>