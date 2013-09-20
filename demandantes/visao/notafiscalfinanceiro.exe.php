<?php
session_start();
require_once("../modelo/notafiscalfinanceiro.cls.php");
require_once("../config.cls.php");

$centro = new clsNotaFiscalFinanceiro();
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

    $centro->setCodigo($codigo);
    $centro->setIdcentro($_SESSION['centroCusto']);
    $centro->setIdfornecedor($IDFORNECEDOR);
    $centro->setNumNotaFiscal($NUMNOTA);
    $centro->setValorNota($VALORNOTA);
    $centro->setPagamento($DTPAGAMENTO);
    $centro->setDtReferencia($DTREFERENCIA);
    $centro->setVencimento($DTVENCIMENTO);
    $centro->setTipoNota($_SESSION['tiponota']);

    $centro->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacaoTempoVolta("visao/notafiscalfinanceiro.frm.php", $msg, 1);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idnota'];
    $centro->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/notafiscalfinanceiro.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $centro->setIdcentro($_SESSION['centroCusto']);
    $centro->setIdfornecedor($IDFORNECEDOR);
    $centro->setNumNotaFiscal($NUMNOTA);
    $centro->setValorNota($VALORNOTA);
    $centro->setPagamento($DTPAGAMENTO);
    $centro->setDtReferencia($DTREFERENCIA);
    $centro->setVencimento($DTVENCIMENTO);
    $centro->setTipoNota($_SESSION['tiponota']);

    $centro->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacaoTempoVolta("visao/notafiscalfinanceiro_alteracao.frm.php", $msg, 1);
    
}
 
?>