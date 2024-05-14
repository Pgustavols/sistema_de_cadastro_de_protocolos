<?php 

    class Movimentacao {    
        private $id;
        private $dataEnvio;
        private $dataRecebimento;
        private $cpfRemetente;
        private $cpfDestinatario;
        private $status;
        private $nProtocoloDocumento;

        //Getters and setters
            //ID
            public function setId($id){
                $this->id = $id;
            }
            public function getId(){
                return $this->id;
            }

            //Data Envio
            public function setDataEnvio($dataEnvio){
                $this->dataEnvio = $dataEnvio;
            }
            public function getDataEnvio(){
                return $this->dataEnvio;
            }
            
            //Data Recebimento
            public function setDataRecebimento($dataRecebimento){
                $this->dataRecebimento = $dataRecebimento;
            }
            public function getDataRecebimento(){
                return $this->dataRecebimento;
            }

            //CPF Remetente
            public function setCPFRemetente($cpfRemetente){
                $this->cpfRemetente = $cpfRemetente;
            }
            public function getCPFRemetente(){
                return $this->cpfRemetente;
            }

            //CPF Destinatario
            public function setCPFDestinatario($cpfDestinatario){
                $this->cpfDestinatario = $cpfDestinatario;
            }
            public function getCPFDestinatario(){
                return $this->cpfDestinatario;
            }

            //Status
            public function setStatus($status){
                $this->status = $status;
            }
            public function getStatus(){
                return $this->status;
            }
            
            //Numero Protocolo Documento
            public function setNProtocoloDocumento($nProtocoloDocumento){
                $this->nProtocoloDocumento = $nProtocoloDocumento;
            }
            public function getMProtocoloDocumento(){
                return $this->nProtocoloDocumento;
            }
    }
?>