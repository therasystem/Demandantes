<?php

require_once("../modelo/dados_imovel_pretendido.cls.php");
require_once("../config.cls.php");

$imovel = new clsDadosImovelPretendido();
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

    $imovel->setCodigo($codigo);
    $imovel->setQUANTMORADORES($QUANTMORADORES);
    $imovel->setIDESTADO($IDESTADO);
    $imovel->setIDMUNICIPIO($IDMUNICIPIO);
    $imovel->setBAIRRO1($BAIRRO1);
    $imovel->setBAIRRO2($BAIRRO2);
    $imovel->setBAIRRO3($BAIRRO3);
    $imovel->setIDDADOSOLICITANTE($IDDADOSOLICITANTE);
    $imovel->setDTCADASTRO($DTCADASTRO);

    $imovel->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/dadosimovel.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['IDDADOIMOVELPRETENDIDO'];
    $imovel->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/dadosimovel.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $imovel->setQUANTMORADORES($QUANTMORADORES);
    $imovel->setIDESTADO($IDESTADO);
    $imovel->setIDMUNICIPIO($IDMUNICIPIO);
    $imovel->setBAIRRO1($BAIRRO1);
    $imovel->setBAIRRO2($BAIRRO2);
    $imovel->setBAIRRO3($BAIRRO3);
    $imovel->setIDDADOSOLICITANTE($IDDADOSOLICITANTE);
    $imovel->setDTCADASTRO($DTCADASTRO);

    $imovel->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/dadosimovel.frm.php", $msg);
}
 
?>