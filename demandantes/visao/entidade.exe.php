<?php

require_once("../modelo/entidade.cls.php");
require_once("../config.cls.php");

$entidade = new clsEntidade();
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

    $entidade->setCodigo($codigo);
    $entidade->setNOMEENT($NOMEENT);
    $entidade->setREGENT($REGENT);
    $entidade->setIDMUNICIPIO($IDMUNICIPIO);
    $entidade->setENDENT($ENDENT);
    $entidade->setOBSENT($OBSENT);
    $entidade->setDATAENTRADAENT($DATAENTRADAENT);

    $entidade->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/cadastro_entidade.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['IDENTIDADE'];
    $entidade->setCodigo($cod);
    $entidade->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/cadastro_entidade.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    
    $entidade->setCodigo($codigo);
    $entidade->setNOMEENT($NOMEENT);
    $entidade->setREGENT($REGENT);
    $entidade->setIDMUNICIPIO($IDMUNICIPIO);
    $entidade->setENDENT($ENDENT);
    $entidade->setOBSENT($OBSENT);
    $entidade->setDATAENTRADAENT($DATAENTRADAENT);

    $entidade->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/cadastro_entidade.frm.php", $msg);
}
 
?>