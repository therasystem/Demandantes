<?php

require_once("../controle/conexao.gti.php");

class clsDadosImovelPretendido {

    // CAMPOS PRIVADOS-----------------------------------------
    private $CODIGO;
    private $QUANTMORADORES;
    private $IDESTADO;
    private $IDMUNICIPIO;
    private $BAIRRO1;
    private $BAIRRO2;
    private $BAIRRO3;
    private $IDDADOSOLICITANTE;
    private $DTCADASTRO;

    public function getCODIGO() {
        return $this->CODIGO;
    }

    public function setCODIGO($CODIGO) {
        $this->CODIGO = $CODIGO;
    }

    public function getQUANTMORADORES() {
        return $this->QUANTMORADORES;
    }

    public function setQUANTMORADORES($QUANTMORADORES) {
        $this->QUANTMORADORES = $QUANTMORADORES;
    }

    public function getIDESTADO() {
        return $this->IDESTADO;
    }

    public function setIDESTADO($IDESTADO) {
        $this->IDESTADO = $IDESTADO;
    }

    public function getIDMUNICIPIO() {
        return $this->IDMUNICIPIO;
    }

    public function setIDMUNICIPIO($IDMUNICIPIO) {
        $this->IDMUNICIPIO = $IDMUNICIPIO;
    }

    public function getBAIRRO1() {
        return $this->BAIRRO1;
    }

    public function setBAIRRO1($BAIRRO1) {
        $this->BAIRRO1 = $BAIRRO1;
    }

    public function getBAIRRO2() {
        return $this->BAIRRO2;
    }

    public function setBAIRRO2($BAIRRO2) {
        $this->BAIRRO2 = $BAIRRO2;
    }

    public function getBAIRRO3() {
        return $this->BAIRRO3;
    }

    public function setBAIRRO3($BAIRRO3) {
        $this->BAIRRO3 = $BAIRRO3;
    }

    public function getIDDADOSOLICITANTE() {
        return $this->IDDADOSOLICITANTE;
    }

    public function setIDDADOSOLICITANTE($IDDADOSOLICITANTE) {
        $this->IDDADOSOLICITANTE = $IDDADOSOLICITANTE;
    }

    public function getDTCADASTRO() {
        return $this->DTCADASTRO;
    }

    public function setDTCADASTRO($DTCADASTRO) {
        $this->DTCADASTRO = $DTCADASTRO;
    }

    function __construct() {
        $this->CODIGO = "";
        $this->QUANTMORADORES = "";
        $this->IDESTADO = "";
        $this->IDMUNICIPIO = "";
        $this->BAIRRO1 = "";
        $this->BAIRRO2 = "";
        $this->BAIRRO3 = "";
        $this->IDDADOSOLICITANTE = "";
        $this->DTCADASTRO = "";
    }

    
    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM dip_dados_imovel_pretendido WHERE IDDADOIMOVELPRETENDIDO=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {

        $SQL = "UPDATE dip_dados_imovel_pretendido SET 
                QUANTMORADORES='" . $this->QUANTMORADORES . "',
                IDESTADO='" . $this->IDESTADO . "',
                IDMUNICIPIO='" . $this->IDMUNICIPIO . "',
                BAIRRO1='" . $this->BAIRRO1 . "',
                BAIRRO2='" . $this->BAIRRO2 . "',
                BAIRRO3='" . $this->BAIRRO3 . "',
                IDDADOSOLICITANTE='" . $this->IDDADOSOLICITANTE . "',
                DTCADASTRO=(SELECT DATE(NOW()))
                WHERE IDDADOIMOVELPRETENDIDO='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO dip_dados_imovel_pretendido (
                QUANTMORADORES, IDESTADO, IDMUNICIPIO, BAIRRO1,
                BAIRRO2, BAIRRO3, IDDADOSOLICITANTE, DTCADASTRO
                ) VALUES (
                '" . $this->QUANTMORADORES . "', '" . $this->IDESTADO . "', '" . $this->IDMUNICIPIO . "',
                '" . $this->BAIRRO1 . "', '" . $this->BAIRRO2 . "',
                '" . $this->BAIRRO3 . "', '" . $this->IDDADOSOLICITANTE . "', (SELECT DATE(NOW())) );";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM dip_dados_imovel_pretendido 
                WHERE IDDADOIMOVELPRETENDIDO = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDDADOFAMILIA']);
            $this->setQUANTMORADORES($linha['QUANTMORADORES']);
            $this->setIDESTADO($linha['IDESTADO']);
            $this->setIDMUNICIPIO($linha['IDMUNICIPIO']);
            $this->setBAIRRO1($linha['BAIRRO1']);
            $this->setBAIRRO2($linha['BAIRRO2']);
            $this->setBAIRRO3($linha['BAIRRO3']);
            $this->setIDDADOSOLICITANTE($linha['IDDADOSOLICITANTE']);
            $this->setDTCADASTRO($linha['DTCADASTRO']);
            
        }
    }

    //M�todo que lista as cargo em um array para preencher o grid
    public function ListaDadosImovelPretendidoPesq($pesq = "") {

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