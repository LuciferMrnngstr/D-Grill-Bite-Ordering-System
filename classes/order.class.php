<?php

    include_once 'database.php';

    class Order{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function addOrder($customer_id, $food_product_id, $quantity){
            $sql = 'INSERT INTO orders (customer_id, food_product_id, quantity, status) 
                    VALUES (:customer_id, :food_product_id, :quantity, "PENDING");';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':customer_id', $customer_id);
            $query->bindParam(':food_product_id', $food_product_id);
            $query->bindParam(':quantity', $quantity);

            if($query->execute()){
                return true;
            }

            return false;
        }
    }

?>