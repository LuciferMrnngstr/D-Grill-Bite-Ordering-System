<?php
    session_start();
    // session_destroy();

    include_once '../../tools/variables.php';
    $page_title = 'Meraki | Login';
    
    include_once '../../includess/header.php';
    include_once '../../classes/user.class.php';
    include_once '../../classes/vendor.class.php';

    if(isset($_POST['login'])){
        $vendor = new Vendor;
        $user = new User;

        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);

        if($vendor->check($email, $password)){
            $data = $vendor->check($email, $password);

            if($user->getInfo($data['vendor_id'], 'vendor')){
                $data = $user->getInfo($data['vendor_id'], 'vendor');

                $_SESSION['logged_in'] = $data['vendor_id'];
                $_SESSION['user_id'] = $data['user_id'];
                $_SESSION['user_type'] = $data['user_type'];
                header('location: ../orders.php');
            }
        }

        $error = 'Invalid email/password.';
        // echo $_SESSION['user_type'];
    }
?>

<div class="wrapper login-reg">
    <section class="form login admin">
        <img class="logo" src="../../icons/logo/logo_icon.svg">
        <img class="logo-text" src="../../icons/logo/logo_text.png">

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

            <div class="field button">
                <input type="submit" value="LOGIN" name="login">
            </div>
        </form>

    </section>
</div>

<script src="../../script/showPass.js"></script>

<?php
    include_once '../../includes/footer.php';
?>