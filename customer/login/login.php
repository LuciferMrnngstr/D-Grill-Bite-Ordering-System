<?php
    session_start();

    include_once '../../tools/variables.php';
    $page_title = 'Meraki | Login';
    
    include_once '../../includess/header.php';
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
            $cust_data = $customer->check($email, $password);

            if($user->getInfo($cust_data['customer_id'], 'customer')){
                $cust_data = $user->getInfo($cust_data['customer_id'], 'customer');

                $_SESSION['logged_in'] = $cust_data['customer_id'];
                $_SESSION['user_id'] = $cust_data['user_id'];
                $_SESSION['user_type'] = $cust_data['user_type'];
            }
            header('location: ../home.php');
        }

        $error = 'Invalid email/password.';

    }
?>

<div class="wrapper login-reg">
    <?php
        if(isset($_SESSION['registered'])){ //Popup sign up successful 
            echo '<div class="alert active" onclick="this.remove();"><p>' . $_SESSION['registered'] . '</p></div>';
            unset($_SESSION['registered']);
        }
    ?>

    <section class="form login">
        <img class="logo" src="../../icons/mix/logo_icon.svg">

        <header>Login</header>

        <form method="post">
            <div class="field input">
                <label>Email</label>
                <input type="text" name="email" placeholder="Enter your email">
            </div>

            <div class="field input">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password">
                <i class="toggle"></i>
            </div>

            <?php //Error message
                if(isset($error)) echo '<div class="error-txt">' . $error .'</div>'
            ?>

            <div class="field action">
                <div class="content">
                    <input type="checkbox" class="check-box" name="remember" value="0">
                    <p>Remember me</p>
                </div>
                <a href="#">Forgot Password?</a>
            </div>

            <div class="field button">
                <input type="submit" value="LOGIN" name="login">
            </div>
        </form>

        <div class="link">Don't have account? <a href="register.php">Signup now</a></div>
    </section>
</div>

<script src="../../script/showPass.js"></script>

<?php
    include_once '../../includes/footer.php';
?>