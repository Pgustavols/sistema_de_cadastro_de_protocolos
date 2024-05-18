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

            case isset($_POST["btnLogin"]):

            if(empty($_POST["txtCPF"]) || empty($_POST["txtSenha"])){
                echo
                "<script>
                alert('Por favor, preencha todos os campos.');
                window.history.back();
                </script>";
                } else {
                    $uController = new UsuarioController();
                    $result = $uController->login($_POST["txtCPF"], $_POST["txtSenha"]);

                    if($result == 1){
                        include_once "../View/inicioGestor.php";
                    } elseif ($result == 2){
                        include_once "../View/inicioUsuario.php";
                    } else{
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