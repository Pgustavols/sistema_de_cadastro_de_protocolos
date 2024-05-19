<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .font-padrao {
            font-family: Roboto;
        }
    </style>
</head>
<body style="background-color: #D9D9D9;">
<?php
    include_once '../Controller/DocumentoController.php';
    include_once '../Controller/UsuarioController.php';
    include_once '../Model/Usuario.php';
    if(!isset($_SESSION))
        {
        session_start();
        }
?>
<header class="container-fluid bg-dark shadow p-4 text-center mb-3">
    <h1 class="font-padrao text-white ">Visualização Documento</h1>
</header>
<main class="container-fluid p-2 font-padrao">
    <div class="container m-auto bg-white rounded shadow p-4 border row align-items-center">
        <div class="col-6 text-center">
            <img src="../Img/Logo.png" alt="Logo" class="figure-img img-fluid rounded">
            <h1>Alteração de usuário</h1>
            <p class="text-break">Confira os dados dos funcionários</p>
        </div>
        <div class="col-6">
        <?php 
        
        
        echo "
        <form action='../Controller/Navegacao.php' method='POST'>
            <div class='form-floating mb-3'>
                <input type='text' class='form-control' id='txtCPF' name='txtCPF' placeholder='CPF' disabled value='"."'>
                <label for='txtCPF'>CPF</label>
            </div>
            <div class='form-floating mb-3'>
                <input type='text' class='form-control' id='txtNome' name='txtNome' placeholder='Nome' value='"."'>
                <label for='txtNome'>Nome</label>
            </div>
            <div class='form-floating mb-3'>
                <input type='text' class='form-control' id='txtSetor' name='txtSetor' placeholder='Setor' value='"."'>
                <label for='txtSetor'>Setor</label>
            </div>
            <div class='form-floating mb-3'>
                <input type='email' class='form-control' id='txtEmail' name='txtEmail' placeholder='E-mail' value='"."'>
                <label for='txtEmail'>E-mail</label>
            </div>
            <div class='form-floating mb-3'>
                <input type='text' class='form-control' id='txtNivel' name='txtNivel' placeholder='Nível' value='"."'>
                <label for='txtNivel'>Nível</label>
            </div>
            <div class='form-floating mb-3'>
                <input type='password' class='form-control' id='txtSenha' name='txtSenha' placeholder='Senha' value='"."'>
                <label for='txtSenha'>Senha</label>
                <span id='senha-error' class='error'></span>
            </div>
            <button name='btnCancelar' class='btn btn-danger'>Cancelar</button>
            <button name='btnAlterarUser' class='btn btn-dark'>Alterar</button>
        </form>";
        ?>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>