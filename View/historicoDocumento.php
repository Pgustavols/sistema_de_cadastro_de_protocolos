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
    include_once '../Model/Movimentacao.php';
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
<header class="container-fluid bg-dark shadow p-4 text-center">
    <button class="btn btn-light position-absolute top-0 start-0 m-4" onclick="returnToMainPage()"><i class="bi bi-house-fill"></i></button>
    <h1 class="font-padrao text-white ">Histórico do Documento</h1>
</header>
<h2 class="text-center fw-bold mt-4 mb-2 fs-4">Nº Protocolo: <?php echo $_GET['nProtocolo'];?></h2>
<main class="container-fluid p-4 font-padrao">
    <div class="container m-auto bg-white rounded shadow p-4 border table-responsive" style="max-height: 500px; overflow-y:auto;">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <th class="text-center">Titulo Documento</th>
                <th class="text-center">Data</th>
                <th class="text-center">Movimentação</th>
                <th class="text-center">Autor</th>
                <th class="text-center">Destino</th>
            </thead>
            <?php
                $mCon = new Movimentacao();
                $results = $mCon->carregarMovimentacoes($_GET['nProtocolo']);
                if($results != null)
                while($row = $results->fetch_object()) {
                echo '<tr>';
                echo '<td class="text-center">'.$row->titulo.'</td>';
                echo '<td class="text-center">'.date('d/m/Y', strtotime($row->data_da_acao)).'</td>';
                echo '<td class="text-center">'.$row->estado.'</td>';
                echo '<td class="text-center">'.$row->nome_remetente.'</td>';
                echo '<td class="text-center">'.$row->nome_destinatario.'</td>';
                echo '</tr>';
                }
            ?>
        </table>
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