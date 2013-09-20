<?php

require_once("../controle/conexao.gti.php");

class clsCentroCusto {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idobra;
    private $descCentro;
    private $idrelaciona;

    //Mï¿½TODOS------------------------------------------------------
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

    public function getDescCentro() {
        return $this->descCentro;
    }

    public function setDescCentro($descCentro) {
        $this->descCentro = $descCentro;
    }

    public function getIdrelaciona() {
        return $this->idrelaciona;
    }

    public function setIdrelaciona($idrelaciona) {
        $this->idrelaciona = $idrelaciona;
    }

    function __construct() {
        $this->codigo = "";
        $this->idobra = "";
        $this->descCentro = "";
        $this->idrelaciona = "";
    }

    //Mï¿½todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM centro_custo WHERE IDCENTRO=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO centro_custo (IDOBRA, DESCCENTRO, IDRELACIONA) VALUES 
                ('" . $this->idobra . "','" . $this->descCentro . "','" . $this->idrelaciona . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que lista as cargo em um array para preencher o grid
    public function ListaCentroPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Centro de Custo" width = "30px" align = "right"><a href = "centro_custo_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "250px">Obra</th>
                <th align = "center" class = "small" width = "150px">Descrição</th>
                <th align = "center" class = "small" width = "100px">Ver Estoque</th>
                <th align = "center" class = "small" width = "180px">Acessar Centro de Custo</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT cc.IDCENTRO, cc.IDOBRA, cc.DESCCENTRO, ob.DESCOBRA
                FROM centro_custo cc
                INNER JOIN obra ob
                ON cc.IDOBRA = ob.IDOBRA
                WHERE IDRELACIONA = 0";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" AND UPPER(cc.DESCCENTRO) LIKE UPPER('%" . $pesq . "%') OR UPPER(ob.DESCOBRA) LIKE UPPER('%" . $pesq . "%')  ";
        }

        $SQL.=" ORDER BY ob.DESCOBRA, cc.DESCCENTRO ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCOBRA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCCENTRO']) . ' </td>
                <td align = "center"><a href = "visualiza_estoque.frm.php?idobra=' . htmlentities($linha['IDOBRA']) . '"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "centro_custo.frm.php?idcentro=' . htmlentities($linha['IDCENTRO']) . '&metodo=2"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "centro_custo.exe.php?idcentro=' . htmlentities($linha['IDCENTRO']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function ListaCentroMateriPesq($idcentro, $metodo = "") {

        $SQL = "SELECT cc.IDCENTRO, cc.DESCCENTRO
                FROM centro_custo cc 
                WHERE IDCENTRO =" . $idcentro;

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {
            $nomeCentro = htmlentities($linha['DESCCENTRO']);
        }

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr> 
                <td align = "right">Adicionar Sub Centro de Custo - ' . $nomeCentro . ':</td>
                <td title = "Centro de Custo" width = "30px" align = "right"><a href = "centro_custo_alteracao_segundo.frm.php?idcentro=' . $idcentro . '&metodo=3"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>
                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "250px">Centro de Custo</th>
                <th align = "center" class = "small" width = "250px">Sub Centro de Custo</th>
                <th align = "center" class = "small" width = "180px">Acessar Sub Centro de Custo</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT cc.IDCENTRO, cc.IDOBRA, cc.DESCCENTRO, ob.DESCOBRA
                FROM centro_custo cc
                INNER JOIN obra ob
                ON cc.IDOBRA = ob.IDOBRA
                WHERE IDRELACIONA =" . $idcentro;

        $SQL.=" ORDER BY ob.DESCOBRA, cc.DESCCENTRO ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . $nomeCentro . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCCENTRO']) . ' </td>
                <td align = "center"><a href = "centro_custo.frm.php?idcentro=' . htmlentities($linha['IDCENTRO']) . '&metodo=2"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "centro_custo.exe.php?idcentro=' . htmlentities($linha['IDCENTRO']) . '&metodo=4"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';




