<?php
    include_once 'database.php';

    class Cart{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function addToCart1($customer_id, $food_id, $quantity, $total_price){
            $sql = 'INSERT INTO cart (customer_id, food_id, quantity, total_price) VALUES 
                    (:customer_id, :food_id, :quantity, :total_price);';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':customer_id', $customer_id);
            $query->bindParam(':food_id', $food_id);
            $query->bindParam(':quantity', $quantity);
            $query->bindParam(':total_price', $total_price);

            if($query->execute()){
                return true;
            } else{
                return false;
            }
        }

        function addToCart2($food_id, $quantity, $total_price){
            $sql = 'INSERT INTO cart (food_id, quantity, total_price) VALUES 
                    (:food_id, :quantity, :total_price);';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':food_id', $food_id);
            $query->bindParam(':quantity', $quantity);
            $query->bindParam(':total_price', $total_price);

            if($query->execute()){
                return true;
            } else{
                return false;
            }
        }
    }
?>