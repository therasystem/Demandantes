<?php

require_once("../controle/conexao.gti.php");

class clsDadosEnteFamiliar {

    // CAMPOS PRIVADOS-----------------------------------------
    private $CODIGO;
    private $IDGRAUPARENTESCO;
    private $CPF;
    private $NOME;
    private $NOMEMAE;
    private $RG;
    private $DTEMISSAO;
    private $IDESTADOIDENT;
    private $IDORGAOEMISSORIDENT;
    private $NUMTITULOELEITOR;
    private $NUMZONAELEITOR;
    private $NUMSECAOELEITOR;
    private $IDPAISNASC;
    private $NACIONALIDADENASC;
    private $IDESTADONASC;
    private $IDMUNICIPIONASC;
    private $DTNASC;
    private $NUMNIS;
    private $IDSEXO;
    private $IDESTADOCIVIL;
    private $CPFCONJUGE;
    private $IDGRAUINSTRUCAO;
    private $VALTRABFORMAL;
    private $VALTRABINFORMAL;
    private $IDDEFICIENCIATIPO;
    private $IDRESTLOCOMOCAO;
    private $IDDADOSOLICITANTE;

    public function getCODIGO() {
        return $this->CODIGO;
    }

    public function setCODIGO($CODIGO) {
        $this->CODIGO = $CODIGO;
    }

    public function getIDGRAUPARENTESCO() {
        return $this->IDGRAUPARENTESCO;
    }

    public function setIDGRAUPARENTESCO($IDGRAUPARENTESCO) {
        $this->IDGRAUPARENTESCO = $IDGRAUPARENTESCO;
    }

    public function getCPF() {
        return $this->CPF;
    }

    public function setCPF($CPF) {
        $this->CPF = $CPF;
    }

    public function getNOME() {
        return $this->NOME;
    }

    public function setNOME($NOME) {
        $this->NOME = $NOME;
    }

    public function getNOMEMAE() {
        return $this->NOMEMAE;
    }

    public function setNOMEMAE($NOMEMAE) {
        $this->NOMEMAE = $NOMEMAE;
    }

    public function getRG() {
        return $this->RG;
    }

    public function setRG($RG) {
        $this->RG = $RG;
    }

    public function getDTEMISSAO() {
        return $this->DTEMISSAO;
    }

    public function setDTEMISSAO($DTEMISSAO) {
        $this->DTEMISSAO = $DTEMISSAO;
    }

    public function getIDESTADOIDENT() {
        return $this->IDESTADOIDENT;
    }

    public function setIDESTADOIDENT($IDESTADOIDENT) {
        $this->IDESTADOIDENT = $IDESTADOIDENT;
    }

    public function getIDORGAOEMISSORIDENT() {
        return $this->IDORGAOEMISSORIDENT;
    }

    public function setIDORGAOEMISSORIDENT($IDORGAOEMISSORIDENT) {
        $this->IDORGAOEMISSORIDENT = $IDORGAOEMISSORIDENT;
    }

    public function getNUMTITULOELEITOR() {
        return $this->NUMTITULOELEITOR;
    }

    public function setNUMTITULOELEITOR($NUMTITULOELEITOR) {
        $this->NUMTITULOELEITOR = $NUMTITULOELEITOR;
    }

    public function getNUMZONAELEITOR() {
        return $this->NUMZONAELEITOR;
    }

    public function setNUMZONAELEITOR($NUMZONAELEITOR) {
        $this->NUMZONAELEITOR = $NUMZONAELEITOR;
    }

    public function getNUMSECAOELEITOR() {
        return $this->NUMSECAOELEITOR;
    }

    public function setNUMSECAOELEITOR($NUMSECAOELEITOR) {
        $this->NUMSECAOELEITOR = $NUMSECAOELEITOR;
    }

    public function getIDPAISNASC() {
        return $this->IDPAISNASC;
    }

    public function setIDPAISNASC($IDPAISNASC) {
        $this->IDPAISNASC = $IDPAISNASC;
    }

