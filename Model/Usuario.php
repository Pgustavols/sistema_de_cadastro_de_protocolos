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

            //Nivel
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
    }
?>
