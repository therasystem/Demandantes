<?php

require_once("../controle/conexao.gti.php");

class clsMaterialNota {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idnota;
    private $iditem;
    private $quantMatNota;

    //M�TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdnota() {
        return $this->idnota;
    }

    public function setIdnota($idnota) {
        $this->idnota = $idnota;
    }

    public function getIditem() {
        return $this->iditem;
    }

    public function setIditem($iditem) {
        $this->iditem = $iditem;
    }

    public function getQuantMatNota() {
        return $this->quantMatNota;
    }

    public function setQuantMatNota($quantMatNota) {
        $this->quantMatNota = $quantMatNota;
    }

    function __construct() {
        $this->codigo = "";
        $this->idnota = "";
        $this->iditem = "";
        $this->quantMatNota = "";
    }

    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM material_nota WHERE IDNOTA=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {
        $SQL = "UPDATE material_nota SET 
		IDNOTA='" . $this->idnota . "',
		IDITEM='" . $this->iditem . "',
		QUANTMATNOTA='" . $this->quantMatNota . "'
                WHERE IDMATNOTA='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar($numInteracao) {
        $i = 0;
        while ($numInteracao > $i) {

            $SQL = "INSERT INTO material_nota (IDNOTA, IDITEM, QUANTMATNOTA) VALUES 
                ('" . $this->idnota . "','" . $this->iditem . "','" . $this->quantMatNota . "');";

            $this->idnota--;
            $i++;
            $this->quantMatNota = 0;
            //die($SQL);

            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();
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

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM cargo 
                WHERE IDCARGO = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDCARGO']);
            $this->setNome($linha['NOMECARGO']);
        }
    }

    public function ListaComboCargoALL($idCargo = "") {
        $SQL = 'SELECT ca.idcargo as id,  ca.nomecargo as nome
                FROM cargo ca ';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);

            if ($id == $idCargo) {
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }

        return $drop;
    }

    public function ListaComboCargoTiraSocio($idCargo = "") {
        $SQL = 'SELECT ca.idcargo as id,  ca.nomecargo as nome
                FROM cargo ca 
                WHERE ca.idcargo <> 1';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);

            if ($id == $idCargo) {
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }

        return $drop;
    }

}

?>