<?php

require_once("../controle/conexao.gti.php");

class clsAddEstoque {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idobra;
    private $idmaterial;
    private $idunidade;
    private $quantidade;
    private $dataentrada;

    //M�TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdobra() {
        return $this->idobra;
    }

    public function setIdobra($idobra) {
        $this->idobra = $idobra;
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

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getDataentrada() {
        return $this->dataentrada;
    }

    public function setDataentrada($dataentrada) {
        $this->dataentrada = $dataentrada;
    }

    function __construct() {
        $this->codigo = "";
        $this->idobra = "";
        $this->idmaterial = "";
        $this->idunidade = "";
        $this->quantidade = "";
        $this->dataentrada = "";
    }

    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM add_estoque WHERE IDESTOQUE=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {
        $SQL = "UPDATE add_estoque SET 
		IDOBRA='" . $this->idobra . "',
		IDMATERIAL='" . $this->idmaterial . "',
		IDUNIDADE='" . $this->idunidade . "',
		QUANTESTOQUE='" . $this->quantidade . "',
		DATAENTESTOQUE='" . $this->dataentrada . "'
                WHERE IDESTOQUE='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO add_estoque (IDOBRA, IDMATERIAL, IDUNIDADE, QUANTESTOQUE, DATAENTESTOQUE) VALUES 
                ('" . $this->idobra . "','" . $this->idmaterial . "','" . $this->idunidade . "','" . $this->quantidade . "','" . $this->dataentrada . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que lista as cargo em um array para preencher o grid
    public function ListaEstoquePesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar ao Estoque" width = "30px" align = "right"><a href = "add_estoque_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "150px">Obra</th>
                <th align = "center" class = "small" width = "250px">Material</th>
                <th align = "center" class = "small" width = "50px">Quant.</th>
                <th align = "center" class = "small" width = "80px">Data Entrada</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT ob.DESCOBRA, ae.IDESTOQUE, mat.DESCMATERIAL, CONCAT(mat.DESCMATERIAL, ' / ', un.SIGLAUNID) AS MATERIAL, ae.QUANTESTOQUE, ae.DATAENTESTOQUE
                FROM add_estoque ae
                INNER JOIN obra ob
                ON ae.IDOBRA = ob.IDOBRA
                INNER JOIN material mat
                ON ae.IDMATERIAL = mat.IDMATERIAL
                INNER JOIN unidade un
                ON ae.IDUNIDADE = un.IDUNIDADE ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(ob.DESCOBRA) LIKE UPPER('%" . $pesq . "%') OR UPPER(mat.DESCMATERIAL) LIKE UPPER('%" . $pesq . "%') OR UPPER(ae.DATAENTESTOQUE) LIKE UPPER('%" . $pesq . "%') OR UPPER(ae.QUANTESTOQUE) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY ob.DESCOBRA, mat.DESCMATERIAL ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCOBRA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['MATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['QUANTESTOQUE']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAENTESTOQUE']) . ' </td>
                <td align = "center"><a href = "add_estoque_alteracao.frm.php?idestoque=' . htmlentities($linha['IDESTOQUE']) . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "add_estoque.exe.php?idestoque=' . htmlentities($linha['IDESTOQUE']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM add_estoque 
                WHERE IDESTOQUE = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDESTOQUE']);
            $this->setIdobra($linha['IDOBRA']);
            $this->setIdmaterial($linha['IDMATERIAL']);
            $this->setIdunidade($linha['IDUNIDADE']);
            $this->setQuantidade($linha['QUANTESTOQUE']);
            $this->setDataentrada($linha['DATAENTESTOQUE']);
        }
    }

}

?>