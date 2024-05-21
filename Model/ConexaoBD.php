<?php
    class ConexaoBD{
        private $serverName = "localhost";
        private $userName = "root";
        private $password = "";
        private $dbName = "sistema_de_protocolo";

        public function conectar(){
            $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
            return $conn;
        }
    };
    
?>
