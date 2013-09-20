<?php

require_once("../controle/conexao.gti.php");

class clsItemCompra {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idcompra;
    private $idmaterial;
    private $idunidade;
    private $descricao;
    private $quantidade;
    private $idusuario;

    //Mï¿½TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdcompra() {
        return $this->idcompra;
    }

    public function setIdcompra($idcompra) {
        $this->idcompra = $idcompra;
    }

    public function getIdmaterial() {
        return $this->idmaterial;
    }

    public function setIdmaterial($idmaterial) {
        $this->idmaterial = $idmaterial;
    }

    public function getIdunidade() {
        return $this->idunidade;
    }

    public function setIdunidade($idunidade) {
        $this->idunidade = $idunidade;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    function __construct() {
        $this->codigo = "";
        $this->idcompra = "";
        $this->idmaterial = "";
        $this->idunidade = "";
        $this->descricao = "";
        $this->quantidade = "";
        $this->idusuario = "";
    }

    //Mï¿½todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM item WHERE IDITEM=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {
        //session_start();

        $SQL = "UPDATE item SET 
		IDMATERIAL='" . $this->idmaterial . "',
		IDUNIDADE='" . $this->idunidade . "',
		DESCITEM='" . $this->descricao . "',
		QUANTITEM='" . $this->quantidade . "',
		IDUSU='" . $_SESSION['codigo'] . "'
                WHERE IDITEM='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO item (IDCOMPRA, IDMATERIAL, IDUNIDADE, DESCITEM, QUANTITEM, IDUSU) VALUES 
                ('" . $_SESSION['idcompra'] . "', '" . $this->idmaterial . "', '" . $this->idunidade . "', '" . $this->descricao . "', '" . $this->quantidade . "', '" . $this->idusuario . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que lista as cargo em um array para preencher o grid
    public function ListaItemCompraPesq($idcompra = "", $pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Item de Compra" width = "30px" align = "right"><a href = "item_compra_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "30px">N&uacute;mero</th>
                <th align = "center" class = "small" width = "200px">Material</th>
                <th align = "center" class = "small" width = "30px">Quant.</th>
                <th align = "center" class = "small" width = "30px">Unid.</th> 
                <th align = "center" class = "small" width = "200px">Descrição</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT it.IDITEM, it.IDCOMPRA, ma.DESCMATERIAL, un.SIGLAUNID, it.QUANTITEM, it.DESCITEM
                FROM item it
                INNER JOIN material ma
                ON it.idmaterial = ma.idmaterial
                INNER JOIN unidade un
                ON it.idunidade = un.idunidade 
                WHERE it.IDCOMPRA = '" . $idcompra . "' ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);
/// olharrrrrrrrrrr
            $SQL.=" AND UPPER(DESCMATERIAL) LIKE UPPER('%" . $pesq . "%') OR UPPER(DESCITEM) LIKE UPPER('%" . $pesq . "%')";
        }

        $SQL.=" ORDER BY DESCMATERIAL ";
        //die($SQL);
        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $numeracao = 1;
         
        if ($tbl->RecordCount() > 0) {
            foreach ($tbl as $chave => $linha) {

                $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . $numeracao++ . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCMATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['QUANTITEM']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['SIGLAUNID']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCITEM']) . ' </td>
                <td align = "center"><a href = "item_compra_alteracao.frm.php?iditemcompra=' . htmlentities($linha['IDITEM']) . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "item_compra.exe.php?iditemcompra=' . htmlentities($linha['IDITEM']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
            }


            $html .= '</table> </table>';
        }



        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM item 
                WHERE IDITEM = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDITEM']);
            $this->setIdcompra($linha['IDCOMPRA']);
            $this->setIdmaterial($linha['IDMATERIAL']);
            $this->setIdunidade($linha['IDUNIDADE']);
            $this->setDescricao($linha['DESCITEM']);
            $this->setQuantidade($linha['QUANTITEM']);
            $this->setIdusuario($linha['IDUSU']);
        }
    }

    public function Liberado($codigo) {
        //session_start();

        $SQL = "SELECT AUTORIZACOMPRA1, AUTORIZACOMPRA2, IDUSU
                FROM compra 
                WHERE IDCOMPRA='" . $codigo . "' AND AUTORIZACOMPRA1 = 0 AND AUTORIZACOMPRA2 = 0";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        if ($tbl->RecordCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>