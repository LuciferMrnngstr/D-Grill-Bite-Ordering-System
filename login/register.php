<?php
    include_once '../tools/functions.php';
    include_once '../tools/variables.php';
    $page_title = 'Meraki | Register';
    $css = 'register';
    $register = ' active';

    include_once '../includes/header.php';
    include_once '../classes/customer.class.php';

    if(isset($_POST['register'])){
        $cust_type = $_POST['customer-type'];
        $department = $_POST['department'];
        $firstname = htmlentities($_POST['firstname']);
        $middlename = htmlentities($_POST['middlename']);
        $lastname = htmlentities($_POST['lastname']);
        $contact_num = htmlentities($_POST['contact-num']);
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $confirm_pass = htmlentities($_POST['confirm-pass']);

        $customer = new Customer;

        if(validate_register($_POST)){
            if($password == $confirm_pass){
                if(!empty($email)){
                    if($customer->register1($cust_type, $department, $firstname, $middlename, $lastname, $contact_num, $email, $password)){

                        header('location: login.php');
    
                    }
                }
                else{
                    if($customer->register2($cust_type, $department, $firstname, $lastname, $contact_num, $email, $password)){

                        header('location: login.php');
    
                    }
                }
            }
        }

    }
?>

<div class="content">
    <form class="form-container" method="post">
        <h1>Register</h1>
        <hr>
        <div class="row1">
            <div class="column">
                <label for="customer-type">Customer Type</label>
                <select name="customer-type" id="customer-type">
                    <option value="none" <?php if(isset($cust_type)){ if($cust_type == 'none') echo 'selected="selected"'; } ?>>Select</option>
                    <option value="Student" <?php if(isset($cust_type)){ if($cust_type == 'Student') echo 'selected="selected"'; } ?>>Student</option>
                    <option value="Faculty" <?php if(isset($cust_type)){ if($cust_type == 'Faculty') echo 'selected="selected"'; } ?>>Faculty</option>
                </select>
            </div>
            <div class="column">
                <label for="department">Department</label>
                <select name="department" id="department">
                    <option value="none" <?php if(isset($department)){ if($department == 'none') echo 'selected="selected"'; } ?>>Select</option>
                    <option value="CCS" <?php if(isset($department)){ if($department == 'CCS') echo 'selected="selected"'; } ?>>CCS</option>
                    <option value="CSM" <?php if(isset($department)){ if($department == 'CSM') echo 'selected="selected"'; } ?>>CSM</option>
                </select>
            </div>
        </div>
        
        <!-- error message -->
        <?php
            if(isset($_POST['register'])){
                if(!validate_custtype($_POST) && !validate_department($_POST)){
                    echo '<div class="error"><p>Please select customer type or department.</p></div>';
                }
                else if(!validate_custtype($_POST)){
                    echo '<div class="error"><p>Please select customer type.</p></div>';
                }
                else if(!validate_department($_POST)){
                    echo '<div class="error"><p>Please select a department.</p></div>';
                }
            }
        ?>

        <div class="input-container">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" value="<?php if(isset($firstname)){ echo $firstname; } ?>">
            
            <!-- error message -->
            <?php
                if(isset($_POST['register'])){
                    if(empty($_POST['firstname'])){
                        echo '<div class="error"><p>Please enter your first name.</p></div>';
                    }
                    else if(!validate_firstname($_POST)){
                        echo '<div class="error"><p>Invalid first name.</p></div>';
                    }
                }
            ?>

            <label for="middlename">Middle Name <span>(optional)</span></label>
            <input type="text" name="middlename" id="middlename" value="<?php if(isset($middlename)){ echo $middlename; } ?>">
            
            <!-- error message -->
            <?php
                if(isset($_POST['register'])){
                    if(!validate_middlename($_POST)){
                        echo '<div class="error"><p>Invalid middle name.</p></div>';
                    }
                }
            ?>

            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" value="<?php if(isset($lastname)){ echo $lastname; } ?>">
            
            <!-- error message -->
            <?php
                if(isset($_POST['register'])){
                    if(empty($_POST['lastname'])){
                        echo '<div class="error"><p>Please enter your last name.</p></div>';
                    }
                    else if(!validate_lastname($_POST)){
                        echo '<div class="error"><p>Invalid last name.</p></div>';
                    }
                }
            ?>

            <label for="contact-num">Contact Number</label>
            <input type="number" name="contact-num" id="contact-num" value="<?php if(isset($contact_num)){ echo $contact_num; } else{ echo '09'; } ?>">
            
            <!-- error message -->
            <?php
                if(isset($_POST['register'])){
                    if(empty($_POST['contact-num'])){
                        echo '<div class="error"><p>Please enter your contact number.</p></div>';
                    }
                    else if(!validate_contact($_POST)){
                        echo '<div class="error"><p>Invalid contact number.</p></div>';
                    }
                }
            ?>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="sample132@wmsu.edu.ph" value="<?php if(isset($email)){ echo $email; } ?>">
            
            <!-- error message -->
            <?php
                if(isset($_POST['register'])){
                    if(empty($_POST['email'])){
                        echo '<div class="error"><p>Please enter an email address.</p></div>';
                    }
                    else if(!validate_email($_POST)){
                        echo '<div class="error"><p>Invalid email address.</p></div>';
                    }
                    else if(!validate_email_duplicate($_POST)){
                        echo '<div class="error"><p>Email address has alreaady been used.</p></div>';
                    }
                }
            ?>

            <label for="password">Password <span>(must be 8 or more characters long)</span></label>
            <input type="password" name="password" id="password">
            
            <!-- error message -->
            <?php
                if(isset($_POST['register'])){
                    if(empty($_POST['password'])){
                        echo '<div class="error"><p>Please enter a password.</p></div>';
                    }
                    else if(!validate_password($_POST)){
                        echo '<div class="error"><p>Invalid password. Must be more than 8 letters.</p></div>';
                    }
                }
            ?>

            <label for="confirm-pass">Confirm Password</label>
            <input type="password" name="confirm-pass" id="confirm-pass">
            
            <!-- error message -->
            <?php
                if(isset($_POST['register'])){
                    if(empty($_POST['confirm-pass'])){
                        echo '<div class="error"><p>Please re-enter the password.</p></div>';
                    }
                    else if($_POST['password'] != $_POST['confirm-pass'] ){
                        echo '<div class="error"><p>Password didn\'t match.</p></div>';
                    }
                }
            ?>

        </div>
        <input type="submit" name="register" class="submit-btn" value="Register">
        <div class="row2">
            <p>Already have an account?</p>
            <a href="login.php">Login</a>
        </div>
    </form>
</div>

<?php
    include_once '../includes/navbar.php';
    include_once '../includes/footer.php';
?>