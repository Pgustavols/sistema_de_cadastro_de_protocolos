<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização Documento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .font-padrao {
            font-family: Roboto;
        }
        .top-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body style="background-color: #D9D9D9;">
<?php
    include_once '../Controller/DocumentoController.php';
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
<header class="container-fluid bg-dark shadow p-4 text-center mb-4">
    <button class="btn btn-light position-absolute top-0 start-0 m-4" onclick="returnToMainPage()"><i class="bi bi-house-fill"></i></button>
    <h1 class="font-padrao text-white">Visualização Documento</h1>
</header>
<main class="container-fluid p-4 font-padrao">
    <div class="container m-auto bg-white rounded shadow p-4 border">
        <form action="" method="POST" class="row g-3 justify-content-between">
            <div class="col-2 my-3">
                    <label for="txtProtocolo" class="form-label">Nº Protocolo</label>
                    <input type="number" class="form-control" id="txtProtocolo" name="txtProtocolo" disabled value="<?php echo $_GET['nProtocolo']?>">
            </div>
            <div class="col-10 my-3">
                <label for="txtTitulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" value="<?php echo $_GET['titulo']?>">
            </div>
            <div class="col-3 my-3">
                <label for="txtData" class="form-label">Data de cadastro</label>
                <input type="date" class="form-control" id="txtData" name="txtData" disabled value="<?php echo $_GET['data_de_cadastro']?>">
            </div>
            <div class="col-6 my-3">
                <label for="txtPossuidor" class="form-label">Possuidor</label>
                <input type="text" class="form-control" id="txtPossuidor" name="txtPossuidor" disabled value="<?php echo $_GET['nome_possuidor']?>">
            </div>
            <div class="col-3 my-3">
                <label for="txtTipo" class="form-label">Tipo Documento</label>
                <select class="form-select" id="txtTipo" name="txtTipo">
                    <option value="Requerimento">Requerimento</option>
                    <option value="Pedido de Compra">Pedido de Compra</option>
                    <option value="Ata">Ata</option>
                    <option value="Relatório">Relatório</option>
                </select>
            </div>
            <div class="col-8 my-3">
                <label for="txtDestinatario" class="form-label">Destinatário</label>
                <input class="form-control" id="txtDestinatario" name="txtDestinatario" disabled value="<?php echo $_GET['nome_destinatario']?>">
            </div>
            <div class="col-4 my-3">
                <label for="txtSetor" class="form-label">Setor Destinatário</label>
                <input class="form-control" id="txtSetor" name="txtSetor" disabled value="<?php echo $_GET['setor_destinatario']?>">
            </div>
            <button class="col-3 btn btn-danger my-3 mx-2">Exluir</button>
            <button class="col-3 btn btn-secondary my-3 mx-2">Alterar</button>
            <button class="col-3 btn btn-dark my-3 mx-2">Enviar</button>
        </form>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
        // Função para retornar à página principal
        function returnToMainPage() {
            if ("<?php echo $nivelUsuario; ?>" === 'Gerente') {
                window.location.href = '../View/inicioGestor.php';
            } else if ("<?php echo $nivelUsuario; ?>" === 'Usuário') {
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