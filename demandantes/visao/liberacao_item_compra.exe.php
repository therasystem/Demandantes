<?php
session_start();
require_once("../modelo/liberacao_item_compra.cls.php");
require_once("../config.cls.php");

$itemCompra = new clsLiberacaoItemCompra();
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

    $itemCompra->setCodigo($codigo);
    $itemCompra->setIdcompra($_SESSION['idcompra']);
    $itemCompra->setIdmaterial($MATER);
    $itemCompra->setIdunidade($UNID);
    $itemCompra->setDescricao($DESC);
    $itemCompra->setQuantidade($QUANT);
    $itemCompra->setIdusuario($_SESSION['codigo']);

    $itemCompra->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/liberacao_item_compra.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $idcompra = $_SESSION['idcompra'];
    $cod = $_GET['iditemcompra'];
    $itemCompra->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/liberacao_item_compra.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $itemCompra->setIdcompra($_SESSION['idcompra']);
    $itemCompra->setIdmaterial($MATER);
    $itemCompra->setIdunidade($UNID);
    $itemCompra->setDescricao($DESC);
    $itemCompra->setQuantidade($QUANT);
    $itemCompra->setIdusuario($_SESSION['codigo']);

    $itemCompra->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/liberacao_item_compra.frm.php", $msg);
}
 
?>