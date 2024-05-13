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
        .card-centralizado {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
        .titulo-centralizado {
            text-align: center;
        }
        .negrito {
            font-weight: bold;
        }
        .botao-cancelar {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body style="background-color: #F2F2F2;">
<header class="container-fluid bg-dark shadow p-4">
    <h1 class="font-padrao text-white titulo-centralizado">Recuperação de Senha</h1>
</header>
<main class="container-fluid p-3">
    <div class="card card-centralizado">
        <div class="card-body">
            <p><span class="negrito">O seu gestor irá receber a solicitação para alteração da senha.</span></p>
            <form action="#" class="row g-3">
                <div class="col-12">
                    <label for="login" class="form-label"><span class="negrito">Login</span></label>
                    <input type="text" class="form-control" id="login" name="login">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-dark">Enviar Solicitação</button>
                    <button type="button" class="btn btn-secondary botao-cancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>