<?php
    if(!isset($_SESSION)){
        session_start();
    }

    switch ($_POST){
        //Caso a variavel seja nula mostrar a tela de login
        case isset($_POST[null]):
            include_once "View/login.php";
            break;

        //Login
        case isset($_POST["btnLogin"]):
            require_once "../Controller/UsuarioController.php";
            $uController = new UsuarioController();

            if(empty($_POST["txtCPF"]) || empty($_POST["txtSenha"])){
                echo
                "<script>
                alert('Por favor, preencha todos os campos.');
                window.history.back();
                </script>";
                } else {
                    $uController = new UsuarioController();
                    $result = $uController->login($_POST["txtCPF"], $_POST["txtSenha"]);

                    if(is_array($result)){
                        $_SESSION['cpf'] = $result['cpf'];
                        $_SESSION['nome'] = $result['nome'];
                        $_SESSION['nivel'] = $result['nivel'];
                    
                        if($result['nivel'] == 'Gerente'){
                            include_once "../View/inicioGestor.php";
                        } elseif ($result['nivel'] == 'Usuário'){
                            include_once "../View/inicioUsuario.php";
                        }
                    }  else{
                        echo "<script>
                        alert('Login não encontrado');
                        window.history.back();
                        </script>";
                    }
                }
            break;

        //Cadastrar usuario
        case isset($_POST["btnCadastrarUser"]):
            require_once "../Controller/UsuarioController.php";
            $uController = new UsuarioController();

            if ($uController->inserir(
                $_POST["txtCPF"],
                $_POST["txtNome"],
                $_POST["txtSetor"],
                $_POST["txtEmail"],
                $_POST["txtSenha"],
                $_POST["txtNivel"],
            )){
                include_once "../View/cadastroRealizado.php";
            } else {
                include_once "../View/cadastroNaoRealizado.php";
            }
            break;

        //Confirmar documento
        case isset($_POST["btnConfirmarDocumentoComum"]):
            require_once "../Model/Usuario.php";
            require_once "../Controller/DocumentoController.php";
            $documentoController = new DocumentoController();
            if ($documentoController->aceitacaoDoDocumento($_POST["nProtocoloConfirmarComum"], unserialize($_SESSION['Usuario'])->getCPF())) {
                echo "<script>
                alert('Documento Aceito');
                window.history.back();
                </script>";
                include_once "../View/inicioUsuario.php";
            } else {
                include_once "../View/inicioUsuario.php";
            }
            break;

            //Visualizar documento
            case isset($_POST["btnVisualizarDoc"]):
                require_once "../Controller/DocumentoController.php";
                require_once "../Model/Documento.php";
                
                $documentoController = new Documento();
                $results = $documentoController->visualizarDocumento($_POST['nProtocoloVisualizacao']);
                
                if ($results) {
                    // Construa a URL de redirecionamento com os parâmetros extraídos
                    $url = "../View/visualizarDocumento.php?nProtocolo=" . urlencode($results['nProtocolo']) .
                           "&nome_possuidor=" . urlencode($results['nome_possuidor']) .
                           "&nome_destinatario=" . urlencode($results['nome_destinatario']) .
                           "&setor_destinatario=" . urlencode($results['setor_destinatario']) .
                           "&data_de_cadastro=" . urlencode($results['data_de_cadastro']) .
                           "&tipo=" . urlencode($results['tipo']) .
                           "&titulo=" . urlencode($results['titulo']);
                    header("Location: $url");
                    exit;
                } else {
                    // Trate a situação onde o documento não foi encontrado
                    header("Location: ../View/errorPage.php?error=DocumentoNaoEncontrado");
                    exit;
                }
                break;

            //Historico documento
            case isset($_POST["btnHistoricoDoc"]):
                require_once "../Model/Movimentacao.php";
                
                $movimentacaoController = new Movimentacao();
                $results = $movimentacaoController->carregarMovimentacoes($_POST['nProtocoloHist']);
                
                if ($results) {
                    // Construa a URL de redirecionamento com os parâmetros extraídos
                    $url = "../View/historicoDocumento.php?nProtocolo=" . ($_POST['nProtocoloHist']);
                    header("Location: $url");
                    exit;
                } else {
                    // Trate a situação onde o documento não foi encontrado
                    header("Location: ../View/errorPage.php?error=DocumentoNaoEncontrado");
                    exit;
                }
                break;
                  
            //Cadastro documento  
            case isset($_POST["btnCadastrarDocumentoGestor"]):
                require_once "../Model/Usuario.php";
                require_once "../Controller/DocumentoController.php";
                $documentoController = new DocumentoController();
                if($documentoController->cadastrarDocumento(unserialize($_SESSION['Usuario'])->getCPF(), $_POST["txtDestinatario"], $_POST["txtTipo"], $_POST["txtTitulo"])){
                    echo "<script>
                    alert('Documento Cadastrado');
                    window.history.back();
                    </script>";
                    include_once "../View/inicioGestor.php";
                }else {
                    echo "<script>
                    alert('Documento Não Cadastrado');
                    window.history.back();
                    </script>";
                    include_once "../View/inicioGestor.php";
                }
                break;;
            
            //Cadastro realizado
            case isset($_POST["btnCadRealizado"]):
                include_once "../View/inicioGestor.php";
                break;
            
            //Cadastro não realizado
            case isset($_POST["btnCadNaoRealizado"]):
                include_once "../View/inicioGestor.php";
                break;
    }
?>
