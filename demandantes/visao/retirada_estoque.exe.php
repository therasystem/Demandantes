<?php

require_once("../modelo/retirada_estoque.cls.php");
require_once("../modelo/centro_custo.cls.php");
require_once("../config.cls.php");

$retirada = new clsRetiradaEstoque();
$centroCusto = new clsCentroCusto();
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
 
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idretirada'];
    $codigo = $_GET['idcentro'];
    $retirada->Excluir($cod);
    header("Location: centro_custo.frm.php?idcentro=".$codigo."&metodo=2");
    //$msg = "Registro excluido com sucesso!";
    //$config->ConfirmaOperacao("visao/centro_custo.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");
    
    $centroCusto->RetornaCentroCusto($codigo);

    $retirada->setIdobra($centroCusto->getIdobra());
    $retirada->setIdmaterial($IDMATERIAL);
    $retirada->setIdunidade($IDUNIDADE);
    $retirada->setQuantidade($QUANTIDADE);
    $retirada->setDataentrada($DATAENTRADA);
    $retirada->setIdcentro($codigo);
    $retirada->setIdrelaciona($centroCusto->getIdrelaciona());

    $retirada->Salvar();
    header("Location: centro_custo.frm.php?idcentro=".$codigo."&metodo=2");
    //$msg = "Registro inserido com sucesso!";
    //$config->ConfirmaOperacao("visao/centro_custo.frm.php", $msg);
}
 
?>