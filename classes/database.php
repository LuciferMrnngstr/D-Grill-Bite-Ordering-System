<?php

    class Database{
        private $host = 'localhost';
        private $username = 'u524944378_root';
        private $password = 'Meraki123';
        private $database = 'u524944378_meraki';

        protected $connection;

        function connect(){
            try{
                $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", 
                                            $this->username, $this->password); 
            }
            catch(PDOException $e){
                echo 'Connection Error ' . $e->getMessage();
            }

            return $this->connection;
        }
    }
?>
