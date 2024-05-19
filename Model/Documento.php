<?php 

    class Documento {    
        private $nProtocolo;
        private $cpf_possuidor;
        private $cpf_destinatario;
        private $data_de_cadastro;
        private $tipo;
        private $titulo;
        private $estado;

        //Getters and setters
            //Numero nProtocolo
            public function setnProtocolo($nProtocolo){
                $this->nProtocolo = $nProtocolo;
            }
            public function getnProtocolo(){
                return $this->nProtocolo;
            }
            
            //cpf possuidor
            public function setCpf_possuidor($cpf_possuidor){
                $this->cpf_possuidor = $cpf_possuidor;
            }
            public function getCpf_possuidor(){
                return $this->cpf_possuidor;
            }
            
            //CPF Destinatário
            public function setCpf_destinatario($cpf_destinatario){
                $this->cpf_destinatario = $cpf_destinatario;
            }
            public function getCpf_destinatario(){
                return $this->cpf_destinatario;
            }
            //Data Cadastro
            public function setData_de_cadastro($data_de_cadastro){
                $this->data_de_cadastro = $data_de_cadastro;
            }
            public function getData_de_cadastro(){
                return $this->data_de_cadastro;
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
            public function getEstado(){
                return $this->estado;
            }


            public function carregarDocumentosNaTelaInicialComum($cpf_possuidor){
                require_once "ConexaoBD.php";
    
                $con = new ConexaoBD();
                $conn = $con->conectar();
    
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "SELECT * FROM documento WHERE cpf_possuidor = '$cpf_possuidor' AND estado <> 'Excluído'";
                $re = $conn->query($sql);
                $conn->close();
                return $re;
            }

            



            public function carregarDocumentosNaTelaInicialGestor($cpf_possuidor, $cpf_destinatario){
                require_once "ConexaoBD.php";
    
                $con = new ConexaoBD();
                $conn = $con->conectar();
    
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }

                $sql = "SELECT nProtocolo, titulo, 
                CASE 
                    WHEN cpf_possuidor = '$cpf_possuidor' THEN 'Eu'
                    ELSE nome
                END AS nome, data_de_cadastro, estado
                FROM documento
                INNER JOIN usuario ON cpf = cpf_possuidor
                WHERE cpf_possuidor = cpf_destinatario OR cpf_destinatario <> '$cpf_destinatario'
                ORDER BY nProtocolo";
                
                $re = $conn->query($sql);
                $conn->close();
                return $re;
            }



            public function receberDocumento($protocolo, $cpf_destinatario){
                require_once "ConexaoBD.php";

                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                // $sql = "UPDATE documento SET cpf_possuidor = '".$cpf_destinatario."', estado ='"."Recebido"."'WHERE nProtocolo = '".$protocolo.'";"';

                $sql = "UPDATE documento 
                SET cpf_possuidor = '" . $cpf_destinatario . "', estado = 'Recebido' 
                WHERE nProtocolo = '" . $protocolo . "'";
               
                if($conn->query($sql) === TRUE){
                    $conn->close();
                    return TRUE;
                }else{
                    $conn->close();
                    return FALSE;
                }
            }

            public function enviarDocumento(){
                require_once "ConexaoBD.php";

                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "UPDATE documento SET cpf_destinatario = '".$this->cpf_destinatario."', estado ='".
                "Pendente"."'WHERE nProtocolo = '".$this->nProtocolo.'";"';
               
                if($conn->query($sql) === TRUE){
                    $conn->close();
                    return TRUE;
                }else{
                    $conn->close();
                    return FALSE;
                }
            }

            public function alterarDocumento(){
                require_once "ConexaoBD.php";

                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "UPDATE documento SET titulo = '".$this->titulo."', estado ='".
                "Alterado"."'WHERE nProtocolo = '".$this->nProtocolo.'";"';
               
                if($conn->query($sql) === TRUE){
                    $conn->close();
                    return TRUE;
                }else{
                    $conn->close();
                    return FALSE;
                }
            }

            public function excluirDocumento(){
                require_once "ConexaoBD.php";

                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "UPDATE documento SET estado = ".'"Excluído"'.", cpf_possuidor = ".null.
                'WHERE protocolo = '.$this->nProtocolo.";";
               
                if($conn->query($sql) === TRUE){
                    $conn->close();
                    return TRUE;
                }else{
                    $conn->close();
                    return FALSE;
                }
            }
        

            public function naoAceitarDocumentos(){
                require_once "ConexaoBD.php";

                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "UPDATE documento SET estado = ".'"Não aceito"'.", cpf_destinatario = ".$this->cpf_destinatario.
                'WHERE protocolo = '.$this->nProtocolo.";";
               
                if($conn->query($sql) === TRUE){
                    $conn->close();
                    return TRUE;
                }else{
                    $conn->close();
                    return FALSE;
                }
            }

            public function cadastrarDocumento(){
                require_once "ConexaoBD.php";

                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "INSERT INTO documento
                (cpf_possuidor, cpf_destinatario, data_de_cadastro, tipo, titulo, estado) VALUES"."'"
                ($this->cpf_possuidor, $this->cpf_destinatario, $this->data_de_cadastro, $this->tipo, $this->titulo, $this->estado).";'";
               
                if($conn->query($sql) === TRUE){
                    $conn->close();
                    return TRUE;
                }else{
                    $conn->close();
                    return FALSE;
                }
            }

            public function documentosPendente($cpf_destinatario){
                require_once "ConexaoBD.php";
    
                $con = new ConexaoBD();
                $conn = $con->conectar();
    
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }

                $sql = "SELECT d.nProtocolo, d.titulo, u.nome, m.data_da_acao 
                        FROM documento d 
                        INNER JOIN usuario u ON u.cpf = d.cpf_possuidor
                        INNER JOIN (
                            SELECT nProtocolo, estado, cpf_remetente, cpf_destinatario, MAX(data_da_acao) AS data_da_acao 
                            FROM movimentacao
                            GROUP BY nProtocolo, estado, cpf_remetente, cpf_destinatario 
                            HAVING cpf_destinatario = '$cpf_destinatario'
                        ) m ON m.nProtocolo = d.nProtocolo AND m.cpf_remetente = u.cpf 
                        WHERE d.cpf_destinatario = '$cpf_destinatario';";
                $re = $conn->query($sql);
                $conn->close();
                return $re;
            }

            public function visualizarDocumento($nProtocolo){
                require_once "ConexaoBD.php";
    
                $con = new ConexaoBD();
                $conn = $con->conectar();
    
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
                
                $sql = "SELECT * FROM documento WHERE nProtocolo = '$nProtocolo'";
                $re = $conn->query($sql);
                $conn->close();
                return $re;
            }

            public function pegaNumeroProtocolo(){
                require_once "ConexaoBD.php";
            
                $con = new ConexaoBD();
                $conn = $con->conectar();
            
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
            
                $sql = "SELECT max(nProtocolo) + 1 as nextProtocolo from documento";
                $re = $conn->query($sql);
            
                if ($re->num_rows > 0) {
                    $row = $re->fetch_assoc();
                    $nextProtocolo = $row['nextProtocolo'];
                } else {
                    $nextProtocolo = 1; // Se não houver registros, iniciar com 1
                }
            
                $conn->close();
                return $nextProtocolo;
            }


    }
?>
