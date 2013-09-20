<?php

require_once("../controle/conexao.gti.php");

class clsMaterial {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $descricao;
    private $tipo;

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function __construct() {
        $this->codigo = "";
        $this->descricao = "";
        $this->tipo = "";
    }

    public function Excluir($codigo) {
        $SQL = 'DELETE FROM material WHERE IDMATERIAL=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {
        $SQL = "UPDATE material SET 
		DESCMATERIAL='" . $this->descricao . "',
                TIPOMATERIAL='" . $this->tipo . "'
                WHERE IDMATERIAL='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO material (DESCMATERIAL, TIPOMATERIAL) VALUES 
                ('" . $this->descricao . "', '" . $this->tipo . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que lista as cargo em um array para preencher o grid
    public function ListaMaterialPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Material" width = "30px" align = "right"><a href = "material_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "500px">Material</th>
                <th align = "center" class = "small" width = "150px">Tipo</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT IDMATERIAL, DESCMATERIAL, TIPOMATERIAL
                FROM material ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(DESCMATERIAL) LIKE UPPER('%" . $pesq . "%') OR UPPER(TIPOMATERIAL) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY DESCMATERIAL ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCMATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['TIPOMATERIAL']) . ' </td>
                <td align = "center"><a href = "material_alteracao.frm.php?idmaterial=' . htmlentities($linha['IDMATERIAL']) . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "material.exe.php?idmaterial=' . htmlentities($linha['IDMATERIAL']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM material 
                WHERE IDMATERIAL = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDMATERIAL']);
            $this->setDescricao($linha['DESCMATERIAL']);
            $this->setTipo($linha['TIPOMATERIAL']);
        }
    }

    public function ListaComboMaterialALL($idUnidade = "") {
        $SQL = 'SELECT IDMATERIAL as id, DESCMATERIAL as nome
                FROM material 
                ORDER BY DESCMATERIAL';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "<option value='0' selected>---------  SELECIONE  ---------</option>";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);

            if ($id == $idUnidade) {
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }

        return $drop;
    }

    public function ListaComboMaterialEstoque($idcentro = "") {

        $idobra = 0;

        $SQL = 'SELECT IDOBRA FROM centro_custo WHERE IDCENTRO =' . $idcentro;
        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl1 = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        foreach ($tbl1 as $chave => $linha1) {
            $idobra = $linha1['IDOBRA'];
        }

        $SQL = 'SELECT it.IDMATERIAL
                FROM material_nota mn
                INNER JOIN item it
                ON mn.IDITEM = it.IDITEM
                INNER JOIN compra cp
                ON it.IDCOMPRA = cp.IDCOMPRA 
                WHERE cp.IDOBRA =' . $idobra;
        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl2 = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        foreach ($tbl2 as $chave => $linha2) {
            $idmaterial .= $linha2['IDMATERIAL'].', ';
        } 
        
        $SQL = 'SELECT IDMATERIAL
                FROM add_estoque 
                WHERE IDOBRA =' . $idobra;
        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl3 = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        foreach ($tbl3 as $chave => $linha3) {
            $idmaterial .= $linha3['IDMATERIAL'].', ';
        } 
        $idmaterial.='0';

        $SQL = 'SELECT IDMATERIAL as id, DESCMATERIAL as nome
                FROM material 
                WHERE IDMATERIAL IN ('.$idmaterial.')
                ORDER BY DESCMATERIAL';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "<option value='0' selected>---------  SELECIONE  ---------</option>";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);

            if ($id == $idUnidade) {
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }

        return $drop;
    }

    public function ListaComboMaterialPorCompra($idCompra = "") {
        $SQL = 'SELECT IDITEM AS id, DESCMATERIAL AS nome
                FROM item it 
                INNER JOIN material ma
                ON it.IDMATERIAL = ma.IDMATERIAL
                WHERE it.IDCOMPRA = "' . $idCompra . '" 
                ORDER BY DESCMATERIAL';
        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "<option value='0' selected>-------------------  SELECIONE  -------------------</option>";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);

            $drop .= '<option value="' . $id . '">' . $nome . '</option>';
        }

        return $drop;
    }

}

?>