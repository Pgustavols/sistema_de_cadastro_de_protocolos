<?php 

    class Documento {    
        private $protocolo;
        private $autor;
        private $destinatario;
        private $dataCadastro;
        private $tipo;
        private $titulo;
        private $estado;

        //Getters and setters
            //Numero Protocolo
            public function setProtocolo($protocolo){
                $this->protocolo = $protocolo;
            }
            public function getProtocolo(){
                return $this->protocolo;
            }
            
            //cpf autor
            public function setAutor($autor){
                $this->autor = $autor;
            }
            public function getAutor(){
                return $this->autor;
            }
            
            //CPF Destinatário
            public function setDestinatario($destinatario){
                $this->destinatario = $destinatario;
            }
            public function getDestinatatio(){
                return $this->destinatario;
            }
            //Data Cadastro
            public function setDataCadastro($dataCadastro){
                $this->dataCadastro = $dataCadastro;
            }
            public function getDataCadastro(){
                return $this->dataCadastro;
            }
            
            //Tipo
            public function setTipo($tipo){
                $this->tipo = $tipo;
            }
            public function getTipo(){
                return $this->tipo;
            }

            //Título
            public function setTitulo($titulo){
                $this->titulo = $titulo;
            }
            public function getTitulo(){
                return $this->titulo;
            }

            // estado 
            public function setEstado($estado){
                $this->estado = $estado;
            }
            public function getEstado($estado){
                return $this->$estado;
            }

    }
?>
