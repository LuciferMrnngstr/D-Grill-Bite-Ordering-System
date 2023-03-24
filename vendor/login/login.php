<?php
    session_start();

    include_once '../../tools/variables.php';
    $page_title = 'Meraki | Vendor Login';
    $css = 'login';
    $login = ' active';
    
    include_once '../../includes/header.php';
    include_once '../../classes/vendor.class.php';

    if(isset($_POST['login'])){
        $vendor = new Vendor;

        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);

        if($vendor->check($email, $password)){
            $data = $vendor->check($email, $password);

            $_SESSION['logged_in'] = $data['vendor_id'];
            $_SESSION['user_type'] = 'vendor';
            header('location: ../order.php');
        }

        $error = 'Invalid email/password. Please try again.';

    }
?>
<div class="content">
    <form class="form-container .invalid" method="post">
        <img src="../../icons/logo/logo_icon.svg">
        <h1>Login</h1>
        <hr>
        <div class="input-container">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <?php
            if(isset($error)){
                echo '<div class="error"><p>'.$error.'</p></div>';
            }
        ?>
        <div class="row1">
            <div class="remember-container">
                <input type="checkbox" class="check-box" name="remember" value="0">
                <p>Remember me</p>
            </div>
            <a href="#">Forgot Password?</a>
        </div>
        <input type="submit" name="login" class="submit-btn" value="Login">
    </form>
</div>

<?php
    include_once '../../includes/footer.php';
?>