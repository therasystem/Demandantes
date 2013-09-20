<?php

require_once("../modelo/dados_demandante.cls.php");
require_once("../config.cls.php");

$dadosDemandante = new clsDadosDemandante();
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

    $dadosDemandante->setCodigo($codigo);
    $dadosDemandante->setCPF($CPF);
    $dadosDemandante->setNOME($NOME);
    $dadosDemandante->setNOMEMAE($NOMEMAE);
    $dadosDemandante->setRG($RG);
    $dadosDemandante->setDTEMISSAO($DTEMISSAO);
    $dadosDemandante->setIDESTADOIDENT($IDESTADOIDENT);
    $dadosDemandante->setIDORGAOEMISSORIDENT($IDORGAOEMISSORIDENT);
    $dadosDemandante->setNUMTITULOELEITOR($NUMTITULOELEITOR);
    $dadosDemandante->setNUMZONAELEITOR($NUMZONAELEITOR);
    $dadosDemandante->setNUMSECAOELEITOR($NUMSECAOELEITOR);
    $dadosDemandante->setIDPAISNASC($IDPAISNASC);
    $dadosDemandante->setIDNACIONALIDADENASC($IDNACIONALIDADENASC);
    $dadosDemandante->setIDESTADONASC($IDESTADONASC);
    $dadosDemandante->setIDMUNICIPIONASC($IDMUNICIPIONASC);
    $dadosDemandante->setDTNASC($DTNASC);
    $dadosDemandante->setNUMNIS($NUMNIS);
    $dadosDemandante->setTELRESID($TELRESID);
    $dadosDemandante->setTELCOMERC($TELCOMERC);
    $dadosDemandante->setTELMOVEL($TELMOVEL);
    $dadosDemandante->setEMAIL1($EMAIL1);
    $dadosDemandante->setEMAIL2($EMAIL2);
    $dadosDemandante->setIDSEXO($IDSEXO);
    $dadosDemandante->setIDESTADOCIVIL($IDESTADOCIVIL);
    $dadosDemandante->setCPFCONJUGE($CPFCONJUGE);
    $dadosDemandante->setIDGRAUINSTRUCAO($IDGRAUINSTRUCAO);
    $dadosDemandante->setIDSITMERCADOTRABALHO($IDSITMERCADOTRABALHO);
    $dadosDemandante->setIDOCUPACAO($IDOCUPACAO);
    $dadosDemandante->setDTADMISTRAB($DTADMISTRAB);
    $dadosDemandante->setIDDEFICIENCIATIPO($IDDEFICIENCIATIPO);
    $dadosDemandante->setIDRESTLOCOMOCAO($IDRESTLOCOMOCAO);
    $dadosDemandante->setIDBENGOV($IDBENGOV);
    $dadosDemandante->setVALORBENEF($VALORBENEF);
    $dadosDemandante->setDTINIBENEF($DTINIBENEF);
    $dadosDemandante->setIDPROGGOV($IDPROGGOV);
    $dadosDemandante->setVALORPROG($VALORPROG);
    $dadosDemandante->setDTINIPROG($DTINIPROG);
    $dadosDemandante->setIDENTIDADE($IDENTIDADE);

    $dadosDemandante->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/solicitante.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idcargo'];
    $dadosDemandante->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/solicitante.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $dadosDemandante->setCPF($CPF);
    $dadosDemandante->setNOME($NOME);
    $dadosDemandante->setNOMEMAE($NOMEMAE);
    $dadosDemandante->setRG($RG);   
    $dadosDemandante->setDTEMISSAO($DTEMISSAO);
    $dadosDemandante->setIDESTADOIDENT($IDESTADOIDENT);
    $dadosDemandante->setIDORGAOEMISSORIDENT($IDORGAOEMISSORIDENT);
    $dadosDemandante->setNUMTITULOELEITOR($NUMTITULOELEITOR);
    $dadosDemandante->setNUMZONAELEITOR($NUMZONAELEITOR);
    $dadosDemandante->setNUMSECAOELEITOR($NUMSECAOELEITOR);
    $dadosDemandante->setIDPAISNASC($IDPAISNASC);
    $dadosDemandante->setIDNACIONALIDADENASC($IDNACIONALIDADENASC);
    $dadosDemandante->setIDESTADONASC($IDESTADONASC);
    $dadosDemandante->setIDMUNICIPIONASC($IDMUNICIPIONASC);
    $dadosDemandante->setDTNASC($DTNASC);
    $dadosDemandante->setNUMNIS($NUMNIS);
    $dadosDemandante->setTELRESID($TELRESID);
    $dadosDemandante->setTELCOMERC($TELCOMERC);
    $dadosDemandante->setTELMOVEL($TELMOVEL);
    $dadosDemandante->setEMAIL1($EMAIL1);
    $dadosDemandante->setEMAIL2($EMAIL2);
    $dadosDemandante->setIDSEXO($IDSEXO);
    $dadosDemandante->setIDESTADOCIVIL($IDESTADOCIVIL);
    $dadosDemandante->setCPFCONJUGE($CPFCONJUGE);
    $dadosDemandante->setIDGRAUINSTRUCAO($IDGRAUINSTRUCAO);
    $dadosDemandante->setIDSITMERCADOTRABALHO($IDSITMERCADOTRABALHO);
    $dadosDemandante->setIDOCUPACAO($IDOCUPACAO);
    $dadosDemandante->setDTADMISTRAB($DTADMISTRAB);
    $dadosDemandante->setIDDEFICIENCIATIPO($IDDEFICIENCIATIPO);
    $dadosDemandante->setIDRESTLOCOMOCAO($IDRESTLOCOMOCAO);
    $dadosDemandante->setIDBENGOV($IDBENGOV);
    $dadosDemandante->setVALORBENEF($VALORBENEF);
    $dadosDemandante->setDTINIBENEF($DTINIBENEF);
    $dadosDemandante->setIDPROGGOV($IDPROGGOV);
    $dadosDemandante->setVALORPROG($VALORPROG);
    $dadosDemandante->setDTINIPROG($DTINIPROG);
    $dadosDemandante->setIDENTIDADE($IDENTIDADE);

    $dadosDemandante->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/solicitante.frm.php", $msg);
}
 
?>