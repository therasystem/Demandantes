<?php

require_once("../modelo/dados_familia.cls.php");
require_once("../config.cls.php");

$familia = new clsDadosFamilia();
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

    $familia->setCodigo($codigo);
    $familia->setIDTIPORISCO($IDTIPORISCO);
    $familia->setDESCRISCO($DESCRISCO);
    $familia->setNOMEAREAOCUP($NOMEAREAOCUP);
    $familia->setDATADESABR($DATADESABR);
    $familia->setLOCALDESABR($LOCALDESABR);
    $familia->setMOTIVODESABR($MOTIVODESABR);
    $familia->setIDCOMUNIDADE($IDCOMUNIDADE);
    $familia->setNOMECOMUNID($NOMECOMUNID);
    $familia->setIDBENGOVFED($IDBENGOVFED);
    $familia->setNOMEOUTROBENEF($NOMEOUTROBENEF);
    $familia->setVALBENEF($VALBENEF);
    $familia->setDTINIBENEF($DTINIBENEF);
    $familia->setIDPROGGOVFED($IDPROGGOVFED);
    $familia->setNOMEOUTROPROG($NOMEOUTROPROG);
    $familia->setVALPROG($VALPROG);
    $familia->setDTINIPROG($DTINIPROG);
    $familia->setDTAJUDAFINANC($DTAJUDAFINANC);
    $familia->setVALAJUDAFINANC($VALAJUDAFINANC);
    $familia->setCPFRESPFAMIL($CPFRESPFAMIL);
    $familia->setIDDADOSOLICITANTE($IDDADOSOLICITANTE);

    $familia->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/dadosfamilia.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['IDDADOFAMILIA'];
    $familia->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/dadosfamilia.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $familia->setIDTIPORISCO($IDTIPORISCO);
    $familia->setDESCRISCO($DESCRISCO);
    $familia->setNOMEAREAOCUP($NOMEAREAOCUP);
    $familia->setDATADESABR($DATADESABR);
    $familia->setLOCALDESABR($LOCALDESABR);
    $familia->setMOTIVODESABR($MOTIVODESABR);
    $familia->setIDCOMUNIDADE($IDCOMUNIDADE);
    $familia->setNOMECOMUNID($NOMECOMUNID);
    $familia->setIDBENGOVFED($IDBENGOVFED);
    $familia->setNOMEOUTROBENEF($NOMEOUTROBENEF);
    $familia->setVALBENEF($VALBENEF);
    $familia->setDTINIBENEF($DTINIBENEF);
    $familia->setIDPROGGOVFED($IDPROGGOVFED);
    $familia->setNOMEOUTROPROG($NOMEOUTROPROG);
    $familia->setVALPROG($VALPROG);
    $familia->setDTINIPROG($DTINIPROG);
    $familia->setDTAJUDAFINANC($DTAJUDAFINANC);
    $familia->setVALAJUDAFINANC($VALAJUDAFINANC);
    $familia->setCPFRESPFAMIL($CPFRESPFAMIL);
    $familia->setIDDADOSOLICITANTE($IDDADOSOLICITANTE);

    $familia->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/dadosfamilia.frm.php", $msg);
}
 
?>