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
    include_once '../Model/Usuario.php';
    if(!isset($_SESSION))
        {
        session_start();
        }
    if (!isset($_SESSION['cpf'])) {
        // Redireciona para a página de login se o usuário não estiver logado
        header("Location: ../index.php");
        exit;
    }
    $nivelUsuario = $_SESSION['nivel'];
?>
<header class="container-fluid bg-dark shadow p-4 text-center mb-3">
    <button class="btn btn-light position-absolute top-0 start-0 m-4" onclick="returnToMainPage()"><i class="bi bi-house-fill"></i></button>
    <h1 class="font-padrao text-white">Alteração de Cadastro de Usuario</h1>
</header>
<main class="container-fluid p-2 font-padrao">
    <div class="container m-auto bg-white rounded shadow p-4 border row align-items-center">
        <div class="col-6 text-center">
            <img src="../Img/Logo.png" alt="Logo" class="figure-img img-fluid rounded">
            <h1>Alteração de usuário</h1>
            <p class="text-break">Confira os dados do funcionário</p>
        </div>
        <div class="col-6">
        <form action="../Controller/Navegacao.php" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtCPF" name="txtCPF" placeholder="CPF" value="<?php echo $_GET['cpf']?>" readonly>
                <label for="txtCPF">CPF</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome" value="<?php echo $_GET['nome']?>">
                <label for="txtNome">Nome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtSetor" name="txtSetor" placeholder="Setor" value="<?php echo $_GET['setor']?>">
                <label for="txtSetor">Setor</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="E-mail" value="<?php echo $_GET['email']?>">
                <label for="txtEmail">E-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtNivel" name="txtNivel" placeholder="Nível" disabled value="<?php echo $_GET['nivel']?>">
                <label for="txtNivel">Nível</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtSenha" name="txtSenha" placeholder="Senha" value="<?php echo $_GET['senha']?>">
                <label for="txtSenha">Senha</label>
            </div>
            <button name="btnCancelar" class="btn btn-danger">Cancelar</button>
            <button name="btnAlterarUser" class="btn btn-dark">Alterar</button>
        </form>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
        // Função para retornar à página principal
        function returnToMainPage() {
            if ("<?php echo $nivelUsuario; ?>" === 'Gerente') {
                window.location.href = '../View/inicioGestor.php';
            } else if ("<?php echo $nivelUsuario; ?>" === 'Comum') {
                window.location.href = '../View/inicioUsuario.php';
            }
        }

        // Verifica o parâmetro de controle
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('open_in_new_tab')) {
            const newUrl = window.location.href.replace('&open_in_new_tab=1', '').replace('?open_in_new_tab=1', '');
            window.open(newUrl, '_blank'); // Abre a URL em uma nova guia
            window.close(); // Fecha a guia atual
        }
    </script>
</body>
</html>