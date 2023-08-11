<?php

    include_once 'database.php';

    class Order{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        // this
        function addOrder($user_id, $total_order, $grand_total){
            $sql = 'INSERT INTO orders (user_id, total_order, grand_total, payment_method, payment_status, order_status) 
                    VALUES (:user_id, :total_order, :grand_total, "Cash (Walk-in)", "unpaid", "pending");';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':total_order', $total_order);
            $query->bindParam(':grand_total', $grand_total);

            if($query->execute()){
                return true;
            }

            return false;
        }

        // this
        function countCustOrder($user_id){
            if($user_id == 'all'){ //for vendors landing page
                $sql = 'SELECT COUNT(*) FROM orders WHERE order_status != "released" AND order_status != "claimed";';
            }
            else{ //for customer order page
                $sql = 'SELECT COUNT(*) FROM orders WHERE user_id = :user_id and order_status != "released";';
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

        // this
        function countCustOrderHistory($user_id){
            if($user_id == 'all'){ //for vendors landing page
                $sql = 'SELECT COUNT(*) FROM orders WHERE order_status = "released" OR order_status = "claimed";';
            }
            else{ //for customer order page
                $sql = 'SELECT COUNT(*) FROM orders WHERE user_id = :user_id AND order_status = "released" OR order_status = "claimed";';
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

        // this
        function renderStatus(){
            $sql = 'SELECT order_status FROM orders WHERE order_status != "claimed" GROUP BY order_status;';
            
            $query = $this->db->connect()->prepare($sql);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        // this. Count the number of order by status, for limiting render
        function countStatus($status){
            $sql = 'SELECT COUNT(*) FROM orders WHERE order_status = :order_status;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_status', $status);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        // this
        function renderOrderHistoryStatus(){
            $sql = 'SELECT order_status FROM orders WHERE order_status = "claimed" OR order_status = "released" GROUP BY order_status;';
            
            $query = $this->db->connect()->prepare($sql);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        // this. For Vendor
        function renderOrdersVendor($order_status, $show_all){
            if($show_all === false){ //limiting the render to 2
                $sql = 'SELECT orders.order_id, orders.user_id, orders.total_order, orders.grand_total, orders.order_status, orders.payment_method, orders.payment_status, DATE_FORMAT(orders.created_at, "%M %d, %Y") as date, DATE_FORMAT(orders.created_at, "%H:%i") as time 
                FROM orders, user WHERE orders.user_id = user.user_id AND orders.order_status = :order_status ORDER BY orders.created_at LIMIT 2;';
            }
            else{ //if show all is active for certain status
                $sql = 'SELECT orders.order_id, orders.user_id, orders.total_order, orders.grand_total, orders.order_status, orders.payment_method, orders.payment_status, DATE_FORMAT(orders.created_at, "%M %d, %Y") as date, DATE_FORMAT(orders.created_at, "%H:%i") as time 
                FROM orders, user WHERE orders.user_id = user.user_id AND orders.order_status = :order_status ORDER BY orders.created_at;';
            }

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_status', $order_status);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }



        // this
        function renderOrdersCust($user_id, $order_status){
            $sql = 'SELECT orders.order_id, orders.user_id, orders.total_order, orders.grand_total, orders.order_status, orders.payment_status, DATE_FORMAT(orders.created_at, "%M %d, %Y") as date, DATE_FORMAT(orders.created_at, "%H:%i") as time, customer.last_name, customer.first_name, customer.middle_name, customer.email, customer.contact_no 
            FROM orders, customer, user WHERE orders.user_id = :user_id AND orders.user_id = user.user_id AND user.customer_id = customer.customer_id AND orders.order_status = :order_status ORDER BY orders.created_at;';
            

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':order_status', $order_status);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        // this
        function renderOrdersCustAll($order_status){
            $sql = 'SELECT orders.order_id, orders.user_id, orders.total_order, orders.grand_total, orders.order_status, orders.payment_status, DATE_FORMAT(orders.created_at, "%M %d, %Y") as date, DATE_FORMAT(orders.created_at, "%H:%i") as time 
            FROM orders, user WHERE orders.user_id = user.user_id AND orders.order_status = :order_status ORDER BY orders.created_at;';
            

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_status', $order_status);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        // this for rendering order info -----

        //get user type
        function getUserType($user_id){
            $sql = 'SELECT user_type FROM user WHERE user_id = :user_id;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        //render user info
        function renderOrder($order_id, $user_id){
            $user_type = $this->getUserType($user_id);

            if($user_type[0] === 'customer'){
                $sql = 'SELECT customer.first_name, customer.middle_name, customer.last_name, customer.email, customer.contact_no, orders.order_status, orders.payment_status, orders.payment_method, orders.total_order, orders.order_id,
                    DATE_FORMAT(orders.created_at, "%M %d, %Y") as date, DATE_FORMAT(orders.created_at, "%H:%i") as time FROM orders, customer WHERE order_id = :order_id AND user_id = :user_id;';
            }
            else if($user_type[0] === 'vendor'){
                $sql = 'SELECT vendor.first_name, vendor.middle_name, vendor.last_name, vendor.email, vendor.contact_no, orders.order_status, orders.payment_status, orders.payment_method, orders.total_order, orders.order_id, 
                DATE_FORMAT(orders.created_at, "%M %d, %Y") AS date, DATE_FORMAT(orders.created_at, "%H:%i") AS time FROM orders, vendor WHERE order_id = :order_id AND user_id = :user_id;';
            }
            else if($user_type[0] === 'admin'){
                $sql = 'SELECT admin.first_name, admin.middle_name, admin.last_name, admin.email, admin.contact_no, orders.order_status, orders.payment_status, orders.payment_method, orders.total_order, orders.order_id, 
                DATE_FORMAT(orders.created_at, "%M %d, %Y") AS date, DATE_FORMAT(orders.created_at, "%H:%i") AS time FROM orders, admin WHERE order_id = :order_id AND user_id = :user_id;';
            }

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);
            $query->bindParam(':user_id', $user_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        // ----- ***** -----

        function updatePrepare($order_id){
            $sql = "UPDATE orders SET order_status = 'preparing' WHERE order_id = :order_id;";

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
            $sql = "UPDATE orders SET order_status = 'ready for pickup' WHERE order_id = :order_id;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        function updatePaid($order_id){
            $sql = "UPDATE orders SET payment_status = 'paid' WHERE order_id = :order_id;";

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
            $sql = "UPDATE orders SET order_status = 'released' WHERE order_id = :order_id;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        function markClaimed($order_id){
            $sql = "UPDATE orders SET order_status = 'claimed' WHERE order_id = :order_id;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        function getOrderInfo($order_id){
            $sql = 'SELECT * from orders where order_id = :order_id;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }
    }

?>