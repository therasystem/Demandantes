<?php

require_once("../controle/conexao.gti.php");

class clsUsuario {

    private $codigo;
    private $NOMEUSU;
    private $LOGINUSU;
    private $SENHAUSU;
    private $IDENTIDADE;
    private $IDPERMISSAO;

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNOMEUSU() {
        return $this->NOMEUSU;
    }

    public function setNOMEUSU($NOMEUSU) {
        $this->NOMEUSU = $NOMEUSU;
    }

    public function getLOGINUSU() {
        return $this->LOGINUSU;
    }

    public function setLOGINUSU($LOGINUSU) {
        $this->LOGINUSU = $LOGINUSU;
    }

    public function getSENHAUSU() {
        return $this->SENHAUSU;
    }

    public function setSENHAUSU($SENHAUSU) {
        $this->SENHAUSU = $SENHAUSU;
    }

    public function getIDENTIDADE() {
        return $this->IDENTIDADE;
    }

    public function setIDENTIDADE($IDENTIDADE) {
        $this->IDENTIDADE = $IDENTIDADE;
    }

    public function getIDPERMISSAO() {
        return $this->IDPERMISSAO;
    }

    public function setIDPERMISSAO($IDPERMISSAO) {
        $this->IDPERMISSAO = $IDPERMISSAO;
    }

    function __construct() {

        $this->IDUSUARIO = "";
        $this->NOMEUSU = "";
        $this->LOGINUSU = "";
        $this->SENHAUSU = "";
        $this->IDENTIDADE = "";
        $this->IDPERMISSAO = "";
    }

//Mï¿½todo para excluir um cargo
    public function Excluir() {
        $SQL = 'DELETE FROM usuario WHERE IDUSUARIO=' . $this->codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

//Metodo para alterar uma cargo
    function Alterar() {
        $SQL = "UPDATE usuario SET 
                NOMEUSU ='" . $this->NOMEUSU . "',
                LOGINUSU ='" . $this->LOGINUSU . "',
                SENHAUSU =(SELECT MD5('" . $this->SENHAUSU . "')),
                IDENTIDADE ='" . $this->IDENTIDADE . "',
                IDPERMISSAO ='" . $this->IDPERMISSAO . "'
                WHERE IDUSUARIO='" . $this->codigo . "'";

//die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function Salvar() {

        $SQL = "INSERT INTO usuario (
            NOMEUSU, LOGINUSU, SENHAUSU, IDENTIDADE, IDPERMISSAO       
            ) VALUES (
            '" . $this->NOMEUSU . "','" . $this->LOGINUSU . "',
            (SELECT MD5('" . $this->SENHAUSU . "')),'" . $this->IDENTIDADE . "', '" . $this->IDPERMISSAO . "');";

//die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

//Mï¿½todo que lista as cargo em um array para preencher o grid


    public function preencheDados($cod) {

        $SQL = "SELECT *
            FROM usuario 
            WHERE IDUSUARIO = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDUSUARIO']);
            $this->setNOMEUSU($linha['NOMEUSU']);
            $this->setLOGINUSU($linha['LOGINUSU']);
            $this->setSENHAUSU($linha['SENHAUSU']);
            $this->setIDENTIDADE($linha['IDENTIDADE']);
            $this->setIDPERMISSAO($linha['IDPERMISSAO']);
        }
    }

    public function ListaUsuario($pesq = "") {


        $html = '
            <div style="margin-top: 1px; float: left">
                            <input type="text" name="pesquisa" value="' . $pesq . '" class="form-control">
                        </div>
                    <div style="float: left; margin-left: 1%">
                    <a type="submit"  onclick = "document.form1.submit();" class="btn btn-primary">Pesquisar</a>';
        if ($_SESSION['permissao'] != 3) {
            $html .= '<a type="submit" href = "usuario_alteracao.frm.php" style="margin-left:2px"  class="btn btn-success">Adicionar</a>';
        }
        $html .= '<a href="../visao/menuadministrador.frm.php"  style="margin-left:2px" class="btn btn-primary"">Voltar</a>
                    </div>
                              <table class="table1 table1-bordered">
                              <thead>
                                <tr>
                                  <th>CPF</th>
                                  <th>Nome</th>
                                  <th>Entidade</th>
                                  <th>Permissão</th>
                                  <th>Editar</th>
                                  <th>Excluir</th>
                                </tr>
                              </thead>';

        if ($_SESSION['permissao'] == 1) {
            $WHERE = " 1=1 ";
        } else if ($_SESSION['permissao'] == 2) {
            $WHERE = " us.IDENTIDADE = " . $_SESSION['entidade'] . " AND us.IDPERMISSAO <> 1 ";
        } else {
            $WHERE = " us.IDUSUARIO = " . $_SESSION['codigo'];
        }

        $SQL = "SELECT us.IDUSUARIO, us.LOGINUSU, us.NOMEUSU, us.IDPERMISSAO,
                pe.DESCPERMISSAO, et.NOMEENT
                FROM usuario us
                LEFT JOIN permissao pe
                ON us.IDPERMISSAO = pe.IDPERMISSAO
                LEFT JOIN entidade et
                ON us.IDENTIDADE = et.IDENTIDADE 
                WHERE " . $WHERE;

        //die(print_r($_SESSION));

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" AND UPPER(NOMEUSU) LIKE UPPER('%" . $pesq . "%') OR 
                UPPER(DESCPERMISSAO) LIKE UPPER('%" . $pesq . "%') OR 
                UPPER(LOGINUSU) LIKE UPPER('%" . $pesq . "%') OR 
                UPPER(NOMEENT) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY us.IDPERMISSAO, us.NOMEUSU ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);

        foreach ($tbl as $chave => $linha) {

            $pula = false;

            if ($_SESSION['permissao'] == 2) {
                if ($linha['IDPERMISSAO'] == 2 && $linha['IDUSUARIO'] != $_SESSION['codigo']) {
                    $pula = true;
                }
            }

            if ($pula == false) {
                $html .= '   <tbody>
                <td > ' . htmlentities($linha['LOGINUSU']) . ' </td>
                <td > ' . htmlentities($linha['NOMEUSU']) . ' </td>
                <td > ' . htmlentities($linha['NOMEENT']) . ' </td>
                <td > ' . htmlentities($linha['DESCPERMISSAO']) . ' </td>
                <td ><a href = "usuario_alteracao.frm.php?IDUSUARIO=' . htmlentities($linha['IDUSUARIO']) . '&metodo=1"><img src = "img/edit.png" ></a> </td>
                <td ><a href = "usuario.exe.php?IDUSUARIO=' . htmlentities($linha['IDUSUARIO']) . '&metodo=2"><img  src = "img/delete.png"  ></a> </td>
                </tbody>
                ';
            }
        }


        $html .= ' </table>';



        return $html;
    }

}

?>