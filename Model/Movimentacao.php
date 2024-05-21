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

        public function carregarMovimentacoes($nProtocolo){
            require_once "ConexaoBD.php";

            $con = new ConexaoBD();
            $conn = $con->conectar();

            if($conn->connect_error){
                die("Connection failed: ".$conn->connect_error);
            }

            $sql = "SELECT a.id, c.titulo, a.nProtocolo, a.estado, b.nome AS nome_destinatario, a.data_da_acao, a.nome AS nome_remetente 
            FROM (
                SELECT id, nProtocolo, estado, cpf_destinatario, data_da_acao, nome 
                FROM movimentacao 
                INNER JOIN usuario ON cpf = cpf_remetente
            ) a 
            INNER JOIN (
                SELECT id, nome 
                FROM movimentacao 
                LEFT JOIN usuario ON cpf = cpf_destinatario
            ) b ON a.id = b.id
            INNER JOIN documento c ON c.nProtocolo = a.nProtocolo
            WHERE a.nProtocolo = '$nProtocolo' 
            ORDER BY a.id;";

            $re = $conn->query($sql);
                $conn->close();
                return $re;
        }
    }
?>