    public function getNACIONALIDADENASC() {
        return $this->NACIONALIDADENASC;
    }

    public function setNACIONALIDADENASC($NACIONALIDADENASC) {
        $this->NACIONALIDADENASC = $NACIONALIDADENASC;
    }

    public function getIDESTADONASC() {
        return $this->IDESTADONASC;
    }

    public function setIDESTADONASC($IDESTADONASC) {
        $this->IDESTADONASC = $IDESTADONASC;
    }

    public function getIDMUNICIPIONASC() {
        return $this->IDMUNICIPIONASC;
    }

    public function setIDMUNICIPIONASC($IDMUNICIPIONASC) {
        $this->IDMUNICIPIONASC = $IDMUNICIPIONASC;
    }

    public function getDTNASC() {
        return $this->DTNASC;
    }

    public function setDTNASC($DTNASC) {
        $this->DTNASC = $DTNASC;
    }

    public function getNUMNIS() {
        return $this->NUMNIS;
    }

    public function setNUMNIS($NUMNIS) {
        $this->NUMNIS = $NUMNIS;
    }

    public function getIDSEXO() {
        return $this->IDSEXO;
    }

    public function setIDSEXO($IDSEXO) {
        $this->IDSEXO = $IDSEXO;
    }

    public function getIDESTADOCIVIL() {
        return $this->IDESTADOCIVIL;
    }

    public function setIDESTADOCIVIL($IDESTADOCIVIL) {
        $this->IDESTADOCIVIL = $IDESTADOCIVIL;
    }

    public function getCPFCONJUGE() {
        return $this->CPFCONJUGE;
    }

    public function setCPFCONJUGE($CPFCONJUGE) {
        $this->CPFCONJUGE = $CPFCONJUGE;
    }

    public function getIDGRAUINSTRUCAO() {
        return $this->IDGRAUINSTRUCAO;
    }

    public function setIDGRAUINSTRUCAO($IDGRAUINSTRUCAO) {
        $this->IDGRAUINSTRUCAO = $IDGRAUINSTRUCAO;
    }


    public function getVALTRABFORMAL() {
        return $this->VALTRABFORMAL;
    }

    public function setVALTRABFORMAL($VALTRABFORMAL) {
        $this->VALTRABFORMAL = $VALTRABFORMAL;
    }

    public function getVALTRABINFORMAL() {
        return $this->VALTRABINFORMAL;
    }

    public function setVALTRABINFORMAL($VALTRABINFORMAL) {
        $this->VALTRABINFORMAL = $VALTRABINFORMAL;
    }


    public function getIDDEFICIENCIATIPO() {
        return $this->IDDEFICIENCIATIPO;
    }

    public function setIDDEFICIENCIATIPO($IDDEFICIENCIATIPO) {
        $this->IDDEFICIENCIATIPO = $IDDEFICIENCIATIPO;
    }


    public function getIDRESTLOCOMOCAO() {
        return $this->IDRESTLOCOMOCAO;
    }

    public function setIDRESTLOCOMOCAO($IDRESTLOCOMOCAO) {
        $this->IDRESTLOCOMOCAO = $IDRESTLOCOMOCAO;
    }


    public function getIDDADOSOLICITANTE() {
        return $this->IDDADOSOLICITANTE;
    }

    public function setIDDADOSOLICITANTE($IDDADOSOLICITANTE) {
        $this->IDDADOSOLICITANTE = $IDDADOSOLICITANTE;
    }

