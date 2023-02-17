<?php
    include_once 'database.php';

    class Cart{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function addToCart($customer_id, $food_product_id, $quantity, $sub_total){
            if(!empty($customer_id)){
                $sql = 'INSERT INTO cart (customer_id, food_product_id, quantity, sub_total) VALUES 
                    (:customer_id, :food_product_id, :quantity, :sub_total);';
            }
            else{
                $sql = 'INSERT INTO cart (food_product_id, quantity, sub_total) VALUES 
                    (:food_product_id, :quantity, :sub_total);';
            }

            $query = $this->db->connect()->prepare($sql);
            if(!empty($customer_id)){
                $query->bindParam(':customer_id', $customer_id);
            }
            $query->bindParam(':food_product_id', $food_product_id);
            $query->bindParam(':quantity', $quantity);
            $query->bindParam(':sub_total', $sub_total);

            if($query->execute()){
                return true;
            } else{
                return false;
            }
        }

        function render($customer_id){
            if($customer_id == 'NULL'){
                $sql = 'SELECT cart.customer_id, cart.cart_id, cart.created_at, food_product.img, food_product.name, cart.quantity, 
            food_product.price, cart.sub_total FROM cart, food_product WHERE cart.food_product_id = food_product.food_product_id AND 
            cart.customer_id IS NULL ORDER BY cart.created_at;';
            }
            else{
                $sql = 'SELECT cart.customer_id, cart.cart_id, cart.created_at, food_product.img, food_product.name, cart.quantity, 
            food_product.price, cart.sub_total FROM cart, food_product WHERE cart.food_product_id = food_product.food_product_id AND 
            cart.customer_id = :customer_id ORDER BY cart.created_at;';
            }

            $query = $this->db->connect()->prepare($sql);
            if($customer_id != 'NULL'){
                $query->bindParam(':customer_id', $customer_id);
            }

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }
    }
?>