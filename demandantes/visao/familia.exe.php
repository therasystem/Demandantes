<?php

require_once("../modelo/dados_ente_familiar.cls.php");
require_once("../config.cls.php");

$enteFamilia = new clsDadosEnteFamiliar();
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

    $enteFamilia->setCodigo($codigo);
    $enteFamilia->setIDGRAUPARENTESCO($IDGRAUPARENTESCO); 
    $enteFamilia->setCPF($CPF); 
    $enteFamilia->setNOME($NOME); 
    $enteFamilia->setNOMEMAE($NOMEMAE); 
    $enteFamilia->setRG($RG); 
    $enteFamilia->setDTEMISSAO($DTEMISSAO); 
    $enteFamilia->setIDESTADOIDENT($IDESTADOIDENT); 
    $enteFamilia->setIDORGAOEMISSORIDENT($IDORGAOEMISSORIDENT); 
    $enteFamilia->setNUMTITULOELEITOR($NUMTITULOELEITOR); 
    $enteFamilia->setNUMZONAELEITOR($NUMZONAELEITOR); 
    $enteFamilia->setNUMSECAOELEITOR($NUMSECAOELEITOR); 
    $enteFamilia->setIDPAISNASC($IDPAISNASC); 
    $enteFamilia->setNACIONALIDADENASC($NACIONALIDADENASC); 
    $enteFamilia->setIDESTADONASC($IDESTADONASC); 
    $enteFamilia->setIDMUNICIPIONASC($IDMUNICIPIONASC); 
    $enteFamilia->setDTNASC($DTNASC); 
    $enteFamilia->setNUMNIS($NUMNIS); 
    $enteFamilia->setIDSEXO($IDSEXO); 
    $enteFamilia->setIDESTADOCIVIL($IDESTADOCIVIL); 
    $enteFamilia->setCPFCONJUGE($CPFCONJUGE); 
    $enteFamilia->setIDGRAUINSTRUCAO($IDGRAUINSTRUCAO); 
    $enteFamilia->setVALTRABFORMAL($VALTRABFORMAL); 
    $enteFamilia->setVALTRABINFORMAL($VALTRABINFORMAL); 
    $enteFamilia->setIDDEFICIENCIATIPO($IDDEFICIENCIATIPO); 
    $enteFamilia->setIDRESTLOCOMOCAO($IDRESTLOCOMOCAO); 
    $enteFamilia->setIDDADOSOLICITANTE($IDDADOSOLICITANTE); 

    $enteFamilia->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/familia.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['IDDADOENTEFAMILIA'];
    $enteFamilia->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/familia.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $enteFamilia->setIDGRAUPARENTESCO($IDGRAUPARENTESCO); 
    $enteFamilia->setCPF($CPF); 
    $enteFamilia->setNOME($NOME); 
    $enteFamilia->setNOMEMAE($NOMEMAE); 
    $enteFamilia->setRG($RG); 
    $enteFamilia->setDTEMISSAO($DTEMISSAO); 
    $enteFamilia->setIDESTADOIDENT($IDESTADOIDENT); 
    $enteFamilia->setIDORGAOEMISSORIDENT($IDORGAOEMISSORIDENT); 
    $enteFamilia->setNUMTITULOELEITOR($NUMTITULOELEITOR); 
    $enteFamilia->setNUMZONAELEITOR($NUMZONAELEITOR); 
    $enteFamilia->setNUMSECAOELEITOR($NUMSECAOELEITOR); 
    $enteFamilia->setIDPAISNASC($IDPAISNASC); 
    $enteFamilia->setNACIONALIDADENASC($NACIONALIDADENASC); 
    $enteFamilia->setIDESTADONASC($IDESTADONASC); 
    $enteFamilia->setIDMUNICIPIONASC($IDMUNICIPIONASC); 
    $enteFamilia->setDTNASC($DTNASC); 
    $enteFamilia->setNUMNIS($NUMNIS); 
    $enteFamilia->setIDSEXO($IDSEXO); 
    $enteFamilia->setIDESTADOCIVIL($IDESTADOCIVIL); 
    $enteFamilia->setCPFCONJUGE($CPFCONJUGE); 
    $enteFamilia->setIDGRAUINSTRUCAO($IDGRAUINSTRUCAO); 
    $enteFamilia->setVALTRABFORMAL($VALTRABFORMAL); 
    $enteFamilia->setVALTRABINFORMAL($VALTRABINFORMAL); 
    $enteFamilia->setIDDEFICIENCIATIPO($IDDEFICIENCIATIPO); 
    $enteFamilia->setIDRESTLOCOMOCAO($IDRESTLOCOMOCAO); 
    $enteFamilia->setIDDADOSOLICITANTE($IDDADOSOLICITANTE); 

    $enteFamilia->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/familia.frm.php", $msg);
}
?>