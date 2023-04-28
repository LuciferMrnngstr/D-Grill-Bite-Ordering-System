<?php
    session_start();

    include_once '../../tools/variables.php';
    $page_title = 'Meraki | Login';
    $css = 'login';
    $login = ' active';
    
    include_once '../../includes/header.php';
    include_once '../../classes/user.class.php';
    include_once '../../classes/customer.class.php';

    $_SESSION['user_type'] = 'customer';
    $_SESSION['logged_in'] = 'null';

    if(isset($_POST['login'])){
        $customer = new Customer;
        $user = new User;

        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);

        if($customer->check($email, $password)){
            $data = $customer->check($email, $password);

            if($user->getInfo($data['customer_id'], 'customer')){
                $data = $user->getInfo($data['customer_id'], 'customer');

                $_SESSION['logged_in'] = $data['customer_id'];
                $_SESSION['user_id'] = $data['user_id'];
                $_SESSION['user_type'] = $data['user_type'];
            }
            header('location: ../home.php');
        }

        $error = 'Invalid email/password. Please try again.';

    }
?>
<div class="content">
    <?php
        if(isset($_SESSION['registered'])){
           echo '<div class="message active" onclick="this.remove();"><p>' . $_SESSION['registered'] .'</p></div>';
           session_destroy();
        }
    ?>
    <form class="form-container" method="post">
        <img src="../../icons/logo/logo_icon.svg">
        <h1>Login</h1>
        <hr>
        <div class="input-container">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="@wmsu.edu.ph">
            <label for="password">Password</label>
            <div class="password-container">
                <input type="password" id="password" name="password">
                <div class="show-pass"></div>
            </div>
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
        <div class="row2">
            <p>Don't have account?</p>
            <a href="register.php">Register</a>
        </div>
    </form>
</div>

<?php
    include_once '../../includes/navbar.php';
    include_once '../../includes/footer.php';
?>