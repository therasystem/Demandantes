<?php

require_once("../controle/conexao.gti.php");

class clsFornecedor {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $contato;
    private $nome;
    private $cnpj;
    private $endereco;
    private $telefone1;
    private $telefone2;
    private $email;

    //Mï¿½TODOS------------------------------------------------------
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

    public function getContato() {
        return $this->contato;
    }

    public function setContato($contato) {
        $this->contato = $contato;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getTelefone1() {
        return $this->telefone1;
    }

    public function setTelefone1($telefone1) {
        $this->telefone1 = $telefone1;
    }

    public function getTelefone2() {
        return $this->telefone2;
    }

    public function setTelefone2($telefone2) {
        $this->telefone2 = $telefone2;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    function __construct() {
        $this->codigo = "";
        $this->nome = "";
        $this->contato = "";
        $this->cnpj = "";
        $this->endereco = "";
        $this->telefone1 = "";
        $this->telefone2 = "";
        $this->email = "";
    }

    //Mï¿½todo para excluir um fornecedor
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM fornecedor WHERE IDFORNECEDOR=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma fornecedor
    function Alterar() {
        $SQL = "UPDATE fornecedor SET 
		NOMEFORNECEDOR='" . $this->nome . "',
		CONTATOFORNECEDOR='" . $this->contato . "',
		CNPJFORNECEDOR='" . $this->cnpj . "',
		ENDFORNECEDOR='" . $this->endereco . "',
		TEL1FORNECEDOR='" . $this->telefone1 . "',
		TEL2FORNECEDOR='" . $this->telefone2 . "',
		EMAILFORNECEDOR='" . $this->email . "'
                WHERE IDFORNECEDOR='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que realiza o cadastro de um novo fornecedor
    public function Salvar() {

        $SQL = "INSERT INTO fornecedor (NOMEFORNECEDOR, CONTATOFORNECEDOR, CNPJFORNECEDOR, ENDFORNECEDOR, TEL1FORNECEDOR, TEL2FORNECEDOR, EMAILFORNECEDOR) VALUES 
                ('" . $this->nome . "', '" . $this->contato . "', '" . $this->cnpj . "', '" . $this->endereco . "', '" . $this->telefone1 . "', '" . $this->telefone2 . "', '" . $this->email . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que lista as fornecedor em um array para preencher o grid
    public function ListaFornecedorPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Fornecedor" width = "30px" align = "right"><a href = "fornecedor_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>';

        if (isset($_SESSION['tiponota'])) {
            if ($_SESSION['cargo'] == 1 || $_SESSION['cargo'] == 2 || $_SESSION['cargo'] == 5) {
                $html .= '<td title = "Lançar notas" width = "30px" align = "right"><a href = "notafiscalfinanceiro.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/bt_nota.jpg" width = "22" ></a></td>';
            }
        }

        $html .= '</tr> 
                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "180px">Nome</th>
                <th align = "center" class = "small" width = "90px">CNPJ</th>
                <th align = "center" class = "small" width = "110px">Telefone Principal</th> 
                <th align = "center" class = "small" width = "170px">Contato</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT IDFORNECEDOR, NOMEFORNECEDOR, CONTATOFORNECEDOR, CNPJFORNECEDOR, ENDFORNECEDOR, TEL1FORNECEDOR, TEL2FORNECEDOR, EMAILFORNECEDOR
                FROM fornecedor ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(NOMEFORNECEDOR) LIKE UPPER('%" . $pesq . "%') OR UPPER(CNPJFORNECEDOR) LIKE UPPER('%" . $pesq . "%')  OR 
                    UPPER(ENDFORNECEDOR) LIKE UPPER('%" . $pesq . "%')  OR UPPER(CONTATOFORNECEDOR) LIKE UPPER('%" . $pesq . "%')";
        }

        $SQL.=" ORDER BY NOMEFORNECEDOR ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "90px"> ' . htmlentities($linha['NOMEFORNECEDOR']) . ' </td>
                <td align = "center" class = "small" width = "80px"> ' . htmlentities($linha['CNPJFORNECEDOR']) . ' </td>
                <td align = "center" class = "small" width = "80px"> ' . htmlentities($linha['TEL1FORNECEDOR']) . ' </td> 
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['CONTATOFORNECEDOR']) . ' </td>
                <td align = "center"><a href = "fornecedor_alteracao.frm.php?idfornecedor=' . htmlentities($linha['IDFORNECEDOR']) . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "fornecedor.exe.php?idfornecedor=' . htmlentities($linha['IDFORNECEDOR']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }

        $html .= '</table> </table>';

        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM fornecedor 
                WHERE IDFORNECEDOR = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDFORNECEDOR']);
            $this->setNome($linha['NOMEFORNECEDOR']);
            $this->setContato($linha['CONTATOFORNECEDOR']);
            $this->setCnpj($linha['CNPJFORNECEDOR']);
            $this->setEndereco($linha['ENDFORNECEDOR']);
            $this->setTelefone1($linha['TEL1FORNECEDOR']);
            $this->setTelefone2($linha['TEL2FORNECEDOR']);
            $this->setEmail($linha['EMAILFORNECEDOR']);
        }
    }

    public function preencheDadosNome($cod) {

        $SQL = "SELECT *
                FROM fornecedor 
                WHERE NOMEFORNECEDOR = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDFORNECEDOR']);
            $this->setNome($linha['NOMEFORNECEDOR']);
            $this->setContato($linha['CONTATOFORNECEDOR']);
            $this->setCnpj($linha['CNPJFORNECEDOR']);
            $this->setEndereco($linha['ENDFORNECEDOR']);
            $this->setTelefone1($linha['TEL1FORNECEDOR']);
            $this->setTelefone2($linha['TEL2FORNECEDOR']);
            $this->setEmail($linha['EMAILFORNECEDOR']);
        }
    }

    public function ListaComboFornecedorALL($idFornecedor = "") {
        $SQL = 'SELECT idfornecedor as id,  nomefornecedor as nome
                FROM fornecedor ORDER BY nomefornecedor ';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);

            if ($id == $idFornecedor) {
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }

        return $drop;
    }

}

?>