<?php
    if(!isset($_SESSION))
    {
    session_start();
    }

    class DocumentoController{
        public function aceitacaoDoDocumento($protocolo, $destinatario) {
            require_once '../Model/Documento.php';
            $documento = new Documento();
            $documento->setnProtocolo($protocolo);
            $documento->setCpf_possuidor($destinatario);
            $r = $documento->receberDocumento();
            $_SESSION['documento'] = serialize($documento);
            return $r;
        }

        public function telaInicialdocumento(){
            require_once '../Model/Documento.php';
            $documento = new Documento();
            $r = $documento->carregarDocumentosNaTelaInicialGestor();
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
    }
?>
