<?php 

    class Movimentacao {    
        private $id;
        private $protocolo;
        private $estado;
        private $destinatario;
        private $dataAcao;
        private $remetente;
        
        //Getters and setters
        //ID
        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }
        //Numero Protocolo Documento
        public function setProtocolo($protocolo){
            $this->protocolo = $protocolo;
        }
        public function getProtocolo(){
            return $this->protocolo;
        }
        //estado
        public function setEstado($estado){
            $this->estado = $estado;
        }
        public function getEstado(){
            return $this->estado;
        }

        //CPF Destinatario
        public function setDestinatario($destinatario){
            $this->destinatario = $destinatario;
        }
        public function getDestinatatio(){
            return $this->destinatario;
        }

        //Data Ação
        public function setDataAcao($dataAcao){
            $this->dataAcao = $dataAcao;
        }
        public function getDataAcao(){
            return $this->dataAcao;
        }
            
    
        //CPF Remetente
        public function setRemetente($remetente){
            $this->remetente = $remetente;
        }
        public function getRemetente(){
            return $this->remetente;
        }
   
    }
?>
