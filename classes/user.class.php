<?php
    include_once 'database.php';

    class User{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function getId($user_type){
            if($user_type == 'customer'){
                $sql = "SELECT customer_id FROM customer ORDER BY created_at DESC LIMIT 1;";    
            }

            $query = $this->db->connect()->prepare($sql);
            
            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function insertUser($customer_id, $vendor_id, $cashier_id, $user_type){
            if($user_type == 'customer'){
                $sql = 'INSERT INTO user(customer_id, user_type) VALUES (:customer_id, :user_type);'; 
                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':customer_id', $customer_id);
                $query->bindParam(':user_type', $user_type);
            }

            $query = $this->db->connect()->prepare($sql);

            if($user_type == 'customer'){
                $query->bindParam(':customer_id', $customer_id);
            }
            
            $query->bindParam(':user_type', $user_type);
            // $query->bindParam(':customer_id', $customer_id);
            // $query->bindParam(':vendor_id', $vendor_id);
            // $query->bindParam(':cashier_id', $cashier_id);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        function getInfo($id, $type){
            $sql = 'SELECT * FROM user WHERE (admin_id = :id OR customer_id = :id OR vendor_id = :id OR cashier_id = :id) AND user_type = :type;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':id', $id);
            $query->bindParam(':type', $type);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }
    }
?>