        $html .= '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr> 
                <td align = "right">Executar Retirada no ' . $nomeCentro . ':</td>
                <td title = "Centro de Custo" width = "30px" align = "right"><a href = "retirada_estoque_alteracao.frm.php?idcentro=' . $idcentro . '"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/cancelar.png" width = "22" ></a></td>
                </tr>
                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "350px">Material</th>
                <th align = "center" class = "small" width = "150px">Quantidade</th>
                <th align = "center" class = "small" width = "150px">Data Retirada</th>
                <th align = "center" class = "small" width = "100px">Apagar</th>
                </tr>';


        $SQL = "SELECT IDRETIRADA, cc.IDCENTRO, cc.IDRELACIONA, mat.DESCMATERIAL, 
                CONCAT(mat.DESCMATERIAL, ' / ', und.SIGLAUNID) AS MATERIAL, re.QUANTRETIRADA, re.DATARETESTOQUE
                FROM retirada_estoque re
                INNER JOIN obra ob
                ON re.IDOBRA = ob.IDOBRA
                INNER JOIN material mat
                ON re.IDMATERIAL = mat.IDMATERIAL
                INNER JOIN unidade und
                ON re.IDUNIDADE = und.IDUNIDADE 
                INNER JOIN centro_custo cc
                ON re.IDCENTRO = cc.IDCENTRO 
                WHERE cc.IDCENTRO =" . $idcentro;

        $SQL.=" ORDER BY mat.DESCMATERIAL ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['MATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['QUANTRETIRADA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATARETESTOQUE']) . ' </td>
                <td align = "center"><a href = "retirada_estoque.exe.php?idcentro=' . htmlentities($linha['IDCENTRO']) . '&idretirada=' . htmlentities($linha['IDRETIRADA']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';




