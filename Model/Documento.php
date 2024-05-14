<?php 

    class Documento {    
        private $nProtocolo;
        private $dataCadastro;
        private $tipo;
        private $titulo;
        private $possuidor;
        private $cpfResponsavel;

        //Getters and setters
            //Numero Protocolo
            public function setNProtocolo($nProtocolo){
                $this->nProtocolo = $nProtocolo;
            }
            public function getNProtocolo(){
                return $this->nProtocolo;
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

            //Possuidor
            public function setPossuidor($possuidor){
                $this->possuidor = $possuidor;
            }
            public function getPossuidor(){
                return $this->possuidor;
            }

            //CPF Responsável
            public function setCPFResponsavel($cpfResponsavel){
                $this->cpfResponsavel = $cpfResponsavel;
            }
            public function getCPFResponsavel(){
                return $this->cpfResponsavel;
            }
    }
?>