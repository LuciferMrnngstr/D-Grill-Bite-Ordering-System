<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Profile';
    $profile = 'active';

    include_once '../classes/customer.class.php';

    if(isset($_SESSION['user_type']) && isset($_SESSION['logged_in'])){
        if($_SESSION['logged_in'] === 'null'){ //if customer didn't signed in yet
            $logged_in = false;
        }
        else{
            $logged_in = true;
        }
    }
    else{ //redirect to home if there is an error is session
        header('location: home.php');
    }

    if($logged_in === true){ // if customer signed in
        $customers = new Customer;

        $customer = $customers->renderInfo($_SESSION['logged_in']);
        echo $logged_in;
    }

    include_once '../includes/header.php';
?>

<div class="wrapper">
    <?php include_once '../includes/customer/topnav.php'; ?>

    <section class="profile <?php if($logged_in === true) echo 'logged-in' ?>">
        <div class="customer">
            <img src="../icons/uploads/profile/profile.svg">
            <div class="info">
                <h3><?= $customer['last_name'] . ', ' . $customer['first_name'] . ' ' . $customer['middle_name'] ?></h3>
                <p class="email"><?= $customer['email'] ?></p>
                <p class="contact"><?= $customer['contact_no'] ?></p>
            </div>
            <div class="note">
                <a href="./login/login.php">Login</a>
                <p>or</p>
                <a href="./login/register.php">Sign Up</a>
            </div>
        </div>

        <div class="middle-section">
            <a href="#" class="edit-prof">Edit Profile Info</a>
            <a href="#" class="settings">Settings</a>
            <a href="#" class="rate">Rate and feedback</a>
            <a href="#" class="help">Help and support</a>
        </div>

        <div class="last-section">
            <a href="./login/logout.php" class="logout">Log out</a>
            <a href="../admin/login/logout.php" class="admin">Admin</a>
            <a href="../vendor/login/logout.php" class="vendor">Vendor</a>
        </div>
    </section>

    <?php
        include_once '../includes/customer/navbar.php';
    ?>
</div>
<?php
    if($_SESSION['logged_in'] != 'null'){ //if customer's done signing in
        echo '<script src="../script/notification.js"></script>';
    }

    include_once '../includes/footer.php';
?>