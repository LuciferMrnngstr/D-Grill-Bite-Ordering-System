<?php

    include_once 'database.php';

    class Admin{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function check($email, $password){
            $sql = 'SELECT * FROM admin WHERE email=:email AND password=:password;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
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