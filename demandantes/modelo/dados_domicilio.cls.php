<?php

require_once("../controle/conexao.gti.php");

class clsDadosDomicilio {

    // CAMPOS PRIVADOS-----------------------------------------
    private $CODIGO;
    private $IDTIPOLOGRADOURO;
    private $NOMELOGRADOURO;
    private $NUMDOMICILIO;
    private $COMPLEMENTO;
    private $BAIRRO;
    private $CEP;
    private $IDESTADO;
    private $IDMUNICIPIO;
    private $REFERENCIA;
    private $IDCONSTRUCAO;
    private $IDESTCONSERVACAO;
    private $IDUTILIZACAO;
    private $IDTIPOUSO;
    private $IDESPECIEDOMICILIO;
    private $DATAINICIOMORARMUNICIP;
    private $DATAINICIOMORARDOMICILIO;
    private $QUANTCOMODOS;
    private $QUANTDORMIT;
    private $IDTIPOMATERIALPISOINT;
    private $IDTIPOMATERIALPAREDEEXT;
    private $QTAGUACANALIZADA;
    private $IDFORMAABASTECIMENTO;
    private $IDFORMAESCOASANITARIO;
    private $IDDESTINOLIXO;
    private $IDILUMINACAOCASA;
    private $VALAGUAESGOTO;
    private $VALENERGIA;
    private $VALALUGUEL;
    private $NUMFAMILIAS;
    private $IDDADOSOLICITANTE;

    public function getCODIGO() {
        return $this->CODIGO;
    }

    public function setCODIGO($CODIGO) {
        $this->CODIGO = $CODIGO;
    }

    public function getIDTIPOLOGRADOURO() {
        return $this->IDTIPOLOGRADOURO;
    }

    public function setIDTIPOLOGRADOURO($IDTIPOLOGRADOURO) {
        $this->IDTIPOLOGRADOURO = $IDTIPOLOGRADOURO;
    }

    public function getNOMELOGRADOURO() {
        return $this->NOMELOGRADOURO;
    }

    public function setNOMELOGRADOURO($NOMELOGRADOURO) {
        $this->NOMELOGRADOURO = $NOMELOGRADOURO;
    }

    public function getNUMDOMICILIO() {
        return $this->NUMDOMICILIO;
    }

    public function setNUMDOMICILIO($NUMDOMICILIO) {
        $this->NUMDOMICILIO = $NUMDOMICILIO;
    }

    public function getCOMPLEMENTO() {
        return $this->COMPLEMENTO;
    }

    public function setCOMPLEMENTO($COMPLEMENTO) {
        $this->COMPLEMENTO = $COMPLEMENTO;
    }

    public function getBAIRRO() {
        return $this->BAIRRO;
    }

    public function setBAIRRO($BAIRRO) {
        $this->BAIRRO = $BAIRRO;
    }

    public function getCEP() {
        return $this->CEP;
    }