        return $html;
    }

    public function ListaEstoque($idobra) {


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "650px">Material</th>
                <th align = "center" class = "small" width = "250px">Estoque</th>
                </tr>';


        $arrayNota = array();
        $arrayAdicao = array();
        $arrayRetiraEstoque = array();

        $arrayNota = $this->arrayNota($idobra);
        $arrayAdicao = $this->arrayAdicao($idobra);
        $arrayRetiraEstoque = $this->arrayRetirada($idobra);

        $associaPlusEstoque = array_intersect_key($arrayNota, $arrayAdicao);
        $chavesAssociadas = array_keys($associaPlusEstoque);
        unset($associaPlusEstoque);

        for ($i = 0; $i < count($chavesAssociadas); $i++) {

            $arrayNota[$chavesAssociadas[$i]] += $arrayAdicao[$chavesAssociadas[$i]];
            unset($arrayAdicao[$chavesAssociadas[$i]]);
        }

        //$aditivosTotais = array_merge($arrayNota, $arrayAdicao);
        $aditivosTotais = $arrayNota + $arrayAdicao;
        $associaOutEstoque = array_intersect_key($aditivosTotais, $arrayRetiraEstoque);
        $chavesAssociadasSaida = array_keys($associaOutEstoque);

        unset($associaOutEstoque);

        for ($i = 0; $i < count($chavesAssociadasSaida); $i++) {

            $aditivosTotais[$chavesAssociadasSaida[$i]] -= $arrayRetiraEstoque[$chavesAssociadasSaida[$i]];
            unset($arrayRetiraEstoque[$chavesAssociadasSaida[$i]]);
        }
        ksort($aditivosTotais);

        //die(print_r($chavesAssociadasSaida));
        //die(print_r($aditivosTotais));
        //die(print_r($chavesAssociadas));
        //die(print_r($associaPlusEstoque));
        //die(print_r($arrayNota));
        //die(print_r($arrayAdicao));
        //die(print_r($arrayRetiraEstoque));

        $chavesFinal = array_keys($aditivosTotais);

        for ($i = 0; $i < count($chavesFinal); $i++) {
            if ($aditivosTotais[$chavesFinal[$i]] >= 0) {
                $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . $chavesFinal[$i] . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $aditivosTotais[$chavesFinal[$i]] . ' </td>
                </tr>';
            } else {
                $html .= ' <tr height = "1" style="background-color: lightcoral">
                <td align = "center" class = "small" width = "100px"> ' . $chavesFinal[$i] . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $aditivosTotais[$chavesFinal[$i]] . ' </td>
                </tr>';
            }
        }


        $html .= '</table> </table>';

        return $html;
    }

    public function RetornaCentroCusto($idcentro) {

        $SQL = "SELECT *
                FROM centro_custo
                WHERE IDCENTRO =" . $idcentro;

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {
            $this->setIdobra($linha['IDOBRA']);
            $this->setIdrelaciona($linha['IDRELACIONA']);
            $this->setDescCentro($linha['DESCCENTRO']);
        }
    }

    public function arrayNota($idobra) {


        $SQL = "SELECT mt.IDMATERIAL, SUM(mn.QUANTMATNOTA) AS ESTOQUE, 
                CONCAT(mt.DESCMATERIAL, ' / ', un.SIGLAUNID) AS MATERIAL,
                mt.TIPOMATERIAL
                FROM notafiscal nf
                INNER JOIN compra cp
                ON nf.IDCOMPRA = cp.IDCOMPRA
                INNER JOIN obra ob
                ON cp.IDOBRA = ob.IDOBRA
                INNER JOIN material_nota mn
                ON nf.IDNOTA = mn.IDNOTA
                INNER JOIN item it
                ON mn.IDITEM = it.IDITEM
                INNER JOIN material mt
                ON it.IDMATERIAL = mt.IDMATERIAL
                INNER JOIN unidade un
                ON it.IDUNIDADE = un.IDUNIDADE
                WHERE ob.IDOBRA =" . $idobra . "
                GROUP BY it.IDMATERIAL
                ORDER BY mt.DESCMATERIAL";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL); 
        $arrayNota = array();
        foreach ($tbl as $chave => $linha) {
            if ($linha['TIPOMATERIAL'] != "CONTA")
                $arrayNota[$linha['MATERIAL']] = $linha['ESTOQUE'];
        }

        //die(print_r($arrayNota));

        return $arrayNota;
    }

    public function arrayAdicao($idobra) {

        $SQL = "SELECT mt.IDMATERIAL, SUM(ae.QUANTESTOQUE) AS ESTOQUE,
                CONCAT(mt.DESCMATERIAL, ' / ', un.SIGLAUNID) AS MATERIAL,
                mt.TIPOMATERIAL
                FROM add_estoque ae
                INNER JOIN material mt
                ON ae.IDMATERIAL = mt.IDMATERIAL
                INNER JOIN unidade un
                ON ae.IDUNIDADE = un.IDUNIDADE
                WHERE ae.IDOBRA =" . $idobra . "
                GROUP BY ae.IDMATERIAL";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl2 = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

//die($SQL);
        $arrayAddEstoque = array();
        foreach ($tbl2 as $chave => $linha) {
            if ($linha['TIPOMATERIAL'] != "CONTA")
                $arrayAddEstoque[$linha['MATERIAL']] = $linha['ESTOQUE'];
        }

        //die(print_r($arrayNota));

        return $arrayAddEstoque;
    }

    public function arrayRetirada($idobra) {

        $SQL = "SELECT re.IDOBRA, re.IDMATERIAL, SUM(re.QUANTRETIRADA) ESTOQUE,
                CONCAT(mt.DESCMATERIAL, ' / ', un.SIGLAUNID) AS MATERIAL,
                mt.TIPOMATERIAL
                FROM retirada_estoque re
                INNER JOIN material mt
                ON re.IDMATERIAL = mt.IDMATERIAL
                INNER JOIN unidade un
                ON re.IDUNIDADE = un.IDUNIDADE
                WHERE IDOBRA =" . $idobra . "
                GROUP BY IDMATERIAL";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl4 = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

//die($SQL);
        $arrayRetiraEstoque = array();
        foreach ($tbl4 as $chave => $linha) {
            if ($linha['TIPOMATERIAL'] != "CONTA")
            $arrayRetiraEstoque[$linha['MATERIAL']] = $linha['ESTOQUE'];
        }

        return $arrayRetiraEstoque;
    }
    
    
    public function ListaComboCentroALL() {
        $SQL = 'SELECT IDOBRA as id,  DESCOBRA as nome
                FROM obra ';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "";

        $drop .= '<option value="0">Selecione uma Obra</option>';

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);

            $drop .= '<option value="' . $id . '">' . $nome . '</option>';
        }

        return $drop;
    }
    

}

?>