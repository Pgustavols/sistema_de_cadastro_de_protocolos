<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        .font-padrao {
            font-family: Roboto;
        }
    </style>
</head>
<body style="background-color: #D9D9D9;">
<header class="container-fluid bg-dark shadow p-4 text-center">
    <h1 class="font-padrao text-white">Recuperação de Senha</h1>
</header>
<main class="container-fluid p-4 font-padrao">
    <div class="container m-auto bg-white rounded shadow p-4 border" style="width:30%; min-width:350px;">
        <p class="text-center fw-semibold my-4">O seu gestor irá receber a solicitação para alteração da senha.</p>
        <form action="#">
            <div class="form-floating my-3">
                <input type="text" class="form-control" id="login" name="login" placeholder="Login">
                <label for="login">Login</label>
            </div>
                <button class="btn btn-dark col-12 my-2">Enviar Solicitação</button>
                <button class="btn btn-danger col-12 my-2">Cancelar</button>
        </form>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>