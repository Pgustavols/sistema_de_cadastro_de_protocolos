<?php
    if(!isset($_SESSION))
    {
    session_start();
    }

    class UsuarioController{
        public function inserir($cpf, $nome, $setor, $email, $senha, $nivel) {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setCPF($cpf);
        $usuario->setNome($nome);
        $usuario->setSetor($setor);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setNivel($nivel);
        $r = $usuario->inserirUsuario();
        $_SESSION['Usuario'] = serialize($usuario);
        return $r;
        }

        public function atualizar($nome, $email, $setor, $nivel,$senha) {
            require_once '../Model/Usuario.php';
            $usuario = new Usuario();
            $usuario->setNome($nome);
            $usuario->setEmail($email);
            $usuario->setEmail($setor);
            $usuario->setEmail($nivel);
            $usuario->setSenha($senha);
            $r = $usuario->atualizarUsuario();
            $_SESSION['Usuario'] = serialize($usuario);
            return $r;
        }
        public function login($cpf, $senha){
            require_once '../Model/Usuario.php';
            $usuario = new Usuario();
            $usuario->carregarUsuario($cpf);
            $verSenha=$usuario->getSenha();
            $verNivel=$usuario->getNivel();
            if($senha == $verSenha){
                $_SESSION['Usuario'] = serialize($usuario);
                if($verNivel == "Gerente"){
                    $nivel = 1;
                return $nivel;//Gerente
                }elseif($verNivel == "Comum"){
                    $nivel = 2;
                return $nivel;//Comum
                }
            }
            return false;
        }

        public function listaGestaoUsuarios(){
            require_once '../Model/Usuario.php';
            $usuario = new Usuario();
            $r = $usuario->mostraListaDeUsuarios();
            return $r;
        }
    }
?>
