<?php 

    class Usuario {    
        private $cpf;
        private $nome;
        private $email;
        private $setor;
        private $senha;
        private $nivel;

        //Getters and setters
            //CPF
            public function setCPF($cpf){
                $this->cpf = $cpf;
            }
            public function getCPF(){
                return $this->cpf;
            }

            //Nome
            public function setNome($nome){
                $this->nome = $nome;
            }
            public function getNome(){
                return $this->nome;
            }
            
            //Email
            public function setEmail($email){
                $this->email = $email;
            }
            public function getEmail(){
                return $this->email;
            }

            //Setor
            public function setSetor($setor){
                $this->setor = $setor;
            }
            public function getSetor(){
                return $this->setor;
            }

            //Cargo
            public function setNivel($nivel){
                $this->nivel = $nivel;
            }
            public function getNivel(){
                return $this->nivel;
            }

            //Senha
            public function setSenha($senha){
                $this->senha = $senha;
            }
            public function getSenha(){
                return $this->senha;
            }

            public function inserirCliente(){
                require_once 'ConexaoBD.php';
    
                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
                $sql = "INSERT INTO usuario (cpf, nome, email, setor, senha, nivel) VALUES ('".$this->cpf."','".$this->nome."','".$this->email."','".$this->setor."', '".$this->senha."', '".$this->nivel."');";
    
                if($conn->query($sql) === TRUE){
                    $conn->close();
                    return TRUE;
                }else{
                    $conn->close();
                    return FALSE;
                }
            }


            public function atualizarBD(){
            
                require_once "ConexaoBD.php";
                
                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "UPDATE usuario SET nome = '".$this->nome."', email = '".$this->email."', setor ='".$this->setor."', senha = '".$this->senha."', '".$this->nivel."' WHERE cpf = '".$this->cpf.";";
                
    
                if($conn->query($sql) === TRUE){
                    $conn->close();
                    return TRUE;
                }else{
                    $conn->close();
                    return FALSE;
                }
            }
    }
?>
