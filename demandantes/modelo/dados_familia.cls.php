<?php

require_once("../controle/conexao.gti.php");

class clsDadosFamilia {

    // CAMPOS PRIVADOS-----------------------------------------
    private $CODIGO;
    private $IDTIPORISCO;
    private $DESCRISCO;
    private $NOMEAREAOCUP;
    private $DATADESABR;
    private $LOCALDESABR;
    private $MOTIVODESABR;
    private $IDCOMUNIDADE;
    private $NOMECOMUNID;
    private $IDBENGOVFED;
    private $NOMEOUTROBENEF;
    private $VALBENEF;
    private $DTINIBENEF;
    private $IDPROGGOVFED;
    private $NOMEOUTROPROG;
    private $VALPROG;
    private $DTINIPROG;
    private $DTAJUDAFINANC;
    private $VALAJUDAFINANC;
    private $CPFRESPFAMIL;
    private $IDDADOSOLICITANTE;

    public function getCODIGO() {
        return $this->CODIGO;
    }

    public function setCODIGO($CODIGO) {
        $this->CODIGO = $CODIGO;
    }


    public function getIDTIPORISCO() {
        return $this->IDTIPORISCO;
    }

    public function setIDTIPORISCO($IDTIPORISCO) {
        $this->IDTIPORISCO = $IDTIPORISCO;
    }

    public function getDESCRISCO() {
        return $this->DESCRISCO;
    }

    public function setDESCRISCO($DESCRISCO) {
        $this->DESCRISCO = $DESCRISCO;
    }

    public function getNOMEAREAOCUP() {
        return $this->NOMEAREAOCUP;
    }

    public function setNOMEAREAOCUP($NOMEAREAOCUP) {
        $this->NOMEAREAOCUP = $NOMEAREAOCUP;
    }

     
    public function getDATADESABR() {
        return $this->DATADESABR;
    }

    public function setDATADESABR($DATADESABR) {
        $this->DATADESABR = $DATADESABR;
    }

    public function getLOCALDESABR() {
        return $this->LOCALDESABR;
    }

    public function setLOCALDESABR($LOCALDESABR) {
        $this->LOCALDESABR = $LOCALDESABR;
    }

    public function getMOTIVODESABR() {
        return $this->MOTIVODESABR;
    }

    public function setMOTIVODESABR($MOTIVODESABR) {
        $this->MOTIVODESABR = $MOTIVODESABR;
    }

    public function getIDCOMUNIDADE() {
        return $this->IDCOMUNIDADE;
    }

    public function setIDCOMUNIDADE($IDCOMUNIDADE) {
        $this->IDCOMUNIDADE = $IDCOMUNIDADE;
    }

    public function getNOMECOMUNID() {
        return $this->NOMECOMUNID;
    }

    public function setNOMECOMUNID($NOMECOMUNID) {
        $this->NOMECOMUNID = $NOMECOMUNID;
    }

    public function getIDBENGOVFED() {
        return $this->IDBENGOVFED;
    }

    public function setIDBENGOVFED($IDBENGOVFED) {
        $this->IDBENGOVFED = $IDBENGOVFED;
    }

    public function getNOMEOUTROBENEF() {
        return $this->NOMEOUTROBENEF;
    }

    public function setNOMEOUTROBENEF($NOMEOUTROBENEF) {
        $this->NOMEOUTROBENEF = $NOMEOUTROBENEF;
    }

    public function getVALBENEF() {
        return $this->VALBENEF;
    }

    public function setVALBENEF($VALBENEF) {
        $this->VALBENEF = $VALBENEF;
    }

    public function getDTINIBENEF() {
        return $this->DTINIBENEF;
    }

    public function setDTINIBENEF($DTINIBENEF) {
        $this->DTINIBENEF = $DTINIBENEF;
    }

    public function getIDPROGGOVFED() {
        return $this->IDPROGGOVFED;
    }

    public function setIDPROGGOVFED($IDPROGGOVFED) {
        $this->IDPROGGOVFED = $IDPROGGOVFED;
    }

