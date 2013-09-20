<?php

require_once("../controle/conexao.gti.php");

class clsObra {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $CEI;
    private $descricao;
    private $endereco;
    private $data;
    private $id_usuario;
    private $id_usuario2;
    private $numero;
    private $ordemcompra;

    //M�TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCEI() {
        return $this->CEI;
    }

    public function setCEI($CEI) {
        $this->CEI = $CEI;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getId_usuario2() {
        return $this->id_usuario2;
    }

    public function setId_usuario2($id_usuario2) {
        $this->id_usuario2 = $id_usuario2;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getOrdemcompra() {
        return $this->ordemcompra;
    }

    public function setOrdemcompra($ordemcompra) {
        $this->ordemcompra = $ordemcompra;
    }

    function __construct() {
        $this->codigo = "";
        $this->CEI = "";
        $this->descricao = "";
        $this->endereco = "";
        $this->data = "";
        $this->id_usuario = "";
        $this->id_usuario2 = "";
        $this->numero = "";
        $this->ordemcompra = "";
    }

    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM obra WHERE IDOBRA=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma obra
    function Alterar() {
        $SQL = "UPDATE obra SET 
		CEIOBRA='" . $this->CEI . "',
		ENDOBRA='" . $this->endereco . "',
		DESCOBRA='" . $this->descricao . "',
		DATAOBRA='" . $this->data . "',
		IDUSU='" . $this->id_usuario . "',
		IDUSU2='" . $this->id_usuario2 . "',
		NUMOBRA='" . $this->numero . "',
		ORDEMCOMPRA='" . $this->ordemcompra . "'
                WHERE IDOBRA='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO obra (CEIOBRA, ENDOBRA, DESCOBRA, DATAOBRA, IDUSU, IDUSU2, NUMOBRA, ORDEMCOMPRA) VALUES 
                ('" . $this->CEI . "','" . $this->endereco . "','" . $this->descricao . "','" . $this->data . "','" . $this->id_usuario . "','" . $this->id_usuario2 . "','" . $this->numero . "','" . $this->ordemcompra . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que lista as obras em um array para preencher o grid
    public function ListaObraPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Obra" width = "30px" align = "right"><a href = "obra_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "100px">N&uacute;mero</th>
                <th align = "center" class = "small" width = "100px">CEI</th>
                <th align = "center" class = "small" width = "230px">Descri&ccedil;&atilde;o</th>
                <th align = "center" class = "small" width = "170px">Nome do Respons&aacute;vel</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT ob.IDOBRA, ob.CEIOBRA, ob.NUMOBRA, ob.DATAOBRA, SUBSTRING(ob.DESCOBRA FROM 1 FOR 65 ) AS DESCOBRA, us.NOME
                FROM obra ob
                LEFT JOIN usuario us
                ON ob.IDUSU = us.ID ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(OB.DESCOBRA) LIKE UPPER('%" . $pesq . "%') OR UPPER(OB.CEIOBRA) LIKE UPPER('%" . $pesq . "%') OR UPPER(ob.DATAOBRA) LIKE UPPER('%" . $pesq . "%') OR UPPER(ob.NUMOBRA) LIKE UPPER('%" . $pesq . "%') OR UPPER(us.NOME) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY ob.NUMOBRA ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {
            if (strlen($linha['DESCOBRA']) == 65) {
                $desc = htmlentities($linha['DESCOBRA']) . " ...";
            } else {
                $desc = htmlentities($linha['DESCOBRA']);
            }

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMOBRA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['CEIOBRA']) . ' </td>
                <td align = "center" class = "small" width = "230px"> ' . $desc . ' </td>
                <td align = "center" class = "small" width = "170px"> ' . htmlentities($linha['NOME']) . ' </td>
                <td align = "center"><a href = "obra_alteracao.frm.php?idobra=' . htmlentities($linha['IDOBRA']) . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "obra.exe.php?idobra=' . htmlentities($linha['IDOBRA']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM obra ob
                WHERE IDOBRA = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDOBRA']);
            $this->setCEI($linha['CEIOBRA']);
            $this->setEndereco($linha['ENDOBRA']);
            $this->setDescricao($linha['DESCOBRA']);
            $this->setData($linha['DATAOBRA']);
            $this->setId_usuario($linha['IDUSU']);
            $this->setId_usuario2($linha['IDUSU2']);
            $this->setNumero($linha['NUMOBRA']);
            $this->setOrdemcompra($linha['ORDEMCOMPRA']);
        }
    }

    public function ListaComboObraALL() {
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

    public function ListaComboObraALLPesc($idobra = "") {
        $SQL = 'SELECT IDOBRA as id,  DESCOBRA as nome
                FROM obra 
                ORDER BY DESCOBRA';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "<option value='0' selected>---------  SELECIONE  ---------</option>";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);

            if ($id == $idobra) {
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }

        return $drop;
    }

    public function ListaComboCentroALLPesc($cod = "") {

        $sql = "SELECT cc1.idcentro AS id, CONCAT(cc1.desccentro,' ( ', cc.desccentro,' ) ')   AS nome, cc1.desccentro AS nome1
                FROM centro_custo cc
                RIGHT JOIN centro_custo cc1
                ON cc.idcentro = cc1.idrelaciona
                WHERE cc1.idobra =" . $cod . "
                ORDER BY cc1.idrelaciona";
        
        //die('aaaaaaaaaaaaaaaaaa'.$sql);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($sql);
        $con->gtiDesconecta();

        $drop = '<option value="0">-- Selecione --</option><option value="-1">-- Obra Inteira --</option>';

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            if ($linha['nome'] == null) {
                $nome = $linha['nome1'];
            } else {
                $nome = $linha['nome'];
            }
 
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
  
        }

        return $drop;
    }

}

?>