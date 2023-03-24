<div class="top">
    <header>Welcome!</header>

    <img class="logo" src="../icons/logo/logo.svg">

<?php //Third item of topnav
    if($_SESSION['logged_in'] == 'null'){ //if customer didn't sign-in yet
        echo '<a href="login/login.php">Sign Up</a>';
    } //else will replace to a notification
    else{
        echo '<button><img src="../icons/notification.svg"></button>';
    }
?>    

    <span class="overlay"></span> <!-- Notification overlay --> 

    <div class="modal-box notification"> <!-- Notification container -->
        <div class="content empty">
            <header>No notification as of now.</header>
        </div>
    </div>
</div>