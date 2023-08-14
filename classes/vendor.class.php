<?php

    include_once 'database.php';

    class Vendor{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function check($email, $password){
            $sql = "SELECT * FROM vendor WHERE email=:email AND password=:password;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }

        function renderInfo($vendor_id){
            $sql = "SELECT * FROM vendor WHERE vendor_id = :vendor_id;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':vendor_id', $vendor_id);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }
    }

?>