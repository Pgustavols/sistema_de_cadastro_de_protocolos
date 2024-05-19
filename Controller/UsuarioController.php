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

        public function atualizar($nome, $email, $setor, $senha, $cpf) {
            require_once '../Model/Usuario.php';
            $usuario = new Usuario();
            $usuario->setNome($nome);
            $usuario->setEmail($email);
            $usuario->setSetor($setor);
            $usuario->setSenha($senha);
            $usuario->setCPF($cpf);
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
            $verNome=$usuario->getNome();
            if($senha == $verSenha){
                $_SESSION['Usuario'] = serialize($usuario);
                if($verNivel == "Gerente"){
                    return array(
                        'cpf' => $cpf,
                        'nome' => $verNome,
                        'nivel' => $verNivel
                    );
                }elseif($verNivel == "Comum"){
                    return array(
                        'cpf' => $cpf,
                        'nome' => $verNome,
                        'nivel' => $verNivel
                    );
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
