<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Documentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .font-padrao {
            font-family: Roboto;
        }
        body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f0f0f0;
        }

        .animated-button:hover {
            background-color: #1FA528;
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            animation-duration: 1s;
        }

        .animated-button:active {
            background-color: #2CE839;
            transform: scale(1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .entrada {
        width: 300px;
        height: 150px;
        background-color: #21AE2B;
        animation: slideIn 1s; /* Nome da animação e duração */
        }

        /* Definição da animação */
        @keyframes slideIn {
            0%{
                width: 200px;
                height: 100px;
                background-color: white;
            }
            50% {
                width: 350px;
                height: 175px;
                background-color: #21AE2B;
            }
            100% {
                width: 300px;
                height: 150px;
                background-color: #21AE2B;
            }
        }
    </style>
</head>
<body>
    <form action="../Controller/Navegacao.php" method="post" class="container m-3 p-4 text-center" style="width: 30%;">
        <div>
            <button name="btnDocAceito" class="btn btn-success rounded fs-4 fw-bold shadow animated-button entrada">Documento Aceito!</button>
        </div>
    </form>
</body>
</html>