<div class="top">
    <?php
        if($page_title == 'Home'){
            echo '<p>Welcome!</p>';
        }
        else if($page_title == 'My Cart'){
            echo '<p>My Cart</p>';
        }
        else{
            echo '<a href="home.php" class="back-btn">Go Back</a>';
        }

        echo '<img src="../icons/logo/logo_icon.svg" class="logo">';

        if(!isset($_SESSION['logged_in'])){
            echo '<a href="../login/login.php" class="submit-btn">Sign in</a>';
        }
        else{
            if($css == 'food_details'){
                echo '<a href="#"><img src="../icons/items/heart-empty.svg"></a>';
            }
            else{
                echo '<a href="#"><img src="../icons/notification.svg"></a>';
            }
        }
    ?>
</div>