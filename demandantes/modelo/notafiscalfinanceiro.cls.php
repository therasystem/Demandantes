<?php

require_once("../controle/conexao.gti.php");
require_once("../modelo/centro_custo_financeiro.cls.php");

class clsNotaFiscalFinanceiro {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idcentro;
    private $idfornecedor;
    private $numNotaFiscal;
    private $valorNota;
    private $pagamento;
    private $dtReferencia;
    private $vencimento;
    private $tipoNota;
    private $dataEnvio;
    private $numEnvio;
    private $dataEntrada;

    //Mï¿½TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdcentro() {
        return $this->idcentro;
    }

    public function setIdcentro($idcentro) {
        $this->idcentro = $idcentro;
    }

    public function getIdfornecedor() {
        return $this->idfornecedor;
    }

    public function setIdfornecedor($idfornecedor) {
        $this->idfornecedor = $idfornecedor;
    }

    public function getNumNotaFiscal() {
        return $this->numNotaFiscal;
    }

    public function setNumNotaFiscal($numNotaFiscal) {
        $this->numNotaFiscal = $numNotaFiscal;
    }

    public function getValorNota() {
        return $this->valorNota;
    }

    public function setValorNota($valorNota) {
        $this->valorNota = $valorNota;
    }

    public function getPagamento() {
        return $this->pagamento;
    }

    public function setPagamento($pagamento) {
        $this->pagamento = $pagamento;
    }

    public function getDtReferencia() {
        return $this->dtReferencia;
    }

    public function setDtReferencia($dtReferencia) {
        $this->dtReferencia = $dtReferencia;
    }

    public function getVencimento() {
        return $this->vencimento;
    }

    public function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
    }

    public function getTipoNota() {
        return $this->tipoNota;
    }

    public function setTipoNota($tipoNota) {
        $this->tipoNota = $tipoNota;
    }

    public function getDataEnvio() {
        return $this->dataEnvio;
    }

    public function setDataEnvio($dataEnvio) {
        $this->dataEnvio = $dataEnvio;
    }

    public function getNumEnvio() {
        return $this->numEnvio;
    }

    public function setNumEnvio($numEnvio) {
        $this->numEnvio = $numEnvio;
    }

    public function getDataEntrada() {
        return $this->dataEntrada;
    }

    public function setDataEntrada($dataEntrada) {
        $this->dataEntrada = $dataEntrada;
    }

    function __construct() {
        $this->codigo = "";
        $this->idcentro = "";
        $this->idfornecedor = "";
        $this->numNotaFiscal = "";
        $this->valorNota = "";
        $this->pagamento = "";
        $this->dtReferencia = "";
        $this->vencimento = "";
        $this->tipoNota = "";
        $this->dataEnvio = null;
        $this->numEnvio = null;
        $this->dataEntrada = "";
    }

    //Mï¿½todo para excluir um fornecedor
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM notafiscalfinanceiro WHERE IDNOTAFINANC=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma fornecedor
    function Alterar() {
        $SQL = "UPDATE notafiscalfinanceiro SET 
		IDCENTRO='" . $this->idcentro . "',
		IDFORNECEDOR='" . $this->idfornecedor . "',
		NUMNOTAFINANC='" . $this->numNotaFiscal . "',
		VALORNOTAFINANC='" . $this->valorNota . "',
		DATAPAGAMENTO='" . $this->pagamento . "',
		DTREFERENCIA='" . $this->dtReferencia . "',
		DTVENCIMENTO='" . $this->vencimento . "',
		TIPONOTA='" . $this->tipoNota . "'
                WHERE IDNOTAFINANC='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que realiza o cadastro de um novo fornecedor
    public function Salvar() {

        $SQL = "INSERT INTO notafiscalfinanceiro (IDCENTRO, IDFORNECEDOR, NUMNOTAFINANC, VALORNOTAFINANC, DATAPAGAMENTO, DTREFERENCIA, DTVENCIMENTO, 
                                                  TIPONOTA, DATAENVIO, NUMENVIO, DATAENTRADA) VALUES 
                                                 ('" . $this->idcentro . "','" . $this->idfornecedor . "','" . $this->numNotaFiscal . "', 
                                                  '" . $this->valorNota . "', '" . $this->pagamento . "', '" . $this->dtReferencia . "', '" . $this->vencimento . "', 
                                                  '" . $this->tipoNota . "', '" . $this->dataEnvio . "', '" . $this->numEnvio . "', (SELECT DATE_FORMAT(NOW(),'%d/%m/%Y')));";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function ListaCentroPesq($pesq = "", $tipo = "") {

        if ($tipo != "") {
            //die('tipo maior q 0');
            $pesquisa = "";
            $pesquisa2 = $pesq;
            //die('213e2..'.$tipo.'..213e2..');
        } else {
            //die('tipo vazio');
            $pesquisa2 = "";
            $pesquisa = $pesq;
        }

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" id = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"  onfocus="disableCampo();" onKeyPress="return submitenter(this, event)" ></td>
                    <td><input type="checkbox" value="1" name="limpa" onclick="limpaCampo();"></input></td>
                    
                </tr>
                <tr>
                <td align = "right">
                <select name="tipoPesq" id = "tipoPesq">
                    <option value="1">Dt. Pagamento</option>
                    <option value="2">Fornecedor</option>
                    <option value="3" selected>Nota Fiscal</option> 
                    <option value="4">Dt. Vencimento</option> 
                    <option value="5">Valor</option>
                </select>
                </td>
                <td><input class = "campo_texto" name = "pesquisa2" id = "pesquisa2" type = "text" value = "' . $pesquisa2 . '" size = "40" onfocus="disableCampo2();" onKeyPress="return submitenter(this, event)"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Nota Fiscal" width = "30px" align = "right"><a href = "notafiscalfinanceiro_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                <td title = "Adicionar Fornecedor" width = "30px" align = "right"><a href = "fornecedor.frm.php"><img name = "btnsalvar" id = "btnsalvar" src="../imagens/ico_fornecedor.jpg" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "50px">Num. Envio</th>
                <th align = "center" class = "small" width = "50px">Data Pagto.</th>
                <th align = "center" class = "small" width = "270px">Fornecedor</th>
                <th align = "center" class = "small" width = "210px">Nota Fiscal</th> ';

        if ($_SESSION['tiponota'] == 0) {
            if ($_SESSION['centroCusto'] == 4) {

                $html .= ' <th align = "center" class = "small" width = "80px">Obra</th> ';
            } else if ($_SESSION['centroCusto'] == 1 || $_SESSION['centroCusto'] == 2 || $_SESSION['centroCusto'] == 3 || $_SESSION['centroCusto'] == 17) {

                $html .= ' <th align = "center" class = "small" width = "80px">Tipo</th> ';
            } else {
                $html .= ' <th align = "center" class = "small" width = "80px">Vencimento</th> ';
            }
        } else {
            $html .= ' <th align = "center" class = "small" width = "80px">Vencimento</th> ';
        }

        $html .= ' <th align = "center" class = "small" width = "130px">Valor</th>
                <th align = "center" class = "small" width = "60px">Editar</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT nff.IDNOTAFINANC, nff.NUMENVIO, nff.DATAPAGAMENTO, f.NOMEFORNECEDOR, nff.NUMNOTAFINANC, nff.DTREFERENCIA, nff.DTVENCIMENTO, nff.VALORNOTAFINANC, nff.TIPONOTA
                FROM notafiscalfinanceiro nff
                INNER JOIN centrocustofinanceiro ccf
                ON nff.IDCENTRO = ccf.IDCENTROCUSTOFINANC
                INNER JOIN fornecedor f
                ON nff.IDFORNECEDOR = f.IDFORNECEDOR 
                WHERE nff.TIPONOTA=" . $_SESSION['tiponota'] . " AND nff.IDCENTRO =" . $_SESSION['centroCusto'];

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            if ($tipo != "") {

                switch ($tipo) {
                    case "1":
                        $SQL.=" AND UPPER(nff.DATAPAGAMENTO) LIKE UPPER('%" . $pesq . "%')";
                        break;
                    case "2":
                        $SQL.=" AND UPPER(f.NOMEFORNECEDOR) LIKE UPPER('%" . $pesq . "%')";
                        break;
                    case "3":
                        $SQL.=" AND UPPER(nff.NUMNOTAFINANC) LIKE UPPER('%" . $pesq . "%')";
                        break;
                    case "4":
                        $SQL.=" AND UPPER(nff.DTVENCIMENTO) LIKE UPPER('%" . $pesq . "%')";
                        break;
                    case "5":
                        $SQL.=" AND UPPER(nff.VALORNOTAFINANC) LIKE UPPER('%" . $pesq . "%')";
                        break;
                }
            } else {
                $SQL.=" AND (UPPER(nff.DATAPAGAMENTO) LIKE UPPER('%" . $pesq . "%') 
                    OR UPPER(nff.DTVENCIMENTO) LIKE UPPER('%" . $pesq . "%')
                    OR UPPER(nff.VALORNOTAFINANC) LIKE UPPER('%" . $pesq . "%')
                    OR UPPER(f.NOMEFORNECEDOR) LIKE UPPER('%" . $pesq . "%')
                    OR UPPER(nff.NUMNOTAFINANC) LIKE UPPER('%" . $pesq . "%') )";
            }
        }

        $SQL.=" ORDER BY nff.NUMENVIO DESC, STR_TO_DATE(nff.DATAPAGAMENTO,'%d/%m/%Y'), f.NOMEFORNECEDOR; ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMENVIO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAPAGAMENTO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMEFORNECEDOR']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMNOTAFINANC']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTVENCIMENTO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> R$ ' . htmlentities($linha['VALORNOTAFINANC']) . ' </td>
                <td align = "center"><a href = "notafiscalfinanceiro_alteracao.frm.php?idnota=' . $linha['IDNOTAFINANC'] . '&metodo=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "notafiscalfinanceiro.exe.php?idnota=' . $linha['IDNOTAFINANC'] . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM notafiscalfinanceiro
                WHERE IDNOTAFINANC = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDNOTAFINANC']);
            $this->setIdcentro($linha['IDCENTRO']);
            $this->setIdfornecedor($linha['IDFORNECEDOR']);
            $this->setNumNotaFiscal($linha['NUMNOTAFINANC']);
            $this->setValorNota($linha['VALORNOTAFINANC']);
            $this->setPagamento($linha['DATAPAGAMENTO']);
            $this->setDtReferencia($linha['DTREFERENCIA']);
            $this->setVencimento($linha['DTVENCIMENTO']);
            $this->setTipoNota($linha['TIPONOTA']);
            $this->setDataEnvio($linha['DATAENVIO']);
            $this->setNumEnvio($linha['NUMENVIO']);
            $this->setDataEntrada($linha['DATAENTRADA']);
        }
    }

    public function getLastID() {

        $SQL = "SELECT MAX(IDNOTA) as IDNOTA
                FROM notafiscal";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {
            return $linha['IDNOTA'];
        }
    }

    public function ListaMovimento() {


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "left">Data:
                <input class = "campo_texto" name="data" type = "text" value = "" size="15" maxlength="10" onkeyup="mascaraData(this, event);"></td> 
                </tr>
                <tr>
                <td  align = "right" style="color:red">Em caso de inclusão, coloque o número do lançamento:<input name="numero" value="" type="text" size="3" /></td>
                <td title = "Lançar"  align = "right"><input name="botao" value="Enviar" type="submit" /></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "80px">Data Pagto.</th>
                <th align = "center" class = "small" width = "250px">Fornecedor</th>
                <th align = "center" class = "small" width = "100px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "80px">Referência / Período</th> ';

        if ($_SESSION['tiponota'] == 0) {
            if ($_SESSION['centroCusto'] == 4) {

                $html .= ' <th align = "center" class = "small" width = "80px">Obra</th> ';
            } else {

                $html .= ' <th align = "center" class = "small" width = "80px">Tipo</th> ';
            }
        } else {
            $html .= ' <th align = "center" class = "small" width = "80px">Vencimento</th> ';
        }


        $html .= ' <th align = "center" class = "small" width = "80px">Valor</th>
                <th align = "center" class = "small" width = "60px">Envio</th> 
                </tr>';


        $SQL = "SELECT nff.IDNOTAFINANC, nff.DATAPAGAMENTO, f.NOMEFORNECEDOR, nff.NUMNOTAFINANC, nff.DTREFERENCIA, nff.DTVENCIMENTO, nff.VALORNOTAFINANC, nff.TIPONOTA
                FROM notafiscalfinanceiro nff
                INNER JOIN centrocustofinanceiro ccf
                ON nff.IDCENTRO = ccf.IDCENTROCUSTOFINANC
                INNER JOIN fornecedor f
                ON nff.IDFORNECEDOR = f.IDFORNECEDOR 
                WHERE nff.NUMENVIO < 1 AND nff.TIPONOTA=" . $_SESSION['tiponota'] . " AND nff.IDCENTRO =" . $_SESSION['centroCusto'];


        $SQL.=" ORDER BY STR_TO_DATE(nff.DATAPAGAMENTO,'%d/%m/%Y') ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAPAGAMENTO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMEFORNECEDOR']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMNOTAFINANC']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTREFERENCIA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTVENCIMENTO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> R$ ' . htmlentities($linha['VALORNOTAFINANC']) . ' </td>
                <td align = "center"><input name="ENVIO[]" type="checkbox" checked value="' . $linha['IDNOTAFINANC'] . '" /></td> 
                    
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function ListaMovimentoObra() {


        $centro = new clsCentroCustoFinanceiro();


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "left">Data:
                <input class = "campo_texto" name="data2" type = "text" value = "" size="15" maxlength="10" onkeyup="mascaraData(this, event);"></td> 
                </tr>
                <tr>
                <td  align = "right" style="color:red">
                Em caso de inclusão, coloque o número do lançamento:<input name="numero2" value="" type="text" size="3" /></td>
                <td title = "Lançar"  align = "right"><input name="botao" value="Enviar" type="submit" /></td>
                </tr>
                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "80px">Data Pagto.</th>
                <th align = "center" class = "small" width = "250px">Fornecedor</th>
                <th align = "center" class = "small" width = "150px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "80px">Emissão</th> ';

        if ($_SESSION['tiponota'] == 0) {
            if ($_SESSION['centroCusto'] == 4) {

                $html .= ' <th align = "center" class = "small" width = "80px">Obra</th> ';
            } else {

                $html .= ' <th align = "center" class = "small" width = "80px">Tipo</th> ';
            }
        } else {
            $html .= ' <th align = "center" class = "small" width = "80px">Vencimento</th> ';
        }

        $html .= ' <th align = "center" class = "small" width = "80px">Valor</th>
                <th align = "center" class = "small" width = "60px">Envio</th> 
                </tr>';


        $SQL = "SELECT nf.IDNOTA, nf.NOMECOMPARA, nf.NUMNOTA, nf.VALORNOTA, nf.DTEMISSAONOTA, nf.VENCIMENTONOTA, nf.TIPONOTA, nf.IDCENTROFINANC, nf.DATAPAGAMENTO
                    FROM notafiscal nf
                    INNER JOIN material_nota mn
                    ON nf.IDNOTA = mn.IDNOTA
                    INNER JOIN compra co
                    ON nf.IDCOMPRA = co.IDCOMPRA
                    INNER JOIN item it
                    ON mn.IDITEM = it.IDITEM
                    INNER JOIN material ma
                    ON it.IDMATERIAL = ma.IDMATERIAL
                    INNER JOIN unidade un
                    ON it.IDUNIDADE = un.IDUNIDADE
                    WHERE nf.NUMENVIO < 1 AND nf.TIPONOTA=" . $_SESSION['tiponota'] . " AND nf.IDCENTROFINANC =" . $_SESSION['centroCusto'] . "
                    GROUP BY nf.IDNOTA 
                    ORDER BY STR_TO_DATE(nf.DTEMISSAONOTA,'%d/%m/%Y'), NOMECOMPARA ";



        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAPAGAMENTO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECOMPARA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMNOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTEMISSAONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['VENCIMENTONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> R$ ' . htmlentities($linha['VALORNOTA']) . ' </td>
                <td align = "center"><input name="ENVIO2[]" type="checkbox" checked value="' . $linha['IDNOTA'] . '" /></td> 
                    
                </tr>';
        }


        $html .= '</table> </table>';


        return $html;
    }

    public function ListaMovimentoDeObras($idobra) {

        $centro = new clsCentroCustoFinanceiro();


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr> 
                <td  align="right" class="small">Centro de Custo:</td>
                <td>
                    <select name="CENTRO">
                    ' . $centro->ListaComboCentroCustoALL() . '
                    </select>
                </td> 
                </tr> 
                <tr> 
                <td  align="right" class="small">Tipo Nota Fiscal:</td>
                <td>
                    <input name="TIPONOTA" type="radio" value="0" checked="checked" />Movimento de Caixa
                    <input name="TIPONOTA" type="radio" value="1" />Guia de Encaminhamento
                </td> 
                </tr>
                <tr> 
                <td  align="right" class="small">Data Pagamento:</td>
                <td>
                    <input name="DATAPAG" type="text" value="" maxlength="10" onkeyup="mascaraData(this, event);" size="10" />
                </td> 
                <td title = "Lançar" width = "30px" align = "right">
                <input  style="width: 100px" name="botao" value="Enviar" type="submit" /></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "300px">Fornecedor</th>
                <th align = "center" class = "small" width = "150px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "80px">Emissão</th>
                <th align = "center" class = "small" width = "80px">Vencimento</th>
                <th align = "center" class = "small" width = "80px">Valor</th>
                <th align = "center" class = "small" width = "60px">Envio</th> 
                </tr>';


        $SQL = "SELECT nf.IDNOTA, nf.NOMECOMPARA, nf.NUMNOTA, nf.VALORNOTA, nf.DTEMISSAONOTA, nf.VENCIMENTONOTA, nf.TIPONOTA, nf.IDCENTROFINANC
                    FROM notafiscal nf
                    INNER JOIN material_nota mn
                    ON nf.IDNOTA = mn.IDNOTA
                    INNER JOIN compra co
                    ON nf.IDCOMPRA = co.IDCOMPRA
                    INNER JOIN item it
                    ON mn.IDITEM = it.IDITEM
                    INNER JOIN material ma
                    ON it.IDMATERIAL = ma.IDMATERIAL
                    INNER JOIN unidade un
                    ON it.IDUNIDADE = un.IDUNIDADE
                    WHERE 1=1 AND nf.TIPONOTA = -1 AND nf.IDCENTROFINANC = 0 AND co.IDOBRA =" . $idobra . "
                    GROUP BY nf.IDNOTA 
                    ORDER BY STR_TO_DATE(nf.VENCIMENTONOTA,'%d/%m/%Y'),STR_TO_DATE(nf.DTEMISSAONOTA,'%d/%m/%Y'), NOMECOMPARA ";



        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECOMPARA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMNOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTEMISSAONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['VENCIMENTONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> R$ ' . htmlentities($linha['VALORNOTA']) . ' </td>
                <td align = "center"><input name="ENVIO[]" type="checkbox" checked value="' . $linha['IDNOTA'] . '" /></td> 
                    
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function EnvioNota($data, $planilhas, $numero) {

        if ($numero == "") {
            $numero = $this->getLastNumEnvio() + 1;
        }

        for ($i = 0; $i < count($planilhas); $i++) {

            $SQL = "UPDATE notafiscalfinanceiro SET 
                    DATAENVIO='" . $data . "',
                    NUMENVIO='" . $numero . "'
                    WHERE IDNOTAFINANC='" . $planilhas[$i] . "'";

            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();
        }
    }

    public function EnvioNotaAtualizaObra($data, $planilhas, $numero) {

        if ($numero == "") {
            $numero = $this->getLastNumEnvioObra() + 1;
        }

        for ($i = 0; $i < count($planilhas); $i++) {

            $SQL = "UPDATE notafiscal SET 
                    DATAENVIO='" . $data . "',
                    NUMENVIO='" . $numero . "'
                    WHERE IDNOTA='" . $planilhas[$i] . "'";

            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();
        }
    }

    public function EnvioNotaObra($centro, $tiponota, $planilhas, $dataPag) {


        for ($i = 0; $i < count($planilhas); $i++) {
            if ($tiponota == 1) {
                $dataPag = "";
            }
            $SQL = "UPDATE notafiscal SET 
                    TIPONOTA='" . $tiponota . "',
                    DATAPAGAMENTO='" . $dataPag . "',
                    IDCENTROFINANC='" . $centro . "'
                    WHERE IDNOTA='" . $planilhas[$i] . "'";

            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();
        }
    }

    public function getLastNumEnvio() {

        if ($_SESSION['tiponota'] == 0) {
            $SQL = "SELECT MAX(NUMENVIO) as ID
                FROM notafiscalfinanceiro
                WHERE TIPONOTA=" . $_SESSION['tiponota'] . " AND IDCENTRO =" . $_SESSION['centroCusto'];
        } else {
            $SQL = "SELECT MAX(NUMENVIO) as ID
                FROM notafiscalfinanceiro
                WHERE TIPONOTA=" . $_SESSION['tiponota'];
        }
        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {
            return $linha['ID'];
        }
    }

    public function getLastNumEnvioObra() {

        if ($_SESSION['tiponota'] == 0) {
            $SQL = "SELECT MAX(NUMENVIO) as ID
                FROM notafiscal
                WHERE TIPONOTA=" . $_SESSION['tiponota'] . " AND IDCENTROFINANC =" . $_SESSION['centroCusto'];
        } else {
            $SQL = "SELECT MAX(NUMENVIO) as ID
                FROM notafiscal
                WHERE TIPONOTA=" . $_SESSION['tiponota'];
        }
        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {
            return $linha['ID'];
        }
    }

    public function ListaMovimentoEditar($idcentro, $busca) {


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "80px">Data Pagto.</th>
                <th align = "center" class = "small" width = "150px">Fornecedor</th>
                <th align = "center" class = "small" width = "100px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "80px">Referência / Período</th>
                <th align = "center" class = "small" width = "80px">Vencimento</th>
                <th align = "center" class = "small" width = "80px">Valor</th>
                <th align = "center" class = "small" width = "100px">Tipo</th>
                <th align = "center" class = "small" width = "80px">Data Envio</th>
                <th align = "center" class = "small" width = "80px">Num. Envio</th>
                <th align = "center" class = "small" width = "100px">Reverter Tipo</th> 
                <th align = "center" class = "small" width = "60px">Resetar</th> 
                </tr>';


        $SQL = "SELECT nff.IDNOTAFINANC, nff.DATAPAGAMENTO, f.NOMEFORNECEDOR, nff.NUMNOTAFINANC, nff.DTREFERENCIA, nff.DTVENCIMENTO, nff.VALORNOTAFINANC, nff.TIPONOTA, nff.DATAENVIO, nff.NUMENVIO, 
                    CASE 
                    WHEN nff.TIPONOTA = 0 THEN 'Movimento de Caixa'
                    WHEN nff.TIPONOTA = 1 THEN 'Guia de Encaminhamento'
                    END as TipoDesc
                    FROM notafiscalfinanceiro nff
                    INNER JOIN centrocustofinanceiro ccf
                    ON nff.IDCENTRO = ccf.IDCENTROCUSTOFINANC
                    INNER JOIN fornecedor f
                    ON nff.IDFORNECEDOR = f.IDFORNECEDOR 
                    WHERE nff.IDCENTRO =" . $idcentro;

        if ($busca != null || $busca != "") {
            $SQL.=" AND nff.NUMNOTAFINANC LIKE '%" . $busca . "%'";
        }


        $SQL.=" ORDER BY nff.NUMENVIO DESC, f.NOMEFORNECEDOR ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {
            if ($linha['NUMENVIO'] == 0)
                $linha['NUMENVIO'] = "";
            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAPAGAMENTO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMEFORNECEDOR']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMNOTAFINANC']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTREFERENCIA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTVENCIMENTO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['VALORNOTAFINANC']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['TipoDesc']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAENVIO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMENVIO']) . ' </td>
                <td align = "center"><a href = "obranota.exe.php?idnota=' . htmlentities($linha['IDNOTAFINANC']) . '&idcentro=' . $idcentro . '&metodo=1&tabela=1"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "obranota.exe.php?idnota=' . htmlentities($linha['IDNOTAFINANC']) . '&idcentro=' . $idcentro . '&metodo=2&tabela=1"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                    
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function ListaMovimentoObraEditar($idcentro, $busca) {


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "150px">Fornecedor</th>
                <th align = "center" class = "small" width = "150px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "80px">Emissão</th>
                <th align = "center" class = "small" width = "80px">Vencimento</th>
                <th align = "center" class = "small" width = "80px">Valor</th>
                <th align = "center" class = "small" width = "100px">Tipo</th>
                <th align = "center" class = "small" width = "80px">Data Envio</th>
                <th align = "center" class = "small" width = "80px">Num. Envio</th>
                <th align = "center" class = "small" width = "100px">Reverter Tipo</th> 
                <th align = "center" class = "small" width = "60px">Resetar</th> 
                </tr>';


        $SQL = "SELECT nf.IDNOTA, nf.NOMECOMPARA, nf.NUMNOTA, nf.VALORNOTA, nf.DTEMISSAONOTA, nf.VENCIMENTONOTA, nf.TIPONOTA, nf.DATAENVIO, nf.NUMENVIO, 
                    CASE 
                    WHEN nf.TIPONOTA = 0 THEN 'Movimento de Caixa'
                    WHEN nf.TIPONOTA = 1 THEN 'Guia de Encaminhamento'
                    END as TipoDesc, nf.IDCENTROFINANC
                    FROM notafiscal nf
                    INNER JOIN material_nota mn
                    ON nf.IDNOTA = mn.IDNOTA
                    INNER JOIN compra co
                    ON nf.IDCOMPRA = co.IDCOMPRA
                    INNER JOIN item it
                    ON mn.IDITEM = it.IDITEM
                    INNER JOIN material ma
                    ON it.IDMATERIAL = ma.IDMATERIAL
                    INNER JOIN unidade un
                    ON it.IDUNIDADE = un.IDUNIDADE
                    WHERE  nf.IDCENTROFINANC =" . $idcentro;


        if ($busca != null || $busca != "") {
            $SQL.=" AND nf.NUMNOTA LIKE '%" . $busca . "%'";
        }

        $SQL .= " GROUP BY nf.IDNOTA ORDER BY nf.NUMENVIO, NOMECOMPARA ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {
            if ($linha['NUMENVIO'] == 0)
                $linha['NUMENVIO'] = "";

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECOMPARA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMNOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTEMISSAONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['VENCIMENTONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> R$ ' . htmlentities($linha['VALORNOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['TipoDesc']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAENVIO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMENVIO']) . ' </td>
                <td align = "center"><a href = "obranota.exe.php?idnota=' . htmlentities($linha['IDNOTA']) . '&idcentro=' . $idcentro . '&metodo=1&tabela=2"><img border = "0" src = "../imagens/bt_editar.jpg" width = "24px" ></a> </td>
                <td align = "center"><a href = "obranota.exe.php?idnota=' . htmlentities($linha['IDNOTA']) . '&idcentro=' . $idcentro . '&metodo=2&tabela=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                    
                </tr>';
        }


        $html .= '</table> </table>';


        return $html;
    }

    function AlterarTipoNota() {
        $SQL = "SELECT *
                FROM notafiscalfinanceiro 
                WHERE IDNOTAFINANC = '" . $this->codigo . "'";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $tipo = $linha['TIPONOTA'];
        }
        if ($tipo == 0) {
            $tipo = 1;
        } else {
            $tipo = 0;
        }
        $SQL = "UPDATE notafiscalfinanceiro SET 
		TIPONOTA='" . $tipo . "'
                WHERE IDNOTAFINANC='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    function ResetaTipoNota() {
        $SQL = "UPDATE notafiscalfinanceiro SET 
                DATAENVIO='',
                NUMENVIO='0'
                WHERE IDNOTAFINANC='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

}

?>