    public function getNOMEOUTROPROG() {
        return $this->NOMEOUTROPROG;
    }

    public function setNOMEOUTROPROG($NOMEOUTROPROG) {
        $this->NOMEOUTROPROG = $NOMEOUTROPROG;
    }

    public function getVALPROG() {
        return $this->VALPROG;
    }

    public function setVALPROG($VALPROG) {
        $this->VALPROG = $VALPROG;
    }

    public function getDTINIPROG() {
        return $this->DTINIPROG;
    }

    public function setDTINIPROG($DTINIPROG) {
        $this->DTINIPROG = $DTINIPROG;
    }

    public function getDTAJUDAFINANC() {
        return $this->DTAJUDAFINANC;
    }

    public function setDTAJUDAFINANC($DTAJUDAFINANC) {
        $this->DTAJUDAFINANC = $DTAJUDAFINANC;
    }

    public function getVALAJUDAFINANC() {
        return $this->VALAJUDAFINANC;
    }

    public function setVALAJUDAFINANC($VALAJUDAFINANC) {
        $this->VALAJUDAFINANC = $VALAJUDAFINANC;
    }

    public function getCPFRESPFAMIL() {
        return $this->CPFRESPFAMIL;
    }

    public function setCPFRESPFAMIL($CPFRESPFAMIL) {
        $this->CPFRESPFAMIL = $CPFRESPFAMIL;
    }

    public function getIDDADOSOLICITANTE() {
        return $this->IDDADOSOLICITANTE;
    }

    public function setIDDADOSOLICITANTE($IDDADOSOLICITANTE) {
        $this->IDDADOSOLICITANTE = $IDDADOSOLICITANTE;
    }

