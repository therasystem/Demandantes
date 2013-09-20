<?php

require_once("../modelo/dados_regiao_domicilio.cls.php");
require_once("../config.cls.php");

$domicilio = new clsDadosRegiaoDomicilio();
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

    $domicilio->setCodigo($codigo);
    $domicilio->setIDCONDICAOPAVIMENTO($IDCONDICAOPAVIMENTO);
    $domicilio->setIDCONDICAOTRANSPUBLIC($IDCONDICAOTRANSPUBLIC);
    $domicilio->setIDCONDICAOTRATAGUA($IDCONDICAOTRATAGUA);
    $domicilio->setIDCONDICAOTRATESGOTO($IDCONDICAOTRATESGOTO);
    $domicilio->setIDCONDICAOILUMINAPUBLIC($IDCONDICAOILUMINAPUBLIC);
    $domicilio->setIDCONDICAOSISVIARIO($IDCONDICAOSISVIARIO);
    $domicilio->setIDCONDICAOESCOLAPOSTO($IDCONDICAOESCOLAPOSTO);
    $domicilio->setIDCONDICAOAREARISCO($IDCONDICAOAREARISCO);
    $domicilio->setIDDADOSOLICITANTE($IDDADOSOLICITANTE);

    $domicilio->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/domiciliar.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['IDDADOSREGIAODOMICILIO'];
    $domicilio->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/domiciliar.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $domicilio->setIDCONDICAOPAVIMENTO($IDCONDICAOPAVIMENTO);
    $domicilio->setIDCONDICAOTRANSPUBLIC($IDCONDICAOTRANSPUBLIC);
    $domicilio->setIDCONDICAOTRATAGUA($IDCONDICAOTRATAGUA);
    $domicilio->setIDCONDICAOTRATESGOTO($IDCONDICAOTRATESGOTO);
    $domicilio->setIDCONDICAOILUMINAPUBLIC($IDCONDICAOILUMINAPUBLIC);
    $domicilio->setIDCONDICAOSISVIARIO($IDCONDICAOSISVIARIO);
    $domicilio->setIDCONDICAOESCOLAPOSTO($IDCONDICAOESCOLAPOSTO);
    $domicilio->setIDCONDICAOAREARISCO($IDCONDICAOAREARISCO);
    $domicilio->setIDDADOSOLICITANTE($IDDADOSOLICITANTE);

    $domicilio->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/domiciliar.frm.php", $msg);
}
?>