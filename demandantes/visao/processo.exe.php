<?php

require_once("../modelo/processo.cls.php");
require_once("../config.cls.php");

$processo = new clsProcesso();
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
    $processo->setCodigo($codigo);
    $processo->setIdprocessorelat($PROCRELAT);
    $processo->setIdobra($IDOBRA);
    $processo->setNomeproc($NOMEPROC);
    $processo->setDescproc($DESCPROC);
    $processo->setDocproc($DOCPROC);
    $processo->setLocalproc($LOCPROC);
    $processo->setContatoproc($CONPROC);
    $processo->setValorproc($VALPROC);
    $processo->setTempoproc($TEMPPROC);
    $processo->setOrdemproc($ORDEMPROC);

    $processo->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/processo.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idproc'];
    $processo->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/processo.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $processo->setIdprocessorelat($PROCRELAT);
    $processo->setIdobra($IDOBRA);
    $processo->setNomeproc($NOMEPROC);
    $processo->setDescproc($DESCPROC);
    $processo->setDocproc($DOCPROC);
    $processo->setLocalproc($LOCPROC);
    $processo->setContatoproc($CONPROC);
    $processo->setValorproc($VALPROC);
    $processo->setTempoproc($TEMPPROC);
    $processo->setOrdemproc($ORDEMPROC);

    $processo->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/processo.frm.php", $msg);
}
 
?>