    function __construct() {
        $this->CODIGO = "";
        $this->IDGRAUPARENTESCO = "";
        $this->CPF = "";
        $this->NOME = "";
        $this->NOMEMAE = "";
        $this->RG = "";
        $this->DTEMISSAO = "";
        $this->IDESTADOIDENT = "";
        $this->IDORGAOEMISSORIDENT = "";
        $this->NUMTITULOELEITOR = "";
        $this->NUMZONAELEITOR = "";
        $this->NUMSECAOELEITOR = "";
        $this->IDPAISNASC = "";
        $this->IDNACIONALIDADENASC = "";
        $this->IDESTADONASC = "";
        $this->IDMUNICIPIONASC = "";
        $this->DTNASC = "";
        $this->NUMNIS = "";
        $this->IDSEXO = "";
        $this->IDESTADOCIVIL = "";
        $this->CPFCONJUGE = "";
        $this->IDGRAUINSTRUCAO = "";
        $this->VALTRABFORMAL = "";
        $this->VALTRABINFORMAL = "";
        $this->IDDEFICIENCIATIPO = "";
        $this->IDRESTLOCOMOCAO = "";
        $this->IDDADOSOLICITANTE = "";
    }

    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM def_dados_ente_familia WHERE IDDADOENTEFAMILIA=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {

        $SQL = "UPDATE def_dados_ente_familia SET 
                IDGRAUPARENTESCO='" . $this->IDGRAUPARENTESCO . "',
                CPF='" . $this->CPF . "',
                NOME='" . $this->NOME . "',
                NOMEMAE='" . $this->NOMEMAE . "',
                RG='" . $this->RG . "',
                DTEMISSAO='" . $this->DTEMISSAO . "',
                IDESTADOIDENT='" . $this->IDESTADOIDENT . "',
                IDORGAOEMISSORIDENT='" . $this->IDORGAOEMISSORIDENT . "',
                NUMTITULOELEITOR='" . $this->NUMTITULOELEITOR . "',
                NUMZONAELEITOR='" . $this->NUMZONAELEITOR . "',
                NUMSECAOELEITOR='" . $this->NUMSECAOELEITOR . "',
                IDPAISNASC='" . $this->IDPAISNASC . "',
                IDNACIONALIDADENASC='" . $this->IDNACIONALIDADENASC . "',
                IDESTADONASC='" . $this->IDESTADONASC . "',
                IDMUNICIPIONASC='" . $this->IDMUNICIPIONASC . "',
                DTNASC='" . $this->DTNASC . "',
                NUMNIS='" . $this->NUMNIS . "',
                IDSEXO='" . $this->IDSEXO . "',
                IDESTADOCIVIL='" . $this->IDESTADOCIVIL . "',
                CPFCONJUGE='" . $this->CPFCONJUGE . "',
                IDGRAUINSTRUCAO='" . $this->IDGRAUINSTRUCAO . "',
                VALTRABFORMAL='" . $this->VALTRABFORMAL . "',
                VALTRABINFORMAL='" . $this->VALTRABINFORMAL . "',
                IDDEFICIENCIATIPO='" . $this->IDDEFICIENCIATIPO . "',
                IDRESTLOCOMOCAO='" . $this->IDRESTLOCOMOCAO . "',
                IDDADOSOLICITANTE='" . $this->IDDADOSOLICITANTE . "'
                WHERE IDDADOENTEFAMILIA='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO def_dados_ente_familia (
                IDGRAUPARENTESCO, CPF, NOME, NOMEMAE, RG, DTEMISSAO, IDESTADOIDENT, IDORGAOEMISSORIDENT, NUMTITULOELEITOR,
                NUMZONAELEITOR, NUMSECAOELEITOR, IDPAISNASC, IDNACIONALIDADENASC, IDESTADONASC, IDMUNICIPIONASC,
                DTNASC, NUMNIS, IDSEXO, IDESTADOCIVIL, CPFCONJUGE, IDGRAUINSTRUCAO,  VALTRABFORMAL,
                VALTRABINFORMAL,  IDDEFICIENCIATIPO,  IDRESTLOCOMOCAO, 
                 IDDADOSOLICITANTE
                ) VALUES (
                '" . $this->IDGRAUPARENTESCO . "', '" . $this->CPF . "', '" . $this->NOME . "', '" . $this->NOMEMAE . "',
                '" . $this->RG . "', '" . $this->DTEMISSAO . "', '" . $this->IDESTADOIDENT . "', '" . $this->IDORGAOEMISSORIDENT . "',
                '" . $this->NUMTITULOELEITOR . "', '" . $this->NUMZONAELEITOR . "', '" . $this->NUMSECAOELEITOR . "',
                '" . $this->IDPAISNASC . "', '" . $this->IDNACIONALIDADENASC . "', '" . $this->IDESTADONASC . "',
                '" . $this->IDMUNICIPIONASC . "', '" . $this->DTNASC . "', '" . $this->NUMNIS . "', '" . $this->IDSEXO . "',
                '" . $this->IDESTADOCIVIL . "', '" . $this->CPFCONJUGE . "', '" . $this->IDGRAUINSTRUCAO . "',
                 '" . $this->VALTRABFORMAL . "', '" . $this->VALTRABINFORMAL . "',
                  '" . $this->IDDEFICIENCIATIPO . "',  
                '" . $this->IDRESTLOCOMOCAO . "',  '" . $this->IDDADOSOLICITANTE . "' 
                );";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta
        ();
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM def_dados_ente_familia
                WHERE IDDADOENTEFAMILIA = '" . $cod . "'";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {
            $this->setCodigo($linha['IDDADOENTEFAMILIA']);
            $this->setIDGRAUPARENTESCO($linha['IDGRAUPARENTESCO']);
            $this->setCPF($linha['CPF']);
            $this->setNOME($linha['NOME']);
            $this->setNOMEMAE($linha['NOMEMAE']);
            $this->setRG($linha['RG']);
            $this->setDTEMISSAO($linha['DTEMISSAO']);
            $this->setIDESTADOIDENT($linha['IDESTADOIDENT']);
            $this->setIDORGAOEMISSORIDENT($linha['IDORGAOEMISSORIDENT']);
            $this->setNUMTITULOELEITOR($linha['NUMTITULOELEITOR']);
            $this->setNUMZONAELEITOR($linha['NUMZONAELEITOR']);
            $this->setNUMSECAOELEITOR($linha['NUMSECAOELEITOR']);
            $this->setIDPAISNASC($linha['IDPAISNASC']);
            $this->setIDNACIONALIDADENASC($linha['IDNACIONALIDADENASC']);
            $this->setIDESTADONASC($linha['IDESTADONASC']);
            $this->setIDMUNICIPIONASC($linha['IDMUNICIPIONASC']);
            $this->setDTNASC($linha['DTNASC']);
            $this->setNUMNIS($linha['NUMNIS']);
            $this->setIDSEXO($linha['IDSEXO']);
            $this->setIDESTADOCIVIL($linha['IDESTADOCIVIL']);
            $this->setCPFCONJUGE($linha['CPFCONJUGE']);
            $this->setIDGRAUINSTRUCAO($linha['IDGRAUINSTRUCAO']);
            $this->setVALTRABFORMAL($linha['VALTRABFORMAL']);
            $this->setVALTRABINFORMAL($linha['VALTRABINFORMAL']);
            $this->setIDDEFICIENCIATIPO($linha['IDDEFICIENCIATIPO']);
            $this->setIDRESTLOCOMOCAO($linha['IDRESTLOCOMOCAO']);
            $this->setIDDADOSOLICITANTE($linha['IDDADOSOLICITANTE']);
        }
    }


    public function ListaDadosEnteFamiliarPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();
                " ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Cargo" width = "30px" align = "right"><a href = "cargo_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "50px">N&uacute;mero</th>
                <th align = "center" class = "small" width = "400px">Cargo</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT IDCARGO, NOMECARGO
                FROM cargo ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(NOMECARGO) LIKE UPPER('%" . $pesq . "%' ) ";
        }

        $SQL.=" ORDER BY NOMECARGO ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['IDCARGO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECARGO']) . ' </td>
                <td align = "center"><a href = "cargo_alteracao.frm.php?idcargo = ' . htmlentities($linha['IDCARGO']) . ' & metodo = 1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "cargo.exe.php?idcargo = ' . htmlentities($linha['IDCARGO']) . ' & metodo = 2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

}

?>