<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico Documento</title>
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
<header class="container-fluid bg-dark shadow p-4 text-center">
    <h1 class="font-padrao text-white ">Histórico - </h1>
</header>
<main class="container-fluid p-4 font-padrao">
    <h2 class="text-center fw-semibold my-4 fs-5">Nº Protocolo: </h2>
    <div class="container m-auto bg-white rounded shadow p-4 border table-responsive" style="max-height: 500px; overflow-y:auto;">
        <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <th class="text-center">Data</th>
                    <th class="text-center">Movimentação</th>
                    <th class="text-center">Autor</th>
                    <th class="text-center">Destino</th>
                </thead>
            </table>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>