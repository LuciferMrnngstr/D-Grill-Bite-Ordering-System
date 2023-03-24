<?php

    include_once 'database.php';

    class Order{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function addOrder($user_id, $quantity, $grand_total){
            $sql = 'INSERT INTO orders (user_id, quantity, grand_total, status) 
                    VALUES (:user_id, :quantity, :grand_total, "pending");';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':quantity', $quantity);
            $query->bindParam(':grand_total', $grand_total);

            if($query->execute()){
                return true;
            }

            return false;
        }

        function countCustOrder($user_id){
            if($user_id == 'all'){ //for vendors landing page
                $sql = 'SELECT COUNT(*) FROM orders WHERE status != "released";';
            }
            else{ //for customer order page
                $sql = 'SELECT COUNT(*) FROM orders WHERE user_id = :user_id and status != "released";';
            }
            
            
            $query = $this->db->connect()->prepare($sql);
            if($user_id != 'all'){ //for vendors landing page
                $query->bindParam(':user_id', $user_id);
            }

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function renderStatus(){
            $sql = 'SELECT status FROM orders WHERE status != "released" GROUP BY status;';
            
            $query = $this->db->connect()->prepare($sql);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        function custDetail($user_id, $status, $user_type){
            if($user_type != 'vendor'){ //for customer user
                // $sql = 'SELECT orders.order_id, orders.user_id, orders.quantity, orders.grand_total, orders.status, DATE_FORMAT(orders.created_at, "%M %d,%Y %H:%i") as date, customer.last_name, customer.first_name, customer.middle_name, customer.cust_type, customer.email, customer.contact_no 
                //         FROM orders, customer WHERE orders.user_id = customer.user_id AND orders.user_id = :user_id AND orders.status = :status GROUP BY orders.user_id ORDER BY orders.created_at;';
                $sql = 'SELECT orders.order_id, orders.user_id, orders.quantity, orders.grand_total, orders.status, DATE_FORMAT(orders.created_at, "%M %d,%Y %H:%i") as date, customer.last_name, customer.first_name, customer.middle_name, customer.email, customer.contact_no 
                        FROM orders, customer, user WHERE orders.user_id = :user_id AND orders.user_id = user.user_id AND user.customer_id = customer.customer_id AND orders.status = :status ORDER BY orders.created_at;';
            }
            else if($user_type == 'vendor'){ //for vendor user
                if(!empty($user_id)){
                    $sql = 'SELECT orders.order_id, orders.user_id, orders.quantity, orders.grand_total, orders.status, DATE_FORMAT(orders.created_at, "%M %d,%Y %H:%i") as date, customer.last_name, customer.first_name, customer.middle_name, customer.email, customer.contact_no 
                    FROM orders, customer, user WHERE orders.user_id = :user_id AND orders.user_id = user.user_id AND user.customer_id = customer.customer_id AND orders.status = :status ORDER BY orders.created_at;';
                }
                else{
                    $sql = 'SELECT orders.order_id, orders.user_id, orders.quantity, orders.grand_total, orders.status, customer.last_name, customer.first_name, customer.middle_name 
                    FROM orders, customer, user WHERE orders.user_id = user.user_id AND user.customer_id = customer.customer_id AND orders.status = :status ORDER BY orders.created_at;';
                }
            }

            $query = $this->db->connect()->prepare($sql);
            if(!empty($user_id)){
                $query->bindParam(':user_id', $user_id);
            }
            $query->bindParam(':status', $status);

            if($query->execute()){
                if($user_type == 'customer'){ //for customer user
                    $data = $query->fetchAll();
                }
                else if(!empty($user_id)){ //for vendor user in customer details
                    $data = $query->fetch();
                }
                else{ //for vendor user in all customer orders
                    $data = $query->fetchAll();
                }
            }

            return $data;
        }

        function updatePrepare($order_id){
            $sql = "UPDATE orders SET status = 'preparing' WHERE order_id = :order_id;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        function updatePickup($order_id){
            $sql = "UPDATE orders SET status = 'ready for pickup' WHERE order_id = :order_id;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        function releaseOrder($order_id){
            $sql = "UPDATE orders SET status = 'released' WHERE order_id = :order_id;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }

?>