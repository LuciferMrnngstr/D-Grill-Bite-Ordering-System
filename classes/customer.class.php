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

        function register($firstname, $middlename, $lastname, $email, $contact_num, $password){
            if(strlen($middlename) < 1){ //For without middlename
                $sql = 'INSERT INTO customer(email, password, first_name, last_name, contact_no)
                VALUES (:email, :password, :firstname, :lastname, :contact_num);';
            }
            else{ //For with midlename
                $sql = 'INSERT INTO customer(email, password, first_name, middle_name, last_name, contact_no) 
                VALUES (:email, :password, :firstname, :middlename, :lastname, :contact_num);';
            }
            
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            $query->bindParam(':firstname', $firstname);
            if(strlen($middlename) > 0){
                $query->bindParam(':middlename', $middlename);
            }
            $query->bindParam(':lastname', $lastname);
            $query->bindParam(':contact_num', $contact_num);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        function renderInfo($customer_id){
            $sql = "SELECT * FROM customer WHERE customer_id = :customer_id;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':customer_id', $customer_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }
    }

?>