<?php
    include_once 'database.php';

    class Food{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function render(){
            $sql = 'SELECT * FROM food_product;';

            $query = $this->db->connect()->prepare($sql);
            
            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }

        function fetch($id){
            $sql = 'SELECT * FROM food_product WHERE food_product_id=:food_product_id;';

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':food_product_id', $id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }
    }

?>