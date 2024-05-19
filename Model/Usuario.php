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

            public function inserirUsuario(){
                require_once 'ConexaoBD.php';
    
                $con = new ConexaoBD();
                $conn = $con->conectar();
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }

                $sql = "INSERT INTO usuario (cpf, nome, setor, email, senha, nivel) VALUES ('".$this->cpf."','".$this->nome."', '".$this->setor."', '".$this->email."', '".$this->senha."', '".$this->nivel."')";

                if ($conn->query($sql) === TRUE){
                    $conn->close();
                    return true;
                }else{
                    $conn->close();
                    return false;
                }
            }

            public function atualizarUsuario() {
                require_once "ConexaoBD.php";
                
                $con = new ConexaoBD();
                $conn = $con->conectar();
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            
                $sql = "UPDATE usuario SET nome = ?, email = ?, setor = ?, senha = ? WHERE cpf = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    die("Error preparing statement: " . $conn->error);
                }
                
                // Bind the parameters to the statement
                $stmt->bind_param("sssss", $this->nome, $this->email, $this->setor, $this->senha, $this->cpf);
            
                // Execute the statement
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

            public function carregarUsuario($cpf){
                require_once "ConexaoBD.php";
    
                $con = new ConexaoBD();
                $conn = $con->conectar();
    
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "SELECT * FROM usuario WHERE cpf = ".$cpf;
                $re = $conn->query($sql);
                $r = $re->fetch_object();
                if($r != null){
                    $this->cpf = $r->cpf;
                    $this->nome = $r->nome;
                    $this->email = $r->email;
                    $this->setor = $r->setor;
                    $this->senha = $r->senha;
                    $this->nivel = $r->nivel;
                    $conn->close();
                    return true;
                }else{
                    $conn->close();
                    return false;
                }
            }

            public function mostraListaDeUsuarios(){
                require_once "ConexaoBD.php";
    
                $con = new ConexaoBD();
                $conn = $con->conectar();
    
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }

                $sql = "SELECT * FROM usuario";

                $re = $conn->query($sql);
                $conn->close();
                return $re;
            }

            public function listaDestinatarios($cpf_logado) {
                require_once "ConexaoBD.php";
            
                $con = new ConexaoBD();
                $conn = $con->conectar();
            
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            
                // Certifique-se de usar uma consulta preparada para evitar injeção de SQL
                $stmt = $conn->prepare("SELECT cpf, nome FROM usuario WHERE cpf <> ?");
                $stmt->bind_param("s", $cpf_logado);
                $stmt->execute();
                $result = $stmt->get_result();
            
                $destinatarios = [];
                while ($row = $result->fetch_assoc()) {
                    $destinatarios[] = ['cpf' => $row['cpf'], 'nome' => $row['nome']];
                }
            
                $stmt->close();
                $conn->close();
                return $destinatarios;
            }

            public function listaSetorDestinatario($cpf_da_option) {
                require_once "ConexaoBD.php";
            
                $con = new ConexaoBD();
                $conn = $con->conectar();
            
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            
                // Certifique-se de usar uma consulta preparada para evitar injeção de SQL
                $stmt = $conn->prepare("SELECT setor FROM usuario WHERE cpf = ?");
                $stmt->bind_param("s", $cpf_da_option);
                $stmt->execute();
                $result = $stmt->get_result();
            
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $setorDestinatario = $row['setor'];
                } else {
                    $setorDestinatario = ""; // Ou algum valor padrão, caso não encontre
                }
            
                $stmt->close();
                $conn->close();
                return $setorDestinatario;
            }

            public function alterarUsuario($cpf){
                require_once "ConexaoBD.php";
    
                $con = new ConexaoBD();
                $conn = $con->conectar();
    
                if($conn->connect_error){
                    die("Connection failed: ".$conn->connect_error);
                }
    
                $sql = "SELECT * FROM usuario WHERE cpf = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $cpf);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc(); // Extrai os dados como um array associativo
                    $stmt->close();
                    $conn->close();
                    return $row;
                } else {
                    $stmt->close();
                    $conn->close();
                    return false;
                }
            }
    
    }
?>
