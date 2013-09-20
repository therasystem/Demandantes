<?php

require_once("../modelo/liberacao_compra.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../config.cls.php");

session_start();

$compra = new clsLiberacaoCompra();
$usuario = new clsUsuario();
$config = new clsConfig();
$msg = "";

if ($_GET) {
    $metodoG = $_GET['metodo'];
} else {
    $metodoG = null;
}
if ($_POST) {
    $metodoP = $_POST['metodo'];
} else {
    $metodoP = null;
}

if ($metodoG == 1 || $metodoP == 1) {
    // VERIFICA LIBERAÇÃO DE COMPRA
    $cod = $_GET['idcompra'];
    $resp = $_GET['idresp'];
    $autoriza = $_GET['autoriza'];

    if (!$usuario->verificaSocio($resp)) {
        $msg = "Você não tem autorização para liberar esta compra!";
        $config->ConfirmaOperacao("visao/liberacao_compra.frm.php", $msg);
    } else {
        $compra->AtualizaLiberacaoCompra($cod, $autoriza, $resp);
        if ($autoriza == 0) {
            $msg = "Compra liberada!";
        } else {
            $msg = "Compra bloqueada!";
        }
        $config->ConfirmaOperacao("visao/liberacao_compra.frm.php", $msg);
    }
} else if ($metodoG == 2 || $metodoP == 2) {
    
    $cod = $_GET['idcompra'];
    $autoriza = $_GET['autoriza'];
    
    if (!$usuario->verificaSeCargoDeSocio()) {
        $msg = "Você não tem autorização para mudar o status da compra!";
        $config->ConfirmaOperacao("visao/liberacao_compra.frm.php", $msg);
    } else {
        $compra->AtualizaStatusCompra($cod, $autoriza);
        if ($autoriza == 0) {
            $msg = "Compra executada!";
        } else {
            $msg = "Compra em processo!";
        }
        $config->ConfirmaOperacao("visao/liberacao_compra.frm.php", $msg);
    }
    
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $compra->setIdobra($OBRA);
    if ($OBRA != 0) {
        $compra->Salvar();
        $msg = "Registro inserido com sucesso!";
    } else {
        $msg = "Registro não inserido!";
    }
    $config->ConfirmaOperacao("visao/liberacao_compra.frm.php", $msg);
}
?>