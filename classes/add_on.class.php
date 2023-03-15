<?php
    include_once 'database.php';

    class AddOn{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function count($food_id){
            $sql = "SELECT COUNT(*) FROM add_on WHERE food_id = :food_id";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':food_id', $food_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function renderOption($food_id){
            $sql = "SELECT add_on_name as name FROM add_on WHERE food_id = :food_id";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':food_id', $food_id);

            if($query->execute()){
                $data = $query->fetchAll();
            }

            return $data;
        }
    }
?>