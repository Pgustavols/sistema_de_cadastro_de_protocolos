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
                        } elseif ($result['nivel'] == 'Comum'){
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

        //Recuperar senha
        case isset($_POST["btnRecSenha"]):
            require_once "../Controller/UsuarioController.php";
            if($_POST["txtCpf"] == ''){
                echo
                "<script>
                alert('Por favor, preencha o campo CPF.');
                window.history.back();
                </script>";
            } else {
                $uController = new UsuarioController();
                
                if ($uController->esquecerSenha(
                    $_POST["txtCpf"]
                )){
                    include_once "../View/solicitacaoEnviada.php";
                } else {
                    include_once "../View/solicitacaoNaoEnviada.php";
                }
            }
            break;

        //Cadastrar usuario
        case isset($_POST["btnCadastrarUser"]):
            require_once "../Controller/UsuarioController.php";
            
            if(empty($_POST["txtCPF"]) || empty($_POST["txtNome"]) || empty($_POST["txtSetor"]) || empty($_POST["txtEmail"]) || empty($_POST["txtSenha"]) || empty($_POST["txtNivel"])){
                echo
                    "<script>
                    alert('Por favor, preencha todos os campos.');
                    </script>";
                include_once "../View/cadastroNaoRealizado.php";
               } else {   $uController = new UsuarioController();

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
            }
            exit;
            break;

        //Tela de alteraração de usuario
        case isset($_POST["btnEditarUsuario"]):
            require_once "../Model/Usuario.php";
            
            $uController = new Usuario();
            $results = $uController->alterarUsuario($_POST['cpfEdit']);
            
            if ($results) {
                // Construa a URL de redirecionamento com os parâmetros extraídos
                $url = "../View/alterarUsuario.php?cpf=" . urlencode($results['cpf']) .
                        "&nome=" . urlencode($results['nome']) .
                        "&setor=" . urlencode($results['setor']) .
                        "&email=" . urlencode($results['email']) .
                        "&senha=" . urlencode($results['senha']) .
                        "&nivel=" . urlencode($results['nivel']);
                header("Location: $url");
                exit;
            } else {
                // Trate a situação onde o documento não foi encontrado
                header("Location: ../View/errorPage.php?error=DocumentoNaoEncontrado");
                exit;
            }
            break;

        //Alterar usuario
        case isset($_POST["btnAlterarUser"]):
            require_once "../Controller/UsuarioController.php";
            $uController = new UsuarioController();
            
            if ($uController->atualizar(
                $_POST["txtNome"],
                $_POST["txtEmail"],
                $_POST["txtSetor"],
                $_POST["txtSenha"],
                $_POST["txtCPF"],

            )){
                include_once "../View/alteracaoRealizada.php";
            } else {
                include_once "../View/alteracaoNaoRealizada.php";
            }
            break;

            //Desativar usuario
            case isset($_POST["btnDesativarUsuario"]):
                require_once "../Model/Usuario.php";
                $u = new Usuario();
                if($_SESSION['cpf'] === $_POST["cpfDes"]){
                    echo
                    "<script>
                    alert('Você não pode se auto excluir.');
                    </script>";
                    include_once "../View/usuarioNaoExcluido.php";
                }
                else if($u->excluiUsuario($_POST["cpfDes"])){
                    include_once "../View/usuarioExcluido.php";
                } else{
                    include_once "../View/usuarioNaoExcluido.php";
                }
            break;

        //Confirmar documento
        case isset($_POST["btnConfirmarDocumentoComum"]):
            require_once "../Model/Usuario.php";
            require_once "../Controller/DocumentoController.php";
            $documentoController = new DocumentoController();
            if ($documentoController->aceitacaoDoDocumento($_POST["nProtocoloConfirmarComum"], unserialize($_SESSION['Usuario'])->getCPF())) {
                include_once "../View/documentoAceito.php";
            } else {
                include_once "../View/inicioUsuario.php";
            }
            break;

        //Confirmar documento comum
        case isset($_POST["btnConfirmarDocumento"]):
            require_once "../Model/Usuario.php";
            require_once "../Controller/DocumentoController.php";
            $documentoController = new DocumentoController();

            if ($documentoController->aceitacaoDoDocumento($_POST["nProtocoloConfirmarGestor"], unserialize($_SESSION['Usuario'])->getCPF())) {
                include_once "../View/documentoAceito.php";
            } else {
                include_once "../View/inicioUsuario.php";
            }
            break;

        //Recusar documento
        case isset($_POST["btnRecusarDocumento"]):
            require_once "../Controller/DocumentoController.php";
            $dc = new DocumentoController();
        
            if($dc->recusarDocumento($_POST["nProtocoloRecusarGestor"])){
                include_once "../View/documentoNaoAceito.php";
            } else {
                include_once "../View/inicioUsuario.php";
            }
            break;
        
        //Recusar documento comum
        case isset($_POST["btnRecusarDocumentoComum"]):
            require_once "../Controller/DocumentoController.php";
            $dc = new DocumentoController();
        
            if($dc->recusarDocumento($_POST["nProtocoloRecusarComum"])){
                include_once "../View/documentoNaoAceito.php";
            } else {
                include_once "../View/inicioUsuario.php";
            }
            break;

        //Visualizar documento
        case isset($_POST["btnVisualizarDoc"]):
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
                        "&titulo=" . urlencode($results['titulo']).
                        "&estado=" . urlencode($results['estado']);
                header("Location: $url");
                exit;
            } else {
                // Trate a situação onde o documento não foi encontrado
                header("Location: ../View/errorPage.php?error=DocumentoNaoEncontrado");
                exit;
            }
            break;

        //Tela envio documento
        case isset($_POST["btnTelaEnvio"]):
            require_once "../Model/Usuario.php";
            require_once "../Model/Documento.php";
            
            if($_POST['txtStatus'] == 'Pendente'){
                echo
                "<script>
                alert('O documento está pendente, portanto não pode ser enviado.');
                window.history.back();
                </script>";
            } elseif($_POST['txtStatus'] == 'Excluído'){
                echo
                "<script>
                alert('O documento foi excluído, portanto não pode ser enviado.');
                window.history.back();
                </script>";
                // break;
            }else if($_POST["txtPossuidor"] !== unserialize($_SESSION['Usuario'])->getNome()){
                echo
                "<script>
                alert('Você não é o possuidor deste documento, portanto não pode ser enviado.');
                window.history.back();
                </script>";
            }
            
            
            else{
                $documentoController = new Documento();
                $results = $documentoController->visualizarDocumento($_POST['txtnProtocolo']);
                
                if ($results) {
                    // Construa a URL de redirecionamento com os parâmetros extraídos
                    $url = "../View/enviarDocumento.php?nProtocolo=" . urlencode($results['nProtocolo']) .
                            "&titulo=" . urlencode($results['titulo']);
                    header("Location: $url");
                    exit;
                } else {
                    // Trate a situação onde o documento não foi encontrado
                    header("Location: ../View/errorPage.php?error=DocumentoNaoEncontrado");
                    exit;
                }
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
                  
        //Envio documento  
        case isset($_POST["btnEnviarDoc"]):
            require_once "../Controller/DocumentoController.php";
            $documentoController = new DocumentoController();
            if($documentoController->envioDocumento($_POST["txtnProtocolo"], $_POST["txtDestinatario"])){
                include_once "../View/documentoEnviado.php";
            } else {
                include_once "../View/documentoNaoEnviado.php";
            }
            break;;

        //Cadastro documento  
        case isset($_POST["btnCadastrarDocumentoGestor"]):
            require_once "../Model/Usuario.php";
            require_once "../Controller/DocumentoController.php";
            $documentoController = new DocumentoController();
            if($documentoController->cadastrarDocumento($_SESSION['cpf'], $_POST["txtDestinatario"], $_POST["txtTipo"], $_POST["txtTitulo"])){
                include_once "../View/cadastroRealizado.php";
            } else {
                include_once "../View/cadastroNaoRealizado.php";
            }
            break;;

        //Cadastro documento Comum
        case isset($_POST["btnCadastrarDocumentoComum"]):
            require_once "../Model/Usuario.php";
            require_once "../Controller/DocumentoController.php";
            $documentoController = new DocumentoController();
            if($documentoController->cadastrarDocumento($_SESSION['cpf'], $_POST["txtDestinatario"], $_POST["txtTipo"], $_POST["txtTitulo"])){
                include_once "../View/cadastroRealizado.php";
            } else {
                include_once "../View/cadastroNaoRealizado.php";
            }
            break;;
        
        //Alterar documento
        case isset($_POST["btnAlterarDoc"]):
            require_once "../Controller/DocumentoController.php";
            $dc = new DocumentoController();

            if($_POST['txtStatus'] == 'Pendente'){
                echo
                "<script>
                alert('O documento está pendente, portanto não pode ser alterado.');
                window.history.back();
                </script>";
            } elseif($_POST['txtStatus'] == 'Excluído'){
                echo
                "<script>
                alert('O documento foi excluído, portanto não pode ser alterado.');
                window.history.back();
                </script>";
            }else if($_POST["txtPossuidor"] !== ($_SESSION['nome'])){
                echo
                "<script>
                alert('Você não é o possuidor deste documento, portanto não pode ser alterado.');
                window.history.back();
                </script>";
            }
            else if($dc->alteraTituloDocumento($_POST["txtTitulo"], $_POST["txtnProtocolo"])){
                include_once "../View/alteracaoRealizada.php";
            }
            break;
            
    
        //Excluir documento
        case isset($_POST["btnExcluirDoc"]):
            require_once "../Model/Usuario.php";
            require_once "../Controller/DocumentoController.php";
            $documentoController = new DocumentoController();

            if($_POST['txtStatus'] == 'Pendente'){
                echo
                "<script>
                alert('O documento está pendente, portanto não pode ser excluído.');
                window.history.back();
                </script>";
            } elseif($_POST['txtStatus'] == 'Excluído'){
                echo
                "<script>
                alert('O documento já está excluído.');
                window.history.back();
                </script>";
            }else if($_POST["txtPossuidor"] !== unserialize($_SESSION['Usuario'])->getNome()){
                echo
                "<script>
                alert('Você não é o possuidor deste documento, portanto não pode ser excluído.');
                window.history.back();
                </script>";
            }

            else if($documentoController->excluirDocumento($_POST["txtnProtocolo"])){
                include_once "../View/documentoExcluido.php";
            } 
            break;;
        
        //Cadastro realizado
        case isset($_POST["btnCadRealizado"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            }
            break;
        
        //Cadastro não realizado
        case isset($_POST["btnCadNaoRealizado"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            }
            break;
        
        //Alteração realizada
        case isset($_POST["btnAltRealizada"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            }
            break;

        //Alteração não realizada
        case isset($_POST["btnAltNaoRealizada"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            }
            break;
        
        //Documento aceito
        case isset($_POST["btnDocAceito"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            }
            break;
        
        //Documento não aceito
        case isset($_POST["btnDocNaoAceito"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            }
            break;

        //Documento excluido
        case isset($_POST["btnDocExcluido"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            }
            break;

        //Documento não excluido
        case isset($_POST["btnDocNaoExcluido"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            }
            break;

        //Documento enviado
        case isset($_POST["btnDocEnviado"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            }
            break;

        //Documento não enviado
        case isset($_POST["btnDocNaoEnviado"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            }
            break;

        //Solicitação senha
        case isset($_POST["btnSolicitacao"]):
            session_destroy();

            header("Location: ../index.php");
            exit;
            break;
        
        //Cancelar
        case isset($_POST["btnCancelar"]):
            if($_SESSION['nivel'] == 'Gerente'){
                include_once "../View/inicioGestor.php";
            } elseif ($_SESSION['nivel'] == 'Comum'){
                include_once "../View/inicioUsuario.php";
            } else {
            session_destroy();

            header("Location: ../index.php");
            exit;
            }
            break;

        //Deslogar
        case isset($_POST["btnDeslogar"]):
            // Encerra a sessão
            session_destroy();

            header("Location: ../index.php");
            exit;
            break;   
    }
?>
