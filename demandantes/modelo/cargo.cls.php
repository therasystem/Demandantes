<?php

require_once("../controle/conexao.gti.php");

class clsCargo {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $nome;

    //M�TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

        function __construct() {
        $this->codigo = "";
        $this->nome = "";
    }

    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM cargo WHERE IDCARGO=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {
        $SQL = "UPDATE cargo SET 
		NOMECARGO='" . $this->nome . "'
                WHERE IDCARGO='" . $this->codigo . "'";
        
        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO cargo (NOMECARGO) VALUES 
                ('" . $this->nome . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
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

            $SQL.=" WHERE UPPER(NOMECARGO) LIKE UPPER('%"   . $pesq . "%') ";
        }

        $SQL.=" ORDER BY NOMECARGO ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as  $chave =>  $linha) {
             
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

        foreach ($tbl as  $chave =>  $linha) {

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