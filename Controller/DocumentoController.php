<?php
    if(!isset($_SESSION))
    {
    session_start();
    }

    class DocumentoController{
        public function aceitacaoDoDocumento($protocolo, $cpf_destinatario) {
            require_once '../Model/Documento.php';
            $documento = new Documento();
            $documento->setnProtocolo($protocolo);
            $documento->setCpf_possuidor($cpf_destinatario);
            $r = $documento->receberDocumento($documento->getnProtocolo(), $documento->getCpf_possuidor());
            $_SESSION['documento'] = serialize($documento);
            return $r;
        }

        public function recusarDocumento($nProtocolo){
            require_once "../Model/Documento.php";
            $d = new Documento();
            $r = $d->naoAceitarDocumentos($nProtocolo);
            return $r;
        }

        public function telaInicialdocumento($cpf_possuidor, $cpf_destinatario){
            require_once '../Model/Documento.php';
            $documento = new Documento();
            $r = $documento->carregarDocumentosNaTelaInicialGestor($cpf_possuidor, $cpf_destinatario);
            return $r;
        }

        public function telaInicialComum($cpf_possuidor){
            require_once '../Model/Documento.php';
            $documento = new Documento();
            $resultado = $documento->carregarDocumentosNaTelaInicialComum($cpf_possuidor);
            return $resultado;
        }

        public function telaPendentes($cpf_destinatario){
            require_once "../Model/Documento.php";
            $documento = new Documento();
            $r = $documento->documentosPendente($cpf_destinatario);
            return $r;
        }

        public function cadastrarDocumento($cpf_possuidor, $cpf_destinatario, $tipo, $titulo){
            require_once "../Model/Documento.php";
            $documento = new Documento();
            $r = $documento->escreverDocumento($cpf_possuidor, $cpf_destinatario, $tipo, $titulo);
            return $r;
        }

        public function envioDocumento($nProtocolo, $cpf_destinatario){
            require_once "../Model/Documento.php";
            $documento = new Documento();
            $r = $documento->enviarDocumento($nProtocolo, $cpf_destinatario);
            return $r;
        }
        
        public function excluirDocumento($nProtocolo){
            require_once "../Model/Documento.php";
            $documento = new Documento();
            $documento->setnProtocolo($nProtocolo);
            $r = $documento->excluirDocumento($nProtocolo);
            return $r;
        }

        public function alteraTituloDocumento($titulo, $nProtocolo){
            require_once "../Model/Documento.php";
            $d = new Documento();
            $r = $d->alterarDocumento($titulo, $nProtocolo);
            return $r;
        }
    }
?>
