<?php
    include_once 'database.php';

    class OrderItem{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function getOrderID($user_id){
            $sql = "SELECT order_id FROM orders WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function addOrderItems($user_id, $food_id){
            $order_id = $this->getOrderID($user_id)[0];

            $sql = "INSERT INTO order_item (order_id, user_id, food_id) VALUES 
                    (:order_id, :user_id, :food_id);";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':food_id', $food_id);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        function checkEmpty($user_id, $status){
            $sql = 'SELECT COUNT(*) FROM order_item, orders WHERE order_item.user_id = :user_id AND 
                    order_item.order_id = orders.order_id AND orders.status = :status;';
            
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':status', $status);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function render($user_id, $order_id, $status){
            $sql = 'SELECT order_item.food_id, orders.order_id, orders.grand_total, food_product.name, food_product.price, food_product.img FROM order_item, food_product, orders WHERE order_item.food_id = food_product.food_id 
                    AND order_item.order_id = orders.order_id AND order_item.user_id = :user_id AND orders.order_id = :order_id AND orders.status = :status ORDER BY food_product.name;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':order_id', $order_id);
            $query->bindParam(':status', $status);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        function renderDate($order_id){
            $sql = "SELECT DATE_FORMAT(created_at, '%M %d,%Y %H:%i') as date FROM orders WHERE order_id = :order_id;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function renderSummary($user_id, $status, $order_id, $render){
            if($render == 'quantity'){ //for quantity
                $sql = "SELECT COUNT(order_item.food_id) FROM order_item, food_product, orders WHERE order_item.food_id = food_product.food_id AND order_item.order_id = :order_id AND order_item.user_id = :user_id AND 
                        orders.order_id = order_item.order_id AND food_product.food_id = order_item.food_id AND orders.status = :status GROUP BY order_item.food_id ORDER BY food_product.name;";
            }
            else{ //for food name, price and grand_total
                $sql = "SELECT food_product.name, food_product.price, orders.grand_total FROM food_product, orders, order_item WHERE order_item.food_id = food_product.food_id AND order_item.order_id = orders.order_id 
                        AND order_item.user_id = :user_id AND order_item.order_id = :order_id AND orders.status = :status GROUP BY food_product.food_id ORDER BY food_product.name;";
            }

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':status', $status);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }
    }
?>