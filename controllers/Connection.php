<?php
    class Connection{
        private $host;
        private $user;
        private $password;
        private $database;

        function __construct($host,$user,$password,$database){
            $this->host = $host;
            $this->user = $user;
            $this->password = $password;
            $this->database = $database;
        }

        function openConnection()
        {
            $con = mysqli_connect($this->host,$this->user,$this->password,$this->database);
            if (mysqli_connect_errno()){
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            return $con;
        }
    }
?>