    public function setCEP($CEP) {
        $this->CEP = $CEP;
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

    public function getREFERENCIA() {
        return $this->REFERENCIA;
    }

    public function setREFERENCIA($REFERENCIA) {
        $this->REFERENCIA = $REFERENCIA;
    }

    public function getIDCONSTRUCAO() {
        return $this->IDCONSTRUCAO;
    }

    public function setIDCONSTRUCAO($IDCONSTRUCAO) {
        $this->IDCONSTRUCAO = $IDCONSTRUCAO;
    }

    public function getIDESTCONSERVACAO() {
        return $this->IDESTCONSERVACAO;
    }

    public function setIDESTCONSERVACAO($IDESTCONSERVACAO) {
        $this->IDESTCONSERVACAO = $IDESTCONSERVACAO;
    }

    public function getIDUTILIZACAO() {
        return $this->IDUTILIZACAO;
    }

    public function setIDUTILIZACAO($IDUTILIZACAO) {
        $this->IDUTILIZACAO = $IDUTILIZACAO;
    }

    public function getIDTIPOUSO() {
        return $this->IDTIPOUSO;
    }

    public function setIDTIPOUSO($IDTIPOUSO) {
        $this->IDTIPOUSO = $IDTIPOUSO;
    }

    public function getIDESPECIEDOMICILIO() {
        return $this->IDESPECIEDOMICILIO;
    }

    public function setIDESPECIEDOMICILIO($IDESPECIEDOMICILIO) {
        $this->IDESPECIEDOMICILIO = $IDESPECIEDOMICILIO;
    }

    public function getDATAINICIOMORARMUNICIP() {
        return $this->DATAINICIOMORARMUNICIP;
    }

    public function setDATAINICIOMORARMUNICIP($DATAINICIOMORARMUNICIP) {
        $this->DATAINICIOMORARMUNICIP = $DATAINICIOMORARMUNICIP;
    }

    public function getDATAINICIOMORARDOMICILIO() {
        return $this->DATAINICIOMORARDOMICILIO;
    }

    public function setDATAINICIOMORARDOMICILIO($DATAINICIOMORARDOMICILIO) {
        $this->DATAINICIOMORARDOMICILIO = $DATAINICIOMORARDOMICILIO;
    }

    public function getQUANTCOMODOS() {
        return $this->QUANTCOMODOS;
    }

    public function setQUANTCOMODOS($QUANTCOMODOS) {
        $this->QUANTCOMODOS = $QUANTCOMODOS;
    }

    public function getQUANTDORMIT() {
        return $this->QUANTDORMIT;
    }

    public function setQUANTDORMIT($QUANTDORMIT) {
        $this->QUANTDORMIT = $QUANTDORMIT;
    }

    public function getIDTIPOMATERIALPISOINT() {
        return $this->IDTIPOMATERIALPISOINT;
    }

    public function setIDTIPOMATERIALPISOINT($IDTIPOMATERIALPISOINT) {
        $this->IDTIPOMATERIALPISOINT = $IDTIPOMATERIALPISOINT;
    }

    public function getIDTIPOMATERIALPAREDEEXT() {
        return $this->IDTIPOMATERIALPAREDEEXT;
    }

    public function setIDTIPOMATERIALPAREDEEXT($IDTIPOMATERIALPAREDEEXT) {
        $this->IDTIPOMATERIALPAREDEEXT = $IDTIPOMATERIALPAREDEEXT;
    }

    public function getQTAGUACANALIZADA() {
        return $this->QTAGUACANALIZADA;
    }

    public function setQTAGUACANALIZADA($QTAGUACANALIZADA) {
        $this->QTAGUACANALIZADA = $QTAGUACANALIZADA;
    }

    public function getIDFORMAABASTECIMENTO() {
        return $this->IDFORMAABASTECIMENTO;
    }

    public function setIDFORMAABASTECIMENTO($IDFORMAABASTECIMENTO) {
        $this->IDFORMAABASTECIMENTO = $IDFORMAABASTECIMENTO;
    }


    public function getIDFORMAESCOASANITARIO() {
        return $this->IDFORMAESCOASANITARIO;
    }

    public function setIDFORMAESCOASANITARIO($IDFORMAESCOASANITARIO) {
        $this->IDFORMAESCOASANITARIO = $IDFORMAESCOASANITARIO;
    }


    public function getIDDESTINOLIXO() {
        return $this->IDDESTINOLIXO;
    }

    public function setIDDESTINOLIXO($IDDESTINOLIXO) {
        $this->IDDESTINOLIXO = $IDDESTINOLIXO;
    }

    public function getIDILUMINACAOCASA() {
        return $this->IDILUMINACAOCASA;
    }

    public function setIDILUMINACAOCASA($IDILUMINACAOCASA) {
        $this->IDILUMINACAOCASA = $IDILUMINACAOCASA;
    }

    public function getVALAGUAESGOTO() {
        return $this->VALAGUAESGOTO;
    }

    public function setVALAGUAESGOTO($VALAGUAESGOTO) {
        $this->VALAGUAESGOTO = $VALAGUAESGOTO;
    }

    public function getVALENERGIA() {
        return $this->VALENERGIA;
    }

    public function setVALENERGIA($VALENERGIA) {
        $this->VALENERGIA = $VALENERGIA;
    }

    public function getVALALUGUEL() {
        return $this->VALALUGUEL;
    }

    public function setVALALUGUEL($VALALUGUEL) {
        $this->VALALUGUEL = $VALALUGUEL;
    }

    public function getNUMFAMILIAS() {
        return $this->NUMFAMILIAS;
    }

    public function setNUMFAMILIAS($NUMFAMILIAS) {
        $this->NUMFAMILIAS = $NUMFAMILIAS;
    }

    public function getIDDADOSOLICITANTE() {
        return $this->IDDADOSOLICITANTE;
    }

    public function setIDDADOSOLICITANTE($IDDADOSOLICITANTE) {
        $this->IDDADOSOLICITANTE = $IDDADOSOLICITANTE;
    }

    function __construct() {
        $this->CODIGO = "";
        $this->IDTIPOLOGRADOURO = "";
        $this->NOMELOGRADOURO = "";
        $this->NUMDOMICILIO = "";
        $this->COMPLEMENTO = "";
        $this->BAIRRO = "";
        $this->CEP = "";
        $this->IDESTADO = "";
        $this->IDMUNICIPIO = "";
        $this->REFERENCIA = "";
        $this->IDCONSTRUCAO = "";
        $this->IDESTCONSERVACAO = "";
        $this->IDUTILIZACAO = "";
        $this->IDTIPOUSO = "";
        $this->IDESPECIEDOMICILIO = "";
        $this->DATAINICIOMORARMUNICIP = "";
        $this->DATAINICIOMORARDOMICILIO = "";
        $this->QUANTCOMODOS = "";
        $this->QUANTDORMIT = "";
        $this->IDTIPOMATERIALPISOINT = "";
        $this->IDTIPOMATERIALPAREDEEXT = "";
        $this->QTAGUACANALIZADA = "";
        $this->IDFORMAABASTECIMENTO = "";
        $this->IDFORMAESCOASANITARIO = "";
        $this->IDDESTINOLIXO = "";
        $this->IDILUMINACAOCASA = "";
        $this->VALAGUAESGOTO = "";
        $this->VALENERGIA = "";
        $this->VALALUGUEL = "";
        $this->NUMFAMILIAS = "";
        $this->IDDADOSOLICITANTE = "";
    }

//M�todo para excluir um cargo
    public function Excluir() {
        $SQL = 'DELETE FROM dd_dados_domicilio WHERE IDDADODOMICILIO=' . $this->codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {
        $SQL = "UPDATE dd_dados_domicilio SET 
        IDTIPOLOGRADOURO ='" . $this->IDTIPOLOGRADOURO . "',
        NOMELOGRADOURO ='" . $this->NOMELOGRADOURO . "',
        NUMDOMICILIO ='" . $this->NUMDOMICILIO . "',
        COMPLEMENTO ='" . $this->COMPLEMENTO . "',
        BAIRRO ='" . $this->BAIRRO . "',
        CEP ='" . $this->CEP . "',
        IDESTADO ='" . $this->IDESTADO . "',
        IDMUNICIPIO ='" . $this->IDMUNICIPIO . "',
        REFERENCIA ='" . $this->REFERENCIA . "',
        IDCONSTRUCAO ='" . $this->IDCONSTRUCAO . "',
        IDESTCONSERVACAO ='" . $this->IDESTCONSERVACAO . "',
        IDUTILIZACAO ='" . $this->IDUTILIZACAO . "',
        IDTIPOUSO ='" . $this->IDTIPOUSO . "',
        IDESPECIEDOMICILIO ='" . $this->IDESPECIEDOMICILIO . "',
        DATAINICIOMORARMUNICIP ='" . $this->DATAINICIOMORARMUNICIP . "',
        DATAINICIOMORARDOMICILIO ='" . $this->DATAINICIOMORARDOMICILIO . "',
        QUANTCOMODOS ='" . $this->QUANTCOMODOS . "',
        QUANTDORMIT ='" . $this->QUANTDORMIT . "',
        IDTIPOMATERIALPISOINT ='" . $this->IDTIPOMATERIALPISOINT . "',
        IDTIPOMATERIALPAREDEEXT ='" . $this->IDTIPOMATERIALPAREDEEXT . "',
        QTAGUACANALIZADA ='" . $this->QTAGUACANALIZADA . "',
        IDFORMAABASTECIMENTO ='" . $this->IDFORMAABASTECIMENTO . "',
        IDFORMAESCOASANITARIO ='" . $this->IDFORMAESCOASANITARIO . "',
        IDDESTINOLIXO ='" . $this->IDDESTINOLIXO . "',
        IDILUMINACAOCASA ='" . $this->IDILUMINACAOCASA . "',
        VALAGUAESGOTO ='" . $this->VALAGUAESGOTO . "',
        VALENERGIA ='" . $this->VALENERGIA . "',
        VALALUGUEL ='" . $this->VALALUGUEL . "',
        NUMFAMILIAS ='" . $this->NUMFAMILIAS . "',
        IDDADOSOLICITANTE ='" . $this->IDDADOSOLICITANTE . "'
        WHERE IDDADODOMICILIO='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO dd_dados_domicilio (
                IDTIPOLOGRADOURO, NOMELOGRADOURO, NUMDOMICILIO, COMPLEMENTO, BAIRRO, CEP, IDESTADO, IDMUNICIPIO, REFERENCIA,
                IDCONSTRUCAO, IDESTCONSERVACAO, IDUTILIZACAO, IDTIPOUSO, IDESPECIEDOMICILIO, DATAINICIOMORARMUNICIP,
                DATAINICIOMORARDOMICILIO, QUANTCOMODOS, QUANTDORMIT, IDTIPOMATERIALPISOINT, IDTIPOMATERIALPAREDEEXT,
                QTAGUACANALIZADA, IDFORMAABASTECIMENTO,  IDFORMAESCOASANITARIO,  
                IDDESTINOLIXO, IDILUMINACAOCASA, VALAGUAESGOTO, VALENERGIA, VALALUGUEL, NUMFAMILIAS, IDDADOSOLICITANTE         
                ) VALUES (
                '" . $this->IDTIPOLOGRADOURO . "', '" . $this->NOMELOGRADOURO . "', '" . $this->NUMDOMICILIO . "',
                '" . $this->COMPLEMENTO . "', '" . $this->BAIRRO . "', '" . $this->CEP . "', '" . $this->IDESTADO . "',
                '" . $this->IDMUNICIPIO . "', '" . $this->REFERENCIA . "', '" . $this->IDCONSTRUCAO . "',
                '" . $this->IDESTCONSERVACAO . "', '" . $this->IDUTILIZACAO . "', '" . $this->IDTIPOUSO . "',
                '" . $this->IDESPECIEDOMICILIO . "', '" . $this->DATAINICIOMORARMUNICIP . "', '" . $this->DATAINICIOMORARDOMICILIO . "',
                '" . $this->QUANTCOMODOS . "', '" . $this->QUANTDORMIT . "', '" . $this->IDTIPOMATERIALPISOINT . "',
                '" . $this->IDTIPOMATERIALPAREDEEXT . "', '" . $this->QTAGUACANALIZADA . "', '" . $this->IDFORMAABASTECIMENTO . "',
                 '" . $this->IDFORMAESCOASANITARIO . "', 
                '" . $this->IDDESTINOLIXO . "', '" . $this->IDILUMINACAOCASA . "', '" . $this->VALAGUAESGOTO . "',
                '" . $this->VALENERGIA . "', '" . $this->VALALUGUEL . "', '" . $this->NUMFAMILIAS . "', 
                '" . $this->IDDADOSOLICITANTE . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que lista as cargo em um array para preencher o grid


    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM dd_dados_domicilio 
                WHERE IDDADODOMICILIO = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDDADODOMICILIO']);
            $this->setIDTIPOLOGRADOURO($linha['IDTIPOLOGRADOURO']);
            $this->setNOMELOGRADOURO($linha['NOMELOGRADOURO']);
            $this->setNUMDOMICILIO($linha['NUMDOMICILIO']);
            $this->setCOMPLEMENTO($linha['COMPLEMENTO']);
            $this->setBAIRRO($linha['BAIRRO']);
            $this->setCEP($linha['CEP']);
            $this->setIDESTADO($linha['IDESTADO']);
            $this->setIDMUNICIPIO($linha['IDMUNICIPIO']);
            $this->setREFERENCIA($linha['REFERENCIA']);
            $this->setIDCONSTRUCAO($linha['IDCONSTRUCAO']);
            $this->setIDESTCONSERVACAO($linha['IDESTCONSERVACAO']);
            $this->setIDUTILIZACAO($linha['IDUTILIZACAO']);
            $this->setIDTIPOUSO($linha['IDTIPOUSO']);
            $this->setIDESPECIEDOMICILIO($linha['IDESPECIEDOMICILIO']);
            $this->setDATAINICIOMORARMUNICIP($linha['DATAINICIOMORARMUNICIP']);
            $this->setDATAINICIOMORARDOMICILIO($linha['DATAINICIOMORARDOMICILIO']);
            $this->setQUANTCOMODOS($linha['QUANTCOMODOS']);
            $this->setQUANTDORMIT($linha['QUANTDORMIT']);
            $this->setIDTIPOMATERIALPISOINT($linha['IDTIPOMATERIALPISOINT']);
            $this->setIDTIPOMATERIALPAREDEEXT($linha['IDTIPOMATERIALPAREDEEXT']);
            $this->setQTAGUACANALIZADA($linha['QTAGUACANALIZADA']);
            $this->setIDFORMAABASTECIMENTO($linha['IDFORMAABASTECIMENTO']);
            $this->setIDFORMAESCOASANITARIO($linha['IDFORMAESCOASANITARIO']);
            $this->setIDDESTINOLIXO($linha['IDDESTINOLIXO']);
            $this->setIDILUMINACAOCASA($linha['IDILUMINACAOCASA']);
            $this->setVALAGUAESGOTO($linha['VALAGUAESGOTO']);
            $this->setVALENERGIA($linha['VALENERGIA']);
            $this->setVALALUGUEL($linha['VALALUGUEL']);
            $this->setNUMFAMILIAS($linha['NUMFAMILIAS']);
            $this->setIDDADOSOLICITANTE($linha['IDDADOSOLICITANTE']);
        }
    }

    public function ListaDadosDomicilioPesq($pesq = "") {

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