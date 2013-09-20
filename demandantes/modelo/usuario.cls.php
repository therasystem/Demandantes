<?php

require_once("../controle/conexao.gti.php");

class clsUsuario {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $login;
    private $senha;
    private $nome;
    private $cargo;

    //Mï¿½TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    function __construct() {
        $this->codigo = "";
        $this->login = "";
        $this->senha = "";
        $this->nome = "";
        $this->cargo = "";
    }

    //Mï¿½todo para autenticar os usuarios cadastrados para acessar o sistema
    function Autentica($login, $senha) {
        $SQL = 'SELECT * FROM usuario WHERE login=\'' . trim($login) . '\' AND
        senha=md5(\'' . trim($senha) . '\');';
        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $existe = false;

        if ($tbl->RecordCount() > 0) {
            foreach ($tbl as $chave => $linha) {
                $this->codigo = $linha['ID'];
                $this->nome = $linha['NOME'];
                $this->login = $linha['LOGIN'];
                $this->senha = $linha['SENHA'];
                $this->cargo = $linha['CARGO'];
            }
            $existe = true;
        }

        return $existe;
    }

    public function ListaComboUsuarioCargoALL($idUsu = "") {
        $SQL = 'SELECT us.id, CONCAT(us.nome, " - ", ca.nomecargo) nome
                FROM usuario us
                INNER JOIN cargo ca
                ON us.cargo = ca.idcargo';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "";
        $select = "";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);

            if ($id == $idUsu) {
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
                $select = 1;
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }
        if ($select == "" && $idUsu != "") {
            $drop .= '<option value="0" selected>Não Selecionado</option>';
        }

        return $drop;
    }

    // Mï¿½todo que captura o usuario de acordo com o cï¿½digo informado

    function SelecionaPorCodigo($codigo) {
        $SQL = 'SELECT id, login, senha, nome FROM usuario WHERE id=\'' . trim($codigo) . '\';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        if ($tbl->RecordCount() > 0) {
            foreach ($tbl as $chave => $linha) {
                $this->codigo = $linha['id'];
                $this->login = $linha['login'];
                $this->senha = $linha['senha'];
                $this->nome = $linha['nome'];
            }
        } else {
            $this->__construct();
        }
    }

    public function Excluir($codigo) {

        $SQL = 'SELECT 	*  FROM obra WHERE idusu = ' . $codigo . ' OR idusu2 = ' . $codigo . '';

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        if ($tbl->RecordCount() <= 0) {

            $SQL = "SELECT *
                FROM usuario 
                WHERE CARGO = 1 AND ID='" . $codigo . "' ORDER BY ID";

            //die($SQL); 
            $con1 = new gtiConexao();
            $con1->gtiConecta();
            $tbl1 = $con1->gtiPreencheTabela($SQL);
            $con1->gtiDesconecta();
            $pos = -1;
            if ($tbl1->RecordCount() > 0) {
                $pos = $this->retornaPosicaoSocio($codigo);
            }
            //die('aaa'.$pos);
            $this->editaLiberacaoCompra($pos);
            //die();
            $SQL = 'DELETE FROM usuario WHERE ID=' . $codigo . ';';
            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();
            return true;
        } else {
            return false;
        }
    }

    //Metodo para alterar uma obra
    function Alterar() {
        $SQL = "UPDATE usuario SET 
		LOGIN='" . $this->login . "',
		SENHA=MD5('" . $this->senha . "'),
		NOME='" . $this->nome . "',
		CARGO='" . $this->cargo . "'
                WHERE ID='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO usuario (LOGIN, SENHA, NOME, CARGO) VALUES 
                ('" . $this->login . "',MD5('" . $this->senha . "'),'" . $this->nome . "','" . $this->cargo . "')";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();

        if ($this->cargo == 1) {
            $this->editaLiberacaoCompraInsert();
        }
    }

    //Mï¿½todo que lista as obras em um array para preencher o grid
    public function ListaUsuarioPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>';

        if ($this->verificaSeCargoDeSocio()) {
            $html .= '<td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Usu&aacute;rio" width = "30px" align = "right"><a href = "usuario_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>';
        }
        $html .= '</tr>
                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "100px">Nome</th>
                <th align = "center" class = "small" width = "100px">Login</th>
                <th align = "center" class = "small" width = "230px">Cargo</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';

        if ($this->verificaSeCargoDeSocio()) {
            $SQL = "SELECT us.ID, us.LOGIN , us.NOME, ca.NOMECARGO
                FROM usuario us
                LEFT JOIN cargo ca
                ON us.CARGO = ca.IDCARGO 
                WHERE 1=1";
        } else {
            $SQL = "SELECT us.ID, us.LOGIN , us.NOME, ca.NOMECARGO
                FROM usuario us
                LEFT JOIN cargo ca
                ON us.CARGO = ca.IDCARGO 
                WHERE ID = " . $_SESSION['codigo'];
        }

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" AND UPPER(us.login) LIKE UPPER('%" . $pesq . "%') OR UPPER(us.nome) LIKE UPPER('%" . $pesq . "%') OR UPPER(ca.NOMECARGO) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY us.NOME ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {
            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "250px"> ' . htmlentities($linha['NOME']) . ' </td>
                <td align = "center" class = "small" width = "150px"> ' . htmlentities($linha['LOGIN']) . ' </td>
                <td align = "center" class = "small" width = "170px"> ' . htmlentities($linha['NOMECARGO']) . ' </td>
                <td align = "center"><a href = "usuario_alteracao.frm.php?idusuario=' . htmlentities($linha['ID']) . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "usuario.exe.php?idusuario=' . htmlentities($linha['ID']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';


        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM usuario ob
                WHERE ID = '" . $cod . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['ID']);
            $this->setLogin($linha['LOGIN']);
            $this->setNome($linha['NOME']);
            $this->setCargo($linha['CARGO']);
        }
    }

    public function verificaSocio($resp) {

        $SQL = "SELECT *
                FROM usuario 
                WHERE CARGO = 1
                ORDER BY ID";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $count = 0;
        foreach ($tbl as $chave => $linha) {
            if ($count == $resp) {
                if ($linha['ID'] == $_SESSION['codigo']) {
                    return true;
                } else {
                    return false;
                }
            }
            $count++;
        }
    }

    public function retornaPosicaoSocio($codigo) {

        $SQL = "SELECT *
                FROM usuario 
                WHERE CARGO = 1 ORDER BY ID";

        //die($SQL); 
        $con2 = new gtiConexao();
        $con2->gtiConecta();
        $tbl2 = $con2->gtiPreencheTabela($SQL);
        $con2->gtiDesconecta();
        $count = 0;
        foreach ($tbl2 as $chave => $linha) {
            if ($codigo == $linha['ID']) {
                return $count;
            }
            $count++;
        }
    }

    public function editaLiberacaoCompra($posicao) {

        $SQL = "SELECT IDCOMPRA, LIBERACAOCOMPRA
                FROM compra WHERE AUTORIZACOMPRA1 > 0 AND AUTORIZACOMPRA1 > 0 ";

        //die($SQL); 
        $con2 = new gtiConexao();
        $con2->gtiConecta();
        $tbl2 = $con2->gtiPreencheTabela($SQL);
        $con2->gtiDesconecta();

        foreach ($tbl2 as $chave => $linha) {

            $bin = decbin($linha['LIBERACAOCOMPRA']);

            $totalSocio = $this->buscaNumSocio();
            while (strlen($bin) != $totalSocio) {
                $bin = "0" . $bin;
            }

            $bin{$posicao} = "";

            $SQL = "UPDATE compra SET  
		LIBERACAOCOMPRA='" . bindec($bin) . "'
                WHERE IDCOMPRA='" . $linha['IDCOMPRA'] . "'";

            //die($SQL);

            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();
        }
    }

    public function buscaNumSocio() {

        $SQL = "SELECT COUNT(1) NUM
                FROM USUARIO WHERE CARGO = 1";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {
            return $linha['NUM'];
        }
    }

    public function editaLiberacaoCompraInsert() {

        $SQL = "SELECT IDCOMPRA, LIBERACAOCOMPRA
                FROM compra WHERE AUTORIZACOMPRA1 > 0 AND AUTORIZACOMPRA1 > 0 ";

        //die($SQL); 
        $con2 = new gtiConexao();
        $con2->gtiConecta();
        $tbl2 = $con2->gtiPreencheTabela($SQL);
        $con2->gtiDesconecta();

        foreach ($tbl2 as $chave => $linha) {

            $bin = decbin($linha['LIBERACAOCOMPRA']);

            $totalSocio = $this->buscaNumSocio();
            while (strlen($bin) != $totalSocio) {
                $bin = "0" . $bin;
            }

            $bin = $bin . "0";

            $SQL = "UPDATE compra SET  
		LIBERACAOCOMPRA='" . bindec($bin) . "'
                WHERE IDCOMPRA='" . $linha['IDCOMPRA'] . "'";

            //die($SQL);

            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();
        }
    }

    public function verificaSeCargoDeSocio() {

        $SQL = "SELECT *
                FROM usuario 
                WHERE (CARGO = 1 OR CARGO = 2) AND ID = " . $_SESSION['codigo'] . "
                ORDER BY ID";

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