    function __construct() {
        $this->CODIGO = "";
        $this->IDTIPORISCO = "";
        $this->DESCRISCO = "";
        $this->NOMEAREAOCUP = "";
        $this->DATADESABR = "";
        $this->LOCALDESABR = "";
        $this->MOTIVODESABR = "";
        $this->IDCOMUNIDADE = "";
        $this->NOMECOMUNID = "";
        $this->IDBENGOVFED = "";
        $this->NOMEOUTROBENEF = "";
        $this->VALBENEF = "";
        $this->DTINIBENEF = "";
        $this->IDPROGGOVFED = "";
        $this->NOMEOUTROPROG = "";
        $this->VALPROG = "";
        $this->DTINIPROG = "";
        $this->DTAJUDAFINANC = "";
        $this->VALAJUDAFINANC = "";
        $this->CPFRESPFAMIL = "";
        $this->IDDADOSOLICITANTE = "";
    }

    
    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM df_dados_familia WHERE IDDADOFAMILIA=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {

        $SQL = "UPDATE df_dados_familia SET 
                IDTIPORISCO='" . $this->IDTIPORISCO . "',
                DESCRISCO='" . $this->DESCRISCO. "',
                NOMEAREAOCUP='" . $this->NOMEAREAOCUP . "',
                DATADESABR='" . $this->DATADESABR. "',
                LOCALDESABR='" . $this->LOCALDESABR . "',
                MOTIVODESABR='" . $this->MOTIVODESABR . "',
                IDCOMUNIDADE='" . $this->IDCOMUNIDADE . "',
                NOMECOMUNID='" . $this->NOMECOMUNID . "',
                IDBENGOVFED='" . $this->IDBENGOVFED . "',
                NOMEOUTROBENEF='" . $this->NOMEOUTROBENEF . "',
                VALBENEF='" . $this->VALBENEF . "',
                DTINIBENEF='" . $this->DTINIBENEF . "',
                IDPROGGOVFED='" . $this->IDPROGGOVFED . "',
                NOMEOUTROPROG='" . $this->NOMEOUTROPROG . "',
                VALPROG='" . $this->VALPROG . "',
                DTINIPROG='" . $this->DTINIPROG . "',
                DTAJUDAFINANC='" . $this->DTAJUDAFINANC . "',
                VALAJUDAFINANC='" . $this->VALAJUDAFINANC . "',
                CPFRESPFAMIL='" . $this->CPFRESPFAMIL . "',
                IDDADOSOLICITANTE='" . $this->IDDADOSOLICITANTE . "'
                WHERE IDDADOFAMILIA='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO df_dados_familia (
                IDTIPORISCO, DESCRISCO, NOMEAREAOCUP, DATADESABR,
                LOCALDESABR, MOTIVODESABR, IDCOMUNIDADE, NOMECOMUNID, IDBENGOVFED, NOMEOUTROBENEF, VALBENEF,
                DTINIBENEF, IDPROGGOVFED, NOMEOUTROPROG, VALPROG, DTINIPROG, DTAJUDAFINANC, VALAJUDAFINANC,
                CPFRESPFAMIL, IDDADOSOLICITANTE
                ) VALUES (
                '" . $this->IDTIPORISCO . "', '" . $this->DESCRISCO . "', 
                '" . $this->NOMEAREAOCUP . "', '" . $this->DATADESABR . "', 
                '" . $this->LOCALDESABR . "', '" . $this->MOTIVODESABR . "', '" . $this->IDCOMUNIDADE . "', 
                '" . $this->NOMECOMUNID . "', '" . $this->IDBENGOVFED . "', '" . $this->NOMEOUTROBENEF . "', 
                '" . $this->VALBENEF . "', '" . $this->DTINIBENEF . "', '" . $this->IDPROGGOVFED . "', 
                '" . $this->NOMEOUTROPROG . "', '" . $this->VALPROG . "', '" . $this->DTINIPROG . "', 
                '" . $this->DTAJUDAFINANC . "', '" . $this->VALAJUDAFINANC . "', '" . $this->CPFRESPFAMIL . "', 
                '" . $this->IDDADOSOLICITANTE . "' );";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM df_dados_familia 
                WHERE IDDADOFAMILIA = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDDADOFAMILIA']);
            $this->setIDTIPORISCO($linha['IDTIPORISCO']);
            $this->setDESCRISCO($linha['DESCRISCO']);
            $this->setNOMEAREAOCUP($linha['NOMEAREAOCUP']);
            $this->setDATADESABR($linha['DATADESABR']);
            $this->setLOCALDESABR($linha['LOCALDESABR']);
            $this->setMOTIVODESABR($linha['MOTIVODESABR']);
            $this->setIDCOMUNIDADE($linha['IDCOMUNIDADE']);
            $this->setNOMECOMUNID($linha['NOMECOMUNID']);
            $this->setIDBENGOVFED($linha['IDBENGOVFED']);
            $this->setNOMEOUTROBENEF($linha['NOMEOUTROBENEF']);
            $this->setVALBENEF($linha['VALBENEF']);
            $this->setDTINIBENEF($linha['DTINIBENEF']);
            $this->setIDPROGGOVFED($linha['IDPROGGOVFED']);
            $this->setNOMEOUTROPROG($linha['NOMEOUTROPROG']);
            $this->setVALPROG($linha['VALPROG']);
            $this->setDTINIPROG($linha['DTINIPROG']);
            $this->setDTAJUDAFINANC($linha['DTAJUDAFINANC']);
            $this->setVALAJUDAFINANC($linha['VALAJUDAFINANC']);
            $this->setCPFRESPFAMIL($linha['CPFRESPFAMIL']);
            $this->setIDDADOSOLICITANTE($linha['IDDADOSOLICITANTE']);
            
        }
    }

    //M�todo que lista as cargo em um array para preencher o grid
    public function ListaDadosFamiliaPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
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

            $SQL.=" WHERE UPPER(NOMECARGO) LIKE UPPER('%" . $pesq . "%') ";
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
                <td align = "center"><a href = "cargo_alteracao.frm.php?idcargo=' . htmlentities($linha['IDCARGO']) . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "cargo.exe.php?idcargo=' . htmlentities($linha['IDCARGO']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

}

?>