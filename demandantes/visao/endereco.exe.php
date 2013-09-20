<?php

require_once("../modelo/dados_domicilio.cls.php");
require_once("../config.cls.php");

$endereco = new clsDadosDomicilio();
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

    $endereco->setCodigo($codigo);
    $endereco->setIDTIPOLOGRADOURO($IDTIPOLOGRADOURO);
    $endereco->setNOMELOGRADOURO($NOMELOGRADOURO);
    $endereco->setNUMDOMICILIO($NUMDOMICILIO);
    $endereco->setCOMPLEMENTO($COMPLEMENTO);
    $endereco->setBAIRRO($BAIRRO);
    $endereco->setCEP($CEP);
    $endereco->setIDESTADO($IDESTADO);
    $endereco->setIDMUNICIPIO($IDMUNICIPIO);
    $endereco->setREFERENCIA($REFERENCIA);
    $endereco->setIDCONSTRUCAO($IDCONSTRUCAO);
    $endereco->setIDESTCONSERVACAO($IDESTCONSERVACAO);
    $endereco->setIDUTILIZACAO($IDUTILIZACAO);
    $endereco->setIDTIPOUSO($IDTIPOUSO);
    $endereco->setIDESPECIEDOMICILIO($IDESPECIEDOMICILIO);
    $endereco->setDATAINICIOMORARMUNICIP($DATAINICIOMORARMUNICIP);
    $endereco->setDATAINICIOMORARDOMICILIO($DATAINICIOMORARDOMICILIO);
    $endereco->setQUANTCOMODOS($QUANTCOMODOS);
    $endereco->setQUANTDORMIT($QUANTDORMIT);
    $endereco->setIDTIPOMATERIALPISOINT($IDTIPOMATERIALPISOINT);
    $endereco->setIDTIPOMATERIALPAREDEEXT($IDTIPOMATERIALPAREDEEXT);
    $endereco->setQTAGUACANALIZADA($QTAGUACANALIZADA);
    $endereco->setIDFORMAABASTECIMENTO($IDFORMAABASTECIMENTO);
    $endereco->setIDFORMAESCOASANITARIO($IDFORMAESCOASANITARIO);
    $endereco->setIDDESTINOLIXO($IDDESTINOLIXO);
    $endereco->setIDILUMINACAOCASA($IDILUMINACAOCASA);
    $endereco->setVALAGUAESGOTO($VALAGUAESGOTO);
    $endereco->setVALENERGIA($VALENERGIA);
    $endereco->setVALALUGUEL($VALALUGUEL);
    $endereco->setNUMFAMILIAS($NUMFAMILIAS);
    $endereco->setIDDADOSOLICITANTE($IDDADOSOLICITANTE);

    $endereco->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/endereco.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['IDDADODOMICILIO'];
    $endereco->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/endereco.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $endereco->setIDTIPOLOGRADOURO($IDTIPOLOGRADOURO);
    $endereco->setNOMELOGRADOURO($NOMELOGRADOURO);
    $endereco->setNUMDOMICILIO($NUMDOMICILIO);
    $endereco->setCOMPLEMENTO($COMPLEMENTO);
    $endereco->setBAIRRO($BAIRRO);
    $endereco->setCEP($CEP);
    $endereco->setIDESTADO($IDESTADO);
    $endereco->setIDMUNICIPIO($IDMUNICIPIO);
    $endereco->setREFERENCIA($REFERENCIA);
    $endereco->setIDCONSTRUCAO($IDCONSTRUCAO);
    $endereco->setIDESTCONSERVACAO($IDESTCONSERVACAO);
    $endereco->setIDUTILIZACAO($IDUTILIZACAO);
    $endereco->setIDTIPOUSO($IDTIPOUSO);
    $endereco->setIDESPECIEDOMICILIO($IDESPECIEDOMICILIO);
    $endereco->setDATAINICIOMORARMUNICIP($DATAINICIOMORARMUNICIP);
    $endereco->setDATAINICIOMORARDOMICILIO($DATAINICIOMORARDOMICILIO);
    $endereco->setQUANTCOMODOS($QUANTCOMODOS);
    $endereco->setQUANTDORMIT($QUANTDORMIT);
    $endereco->setIDTIPOMATERIALPISOINT($IDTIPOMATERIALPISOINT);
    $endereco->setIDTIPOMATERIALPAREDEEXT($IDTIPOMATERIALPAREDEEXT);
    $endereco->setQTAGUACANALIZADA($QTAGUACANALIZADA);
    $endereco->setIDFORMAABASTECIMENTO($IDFORMAABASTECIMENTO);
    $endereco->setIDFORMAESCOASANITARIO($IDFORMAESCOASANITARIO);
    $endereco->setIDDESTINOLIXO($IDDESTINOLIXO);
    $endereco->setIDILUMINACAOCASA($IDILUMINACAOCASA);
    $endereco->setVALAGUAESGOTO($VALAGUAESGOTO);
    $endereco->setVALENERGIA($VALENERGIA);
    $endereco->setVALALUGUEL($VALALUGUEL);
    $endereco->setNUMFAMILIAS($NUMFAMILIAS);
    $endereco->setIDDADOSOLICITANTE($IDDADOSOLICITANTE);

    $endereco->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/endereco.frm.php", $msg);
}
 
?>