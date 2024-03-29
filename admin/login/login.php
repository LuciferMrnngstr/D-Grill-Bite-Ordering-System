<?php
    session_start();

    // unset session if user haven't logged in yet or not yet set to admin
    if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin'){
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_type']);
    }

    include_once '../../tools/variables.php';
    $page_title = 'Meraki | Login';
    
    include_once '../../includes/header.php';
    include_once '../../classes/user.class.php';
    include_once '../../classes/admin.class.php';

    if(isset($_POST['login'])){
        $admin = new Admin;
        $user = new User;

        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);

        if($admin->check($email, $password)){
            $data = $admin->check($email, $password);

            if($user->getInfo($data['admin_id'], 'admin')){
                $data = $user->getInfo($data['admin_id'], 'admin');

                $_SESSION['logged_in'] = $data['admin_id'];
                $_SESSION['user_id'] = $data['user_id'];
                $_SESSION['user_type'] = $data['user_type'];

                header('location: ../store.php');
            }
        }

        $error = 'Invalid email/password.';

    }
?>

<div class="wrapper login-reg">
    <section class="form login admin">
        <img class="logo" src="../../icons/mix/logo_icon.svg">
        <img class="logo-text" src="../../icons/mix/logo_text.png">

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