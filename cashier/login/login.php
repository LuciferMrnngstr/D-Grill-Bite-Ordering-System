<?php
    session_start();

    include_once '../../tools/variables.php';
    $page_title = 'Meraki | Login';
    $css = '../css/login.css';
    $login = ' active';
    
    include_once '../../includes/header2.php';
    include_once '../../classes/cashier.class.php';
    include_once '../../classes/user.class.php';

    if(isset($_POST['login'])){
        $cashier = new Cashier;
        $user = new User;

        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);

        if($cashier->check($email, $password)){
            $data = $cashier->check($email, $password);

            if($user->getInfo($data['cashier_id'], 'cashier')){
                $data = $user->getInfo($data['cashier_id'], 'cashier');

                $_SESSION['logged_in'] = $data['cashier_id'];
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

        <input type="submit" name="login" class="submit-btn" value="Login">
        
    </form>
</div>

<?php
    include_once '../../includes/footer.php';
?>