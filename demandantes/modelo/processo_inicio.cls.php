<?php

require_once("../controle/conexao.gti.php");

class clsProcessoInicio {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idoriproc;
    private $descricao;
    private $sitiniproc;
    private $dtiniproc;

    function __construct() {
        $this->codigo = "";
        $this->idoriproc = "";
        $this->descricao = "";
        $this->sitinuproc = "";
        $this->dtiniproc = "";
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdoriproc() {
        return $this->idoriproc;
    }

    public function setIdoriproc($idoriproc) {
        $this->idoriproc = $idoriproc;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getSitiniproc() {
        return $this->sitiniproc;
    }

    public function setSitiniproc($sitiniproc) {
        $this->sitiniproc = $sitiniproc;
    }

    public function getDtiniproc() {
        return $this->dtiniproc;
    }

    public function setDtiniproc($dtiniproc) {
        $this->dtiniproc = $dtiniproc;
    }

    //Mï¿½todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM processo_inicio WHERE IDINIPROC=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();

        $SQL = 'DELETE FROM processo_andamento WHERE IDINIPROC=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma obra
    function Alterar() {
        $SQL = "UPDATE processo_inicio SET 
		IDORIPROC='" . $this->idoriproc . "',
		DESCINIPROC='" . $this->descricao . "'
                WHERE IDINIPROC='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO processo_inicio (IDORIPROC, DESCINIPROC, DTINIPROC) VALUES 
                ('" . $this->idoriproc . "','" . $this->descricao . "',(SELECT DATE_FORMAT(NOW(),'%d/%m/%Y')));";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();

        $SQL = " SELECT IDPROCESSO FROM processo WHERE IDORIPROC='" . $this->idoriproc . "'";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $SQL = "INSERT INTO processo_andamento (IDPROCESSO, IDINIPROC, DTATUPROC) VALUES 
                ('" . $linha['IDPROCESSO'] . "','" . $this->maxId() . "',(SELECT DATE_FORMAT(NOW(),'%d/%m/%Y')));";

            //die($SQL);

            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();
        }
    }

    //Mï¿½todo que lista as obras em um array para preencher o grid
    public function ListaProcIniPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Iniciar novo processo" width = "30px" align = "right"><a href = "processo_inicio_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "220px">Processo Origem</th>
                <th align = "center" class = "small" width = "220px">Descrição</th>
                <th align = "center" class = "small" width = "100px">Data Início</th>
                <th align = "center" class = "small" width = "100px">Situação</th>
                <th align = "center" class = "small" width = "70px">Atualizar Processo</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT pri.IDINIPROC, po.NOMEPROC, pri.DESCINIPROC, pri.DTINIPROC
                FROM processo_inicio pri
                INNER JOIN processo_origem po
                ON pri.IDORIPROC = po.IDORIPROC ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(po.nomeproc) LIKE UPPER('%" . $pesq . "%') OR UPPER(pri.DESCINIPROC) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY STR_TO_DATE(pri.DTINIPROC,'%d/%m/%Y') DESC ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        
        $situacao = "Finalizado";

        //die($SQL);
        foreach ($tbl as $chave => $linha) {
            if (strlen($linha['DESCINIPROC']) == 65) {
                $desc = htmlentities($linha['DESCINIPROC']) . " ...";
            } else {
                $desc = htmlentities($linha['DESCINIPROC']);
            }

            $sitBool = $this->situacaoProc($linha['IDINIPROC']);
            if($sitBool == true){
                $situacao = "Em processo";
            }

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMEPROC']) . ' </td>
                <td align = "center" class = "small" width = "230px"> ' . $desc . ' </td>
                <td align = "center" class = "small" width = "170px"> ' . $linha['DTINIPROC'] . ' </td>
                <td align = "center" class = "small" width = "170px"> ' . $situacao . ' </td>
                <td align = "center"><a href = "processo_organograma.frm.php?idiniproc=' . htmlentities($linha['IDINIPROC']) . '&nomeiniproc=' . htmlentities($linha['DESCINIPROC']) . '&nomeoriproc=' . htmlentities($linha['NOMEPROC']) . '&metodo=3"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "processo_inicio_alteracao.frm.php?idiniproc=' . htmlentities($linha['IDINIPROC']) . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "processo_inicio.exe.php?idiniproc=' . htmlentities($linha['IDINIPROC']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM processo_inicio
                WHERE IDINIPROC = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDINIPROC']);
            $this->setIdoriproc($linha['IDORIPROC']);
            $this->setDescricao($linha['DESCINIPROC']);
            $this->setSitiniproc($linha['SITINIPROC']);
            $this->setDtiniproc($linha['DTINIPROC']);
        }
    }

    public function situacaoProc($iniProc) {

        $html = "";

        $SQL = "SELECT pa.SITPROC
                FROM processo_andamento pa 
                INNER JOIN processo_inicio pri
                ON pa.IDINIPROC = pri.IDINIPROC
                INNER JOIN processo p
                ON pa.IDPROCESSO = p.IDPROCESSO
                INNER JOIN processo_relaciona pr
                ON p.IDPROCESSO = pr.IDPROCESSO
                WHERE pa.IDINIPROC ='" . $iniProc . "'
                ORDER BY CONVERT(ORDEMPROC,UNSIGNED), p.IDPROCESSO DESC";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
 
        foreach ($tbl as $chave => $linha) {

            if ($linha['SITPROC'] == 0) {
                return true;
            }
        }
        return false;
    }

    public function maxId() {

        $SQL = "SELECT MAX(IDINIPROC) as max
                FROM processo_inicio";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {
            return($linha['max']);
        }
    }

}

?>