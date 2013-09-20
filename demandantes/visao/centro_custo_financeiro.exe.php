<?php

require_once("../modelo/centro_custo_financeiro.cls.php");
require_once("../config.cls.php");

$centro = new clsCentroCustoFinanceiro();
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

if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idcentrocusto'];
    $centro->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/centro_custo_financeiro.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $centro->setIdEmpresa($EMPRESA);
    $centro->setNome($CENTRO);

    $centro->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/centro_custo_financeiro.frm.php", $msg);
}
 
?>