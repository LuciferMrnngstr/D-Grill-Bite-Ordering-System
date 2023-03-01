<?php
    include_once 'database.php';

    class Cart{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function addToCart($customer_id, $food_id){
            if(!empty($customer_id)){
                $sql = 'INSERT INTO cart (customer_id, food_id, status) VALUES 
                    (:customer_id, :food_id, "pending");';
            }
            else{
                $sql = 'INSERT INTO cart (food_id, status) VALUES 
                    (:food_id, "pending");';
            }

            $query = $this->db->connect()->prepare($sql);
            if(!empty($customer_id)){
                $query->bindParam(':customer_id', $customer_id);
            }
            $query->bindParam(':food_id', $food_id);

            if($query->execute()){
                return true;
            } else{
                return false;
            }
        }

        function checkEmpty($customer_id){
            if($customer_id == 'NULL'){
                $sql = 'SELECT COUNT(*) FROM cart WHERE customer_id IS NULL AND cart.status = "pending";';
            }
            else{
                $sql = 'SELECT COUNT(*) FROM cart WHERE customer_id = :customer_id AND cart.status = "pending";';
            }

            $query = $this->db->connect()->prepare($sql);
            if($customer_id != 'NULL'){
                $query->bindParam(':customer_id', $customer_id);
            }

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function render($customer_id){
            if($customer_id == 'NULL'){
                $sql = 'SELECT cart.cart_id, cart.customer_id, cart.food_id, cart.status, food_product.price, food_product.img, food_product.name FROM cart, food_product 
                        WHERE cart.food_id = food_product.food_id AND cart.customer_id IS NULL AND cart.status = "pending" ORDER BY food_product.name;';
            }
            else{
                $sql = 'SELECT cart.cart_id, cart.customer_id, cart.food_id, cart.status, food_product.price, food_product.img, food_product.name FROM cart, food_product 
                        WHERE cart.food_id = food_product.food_id AND cart.customer_id = :customer_id AND cart.status = "pending" ORDER BY food_product.name;';
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

        function remove($id, $what){
            if($what == 'all'){
                $sql = "DELETE FROM cart WHERE customer_id = :id;";    
            }
            else{
                $sql = "DELETE FROM cart WHERE cart_id = :id;";
            }

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':id', $id);

            if($query->execute()){
                return true;
            }
            return false;
        }

        // function submitCart($customer_id){
        //     // UPDATE cart SET status = "pending" WHERE customer_id = 1 AND status = "submitted";
        //     $sql = 'UPDATE cart SET status = "submitted" WHERE customer_id = :customer_id AND status = "pending";';

        //     $query = $this->db->connect()->prepare($sql);
        //     $query->bindParam(':customer_id', $customer_id);

        //     if($query->execute()){
        //         return true;
        //     }
        //     else{
        //         return false;
        //     }
        // }

        // FOR ORDER SUMMARY
        function renderSummary($render, $customer_id){
            if($render == 'names'){ //for food product id and food price
                $sql = 'SELECT food_product.name, food_product.price FROM cart, food_product WHERE cart.food_id = food_product.food_id 
                        AND cart.customer_id = :customer_id AND cart.status = "pending" GROUP BY food_product.name ORDER BY food_product.name;';
            }
            else{ //for quantity
                $sql = 'SELECT COUNT(cart.food_id) FROM cart, food_product WHERE cart.food_id = food_product.food_id 
                        AND customer_id = :customer_id AND cart.status = "pending" GROUP BY cart.food_id ORDER BY food_product.name;';
            }

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':customer_id', $customer_id);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

    }
?>