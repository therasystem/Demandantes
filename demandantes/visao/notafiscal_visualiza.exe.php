<?php

session_start();
require_once("../modelo/material_nota.cls.php");
require_once("../modelo/notafiscal.cls.php");
require_once("../config.cls.php");

$nota = new clsNotaFiscal();
$materialNota = new clsMaterialNota();
$config = new clsConfig();
$msg = "";

extract($_POST, EXTR_PREFIX_SAME, "wddx");

//die(print_r($_GET));
//die($idnota);

if (isset($_GET)) {
    $metodo = $_GET['metodo'];
}


//die(print_r($metodo));

if ($metodo == 0) {
    // SALVAR 

    if ($valorNota2 != NULL) {
        $valorNota2 .= ';';
    }
    if ($valorNota3 != "") {
        $valorNota3 .= ';';
    }
    if ($valorNota4 != "") {
        $valorNota4 .= ';';
    }
    if ($valorNota5 != "") {
        $valorNota5 .= ';';
    }
    if ($vencimentoNota2 != "") {
        $vencimentoNota2 .= ';';
    }
    if ($vencimentoNota3 != "") {
        $vencimentoNota3 .= ';';
    }
    if ($vencimentoNota4 != "") {
        $vencimentoNota4 .= ';';
    }
    if ($vencimentoNota5 != "") {
        $vencimentoNota5 .= ';';
    }

//die($nomeEmp);
    $nota->setIdfornecedor($idfornecedor);
    $nota->setIdcompra($idcompra);
    $nota->setNomeCompara($nomeEmp);
    $nota->setNumNotaFiscal($numNota);
    $nota->setValorNota($valorNota1 . ";" . $valorNota2 . $valorNota3 . $valorNota4 . $valorNota5);
    $nota->setDtEmissao($dataNota);
    $nota->setVencimento($vencimentoNota1 . ";" . $vencimentoNota2 . $vencimentoNota3 . $vencimentoNota4 . $vencimentoNota5);
    $nota->setFrete($freteNota);
    $nota->setReferencia($referencia);
    
    $numValorEVencim = $nota->Salvar();

    $materialNota->setIdnota($nota->getLastID());
//die(print_r($_POST));
    for ($i = 0; $i < count($recebido); $i++) {

        $materialNota->setIditem($iditem[$recebido[$i]]);
        $materialNota->setQuantMatNota($quantidade[$recebido[$i]]);

        $materialNota->Salvar($numValorEVencim);
    }
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/compra_visualiza_alteracao.frm.php?idcompra=" . $idcompra, $msg);
} else {
    // DELETAR 
    $cod = $_GET['idnota'];
    $materialNota->Excluir($cod);
    $nota->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/compra_visualiza_alteracao.frm.php?idcompra=" . $_GET['idcompra'], $msg);
}
?>