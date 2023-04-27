<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Order History';
    $css = 'cart';

    include_once '../includes/header.php';
    include_once '../includes/top2.php';
    include_once '../classes/cart.class.php';
    include_once '../classes/order.class.php';

    $carts = new Cart;
    $order = new Order;
        
    if(isset($_SESSION['logged_in'])){
        $customer_id = $_SESSION['logged_in'];
    }
    else{
        $customer_id = 'NULL';
    }

?>
        
<?php
    include_once '../includes/footer.php';
?>