<?php

require_once("../modelo/obra.cls.php");
require_once("../config.cls.php");

$obra = new clsObra();
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

    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $obra->setCodigo($codigo);
    $obra->setCEI($CEI);
    $obra->setEndereco($END);
    $obra->setDescricao($DESC);
    $obra->setData($DATA);
    $obra->setId_usuario($RESP);
    $obra->setId_usuario2($RESP2);
    $obra->setNumero($NUM);
    $obra->setOrdemcompra($ORDEMCOMPRA);

    $obra->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/obra.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idobra'];
    $obra->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/obra.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $obra->setCEI($CEI);
    $obra->setEndereco($END);
    $obra->setDescricao($DESC);
    $obra->setData($DATA);
    $obra->setId_usuario($RESP);
    $obra->setId_usuario2($RESP2);
    $obra->setNumero($NUM);
    $obra->setOrdemcompra($ORDEMCOMPRA);

    $obra->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/obra.frm.php", $msg);
}
 
?>