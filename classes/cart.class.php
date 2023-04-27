<?php
    include_once 'database.php';

    class Cart{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function addToCarts($logged_in, $user_id, $food_id){
            if($logged_in != 'null'){ //for logged in customer
                $sql = 'INSERT INTO cart (user_id, food_id, status) VALUES (:user_id, :food_id, status);';

                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':user_id', $user_id);
                $query->bindParam(':food_id', $food_id);

                if($query->execute()){
                    return true;
                }
                return false;
            }
        }

        function addToCart($logged_in, $user_id, $food_id, $food_name, $food_price, $food_img, $quantity){
            if($logged_in != 'null'){ //for logged in customer
                $sql = 'INSERT INTO cart (user_id, food_id, quantity, status) VALUES 
                    (:user_id, :food_id, :quantity, "pending");';
                    
                $query = $this->db->connect()->prepare($sql);
                $query->bindParam(':user_id', $user_id);
                $query->bindParam(':food_id', $food_id);
                $query->bindParam(':quantity', $quantity);

                if($query->execute()){
                    return true;
                }
                return false;
            }
            else{ //for not logged in customer, we use session array
                $cart = array(
                    "food_id" => $food_id,
                    "food_name" => $food_name,
                    "food_price" => $food_price,
                    "food_img" => $food_img
                );

                if(!isset($_SESSION['cart'])){
                    $_SESSION['cart'] = array();
                }

                if(array_push($_SESSION['cart'], $cart)){
                    return true;
                }
                return false;
            }
        }

        function checkEmpty($user_id){
            $sql = 'SELECT COUNT(*) FROM cart WHERE user_id = :user_id AND cart.status = "pending";';
            $query = $this->db->connect()->prepare($sql);

            $query->bindParam(':user_id', $user_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function render($user_id){
            $sql = 'SELECT cart.cart_id, cart.user_id, cart.food_id, cart.quantity, cart.status, food_product.price, food_product.img, food_product.name FROM cart, food_product 
                    WHERE cart.food_id = food_product.food_id AND cart.user_id = :user_id AND cart.status = "pending" ORDER BY food_product.name;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        function remove($id, $what){
            if($what == 'all'){ //Removing all items in cart, for logged in customer
                $sql = "DELETE FROM cart WHERE user_id = :id;";    
            }
            else{ //removing individual food product, for logged in customer
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
        function renderSummary($render, $user_id){ //logged in customer
            if($render == 'names'){ //for food product id and food price
                $sql = 'SELECT food_product.name, food_product.price FROM cart, food_product WHERE cart.food_id = food_product.food_id 
                        AND cart.user_id = :user_id AND cart.status = "pending" GROUP BY food_product.name ORDER BY food_product.name;';
            }
            else{ //for quantity
                $sql = 'SELECT COUNT(cart.food_id) FROM cart, food_product WHERE cart.food_id = food_product.food_id 
                        AND user_id = :user_id AND cart.status = "pending" GROUP BY cart.food_id ORDER BY food_product.name;';
            }

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

    }
?>