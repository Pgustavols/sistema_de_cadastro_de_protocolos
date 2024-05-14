<?php
    if(!isset($_SESSION)){
        session_start();
    }

    switch ($_POST){
        //Caso a variavel seja nula mostrar a tela de login
        case isset($_PSOT[null]);
        include_once "../TCC/View/login.php";
        break;
    }

?>