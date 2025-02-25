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

            public function enviarDocumento($nProtocolo, $cpf_destinatario){
                require_once "ConexaoBD.php";

                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "UPDATE documento SET cpf_destinatario = '$cpf_destinatario', estado = 'Pendente' WHERE nProtocolo = '$nProtocolo';";

                if($conn->query($sql) === TRUE){
                    $conn->close();
                    return TRUE;
                }else{
                    $conn->close();
                    return FALSE;
                }
            }

            public function alterarDocumento($titulo, $nProtocolo){
                require_once "ConexaoBD.php";

                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "UPDATE documento SET titulo = '" . $titulo . "', estado = 'Alterado', cpf_destinatario = '' WHERE nProtocolo = '" . $nProtocolo . "';";
               
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
    
                $sql = "UPDATE documento SET estado = 'Excluído' , cpf_possuidor = (SELECT cpf FROM usuario WHERE nivel = 'Gerente' LIMIT 1) WHERE nProtocolo = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    die("Error preparing statement: " . $conn->error);
                }
                
                $stmt->bind_param("s", $this->nProtocolo);
            
                if ($stmt->execute() === TRUE) {
                    $stmt->close();
                    $conn->close();
                    return TRUE;
                } else {
                    $stmt->close();
                    $conn->close();
                    return FALSE;
                }
            }
        

            public function naoAceitarDocumentos($nProtocolo){
                require_once "ConexaoBD.php";

                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "UPDATE documento SET estado = ".'"Não aceito"'.", cpf_destinatario = ".'""'.
                'WHERE nProtocolo = '.$nProtocolo.";";
               
                if($conn->query($sql) === TRUE){
                    $conn->close();
                    return TRUE;
                }else{
                    $conn->close();
                    return FALSE;
                }
            }

            public function escreverDocumento($cpf_possuidor, $cpf_destinatario, $tipo, $titulo){
                require_once "ConexaoBD.php";

                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }

                $sql = "INSERT INTO documento (cpf_possuidor, cpf_destinatario, data_de_cadastro, tipo, titulo, estado) VALUES (
                    '$cpf_possuidor',
                    '$cpf_destinatario',
                    CURDATE(),
                    '$tipo',
                    '$titulo',
                    'Pendente'
                );";
               
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

                $sql = "SELECT a.nProtocolo, a.titulo, b.nome, c.data_da_acao 
                FROM documento a 
                INNER JOIN (
                    SELECT nProtocolo, nome 
                    FROM documento 
                    INNER JOIN usuario ON cpf = cpf_possuidor
                ) b ON a.nProtocolo = b.nProtocolo
                INNER JOIN (
                    SELECT nProtocolo, MAX(data_da_acao) AS data_da_acao 
                    FROM movimentacao 
                    GROUP BY nProtocolo
                ) c ON c.nProtocolo = a.nProtocolo 
                WHERE a.cpf_destinatario = '$cpf_destinatario' 
                AND a.cpf_possuidor <> '$cpf_destinatario';
            ";

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
                
                $sql = "SELECT a.nProtocolo, a.titulo, a.data_de_cadastro, b.nome AS nome_possuidor, 
                a.tipo, c.nome AS nome_destinatario, c.setor AS setor_destinatario, 
                a.estado 
                FROM documento a 
                INNER JOIN (
                    SELECT nProtocolo, nome 
                    FROM documento 
                    INNER JOIN usuario ON cpf = cpf_possuidor
                ) b ON a.nProtocolo = b.nProtocolo 
                LEFT JOIN (
                    SELECT nProtocolo, nome, setor 
                    FROM documento 
                    INNER JOIN usuario ON cpf = cpf_destinatario
                ) c ON c.nProtocolo = a.nProtocolo 
                WHERE a.nProtocolo = ?
                ORDER BY a.nProtocolo;";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $nProtocolo);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc(); 
                    $stmt->close();
                    $conn->close();
                    return $row;
                } else {
                    $stmt->close();
                    $conn->close();
                    return false;
                }
        
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
