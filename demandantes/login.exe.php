<?php

require_once("validarlogin.cls.php");
require_once("config.cls.php");

$login = new clsValidarLogin();
$config = new clsConfig();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $usu = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
    $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';



    if ($login->validarLogin($usu, $senha) == true) {

        header("Location: visao/menuadministrador.frm.php");
    } else {
        $config->Logout(true);
    }
}
?>