<?php
    include_once 'database.php';

    class Cashier{
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function check($email, $password){
            $sql = "SELECT * FROM cashier WHERE email=:email AND password=:password;";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);

            if($query->execute()){
                $data = $query->fetch();
            }

            return $data;
        }
    }
?>