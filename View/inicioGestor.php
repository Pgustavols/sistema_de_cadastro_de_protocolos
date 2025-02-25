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
        .table-danger {
            background-color: #f8d7da;
        }
        .notification {
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 1px 2px;
            position: absolute;
            top: 0;
            right: 0;
        }
        .button-container {
            position: relative;
            display: inline-block;
        }

    </style>
</head>
<body style="background-color: #F2F2F2;" class="font-padrao">
<?php
    include_once '../Controller/DocumentoController.php';
    include_once '../Controller/UsuarioController.php';
    include_once '../Model/Usuario.php';
   

    
    if(!isset($_SESSION))
        {
        session_start();
        }

        require_once '../Model/Documento.php';
        $documento = new Documento();
        $protocolo = $documento->pegaNumeroProtocolo();

        require_once '../Model/Usuario.php';

        $cpf_logado = $_SESSION['cpf']; // O CPF do usuário logado deve ser definido aqui
        $usuario = new Usuario();
        $destinatarios = $usuario->listaDestinatarios($cpf_logado);

        $destinatarios_js = array();
        foreach ($destinatarios as $destinatario) {
            $cpf_da_option = $destinatario['cpf'];
            $setorDestinatario = $usuario->listaSetorDestinatario($cpf_da_option);
            $destinatarios_js[] = array('cpf' => $cpf_da_option, 'nome' => $destinatario['nome'], 'setor' => $setorDestinatario);
    }
    
?>
<header class="container-fluid bg-dark shadow p-4">
    <h1 class="font-padrao text-white ">Olá, seja bem vindo(a) <?php echo $_SESSION['nome'];?></h1>
    <form action="../Controller/Navegacao.php" method="post"><button name="btnDeslogar" class="btn btn-danger position-absolute top-0 end-0 m-4"><i class="bi bi-box-arrow-right"></i></button></form>
