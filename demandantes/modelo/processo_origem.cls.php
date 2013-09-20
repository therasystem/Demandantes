<?php

require_once("../controle/conexao.gti.php");

class clsProcessoOrigem {

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
        $SQL = 'DELETE FROM processo_origem WHERE IDORIPROC=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma cargo
    function Alterar() {
        $SQL = "UPDATE processo_origem SET 
		NOMEPROC='" . $this->nome . "'
                WHERE IDORIPROC='" . $this->codigo . "'";
        
        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO processo_origem (NOMEPROC) VALUES 
                ('" . $this->nome . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que lista as cargo em um array para preencher o grid
    public function ListaOriProcPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Processo" width = "30px" align = "right"><a href = "processo_origem_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "50px">N&uacute;mero</th>
                <th align = "center" class = "small" width = "400px">Nome</th>
                <th align = "center" class = "small" width = "150px">Montar Processo</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT IDORIPROC, NOMEPROC
                FROM processo_origem ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(NOMEPROC) LIKE UPPER('%"   . $pesq . "%') ";
        }

        $SQL.=" ORDER BY NOMEPROC ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as  $chave =>  $linha) {
             
            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['IDORIPROC']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMEPROC']) . ' </td>
                <td align = "center"><a href = "processo.frm.php?idoriproc=' . htmlentities($linha['IDORIPROC']) . '"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "processo_origem_alteracao.frm.php?idoriproc=' . htmlentities($linha['IDORIPROC']) . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "processo_origem.exe.php?idoriproc=' . htmlentities($linha['IDORIPROC']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM processo_origem 
                WHERE IDORIPROC = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as  $chave =>  $linha) {

            $this->setCodigo($linha['IDORIPROC']);
            $this->setNome($linha['NOMEPROC']);
        }
    }
    
    public function ListaComboOriProcALL($idCargo = "") {
        $SQL = 'SELECT idoriproc as id,  nomeproc as nome
                FROM processo_origem ';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "<option value='0' selected>----   SELECIONE   ----</option>";

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