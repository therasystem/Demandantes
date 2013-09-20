<?php

require_once("../controle/conexao.gti.php");

class clsDadosRegiaoDomicilio {

    // CAMPOS PRIVADOS-----------------------------------------
    private $CODIGO;
    private $IDCONDICAOPAVIMENTO;
    private $IDCONDICAOTRANSPUBLIC;
    private $IDCONDICAOTRATAGUA;
    private $IDCONDICAOTRATESGOTO;
    private $IDCONDICAOILUMINAPUBLIC;
    private $IDCONDICAOSISVIARIO;
    private $IDCONDICAOESCOLAPOSTO;
    private $IDCONDICAOAREARISCO;
    private $IDDADOSOLICITANTE;

    public function getCODIGO() {
        return $this->CODIGO;
    }

    public function setCODIGO($CODIGO) {
        $this->CODIGO = $CODIGO;
    }

    public function getIDCONDICAOPAVIMENTO() {
        return $this->IDCONDICAOPAVIMENTO;
    }

    public function setIDCONDICAOPAVIMENTO($IDCONDICAOPAVIMENTO) {
        $this->IDCONDICAOPAVIMENTO = $IDCONDICAOPAVIMENTO;
    }

    public function getIDCONDICAOTRANSPUBLIC() {
        return $this->IDCONDICAOTRANSPUBLIC;
    }

    public function setIDCONDICAOTRANSPUBLIC($IDCONDICAOTRANSPUBLIC) {
        $this->IDCONDICAOTRANSPUBLIC = $IDCONDICAOTRANSPUBLIC;
    }

    public function getIDCONDICAOTRATAGUA() {
        return $this->IDCONDICAOTRATAGUA;
    }

    public function setIDCONDICAOTRATAGUA($IDCONDICAOTRATAGUA) {
        $this->IDCONDICAOTRATAGUA = $IDCONDICAOTRATAGUA;
    }

    public function getIDCONDICAOTRATESGOTO() {
        return $this->IDCONDICAOTRATESGOTO;
    }

    public function setIDCONDICAOTRATESGOTO($IDCONDICAOTRATESGOTO) {
        $this->IDCONDICAOTRATESGOTO = $IDCONDICAOTRATESGOTO;
    }

    public function getIDCONDICAOILUMINAPUBLIC() {
        return $this->IDCONDICAOILUMINAPUBLIC;
    }

    public function setIDCONDICAOILUMINAPUBLIC($IDCONDICAOILUMINAPUBLIC) {
        $this->IDCONDICAOILUMINAPUBLIC = $IDCONDICAOILUMINAPUBLIC;
    }

    public function getIDCONDICAOSISVIARIO() {
        return $this->IDCONDICAOSISVIARIO;
    }

    public function setIDCONDICAOSISVIARIO($IDCONDICAOSISVIARIO) {
        $this->IDCONDICAOSISVIARIO = $IDCONDICAOSISVIARIO;
    }

    public function getIDCONDICAOESCOLAPOSTO() {
        return $this->IDCONDICAOESCOLAPOSTO;
    }

    public function setIDCONDICAOESCOLAPOSTO($IDCONDICAOESCOLAPOSTO) {
        $this->IDCONDICAOESCOLAPOSTO = $IDCONDICAOESCOLAPOSTO;
    }

    public function getIDCONDICAOAREARISCO() {
        return $this->IDCONDICAOAREARISCO;
    }

    public function setIDCONDICAOAREARISCO($IDCONDICAOAREARISCO) {
        $this->IDCONDICAOAREARISCO = $IDCONDICAOAREARISCO;
    }

    public function getIDDADOSOLICITANTE() {
        return $this->IDDADOSOLICITANTE;
    }

    public function setIDDADOSOLICITANTE($IDDADOSOLICITANTE) {
        $this->IDDADOSOLICITANTE = $IDDADOSOLICITANTE;
    }

