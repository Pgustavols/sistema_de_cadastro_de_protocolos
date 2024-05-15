<?php
    class ConexaoBD{
        private $serverName = "localhost";
        private $userName = "root";
        private $password = "Kael112131";
        private $dbName = "tcc";

        public function conectar(){
            $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
            return $conn;
        }
    };
    
?>
