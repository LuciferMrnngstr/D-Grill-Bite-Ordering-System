<?php
    include_once 'database.php';

    class User{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function getId($user_type){
            if($user_type == 'customer'){
                $sql = "SELECT customer_id FROM customer ORDER BY created_at DESC LIMIT 1;";    
            }

            $query = $this->db->connect()->prepare($sql);
            
            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function insertUser($customer_id, $vendor_id, $cashier_id, $user_type){
            if($user_type == 'customer'){
                $sql = 'INSERT INTO user(customer_id, user_type) VALUES (:customer_id, :user_type);'; 
                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':customer_id', $customer_id);
                $query->bindParam(':user_type', $user_type);
            }

            $query = $this->db->connect()->prepare($sql);

            if($user_type == 'customer'){
                $query->bindParam(':customer_id', $customer_id);
            }
            
            $query->bindParam(':user_type', $user_type);
            // $query->bindParam(':customer_id', $customer_id);
            // $query->bindParam(':vendor_id', $vendor_id);
            // $query->bindParam(':cashier_id', $cashier_id);

            if($query->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        function getInfo($id, $type){
            $sql = 'SELECT * FROM user WHERE (admin_id = :id OR customer_id = :id OR vendor_id = :id) AND user_type = :type;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':id', $id);
            $query->bindParam(':type', $type);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }


        // ---------- For notification ----------
        // get all admin, vendor and the user who created the notification
        function getAllUsers($customer_id, $user_type){
            if($user_type === 'customer'){
                $sql = 'SELECT * FROM user WHERE user_type IN ("admin", "vendor") OR (user_type = "customer" AND customer_id = :customer_id);';
    
                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':customer_id', $customer_id);
            }
            else{
                $sql = 'SELECT * FROM user WHERE user_type IN ("admin", "vendor");';
    
                $query = $this->db->connect()->prepare($sql);
            }
            
            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        // get all the users
        function getAllUsers2(){
            $sql = 'SELECT * FROM user;';

            $query = $this->db->connect()->prepare($sql);
            
            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        // ---------- Get user informations ----------
        function getUserInformation($id, $user_type){
            if($user_type === 'customer'){
                $sql = 'SELECT * FROM customer WHERE customer_id = :id;';
            }
            else if($user_type === 'vendor'){
                $sql = 'SELECT * FROM vendor WHERE vendor_id = :id;';
            }
            else if($user_type === 'admin'){
                $sql = 'SELECT * FROM admin WHERE admin_id = :id;';
            }

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':id', $id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        // Get Order Owner Information
        function getOrderOwnerInfo($order_id){
            $order_owner_info = $this->getOrderOwnerInfo2($order_id);
            $owner_type = $order_owner_info['user_type'];
            $owner_user_id = $order_owner_info['user_id'];

            if($owner_type === 'customer'){
                $sql = 'SELECT user.user_id, user.user_type, customer.* FROM user, customer WHERE 
                        user.customer_id = customer.customer_id AND user.user_id = :user_id;';
            }
            else if($owner_type === 'vendor'){
                $sql = 'SELECT user.user_id, user.user_type, vendor.* FROM user, vendor WHERE 
                        user.vendor_id = vendor.vendor_id AND user.user_id = :user_id;';
            }
            else if($owner_type === 'admin'){
                $sql = 'SELECT user.user_id, user.user_type, admin.* FROM user, admin WHERE 
                        user.admin_id = admin.admin_id AND user.user_id = :user_id;';
            }

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $owner_user_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function getOrderOwnerInfo2($order_id){
            $sql = 'SELECT orders.order_id, orders.user_id, user.user_type FROM 
                    orders, user WHERE orders.user_id = user.user_id AND order_id = :order_id;';
    
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':order_id', $order_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }
    }

?>