    function __construct() {
        $this->CODIGO = "";
        $this->IDCONDICAOPAVIMENTO = "";
        $this->IDCONDICAOTRANSPUBLIC = "";
        $this->IDCONDICAOTRATAGUA = "";
        $this->IDCONDICAOTRATESGOTO = "";
        $this->IDCONDICAOILUMINAPUBLIC = "";
        $this->IDCONDICAOSISVIARIO = "";
        $this->IDCONDICAOESCOLAPOSTO = "";
        $this->IDCONDICAOAREARISCO = "";
        $this->IDDADOSOLICITANTE = "";
    }

    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM drd_dados_regiao_domicilio WHERE IDDADOSREGIAODOMICILIO=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {

        $SQL = "UPDATE drd_dados_regiao_domicilio SET 
                IDCONDICAOPAVIMENTO='" . $this->IDCONDICAOPAVIMENTO . "',
                IDCONDICAOTRANSPUBLIC='" . $this->IDCONDICAOTRANSPUBLIC . "',
                IDCONDICAOTRATAGUA='" . $this->IDCONDICAOTRATAGUA . "',
                IDCONDICAOTRATESGOTO='" . $this->IDCONDICAOTRATESGOTO . "',
                IDCONDICAOILUMINAPUBLIC='" . $this->IDCONDICAOILUMINAPUBLIC . "',
                IDCONDICAOSISVIARIO='" . $this->IDCONDICAOSISVIARIO . "',
                IDCONDICAOESCOLAPOSTO='" . $this->IDCONDICAOESCOLAPOSTO . "',
                IDCONDICAOAREARISCO='" . $this->IDCONDICAOAREARISCO . "',
                IDDADOSOLICITANTE='" . $this->IDDADOSOLICITANTE . "'
                WHERE IDDADOSREGIAODOMICILIO='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO drd_dados_regiao_domicilio (
                IDCONDICAOPAVIMENTO, IDCONDICAOTRANSPUBLIC, IDCONDICAOTRATAGUA, IDCONDICAOTRATESGOTO,
                IDCONDICAOILUMINAPUBLIC, IDCONDICAOSISVIARIO, IDCONDICAOESCOLAPOSTO, IDCONDICAOAREARISCO,
                IDDADOSOLICITANTE
                ) VALUES (
                '" . $this->IDCONDICAOPAVIMENTO . "', '" . $this->IDCONDICAOTRANSPUBLIC . "', '" . $this->IDCONDICAOTRATAGUA . "',
                '" . $this->IDCONDICAOTRATESGOTO . "', '" . $this->IDCONDICAOILUMINAPUBLIC . "', '" . $this->IDCONDICAOSISVIARIO . "',
                '" . $this->IDCONDICAOESCOLAPOSTO . "', '" . $this->IDCONDICAOAREARISCO . "', '" . $this->IDDADOSOLICITANTE . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM drd_dados_regiao_domicilio 
                WHERE IDDADOSREGIAODOMICILIO = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDDADOSREGIAODOMICILIO']);
            $this->setIDCONDICAOPAVIMENTO($linha['IDCONDICAOPAVIMENTO']);
            $this->setIDCONDICAOTRANSPUBLIC($linha['IDCONDICAOTRANSPUBLIC']);
            $this->setIDCONDICAOTRATAGUA($linha['IDCONDICAOTRATAGUA']);
            $this->setIDCONDICAOTRATESGOTO($linha['IDCONDICAOTRATESGOTO']);
            $this->setIDCONDICAOTRANSPUBLIC($linha['IDCONDICAOILUMINAPUBLIC']);
            $this->setIDCONDICAOSISVIARIO($linha['IDCONDICAOSISVIARIO']);
            $this->setIDCONDICAOESCOLAPOSTO($linha['IDCONDICAOESCOLAPOSTO']);
            $this->setIDCONDICAOAREARISCO($linha['IDCONDICAOAREARISCO']);
            $this->setIDDADOSOLICITANTE($linha['IDDADOSOLICITANTE']);
        }
    }

    //M�todo que lista as cargo em um array para preencher o grid
    public function ListaCargoPesq($pesq = "") {

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