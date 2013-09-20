<?php

require_once("../modelo/notafiscal.cls.php");
require_once("../modelo/notafiscalfinanceiro.cls.php");
require_once("../config.cls.php");


$config = new clsConfig();
$msg = "";


$metodo = $_GET['metodo'];
$tabela = $_GET['tabela'];
$idnota = $_GET['idnota'];
$idcentro = $_GET['idcentro'];

if ($tabela == 1) { //notafiscalfinanceiro
    $notaFinanc = new clsNotaFiscalFinanceiro();
    $notaFinanc->setCodigo($idnota);
    if ($metodo == 1) { ////EDITAR
        $notaFinanc->AlterarTipoNota();
        $msg = "Registro alterado com sucesso!";
    } else { // RESET
        $notaFinanc->ResetaTipoNota();
        $msg = "Registro resetado com sucesso!";
    }
} else { // notafiscal
    $nota = new clsNotaFiscal();
    $nota->setCodigo($idnota);
    if ($metodo == 1) { //EDITAR
        $nota->AlterarTipoNota();
        $msg = "Registro alterado com sucesso!";
    } else { // RESET
        $nota->ResetaTipoNota();
        $msg = "Registro resetado com sucesso!";
    }
}


$config->ConfirmaOperacao("visao/obranota_altera.frm.php?idcentro=".$idcentro, $msg);
?>