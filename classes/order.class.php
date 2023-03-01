<?php

    include_once 'database.php';

    class Order{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function addOrder($customer_id, $quantity, $grand_total){
            $sql = 'INSERT INTO orders (customer_id, quantity, grand_total, status) 
                    VALUES (:customer_id, :quantity, :grand_total, "pending");';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':customer_id', $customer_id);
            $query->bindParam(':quantity', $quantity);
            $query->bindParam(':grand_total', $grand_total);

            if($query->execute()){
                return true;
            }

            return false;
        }

        function countCustOrder($customer_id){
            if($customer_id == 'all'){ //for vendors landing page
                $sql = 'SELECT COUNT(*) FROM orders WHERE status != "released";';
            }
            else{ //for customer order page
                $sql = 'SELECT COUNT(*) FROM orders WHERE customer_id = :customer_id;';
            }
            
            
            $query = $this->db->connect()->prepare($sql);
            if($customer_id != 'all'){ //for vendors landing page
                $query->bindParam(':customer_id', $customer_id);
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

        function custDetail($customer_id, $status, $user_type){
            if(!empty($customer_id)){ //for vendor user
                // $sql = 'SELECT orders.order_id, orders.customer_id, orders.quantity, orders.grand_total, orders.status, DATE_FORMAT(orders.created_at, "%M %d,%Y %H:%i") as date, customer.last_name, customer.first_name, customer.middle_name, customer.cust_type, customer.email, customer.contact_no 
                //         FROM orders, customer WHERE orders.customer_id = customer.customer_id AND orders.customer_id = :customer_id AND orders.status = :status GROUP BY orders.customer_id ORDER BY orders.created_at;';
                $sql = 'SELECT orders.order_id, orders.customer_id, orders.quantity, orders.grand_total, orders.status, DATE_FORMAT(orders.created_at, "%M %d,%Y %H:%i") as date, customer.last_name, customer.first_name, customer.middle_name, customer.cust_type, customer.email, customer.contact_no 
                        FROM orders, customer WHERE orders.customer_id = customer.customer_id AND orders.customer_id = :customer_id AND orders.status = :status ORDER BY orders.created_at;';
            }
            else{ //for customer user
                $sql = 'SELECT orders.order_id, orders.customer_id, orders.quantity, orders.grand_total, orders.status, customer.last_name, customer.first_name, customer.middle_name, customer.cust_type 
                        FROM orders, customer WHERE orders.customer_id = customer.customer_id AND orders.status = :status ORDER BY orders.created_at;';
            }

            $query = $this->db->connect()->prepare($sql);
            if(!empty($customer_id)){
                $query->bindParam(':customer_id', $customer_id);
            }
            $query->bindParam(':status', $status);

            if($query->execute()){
                if($user_type == 'customer'){ //for customer user
                    $data = $query->fetchAll();
                }
                else if(!empty($customer_id)){ //for vendor user in customer details
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