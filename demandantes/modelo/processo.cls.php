<?php

require_once("../controle/conexao.gti.php");

class clsProcesso {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idprocessorelat;
    private $idobra;
    private $nomeproc;
    private $descproc;
    private $docproc;
    private $localproc;
    private $contatoproc;
    private $valorproc;
    private $tempoproc;
    private $ordemproc;
    private $dtiniproc;

    //M�TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdprocessorelat() {
        return $this->idprocessorelat;
    }

    public function setIdprocessorelat($idprocessorelat) {
        $this->idprocessorelat = $idprocessorelat;
    }

    public function getIdobra() {
        return $this->idobra;
    }

    public function setIdobra($idobra) {
        $this->idobra = $idobra;
    }

    public function getNomeproc() {
        return $this->nomeproc;
    }

    public function setNomeproc($nomeproc) {
        $this->nomeproc = $nomeproc;
    }

    public function getDescproc() {
        return $this->descproc;
    }

    public function setDescproc($descproc) {
        $this->descproc = $descproc;
    }

    public function getDocproc() {
        return $this->docproc;
    }

    public function setDocproc($docproc) {
        $this->docproc = $docproc;
    }

    public function getLocalproc() {
        return $this->localproc;
    }

    public function setLocalproc($localproc) {
        $this->localproc = $localproc;
    }

    public function getContatoproc() {
        return $this->contatoproc;
    }

    public function setContatoproc($contatoproc) {
        $this->contatoproc = $contatoproc;
    }

    public function getValorproc() {
        return $this->valorproc;
    }

    public function setValorproc($valorproc) {
        $this->valorproc = $valorproc;
    }

    public function getTempoproc() {
        return $this->tempoproc;
    }

    public function setTempoproc($tempoproc) {
        $this->tempoproc = $tempoproc;
    }

    public function getOrdemproc() {
        return $this->ordemproc;
    }

    public function setOrdemproc($ordemproc) {
        $this->ordemproc = $ordemproc;
    }

    public function getDtiniproc() {
        return $this->dtiniproc;
    }

    public function setDtiniproc($dtiniproc) {
        $this->dtiniproc = $dtiniproc;
    }

    function __construct() {
        $this->codigo = "";
        $this->idprocessorelat = "";
        $this->idobra = "";
        $this->nomeproc = "";
        $this->descproc = "";
        $this->docproc = "";
        $this->localproc = "";
        $this->contatoproc = "";
        $this->valorproc = "";
        $this->tempoproc = "";
        $this->ordemproc = "";
        $this->dtiniproc = "";
    }

    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM processo WHERE IDPROCESSO=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();

        $SQL = 'DELETE FROM processo_relaciona WHERE IDPROCESSO=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();

        $SQL = "UPDATE processo_relaciona SET 
		IDPROCESSORELAT=-1
                WHERE IDPROCESSORELAT='" . $codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma obra
    function Alterar() {
        $SQL = "UPDATE processo SET 
		IDOBRA='" . $this->idobra . "',
		NOMEPROC='" . $this->nomeproc . "',
		DESCPROC='" . $this->descproc . "',
		DOCPROC='" . $this->docproc . "',
		LOCALPROC='" . $this->localproc . "',
		CONTATOPROC='" . $this->contatoproc . "',
		VALORPROC='" . $this->valorproc . "',
		TEMPOPROC='" . $this->tempoproc . "',
		ORDEMPROC='" . $this->ordemproc . "'
                WHERE IDPROCESSO='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();

        $SQL = "UPDATE processo_relaciona SET 
		IDPROCESSORELAT='" . $this->idprocessorelat . "'
                WHERE IDPROCESSO='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        session_start();

        $SQL = "INSERT INTO processo (IDOBRA, NOMEPROC, DESCPROC, DOCPROC, LOCALPROC, CONTATOPROC, VALORPROC, TEMPOPROC, ORDEMPROC, DTINIPROC, IDORIPROC) VALUES
    ('" . $this->idobra . "','" . $this->nomeproc . "','" . $this->descproc . "','" . $this->docproc . "','" . $this->localproc . "','" . $this->contatoproc . "','" . $this->valorproc . "','" . $this->tempoproc . "','" . $this->getProximoOrdem($_SESSION['ORIPROC']) . "',(SELECT DATE_FORMAT(NOW(),'%d/%m/%Y')), '" . $_SESSION['ORIPROC'] . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();


        $SQL = "INSERT INTO processo_relaciona (IDPROCESSO, IDPROCESSORELAT) VALUES
                ('" . $this->getUltimoIDPROCESSO() . "','" . $this->idprocessorelat . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que lista as obras em um array para preencher o grid
    public function ListaProcessoPesq($pesq = "") {


        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Processo" width = "30px" align = "right"><a href = "processo_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "150px">Processo Origem</th>
                <th align = "center" class = "small" width = "150px">Nome</th>
                <th align = "center" class = "small" width = "500px">Descri&ccedil;&atilde;o</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT ORDEMPROC, IDPROCESSO, NOMEPROC, SUBSTRING(DESCPROC,1, 150) AS DESCPROCPART, DESCPROC, DTINIPROC 
                FROM processo 
                WHERE IDORIPROC='" . $_SESSION['ORIPROC'] . "'";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" AND UPPER(NOMEPROC) LIKE UPPER('%" . $pesq . "%') OR UPPER(DESCPROC) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY CONVERT(ORDEMPROC,UNSIGNED)   ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            if (strlen($linha['DESCPROCPART']) == 150) {
                $desc = htmlentities($linha['DESCPROCPART']) . " ...";
            } else {
                $desc = htmlentities($linha['DESCPROCPART']);
            }

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($this->getNomeRelacionamentoHerdado($linha['IDPROCESSO'])) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMEPROC']) . ' </td>
                <td align = "center" class = "small" width = "230px"> ' . $desc . ' </td>
                <td align = "center"><a href = "processo_alteracao.frm.php?idproc=' . htmlentities($linha['IDPROCESSO']) . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "processo.exe.php?idproc=' . htmlentities($linha['IDPROCESSO']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT  *
                FROM processo_relaciona pr
                INNER JOIN processo p
                ON p.idprocesso = pr.idprocesso
                WHERE p.idprocesso ='" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {
            $this->setCodigo($cod);
            $this->setIdprocessorelat($linha['IDPROCESSORELAT']);
            $this->setIdobra($linha['IDOBRA']);
            $this->setNomeproc($linha['NOMEPROC']);
            $this->setDescproc($linha['DESCPROC']);
            $this->setDocproc($linha['DOCPROC']);
            $this->setLocalproc($linha['LOCALPROC']);
            $this->setContatoproc($linha['CONTATOPROC']);
            $this->setValorproc($linha['VALORPROC']);
            $this->setTempoproc($linha['TEMPOPROC']);
            $this->setOrdemproc($linha['ORDEMPROC']);
            $this->setDtiniproc($linha['DTINIPROC']);
        }
    }

    public function ListaComboProcessoALLPesc($idproc = "") {

        $SQL = 'SELECT IDPROCESSO as id,  NOMEPROC as nome
                FROM processo 
                ORDER BY NOMEPROC';

        if (isset($_SESSION['ORIPROC'])) {
            $SQL = 'SELECT IDPROCESSO as id,  NOMEPROC as nome
                FROM processo 
                WHERE IDORIPROC =' . $_SESSION['ORIPROC'] . ' 
                ORDER BY CONVERT(ORDEMPROC,UNSIGNED)';
        }

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        //die($SQL);
        $drop = "<option value='0' selected>----  SELECIONE PROCESSO PAI  ----</option>";
        if ($idproc == '-1') {
            $drop .= '<option value="-1" selected>Relacionamento Perdido</option>';
        }

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);

            if ($id == $idproc) {
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }

        return $drop;
    }

    public function getUltimoIDPROCESSO() {

        $SQL = 'SELECT MAX(IDPROCESSO) MAXIMO
              FROM processo';

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {
            return($linha['MAXIMO']);
        }
    }

    public function getProximoOrdem($cod) {

        $SQL = 'SELECT 
                CASE 
                WHEN MAX(ORDEMPROC) IS NULL THEN 0
                ELSE MAX(ORDEMPROC)+1
                END AS MAXIMO
                FROM processo_relaciona pr
                INNER JOIN processo p
                ON p.idprocesso = pr.idprocesso
                WHERE IDORIPROC =' . $cod;

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
//die($SQL);
        foreach ($tbl as $chave => $linha) {
            return($linha['MAXIMO']);
        }
    }

    public function getNomeRelacionamentoHerdado($cod) {

        $SQL = 'SELECT  p.NOMEPROC
                FROM processo_relaciona pr
                INNER JOIN processo p
                ON p.idprocesso = pr.idprocessorelat
                WHERE pr.idprocesso =' . $cod;

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        if ($tbl->RecordCount() > 0) {
            foreach ($tbl as $chave => $linha) {
                return($linha['NOMEPROC']);
            }
        } else {
            return($this->getValorHeranca($cod));
        }
    }

    public function getValorHeranca($cod) {

        $SQL = 'SELECT idprocessorelat
                FROM processo_relaciona
                WHERE idprocesso =' . $cod;

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            if ($linha['idprocessorelat'] == '-1') {
                return("Relacionamento Perdido");
            } else {
                return("Processo Origem");
            }
        }
    }

    public function MontagemOrganograma($iniProc = "") {

        $html = "";

        $SQL = "SELECT p.NOMEPROC, pa.SITPROC, pr.IDPROCESSO, pr.IDPROCESSORELAT, p.IDPROCESSO
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

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            if ($linha['SITPROC'] == '0') {
                $html .= '<li><a class="btn' . $linha['IDPROCESSO'] . '" id="botao" rel="leanModal" href="#myModal' . $linha['IDPROCESSO'] . '">' . $linha['NOMEPROC'] . '</a>';
            } else {
                $html .= '<li><a id="red" class="btn' . $linha['IDPROCESSO'] . '" rel="leanModal" href="#myModal' . $linha['IDPROCESSO'] . '">' . $linha['NOMEPROC'] . '</a>';
            }
        }


        $html .= '';


        return $html;
    }

    public function RetornaMontagemOrganograma($iniProc = "") {

        $html = "";

        $SQL = "SELECT p.NOMEPROC, pa.SITPROC, pr.IDPROCESSO, pr.IDPROCESSORELAT, p.IDPROCESSO, pa.IDANDPROC,
                p.DESCPROC, p.DOCPROC, p.LOCALPROC, p.CONTATOPROC, p.VALORPROC, p.TEMPOPROC
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

        //die($SQL);

        return $tbl;
    }

    public function updateSituacao($id, $sit) {

        if ($sit == 0) {
            $sit = 1;
        }else{
            $sit = 0;
        }

        $SQL = "UPDATE processo_andamento SET 
		SITPROC=".$sit."
                WHERE IDANDPROC='" . $id . "'";

         //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

}

?>