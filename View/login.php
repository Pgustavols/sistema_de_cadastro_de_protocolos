<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        .centralizado {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>
<body style="background-color: #F2F2F2;">
<header class="container-fluid bg-dark shadow p-4">
    <h1 class="font-padrao text-white centralizado">Login</h1>
</header>
<main class="container-fluid p-3">
    <div class="card card-centralizado">
        <div class="card-body">
            <form action="processar_login.php" method="post" class="row g-3">
                <div class="col-12">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login">
                </div>
                <div class="col-12">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha">
                </div>
                <div class="col-12">
                    <a href="recuperacao.php" class="text-decoration-none">Esqueci minha senha</a>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-dark">Entrar</button>
                </div>
                <div class="col-12">
                    <a href="#" class="text-decoration-none">Solicitar cadastro</a>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
</body>
</html>