</header>
<main class="container-fluid p-3">
    <div class="my-3 p-3 m-auto font-padrao row justify-content-between">
        <div class="col-7">
            <form action="../Controller/Navegacao.php" class="input-group mb-3 h-100">
                <input type="number" class="form-control" id="pesquisa" name="pesquisa" placeholder="Pesquisar por Nº de Protocolo">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span> 
                </button>
            </form>
        </div>
        <div class="col-1 button-container">
            <button class="btn btn-light shadow-sm border h-100 w-100" name="btnDocumentoPendente"
            id="btnDocumentoPendente" data-bs-toggle="modal" data-bs-target="#telaDocumentoPendente">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
            </svg>
            </button>
            <span id="notification" class="position-absolute top-0 start-80 translate-middle badge border border-light rounded-circle bg-danger p-2" style="display:none;"></span>
        </div>
        <div class="col-2">
            <button class="col-2 btn btn-dark shadow-sm border h-100 w-100" name="btnGestor"
            id="btnGestor" data-bs-toggle="modal" data-bs-target="#telaGestorFuncionarios">
            <p class="d-inline">Gestão Func. </p>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
            </svg>
            </button>
        </div>
        <div class="col-2">
            <button class="col-2 btn btn-dark shadow-sm border h-100 w-100" name="btnNovoDocumento"
            id="btnNovoDocumento" data-bs-toggle="modal" data-bs-target="#telaNovoDocumento">
            <p class="d-inline">Novo Documento </p>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
            </svg>
            </button>
        </div>
    </div>
    <div class="modal fade" id="telaDocumentoPendente" tabindex="-1" aria-labelledby="telaDocumentoPendenteLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="telaDocumentoPendenteLabel">Documentos Pendentes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body table-responsive" style="max-height: 400px;">
                    <table class="table table-striped table-hover rounded-3 shadow" id="tabelaDocPendentes">
                        <thead class="table-dark">
                            <th class="text-center">Nº Protocolo</th>
                            <th class="text-center">Título</th>
                            <th class="text-center">Enviado por</th>
                            <th class="text-center">Data de Envio</th>
                            <th class="text-center">Confirmar</th>
                            <th class="text-center">Recusar</th>
                        </thead>
                        <?php
                    $dCon = new DocumentoController();
                    $results = $dCon->telaPendentes(unserialize($_SESSION['Usuario'])->getCPF());
                    if($results != null)
                    while($row = $results->fetch_object()) {
                    echo '<tr>';
                    echo '<td class="text-center">'.$row->nProtocolo.'</td>';
                    echo '<td class="text-center">'.$row->titulo.'</td>';
                    echo '<td class="text-center">'.$row->nome.'</td>';
                    echo '<td class="text-center">'.date('d/m/Y', strtotime($row->data_da_acao)).'</td>';
                    echo '<td class="text-center">
                    <form action="../Controller/Navegacao.php" method="post">
                        <input type="hidden" name="nProtocoloConfirmarGestor" value="'.$row->nProtocolo.'">
                        <button name="btnConfirmarDocumento" class="btn btn-success">
                        <i class="bi bi-check"></i></button></td>';
                    echo '<td class="text-center">
                    <form action="../Controller/Navegacao.php" method="post">
                        <input type="hidden" name="nProtocoloRecusarGestor" value="'.$row->nProtocolo.'">
                        <button name="btnRecusarDocumento" class="btn btn-danger">
                        <i class="bi bi-x"></i></button></td>
                    </form>';
                    echo '</tr>';
                    }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="telaNovoDocumento" tabindex="-1" aria-labelledby="telaNovoDocumentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="telaNovoDocumentoLabel">Cadastro Novo Documento </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form action="../Controller/Navegacao.php" method="POST" class="row g-3 justify-content-between">
                        <div class="col-2 my-3">
                            <label for="txtProtocolo" class="form-label">Nº Protocolo</label>
                            <input type="number" class="form-control" id="txtProtocolo" name="txtProtocolo" placeholder="<?php echo htmlspecialchars($protocolo); ?>" disabled>
                        </div>
                        <div class="col-10 my-3">
                            <label for="txtTitulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="txtTitulo" name="txtTitulo">
                        </div>
                        <div class="col-3 my-3">
                            <label for="txtData" class="form-label">Data de cadastro</label>
                            <input type="date" class="form-control" id="txtData" name="txtData" disabled>
                        </div>
                            <script>
                            var dataInput = document.getElementById('txtData');
                            var hoje = new Date();
                            var dia = hoje.getDate();
                            var mes = hoje.getMonth() + 1; // O mês começa em 0
                            var ano = hoje.getFullYear();

                            // Formata a data no formato YYYY-MM-DD
                            var dataFormatada = ano + '-' + (mes < 10 ? '0' + mes : mes) + '-' + (dia < 10 ? '0' + dia : dia);

                            // Define o valor padrão do campo de entrada de data
                            dataInput.value = dataFormatada;
                        </script>
                        <div class="col-6 my-3">
                        <label for="txtPossuidor" class="form-label">Possuidor</label>
                        <input type="text" class="form-control" id="txtPossuidor" name="txtPossuidor" placeholder="Eu" disabled>
                        </div>
                        <div class="col-3 my-3">
                            <label for="txtTipo" class="form-label">Tipo Documento</label>
                            <select class="form-select" id="txtTipo" name="txtTipo">
                                <option value="1">Requerimento</option>
                                <option value="2">Pedido de Compra</option>
                                <option value="3">Ata</option>
                                <option value="4">Relatório</option>
                            </select>
                        </div>
                        <div class="col-8 my-3">
                        <label for="txtDestinatario" class="form-label">Destinatário</label>
                        <select class="form-select" id="txtDestinatario" name="txtDestinatario">
                        <?php foreach ($destinatarios as $destinatario): ?>
                                    <option value="<?php echo htmlspecialchars($destinatario['cpf']); ?>">
                                        <?php echo htmlspecialchars($destinatario['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                        </div>
                        <div class="col-4 my-3">
                            <label for="txtSetor" class="form-label">Setor Destinatário</label>
                            <input class="form-control" id="txtSetor" name="txtSetor" placeholder="" disabled>
                        </div>
                        <button name="btnCancelar" class="col-5 btn btn-danger my-3">Cancelar</button>
                        <button name="btnCadastrarDocumentoGestor" class="col-5 btn btn-dark my-3">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="telaGestorFuncionarios" tabindex="-1" aria-labelledby="telaGestorFuncionariosLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="telaGestorFuncionariosLabel">Gestão de Funcionários</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                <button class="btn btn-dark shadow-sm border my-3" name="btnNovoFuncionario" id="btnNovoFuncionario" data-bs-toggle="modal" data-bs-target="#telaNovoFuncionario">
                    <p class="d-inline">Novo Funcionário </p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg>
                </button>
                <br>
                    <div class="table-responsive" style="max-height: 400px;">
                        <table class="table table-striped table-hover rounded-3 shadow">
                            <thead class="table-dark">
                                <th class="text-center">Nome</th>
                                <th class="text-center">Setor</th>
                                <th class="text-center">Nível</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Desativar</th>
                            </thead>
                            <?php
                        $dCon = new UsuarioController();
                        $results = $dCon->listaGestaoUsuarios();
                        if($results != null)
                        while($row = $results->fetch_object()) {
                        $rowClass = ($row->senha == '') ? 'table-danger' : '';
                        echo '<tr>';
                        echo '<tr class="'.$rowClass.'">';
                        echo '<td class="text-center">'.$row->nome.'</td>';
                        echo '<td class="text-center">'.$row->setor.'</td>';
                        echo '<td class="text-center">'.$row->nivel.'</td>';
                        echo '<td class="text-center">
                        <form action="../Controller/Navegacao.php" method="post">
                            <input type="hidden" name="cpfEdit" value="'.$row->cpf.'">
                            <button name="btnEditarUsuario" class="btn btn-primary">
                            <i class="bi bi-pencil"></i></button></form></td>';
                        echo '<td class="text-center">
                        <form action="../Controller/Navegacao.php" method="post">
                            <input type="hidden" name="cpfDes" value="'.$row->cpf.'">
                            <button name="btnDesativarUsuario" class="btn btn-danger">
                            <i class="bi bi-person-fill-x"></i></button></form></td>';
                        echo '</tr>';
                        }
                                    ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="telaNovoFuncionario" tabindex="-1" aria-labelledby="telaNovoFuncionarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body row align-items-center p-4">
                    <div class="col-6 text-center">
                        <img src="../Img/Logo1.png" alt="Logo" class="figure-img img-fluid rounded">
                        <h1>Cadastro de usuário</h1>
                        <p class="text-break">Insira as informações do funcionário</p>
                    </div>
                    <div class="col-6">
                            <form action="../Controller/Navegacao.php" method="POST">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="txtCPF" name="txtCPF" placeholder="CPF">
                                    <label for="txtCPF">CPF</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome">
                                    <label for="txtNome">Nome</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="txtSetor" name="txtSetor" placeholder="Setor">
                                    <label for="txtSetor">Setor</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="E-mail">
                                    <label for="txtEmail">E-mail</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="txtNivel" name="txtNivel" placeholder="Nível">
                                    <label for="txtNivel">Nível</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="Senha">
                                    <label for="txtSenha">Senha</label>
                                    <span id="senha-error" class="error"></span>
                                </div>
                            <button name="btnCadastrarUser" class="btn btn-dark">Cadastrar</button>
                            <button name="btnCancelar" class="btn btn-danger">Cancelar</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-4 p-3 font-padrao rounded-3 shadow table-responsive" style="background-color: white;">
        <div class="table-responsive" style="max-height: 350px;">
            <table class="table table-striped table-hover" id="tabelaDocumentos">
                <thead class="table-dark">
                    <th class="text-center">Nº Protocolo</th>
                    <th class="text-center">Título</th>
                    <th class="text-center">Possuidor</th>
                    <th class="text-center">Data de cadastro</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Visualizar</th>
                    <th class="text-center">Histórico</th>
                </thead>
                <tbody>
                    <?php
                        $dCon = new DocumentoController();
                        $results = $dCon->telaInicialdocumento(unserialize($_SESSION['Usuario'])->getCPF(), unserialize($_SESSION['Usuario'])->getCPF());
                        if($results != null)
                        while($row = $results->fetch_object()) {
                        $rowClass = ($row->estado == 'Excluído') ? 'table-danger' : '';
                        echo '<tr class="'.$rowClass.'">';
                        echo '<td class="text-center">'.$row->nProtocolo.'</td>';
                        echo '<td class="text-center">'.$row->titulo.'</td>';
                        echo '<td class="text-center">'.$row->nome.'</td>';
                        echo '<td class="text-center">'.date('d/m/Y', strtotime($row->data_de_cadastro)).'</td>';
                        echo '<td class="text-center">'.$row->estado.'</td>';
                        echo '<td class="text-center">
                        <form action="../Controller/Navegacao.php" method="post">
                        <input type="hidden" name="nProtocoloVisualizacao" value="'.$row->nProtocolo.'">
                        <button name="btnVisualizarDoc" class="btn btn-dark">
                        <i class="bi bi-eye"></i></button></form></td>';
                        echo '<td class="text-center">
                        <form action="../Controller/Navegacao.php" method="post">
                        <input type="hidden" name="nProtocoloHist" value="'.$row->nProtocolo.'">
                        <button name="btnHistoricoDoc" class="btn btn-dark">
                        <i class="bi bi-clock-history"></i></button></form></td>';
                        echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("pesquisa");
            const dataTable = document.getElementById("tabelaDocumentos").getElementsByTagName("tbody")[0];

            searchInput.addEventListener("input", function() {
                const filter = searchInput.value.toLowerCase();
                const rows = dataTable.getElementsByTagName("tr");

                for (let i = 0; i < rows.length; i++) {
                    const cell = rows[i].getElementsByTagName("td")[0]; // Primeira coluna
                    const cellValue = cell.textContent || cell.innerText;

                    if (cellValue.toLowerCase().indexOf(filter) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            });
        });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const destinatarios = <?php echo json_encode($destinatarios_js); ?>;
        const destinatarioSelect = document.getElementById('txtDestinatario');
        const setorInput = document.getElementById('txtSetor');

        destinatarioSelect.addEventListener('change', function() {
            const selectedCpf = destinatarioSelect.value;
            const selectedDestinatario = destinatarios.find(dest => dest.cpf === selectedCpf);
            setorInput.placeholder = selectedDestinatario ? selectedDestinatario.setor : '';
        });

        // Trigger change event on page load to set the initial value
        destinatarioSelect.dispatchEvent(new Event('change'));
    });

    function checkTableAndShowNotification() {
            var table = document.getElementById('tabelaDocPendentes');
            var tbody = table.getElementsByTagName('tbody')[0];
            var rows = tbody.getElementsByTagName('tr');
            var notification = document.getElementById('notification');

            if (rows.length > 0 && rows[0].getElementsByTagName('td').length > 0) {
                notification.style.display = 'inline';
            } else {
                notification.style.display = 'none';
            }
        }

        // Chamar a função para verificar a tabela ao carregar a página
        checkTableAndShowNotification();
</script>
</body>
</html>
