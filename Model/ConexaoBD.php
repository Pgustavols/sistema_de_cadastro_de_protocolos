<?php
    Class ConexaoBD{

        private $serverName = "";
        private $userName = "";
        private $password = "";
        private $dbName = "";

        public function conectar(){
            $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
            return $conn;
        }
    }
?>