<?php

require_once("../modelo/quadro_comparativo.cls.php");
require_once("../config.cls.php");


$quadro = new clsQuadroComparativo();
$config = new clsConfig();

if ($_GET) {
    $metodo = $_GET['metodo'];
} else {
    $metodo = -2;
}
if ($metodo == 1) {

    $quadro->Alterar($_GET['idcompara'], $_GET['melhor']);
    header('location:quadro_comparativo.frm.php?idcompra=' . $_GET['idcompra']);
} else if ($metodo == 2) {

    $quadro->Excluir($_GET['idcompara']);
    $config->ConfirmaOperacao("visao/quadro_comparativo_alteracao.frm.php?idcompra=" . $_GET['idcompra'], "Excluido com sucesso!");
} else {

// SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $quadro->setIdcompra($IDCOMPRA);
    

    if ($MATERIAL == '0') {

        $config->ConfirmaOperacaoIr("visao/quadro_comparativo.frm.php?idcompra=" . $IDCOMPRA, "Material não selecionado!!");
    } else {
        $quadro->setIditem($MATERIAL);
        if ($EMPRESA == "" || $EMPRESA == null) {
            $quadro->setNome($EMPRESACOMBO);
        } else {
            $quadro->setNome($EMPRESA);
        }

        $quadro->setValor($VALOR);
        $quadro->Salvar();

        header('location:quadro_comparativo.frm.php?idcompra=' . $IDCOMPRA);
    }
}
?>