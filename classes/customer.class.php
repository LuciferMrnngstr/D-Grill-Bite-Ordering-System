<?php

    include_once 'database.php';

    class Customer{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function check($email, $password){
            $sql = 'SELECT * FROM customer WHERE email=:email AND password=:password;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function check_email_dupli($email){
            $sql = 'SELECT email FROM customer WHERE email=:email;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':email', $email);

            if($query->execute()){
                $data = $query->fetch();
            }
            return $data;
        }

        function register($cust_type, $department, $firstname, $middlename, $lastname, $contact_num, 
            $email, $password){

            if(strlen($middlename) <= 0){
                $sql = 'INSERT INTO customer(email, password, first_name, last_name, contact_no, 
                cust_type, department) VALUES (:email, :password, :firstname, :lastname, 
                :contact_num, :cust_type, :department);';
            }
            else{
                $sql = 'INSERT INTO customer(email, password, firstName, middleName, lastName, contactNo, 
                cust_type, department) VALUES (:email, :password, :firstname, :middlename, :lastname, 
                :contact_num, :cust_type, :department);';
            }
            
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            $query->bindParam(':firstname', $firstname);
            if(strlen($middlename) > 0){
                if(strlen($middlename) == 1){
                    $middlename = $middlename . '.';
                    $query->bindParam(':middlename', $middlename);
                }
                else{
                    $query->bindParam(':middlename', $middlename);
                }

            }
            $query->bindParam(':lastname', $lastname);
            $query->bindParam(':contact_num', $contact_num);
            $query->bindParam(':cust_type', $cust_type);
            $query->bindParam(':department', $department);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }

?>