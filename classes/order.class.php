<?php

    include_once 'database.php';

    class Order{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function addOrder($cart_id, $total_price){
            $sql = 'INSERT INTO orders (cart_id, total_price) VALUES (:cart_id, :total_price);';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':cart_id', $cart_id);
            $query->bindParam(':total_price', $total_price);

            if($query->execute()){
                return true;
            }

            return false;
        }
    }

?>