<?php
    include_once 'database.php';
    include_once 'user.class.php';
    include_once 'customer.class.php';
    include_once 'order_item.class.php';
    include_once 'food.class.php';

    class Notification{
        protected $db;
        protected $users;
        protected $order_item;
        protected $food;

        function __construct(){
            $this->db = new Database;
        }

        function placeOrder($user_type, $user_id, $id){
            $this->users = new User;
            $this->order_item = new OrderItem;
            $user_info = $this->users->getUserInformation($id, $user_type);
            $order_id = $this->order_item->getOrderID($user_id)[0];
            $sender_id = $user_id;
            $content = '';
            
            // get all admin, vendor and the user who created the notification
            foreach($this->users->getAllUsers($id, $user_type) as $user){
                if($user['user_id'] === $user_id){
                    $content = 'You have successfully placed an order.';
                }
                else{
                    $content = $user_type . ' ' . substr($user_info['first_name'], 0, 1) . '. ' . $user_info['last_name'] . ', placed an order.';
                }

                $sql = 'INSERT INTO notification (sender_id, reciever_id, order_id, content, type) 
                        VALUES (:sender_id, :reciever_id, :order_id, :content, "place order");';
    
                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':sender_id', $sender_id);
                $query->bindParam(':reciever_id', $user['user_id']);
                $query->bindParam(':order_id', $order_id);
                $query->bindParam(':content', $content);
    
                if(!$query->execute()){
                    return false;
                }
            }

            return true;
        }

        function updateOrderStatus($user_type, $user_id, $id, $order_id, $update_status){
            $this->users = new User;
            $this->order_item = new OrderItem;
            $sender_id = $user_id;
            $order_owner = $this->users->getOrderOwnerInfo($order_id);

            if($order_owner['user_type'] === 'customer'){
                $order_owner_id = $order_owner['customer_id'];
            }
            else{
                $order_owner_id = $order_owner['user_id'];
            }
            
            $user_info = $this->users->getUserInformation($order_owner_id, $order_owner['user_type']);
            $content = '';
            
            // get all admin, vendor and the user who created the notification
            foreach($this->users->getAllUsers($order_owner_id, $order_owner['user_type']) as $user){
                if($user['user_id'] === $user_id){
                    if($update_status === 'canceled'){
                        $content = "Order canceled successfully.";
                    }
                    else{
                        if($sender_id == $order_owner['user_id']){
                            $content = "You've updated your order into " . $update_status . '.';
                        }
                        else{
                            $content = "You've updated " . $order_owner['user_type'] . ' ' . substr($order_owner['first_name'], 0, 1) 
                                        . '. ' . $order_owner['last_name'] . ' order into ' . $update_status . '.';
                        }
                    }
                }
                else if($user['user_id'] === $order_owner['user_id']){
                    if($update_status === 'canceled'){
                        $content = $user_type . ' ' . substr($user_info['first_name'], 0, 1) . '. ' . $user_info['last_name'] . 
                                    ', canceled your order.';
                    }
                    else{
                        $content = $user_type . ' ' . substr($user_info['first_name'], 0, 1) . '. ' . $user_info['last_name'] . 
                                    ', updated your order into ' . $update_status . '.';
                    }
                }
                else{
                    if($update_status === 'canceled'){
                        if($sender_id == $order_owner['user_id']){
                            $content = $user_type . ' ' . substr($user_info['first_name'], 0, 1) . '. ' . $user_info['last_name'] . 
                                        ', canceled his/her order.';
                        }
                        else{
                            $content = $user_type . ' ' . substr($user_info['first_name'], 0, 1) . '. ' . $user_info['last_name'] . 
                                        ', canceled ' . $order_owner['user_type'] . ' ' . substr($order_owner['first_name'], 0, 1) 
                                        . '. ' . $order_owner['last_name'] . ' order.';
                        }
                    }
                    else{
                        if($sender_id == $order_owner['user_id']){
                            $content = $user_type . ' ' . substr($user_info['first_name'], 0, 1) . '. ' . $user_info['last_name'] . 
                                        ', updated his/her order into ' . $update_status . '.';
                        }
                        else{
                            $content = $user_type . ' ' . substr($user_info['first_name'], 0, 1) . '. ' . $user_info['last_name'] . 
                                        ', updated ' . $order_owner['user_type'] . ' ' . substr($order_owner['first_name'], 0, 1) 
                                        . '. ' . $order_owner['last_name'] . ' order into ' . $update_status . '.';
                        }
                    }
                }

                $sql = 'INSERT INTO notification (sender_id, reciever_id, order_id, content, type) 
                        VALUES (:sender_id, :reciever_id, :order_id, :content, "update order");';
    
                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':sender_id', $sender_id);
                $query->bindParam(':reciever_id', $user['user_id']);
                $query->bindParam(':order_id', $order_id);
                $query->bindParam(':content', $content);
    
                if(!$query->execute()){
                    return false;
                }
            }

            return true;
        }

        function addEditDeleteDish($user_type, $user_id, $id, $food_id, $action_type){
            $this->users = new User;
            $this->food = new Food;

            if($action_type === 'create dish'){ // pass 'create' string in parameter if creating a new dish
                $food_id = $this->food->getFoodID()[0];
            }
            else{ // for edit and delete
                $food_details = $this->food->fetch($food_id);
            }

            $user_info = $this->users->getUserInformation($id, $user_type);
            $sender_id = $user_id;
            $content = '';

            // get all the users
            foreach($this->users->getAllUsers2() as $user){
                if($user['user_id'] === $user_id){ // notification for the sender of the notif
                    if($action_type === 'create dish'){
                        $content = 'You have successfully created a new dish.';
                    }
                    else if($action_type === 'edit dish'){
                        $content = 'You have successfully updated ' . $food_details['name'] . ' info.';
                    }
                    else{
                        $content = 'You have successfully deleted dish ' . $food_details['name'] . '.';
                    }
                } // for other admin and vendors
                else if($user['user_type'] === 'admin' || $user['user_type'] === 'vendor'){
                    if($action_type === 'create dish'){
                        $content = $user_type . ' ' . substr($user_info['first_name'], 0, 1) . '. ' . $user_info['last_name'] . ', created a new dish.';
                    }
                    else if($action_type === 'edit dish'){
                        $content = $user_type . ' ' . substr($user_info['first_name'], 0, 1) . '. ' . $user_info['last_name'] . ', updated ' . $food_details['name'] . ' info.';
                    }
                    else{
                        $content = $user_type . ' ' . substr($user_info['first_name'], 0, 1) . '. ' . $user_info['last_name'] . ', deleted dish ' . $food_details['name'] . '.';
                    }
                } // for customers
                else{
                    if($action_type === 'create dish'){
                        $content = 'A new dish has been created!';
                    }
                    else if($action_type === 'edit dish'){
                        $content = $food_details['name'] . ' info has been updated.';
                    }
                    else{
                        $content = $food_details['name'] . ' dish has been deleted.';
                    }
                }

                if($action_type === 'delete dish'){
                    $sql = 'INSERT INTO notification (sender_id, reciever_id, content, type) 
                            VALUES (:sender_id, :reciever_id, :content, :action_type);';
        
                    $query = $this->db->connect()->prepare($sql);
                }
                else{
                    $sql = 'INSERT INTO notification (sender_id, reciever_id, food_id, content, type) 
                            VALUES (:sender_id, :reciever_id, :food_id, :content, :action_type);';
        
                    $query = $this->db->connect()->prepare($sql);
                    $query->bindParam(':food_id', $food_id);
                }

                $query->bindParam(':sender_id', $sender_id);
                $query->bindParam(':reciever_id', $user['user_id']);
                $query->bindParam(':content', $content);
                $query->bindParam(':action_type', $action_type);
    
                if(!$query->execute()){
                    return false;
                }
            }

            return true;
        }

        function countUnread($user_id){
            $sql = 'SELECT COUNT(*) FROM notification WHERE notif_read = 0 AND reciever_id = :user_id;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function getAll($user_id){
            $sql = 'SELECT * FROM notification WHERE reciever_id = :user_id ORDER BY created_at DESC;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);

            if($query->execute()){
                if($query->rowCount() < 1){
                    $data = 'empty';
                }
                else{
                    $data = $query->fetchAll();
                }
            }

            return $data;
        }

        function markRead($id, $type){
            if($type === 'all'){
                $sql = 'UPDATE notification SET notif_read = 1 WHERE reciever_id = :id;';
            }
            else{
                $sql = 'UPDATE notification SET notif_read = 1 WHERE notif_id = :id;';
            }

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':id', $id);

            if($query->execute()){
                return true;
            }

            return false;
        }
    }
?>