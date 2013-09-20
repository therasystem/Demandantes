<?php

require_once("../modelo/add_estoque.cls.php");
require_once("../config.cls.php");

$estoque = new clsAddEstoque();
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

    $estoque->setCodigo($codigo);
    $estoque->setIdobra($IDOBRA);
    $estoque->setIdmaterial($IDMATERIAL);
    $estoque->setIdunidade($IDUNIDADE);
    $estoque->setQuantidade($QUANTIDADE);
    $estoque->setDataentrada($DATAENTRADA);

    $estoque->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/add_estoque.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idestoque'];
    $estoque->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/add_estoque.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $estoque->setIdobra($IDOBRA);
    $estoque->setIdmaterial($IDMATERIAL);
    $estoque->setIdunidade($IDUNIDADE);
    $estoque->setQuantidade($QUANTIDADE);
    $estoque->setDataentrada($DATAENTRADA);

    $estoque->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/add_estoque.frm.php", $msg);
}
 
?>