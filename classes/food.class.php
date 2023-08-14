<?php
    include_once 'database.php';

    class Food{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function addNew($name, $price, $description, $img, $availability){
            $sql = 'INSERT INTO food_product (name, price, description, img, availability) 
                    VALUES (:name, :price, :description, :img, :availability);';
            
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':name', $name);
            $query->bindParam(':price', $price);
            $query->bindParam(':img', $img);
            $query->bindParam(':description', $description);
            $query->bindParam(':availability', $availability);

            if($query->execute()){
                return true;
            }

            return false;
        }

        function editInfo($food_id, $name, $price, $description, $availability){
            $sql = 'UPDATE food_product SET name = :name, price = :price, description = :description, 
                    availability = :availability WHERE food_id = :food_id;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':food_id', $food_id);
            $query->bindParam(':name', $name);
            $query->bindParam(':price', $price);
            $query->bindParam(':description', $description);
            $query->bindParam(':availability', $availability);

            if($query->execute()){
                return true;
            }

            return false;
        }

        function editInfo2($food_id, $name, $price, $description, $img, $availability){
            $sql = 'UPDATE food_product SET name = :name, price = :price, description = :description, 
                    img = :img, availability = :availability WHERE food_id = :food_id;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':food_id', $food_id);
            $query->bindParam(':name', $name);
            $query->bindParam(':price', $price);
            $query->bindParam(':description', $description);
            $query->bindParam(':img', $img);
            $query->bindParam(':availability', $availability);

            if($query->execute()){
                return true;
            }

            return false;
        }

        function delete($food_id){
            $sql = 'DELETE FROM food_product WHERE food_id = :food_id;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':food_id', $food_id);

            if($query->execute()){
                return true;
            }

            return false;
        }

        function checkEmpty(){
            $sql = 'SELECT COUNT(*) FROM food_product;';
            
            $query = $this->db->connect()->prepare($sql);
            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function render(){
            $sql = 'SELECT * FROM food_product ORDER BY availability, created_at;';

            $query = $this->db->connect()->prepare($sql);
            
            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        function fetch($id){
            $sql = 'SELECT * FROM food_product WHERE food_id=:food_id;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':food_id', $id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function getFoodID(){
            $sql = "SELECT food_id FROM food_product ORDER BY created_at DESC LIMIT 1;";

            $query = $this->db->connect()->prepare($sql);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }
    }

?>