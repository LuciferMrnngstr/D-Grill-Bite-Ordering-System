<?php

    include_once 'database.php';

    class Order{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        // this
        function addOrder($user_id, $total_order, $grand_total){
            $sql = 'INSERT INTO orders (user_id, total_order, grand_total, discounted_total, payment_method, payment_status, order_status) 
                    VALUES (:user_id, :total_order, :grand_total, :discounted_total, "Cash (Walk-in)", "unpaid", "pending");';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':total_order', $total_order);
            $query->bindParam(':grand_total', $grand_total);
            $query->bindParam(':discounted_total', $grand_total);

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
                $sql = 'SELECT COUNT(*) FROM orders WHERE order_status = "released" OR order_status = "claimed" OR order_status = "canceled";';
            }
            else{ //for customer order page
                $sql = 'SELECT COUNT(*) FROM orders WHERE user_id = :user_id AND order_status = "released" OR order_status = "claimed" OR order_status = "canceled";';
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
        function renderStatus($user_id, $user_type){
            if($user_type === 'customer'){
                $sql = 'SELECT order_status FROM orders WHERE user_id = :user_id AND order_status != "claimed" AND order_status != "canceled" AND order_status != "released" GROUP BY order_status;';

                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':user_id', $user_id);
            }
            else{
                $sql = 'SELECT order_status FROM orders WHERE order_status != "claimed" AND order_status != "canceled" AND order_status != "released" GROUP BY order_status;';

                $query = $this->db->connect()->prepare($sql);
            }

            if($query->execute()){
                if($query->rowCount() === 0){
                    $data = 'empty';
                }
                else{
                    $data = $query->fetchAll();
                }
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
            $sql = 'SELECT order_status FROM orders WHERE order_status = "claimed" OR order_status = "released" OR order_status = "canceled" GROUP BY order_status;';
            
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
            $sql = 'SELECT orders.*, DATE_FORMAT(orders.created_at, "%M %d, %Y") as date, DATE_FORMAT(orders.created_at, "%H:%i") as time 
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
            $sql = 'SELECT * FROM user WHERE user_id = :user_id;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        //render user info
        function renderOrder($order_id, $user_id){
            $info = $this->getUserType($user_id);

            if($info['user_type'] === 'customer'){
                $sql = 'SELECT customer.*, orders.*, DATE_FORMAT(orders.created_at, "%M %d, %Y") as date, DATE_FORMAT(orders.created_at, "%H:%i") 
                        AS time FROM orders, customer WHERE orders.order_id = :order_id AND customer.customer_id = :id;';

                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':id', $info['customer_id']);
            }
            else if($info['user_type'] === 'vendor'){
                $sql = 'SELECT vendor.*, orders.*, DATE_FORMAT(orders.created_at, "%M %d, %Y") AS date, DATE_FORMAT(orders.created_at, "%H:%i")
                         AS time FROM orders, vendor WHERE order_id = :order_id AND vendor_id = :id;';

                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':id', $info['vendor_id']);
            }
            else if($info['user_type'] === 'admin'){
                $sql = 'SELECT admin.*, orders.*, DATE_FORMAT(orders.created_at, "%M %d, %Y") AS date, DATE_FORMAT(orders.created_at, "%H:%i") 
                        AS time FROM orders, admin WHERE order_id = :order_id AND admin_id = :id;';

                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':id', $info['admin_id']);
            }

            $query->bindParam(':order_id', $order_id);

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

        function addDiscount($order_id, $discount, $discounted_total){
            $sql = 'UPDATE orders SET discount = :discount, discounted_total = :discounted_total WHERE order_id = :order_id;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':discount', $discount);
            $query->bindParam(':discounted_total', $discounted_total);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                return true;
            }

            return false;
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

        function cancelOrder($order_id){
            $sql = "UPDATE orders SET order_status = 'canceled' WHERE order_id = :order_id;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                return true;
            }

            return false;
        }

        function getSalesReport($type){
            if($type === 'today'){
                $sql = 'SELECT SUM(discounted_total) AS today FROM orders WHERE (order_status = "released" OR order_status = "claimed") AND payment_status = "paid" AND DATE(created_at) = CURDATE();';
            }
            else if($type === 'week'){
                $sql = 'SELECT SUM(discounted_total) AS week FROM orders WHERE (order_status = "released" OR order_status = "claimed") AND payment_status = "paid" AND YEARWEEK(created_at) = YEARWEEK(CURDATE());';
            }
            else if($type === 'month'){
                $sql = 'SELECT SUM(discounted_total) AS month FROM orders WHERE (order_status = "released" OR order_status = "claimed") AND payment_status = "paid" AND MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE());';
            }

            $query = $this->db->connect()->prepare($sql);

            if($query->execute()){
                $data = $query->fetch();

                if($data[0] === null){
                    $data[0] = '0.00';
                }
            }

            return $data;
        }

        // SELECT SUM(total_amount) AS total_day_networth
        // FROM orders
        // WHERE DATE(order_date) = CURDATE();

        // SELECT SUM(total_amount) AS total_week_networth
        // FROM orders
        // WHERE YEARWEEK(order_date) = YEARWEEK(CURDATE());

        // SELECT SUM(total_amount) AS total_month_networth
        // FROM orders
        // WHERE MONTH(order_date) = MONTH(CURDATE()) AND YEAR(order_date) = YEAR(CURDATE());
    }

?>