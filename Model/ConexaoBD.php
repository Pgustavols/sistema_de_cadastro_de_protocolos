<?php
    class ConexaoBD{
        private $serverName = "localhost:3306";
        private $userName = "root";
        private $password = "";
        private $dbName = "tcc";

        public function conectar(){
            $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
            return $conn;
        }
    };
    
?>
