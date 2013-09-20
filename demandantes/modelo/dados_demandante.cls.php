<?php

require_once("../controle/conexao.gti.php");

class clsDadosDemandante {

    // CAMPOS PRIVADOS-----------------------------------------
    private $CODIGO;
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
    private $IDNACIONALIDADENASC;
    private $IDESTADONASC;
    private $IDMUNICIPIONASC;
    private $DTNASC;
    private $NUMNIS;
    private $TELRESID;
    private $TELCOMERC;
    private $TELMOVEL;
    private $EMAIL1;
    private $EMAIL2;
    private $IDSEXO;
    private $IDESTADOCIVIL;
    private $CPFCONJUGE;
    private $IDGRAUINSTRUCAO;
    private $IDSITMERCADOTRABALHO;
    private $IDOCUPACAO;
    private $DTADMISTRAB;
    private $IDDEFICIENCIATIPO;
    private $IDRESTLOCOMOCAO;
    private $IDBENGOV;
    private $VALORBENEF;
    private $DTINIBENEF;
    private $IDPROGGOV;
    private $VALORPROG;
    private $DTINIPROG;
    private $IDENTIDADE;

    public function getCODIGO() {
        return $this->CODIGO;
    }

    public function setCODIGO($CODIGO) {
        $this->CODIGO = $CODIGO;
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

    public function getIDNACIONALIDADENASC() {
        return $this->IDNACIONALIDADENASC;
    }

    public function setIDNACIONALIDADENASC($IDNACIONALIDADENASC) {
        $this->IDNACIONALIDADENASC = $IDNACIONALIDADENASC;
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

    public function getTELRESID() {
        return $this->TELRESID;
    }

    public function setTELRESID($TELRESID) {
        $this->TELRESID = $TELRESID;
    }

    public function getTELCOMERC() {
        return $this->TELCOMERC;
    }

    public function setTELCOMERC($TELCOMERC) {
        $this->TELCOMERC = $TELCOMERC;
    }

    public function getTELMOVEL() {
        return $this->TELMOVEL;
    }

    public function setTELMOVEL($TELMOVEL) {
        $this->TELMOVEL = $TELMOVEL;
    }

    public function getEMAIL1() {
        return $this->EMAIL1;
    }

    public function setEMAIL1($EMAIL1) {
        $this->EMAIL1 = $EMAIL1;
    }

    public function getEMAIL2() {
        return $this->EMAIL2;
    }

    public function setEMAIL2($EMAIL2) {
        $this->EMAIL2 = $EMAIL2;
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

    public function getIDSITMERCADOTRABALHO() {
        return $this->IDSITMERCADOTRABALHO;
    }

    public function setIDSITMERCADOTRABALHO($IDSITMERCADOTRABALHO) {
        $this->IDSITMERCADOTRABALHO = $IDSITMERCADOTRABALHO;
    }

    public function getIDOCUPACAO() {
        return $this->IDOCUPACAO;
    }

    public function setIDOCUPACAO($IDOCUPACAO) {
        $this->IDOCUPACAO = $IDOCUPACAO;
    }

    public function getDTADMISTRAB() {
        return $this->DTADMISTRAB;
    }

    public function setDTADMISTRAB($DTADMISTRAB) {
        $this->DTADMISTRAB = $DTADMISTRAB;
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

    public function getIDBENGOV() {
        return $this->IDBENGOV;
    }

    public function setIDBENGOV($IDBENGOV) {
        $this->IDBENGOV = $IDBENGOV;
    }

    public function getVALORBENEF() {
        return $this->VALORBENEF;
    }

    public function setVALORBENEF($VALORBENEF) {
        $this->VALORBENEF = $VALORBENEF;
    }

    public function getDTINIBENEF() {
        return $this->DTINIBENEF;
    }

    public function setDTINIBENEF($DTINIBENEF) {
        $this->DTINIBENEF = $DTINIBENEF;
    }

    public function getIDPROGGOV() {
        return $this->IDPROGGOV;
    }

    public function setIDPROGGOV($IDPROGGOV) {
        $this->IDPROGGOV = $IDPROGGOV;
    }

    public function getVALORPROG() {
        return $this->VALORPROG;
    }

    public function setVALORPROG($VALORPROG) {
        $this->VALORPROG = $VALORPROG;
    }

    public function getDTINIPROG() {
        return $this->DTINIPROG;
    }

    public function setDTINIPROG($DTINIPROG) {
        $this->DTINIPROG = $DTINIPROG;
    }

    public function getIDENTIDADE() {
        return $this->IDENTIDADE;
    }

    public function setIDENTIDADE($IDENTIDADE) {
        $this->IDENTIDADE = $IDENTIDADE;
    }

    function __construct() {
        $this->CODIGO = "";
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
        $this->TELRESID = "";
        $this->TELCOMERC = "";
        $this->TELMOVEL = "";
        $this->EMAIL1 = "";
        $this->EMAIL2 = "";
        $this->IDSEXO = "";
        $this->IDESTADOCIVIL = "";
        $this->CPFCONJUGE = "";
        $this->IDGRAUINSTRUCAO = "";
        $this->IDSITMERCADOTRABALHO = "";
        $this->IDOCUPACAO = "";
        $this->DTADMISTRAB = "";
        $this->IDDEFICIENCIATIPO = "";
        $this->IDRESTLOCOMOCAO = "";
        $this->IDBENGOV = "";
        $this->VALORBENEF = "";
        $this->DTINIBENEF = "";
        $this->IDPROGGOV = "";
        $this->VALORPROG = "";
        $this->DTINIPROG = "";
        $this->IDENTIDADE = "";
    }

    //M�todo para excluir um cargo
    public function Excluir() {
        $SQL = 'DELETE FROM ds_dados_solicitante WHERE IDDADOSOLICITANTE=' . $this->codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {
        $SQL = "UPDATE ds_dados_solicitante SET 
        CPF ='" . $this->CPF . "',
        NOME ='" . $this->NOME . "',
        NOMEMAE ='" . $this->NOMEMAE . "',
        RG ='" . $this->RG . "',
        DTEMISSAO ='" . $this->DTEMISSAO . "',
        IDESTADOIDENT ='" . $this->IDESTADOIDENT . "',
        IDORGAOEMISSORIDENT ='" . $this->IDORGAOEMISSORIDENT . "',
        NUMTITULOELEITOR ='" . $this->NUMTITULOELEITOR . "',
        NUMZONAELEITOR ='" . $this->NUMZONAELEITOR . "',
        NUMSECAOELEITOR ='" . $this->NUMSECAOELEITOR . "',
        IDPAISNASC ='" . $this->IDPAISNASC . "',
        IDNACIONALIDADENASC ='" . $this->IDNACIONALIDADENASC . "',
        IDESTADONASC ='" . $this->IDESTADONASC . "',
        IDMUNICIPIONASC ='" . $this->IDMUNICIPIONASC . "',
        DTNASC ='" . $this->DTNASC . "',
        NUMNIS ='" . $this->NUMNIS . "',
        TELRESID ='" . $this->TELRESID . "',
        TELCOMERC ='" . $this->TELCOMERC . "',
        TELMOVEL ='" . $this->TELMOVEL . "',
        EMAIL1 ='" . $this->EMAIL1 . "',
        EMAIL2 ='" . $this->EMAIL2 . "',
        IDSEXO ='" . $this->IDSEXO . "',
        IDESTADOCIVIL ='" . $this->IDESTADOCIVIL . "',
        CPFCONJUGE ='" . $this->CPFCONJUGE . "',
        IDGRAUINSTRUCAO ='" . $this->IDGRAUINSTRUCAO . "',
        IDSITMERCADOTRABALHO ='" . $this->IDSITMERCADOTRABALHO . "',
        IDOCUPACAO ='" . $this->IDOCUPACAO . "',
        DTADMISTRAB ='" . $this->DTADMISTRAB . "',
        IDDEFICIENCIATIPO ='" . $this->IDDEFICIENCIATIPO . "',
        IDRESTLOCOMOCAO ='" . $this->IDRESTLOCOMOCAO . "',
        IDBENGOV ='" . $this->IDBENGOV . "',
        VALORBENEF ='" . $this->VALORBENEF . "',
        DTINIBENEF ='" . $this->DTINIBENEF . "',
        IDPROGGOV ='" . $this->IDPROGGOV . "',
        VALORPROG ='" . $this->VALORPROG . "',
        DTINIPROG ='" . $this->DTINIPROG . "',
        IDENTIDADE ='" . $this->IDENTIDADE . "'
        WHERE IDDADOSOLICITANTE='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO ds_dados_solicitante (
        CPF, NOME, NOMEMAE, RG, DTEMISSAO, IDESTADOIDENT, IDORGAOEMISSORIDENT, NUMTITULOELEITOR,
        NUMZONAELEITOR, NUMSECAOELEITOR, IDPAISNASC, IDNACIONALIDADENASC, IDESTADONASC, IDMUNICIPIONASC,
        DTNASC, NUMNIS, TELRESID, TELCOMERC, TELMOVEL, EMAIL1, EMAIL2, IDSEXO, IDESTADOCIVIL, CPFCONJUGE,
        IDGRAUINSTRUCAO, IDSITMERCADOTRABALHO, IDOCUPACAO, DTADMISTRAB, IDDEFICIENCIATIPO,
        IDRESTLOCOMOCAO, IDBENGOV, VALORBENEF, DTINIBENEF, IDPROGGOV, VALORPROG,
        DTINIPROG, IDENTIDADE ) VALUES (
        '" . $this->CPF . "', '" . $this->NOME . "', '" . $this->NOMEMAE . "', '" . $this->RG . "',
        '" . $this->DTEMISSAO . "', '" . $this->IDESTADOIDENT . "', '" . $this->IDORGAOEMISSORIDENT . "',
        '" . $this->NUMTITULOELEITOR . "', '" . $this->NUMZONAELEITOR . "', '" . $this->NUMSECAOELEITOR . "',
        '" . $this->IDPAISNASC . "', '" . $this->IDNACIONALIDADENASC . "', '" . $this->IDESTADONASC . "',
        '" . $this->IDMUNICIPIONASC . "', '" . $this->DTNASC . "', '" . $this->NUMNIS . "', '" . $this->TELRESID . "',
        '" . $this->TELCOMERC . "', '" . $this->TELMOVEL . "', '" . $this->EMAIL1 . "', '" . $this->EMAIL2 . "',
        '" . $this->IDSEXO . "', '" . $this->IDESTADOCIVIL . "', '" . $this->CPFCONJUGE . "', '" . $this->IDGRAUINSTRUCAO . "',
        '" . $this->IDSITMERCADOTRABALHO . "', '" . $this->IDOCUPACAO . "', '" . $this->DTADMISTRAB . "', 
        '" . $this->IDDEFICIENCIATIPO . "',  '" . $this->IDRESTLOCOMOCAO . "',
        '" . $this->IDBENGOV . "', '" . $this->VALORBENEF . "', '" . $this->DTINIBENEF . "', '" . $this->IDPROGGOV . "',
        '" . $this->VALORPROG . "', '" . $this->DTINIPROG . "', '" . $this->IDENTIDADE . "' );";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que lista as cargo em um array para preencher o grid


    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM ds_dados_solicitante 
                WHERE IDDADOSOLICITANTE = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDDADOSOLICITANTE']);
            $this->setCPF($linha['CPF']);
            $this->setNome($linha['NOME']);
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
            $this->setTELRESID($linha['TELRESID']);
            $this->setTELCOMERC($linha['TELCOMERC']);
            $this->setTELMOVEL($linha['TELMOVEL']);
            $this->setEMAIL1($linha['EMAIL1']);
            $this->setEMAIL2($linha['EMAIL2']);
            $this->setIDSEXO($linha['IDSEXO']);
            $this->setIDESTADOCIVIL($linha['IDESTADOCIVIL']);
            $this->setCPFCONJUGE($linha['CPFCONJUGE']);
            $this->setIDGRAUINSTRUCAO($linha['IDGRAUINSTRUCAO']);
            $this->setIDSITMERCADOTRABALHO($linha['IDSITMERCADOTRABALHO']);
            $this->setIDOCUPACAO($linha['IDOCUPACAO']);
            $this->setDTADMISTRAB($linha['DTADMISTRAB']);
            $this->setIDDEFICIENCIATIPO($linha['IDDEFICIENCIATIPO']);
            $this->setIDRESTLOCOMOCAO($linha['IDRESTLOCOMOCAO']);
            $this->setIDBENGOV($linha['IDBENGOV']);
            $this->setVALORBENEF($linha['VALORBENEF']);
            $this->setDTINIBENEF($linha['DTINIBENEF']);
            $this->setIDPROGGOV($linha['IDPROGGOV']);
            $this->setVALORPROG($linha['VALORPROG']);
            $this->setDTINIPROG($linha['DTINIPROG']);
            $this->setIDENTIDADE($linha['IDENTIDADE']);
        }
    }

    public function ListaDadosDemandate($pesq = "") {

        $pesquisa = $pesq;

        $html = '<div style="margin-top: 1px; float: left">
                    <input type="text" name="pesquisa" value="'. $pesquisa . '" class="form-control">
                    </div>
                    <div style="float: left; margin-left: 1%">
                    <a onclick = "document.form1.submit();" class="btn btn-primary">Pesquisar</a>
                    <a href="../visao/menuadministrador.frm.php"  class="btn btn-primary">Voltar</a>
                    <a type="submit" href = "#"  class="btn btn-success">Adicionar</a>
                    </div>
                              <table class="table1 table1-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>CPF</th>
                                  <th>Nome</th>
                                  <th>Data de nascimento</th>
                                  <th>Editar</th>
                                  <th>Excluir</th>

                                </tr>
                              </thead>';

        $SQL = "SELECT IDDADOSOLICITANTE, CPF, NOME, DTNASC
                FROM ds_dados_solicitante ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(NOME) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY NOME ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tbody>
                <td > ' . htmlentities($linha['IDDADOSOLICITANTE']) . ' </td>
                <td > ' . htmlentities($linha['CPF']) . ' </td>
                <td > ' . htmlentities($linha['NOME']) . ' </td>
                <td > ' . htmlentities($linha['DTNASC']) . ' </td>
                <td ><a href = "solicitante.frm.php?IDDADOSOLICITANTE=' . htmlentities($linha['IDDADOSOLICITANTE']) . '&metodo=1"><img src = "img/edit.png" ></a> </td>
                <td ><a href = "solicitante.exe.php?IDDADOSOLICITANTE=' . htmlentities($linha['IDDADOSOLICITANTE']) . '&metodo=2"><img  src = "img/delete.png"  ></a> </td>
                </tbody>';
        }


        $html .= ' </table>';



        return $html;
    }

}

?>