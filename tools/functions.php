<?php

    function validate_custtype($POST){
        if($_POST['customer-type'] == 'none'){
            return false;
        }
        return true;
    }

    function validate_department($POST){
        if($_POST['department'] == 'none'){
            return false;
        }
        return true;
    }

    function validate_firstname($POST){
        if(strlen(trim($_POST['firstname'])) <= 1){
            return false;
        }
        return true;
    }

    function validate_middlename($POST){
        if(empty($_POST['middlename'])){
            return true;
        }
        else if(strlen(trim($_POST['middlename'])) < 1 || !strlen(trim($_POST['middlename'])) > 2){
            return false;
        }
        return true;
    }

    function validate_lastname($POST){
        if(strlen(trim($_POST['lastname'])) <= 1){
            return false;
        }
        return true;
    }

    function validate_contact($POST){
        if(strlen(trim($_POST['contact-num'])) != 11){
            return false;
        }
        return true;
    }

    function validate_email($POST){
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $parts = explode('@', $email);

            $domain = array_pop($parts);

            if(strcmp(strtolower($domain), 'wmsu.edu.ph') != 0){
                return false;
            }
        }
        else {
            return false;
        }
        return true;
    }

    function validate_email_duplicate($POST){
        $customer = new Customer;

        if($customer->check_email_dupli($_POST['email'])){
            return false;
        }

        return true;
    }

    function validate_password($POST){
        if(strlen(trim($_POST['password'])) < 8){
            return false;
        }
        return true;
    }

    function validate_register($POST){
        if(!validate_custtype($POST) || !validate_department($POST) || !validate_firstname($POST) || 
         !validate_middlename($POST) || !validate_lastname($POST) || !validate_contact($POST) || 
         !validate_email($POST) || !validate_email_duplicate($POST) || !validate_password($POST)){
            return false;
        }
        return true;
    }

?>