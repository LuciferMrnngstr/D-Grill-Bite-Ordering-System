<?php
    session_start();

    include_once '../../tools/functions.php';
    include_once '../../tools/variables.php';
    $page_title = 'Meraki | Register';
    
    include_once '../../includess/header.php';
    include_once '../../classes/user.class.php';
    include_once '../../classes/customer.class.php';

    $_SESSION['user_type'] = 'customer';
    $_SESSION['logged_in'] = 'null';

    if(isset($_POST['next'])){
        $firstname = htmlentities(ucwords($_POST['first-name']));
        $middlename = htmlentities(ucwords($_POST['middle-name']));
        $lastname = htmlentities(ucwords($_POST['last-name']));
    }

    if(isset($_POST['signup'])){
        $firstname = htmlentities(ucwords($_POST['first-name']));
        $middlename = htmlentities(ucwords($_POST['middle-name']));
        $lastname = htmlentities(ucwords($_POST['last-name']));
        $email = htmlentities($_POST['email']);
        $contact_num = htmlentities($_POST['contact-num']);
        $password = htmlentities($_POST['password']);
        $confirm_pass = htmlentities($_POST['confirm-pass']);

        $customer = new Customer;
        $user = new User;

        if($customer->check_email_dupli($email)){
            $emailTaken = 'Email address has already been used.';
        }

        if(!isset($emailTaken)){
            if($password == $confirm_pass){
                // Register customer into database
                if($customer->register($firstname, $middlename, $lastname, $email, $contact_num, $password)){
                    if($user->getId('customer')){
                        $data = $user->getId('customer'); //Get customer id

                        $user->insertUser($data['customer_id'], '', '', 'customer'); //Insert the newly created account into user table 

                        $_SESSION['registered'] = "Registered Successfully";
                        header('location: login.php');
                    }
                }
            }
        }
    }
?>

<script defer src="../../script/reg-validate.js"></script> <!-- register form validation js file -->

<div class="wrapper login-reg">
    <section class="form signup-name <?php if(isset($_POST['signup'])){ echo ''; } else if(!isset($_POST['next'])){ echo 'active'; }?>">
        <header>Register</header>

        <form id="name-form" method="post">
            <div class="field input">
                <label for="first-name" >First Name</label>
                <input type="text" id="first-name" name="first-name" placeholder="Enter your first name" value="<?php if(isset($firstname)){ echo $firstname; } ?>">
                <div class="error-reg"><p>Invalid first name.</p></div>
            </div>

            <div class="field input">
                <label for="middle-name" >Middle Name <span>(optional)</span></label>
                <input type="text" id="middle-name" name="middle-name" placeholder="Enter your middle name" value="<?php if(isset($middlename)){ echo $middlename; } ?>">
                <div class="error-reg"><p>Invalid middle name.</p></div>
            </div>

            <div class="field input">
                <label for="last-name" >Last Name</label>
                <input type="text" id="last-name" name="last-name" placeholder="Enter your last name" value="<?php if(isset($lastname)){ echo $lastname; } ?>">
                <div class="error-reg"><p>Invalid last name.</p></div>
            </div>

            <div class="field button">
                <input type="submit" name="next" value="NEXT">
            </div>
        </form>

        <div class="link">Already have an account? <a href="login.php">Login</a></div>
    </section>

    <section class="form signup-info <?php if(isset($_POST['signup'])){ echo 'active'; } else if(isset($_POST['next'])){ echo 'active'; }?>">
        <header>Register</header>

        <form id="info-form" method="post">
            <input type="hidden" name="first-name" value="<?= $firstname ?>">
            <input type="hidden" name="middle-name" value="<?= $middlename ?>">
            <input type="hidden" name="last-name" value="<?= $lastname ?>">

            <div class="field input <?php if(isset($emailTaken)){ echo 'error'; } ?>">
                <label>Email</label>
                <input type="text" id="email" name="email" placeholder="sample123@wmsu.edu.ph" value="<?php if(isset($email)){ echo $email; } ?>">
                <?php if(isset($emailTaken)){ echo '<div class="error-reg" style="font-size: 12px"><p>'.$emailTaken.'</p></div>'; unset($emailTaken);} else { echo '<div class="error-reg"><p>Invalid email.</p></div>'; } ?>
            </div>

            <div class="field input">
                <label>Contact Number</label>
                <input type="number" id="contact-num" name="contact-num" value="<?php if(isset($contact_num)){ echo $contact_num; } else { echo '09'; }?>">
                <div class="error-reg"><p>Invalid contact number.</p></div>
            </div>

            <div class="field input">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your new password" value="<?php if(isset($password)){ echo $password; } ?>">
                <i class="toggle"></i>
                <div class="error-reg"><p>Must be 8 or more characters.</p></div>
            </div>

            <div class="field input">
                <label>Re-enter Password</label>
                <input type="password" id="confirm-pass" name="confirm-pass" placeholder="Re-enter your password" value="<?php if(isset($confirm_pass)){ echo $confirm_pass; } ?>">
                <div class="error-reg"><p>password didn't matched.</p></div>
            </div>

            <div class="field button">
                <span class="back-btn">Back</span>
                <input type="submit" name="signup" value="NEXT">
            </div>
        </form>

        <div class="link">Already have an account? <a href="login.php">Login</a></div>
    </section>
</div>

<script src="../../script/showPass.js"></script>

<?php
    include_once '../../includess/footer.php';
?>