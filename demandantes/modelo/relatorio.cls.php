<?php

require_once("../controle/conexao.gti.php");
require_once("../modelo/centro_custo_financeiro.cls.php");
require_once("../modelo/centro_custo.cls.php");
require_once("../modelo/obra.cls.php");
require_once("../modelo/material.cls.php");

class clsRelatorio {

    public function RelatorioObra($dataIni, $dataFim, $idobra) {
        //die('obra-'.$dataIni);

        $cc = new clsCentroCusto();

        $html = $this->tableNota($dataIni, $dataFim, $idobra);
        $html .= $this->tableAdicao($dataIni, $dataFim, $idobra);
        $html .= $this->tableRetirada($dataIni, $dataFim, $idobra);
        $html .= $cc->ListaEstoque($idobra);

        return $html;
    }

    public function RelatorioNotaFiscal($dataIni, $dataFim, $notaFiscal, $fornecedor, $tipo) {
        //die('dtIni-'.$dataIni.' __ dtFim-'.$dataFim); 
        //die('nota-'.$notaFiscal.' __ fornecedor-'.$fornecedor); 

        $dtIniNova = $this->converteData($dataIni);
        $dtFimNova = $this->converteData($dataFim);

        if ($notaFiscal == "") {
            $notaFiscal = null;
        }

        if ($fornecedor == "") {
            $fornecedor = null;
        }

        $cabecalho = 'Intervalo de Data: ' . $dataIni . ' às ' . $dataFim . '';
        if ($dtIniNova == null && $dtFimNova == null) {
            $cabecalho = "Intervalo de Data: Sem filtro de data";
        }

        //die('dtIni-'.$dtIniNova.' __ dtFim-'.$dtFimNova); 

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
            <tr height = "1">
                <td align = "left" class = "small" width = "300px"> ' . $cabecalho . ' </td>
            </tr>        
                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "100px">Fornecedor</th>
                <th align = "center" class = "small" width = "100px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "60px">Valor</th>
                <th align = "center" class = "small" width = "60px">Material</th>
                <th align = "center" class = "small" width = "60px">Emissão</th>
                <th align = "center" class = "small" width = "60px">Vencimento</th>
                <th align = "center" class = "small" width = "40px">Frete</th>
                <th align = "center" class = "small" width = "60px">Data Lançamento</th>
                <th align = "center" class = "small" width = "60px">Observação</th>
                <th align = "center" class = "small" width = "60px">Referência</th>
                </tr>';


        $SQL = "SELECT 	nf.IDNOTA, NOMECOMPARA, NUMNOTA, VALORNOTA, DTEMISSAONOTA, VENCIMENTONOTA, FRETENOTA,
                CONCAT(ma.DESCMATERIAL, ' / ', un.SIGLAUNID) AS MATERIAL, DATAENTRADA, STR_TO_DATE(DATAENTRADA,'%d/%m/%Y') AS DATAENT,
                CASE  
                WHEN STR_TO_DATE(DATAENTRADA,'%d/%m/%Y') = STR_TO_DATE(VENCIMENTONOTA,'%d/%m/%Y') THEN 'A PAGAR'
                WHEN STR_TO_DATE(DATAENTRADA,'%d/%m/%Y') < STR_TO_DATE(VENCIMENTONOTA,'%d/%m/%Y') THEN 'FATURADO'
                ELSE 'A VISTA' END AS OBS, DTREFERENCIA
                FROM notafiscal nf
                INNER JOIN material_nota mn
                ON nf.IDNOTA = mn.IDNOTA
                INNER JOIN item it
                ON mn.IDITEM = it.IDITEM
                INNER JOIN material ma
                ON it.IDMATERIAL = ma.IDMATERIAL
                INNER JOIN unidade un
                ON it.IDUNIDADE = un.IDUNIDADE
                WHERE 1=1 ";

        if ($notaFiscal != null) {
            $SQL.=" AND UPPER(NUMNOTA) LIKE UPPER('%" . $notaFiscal . "%')";
        }
        if ($fornecedor != null) {
            $SQL.=" AND UPPER(NOMECOMPARA) LIKE UPPER('%" . $fornecedor . "%')";
        }

        if ($tipo == 2) {
            if ($dtIniNova != null || $dtFimNova != null) {
                $SQL.=" AND STR_TO_DATE(DTEMISSAONOTA,'%d/%m/%Y') BETWEEN '" . $dtIniNova . "' AND '" . $dtFimNova . "' ";
            }
            $SQL.=" ORDER BY STR_TO_DATE(DTEMISSAONOTA,'%d/%m/%Y') ";
        } else if ($tipo == 3) {
            if ($dtIniNova != null || $dtFimNova != null) {
                $SQL.=" AND STR_TO_DATE(DATAENTRADA,'%d/%m/%Y') BETWEEN '" . $dtIniNova . "' AND '" . $dtFimNova . "' ";
            }
            $SQL.=" ORDER BY STR_TO_DATE(DATAENTRADA,'%d/%m/%Y') ";
        } else {
            if ($dtIniNova != null || $dtFimNova != null) {
                $SQL.=" AND STR_TO_DATE(VENCIMENTONOTA,'%d/%m/%Y') BETWEEN '" . $dtIniNova . "' AND '" . $dtFimNova . "' ";
                //die($SQL);
            }
            $SQL.=" ORDER BY STR_TO_DATE(VENCIMENTONOTA,'%d/%m/%Y') ";
        }

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECOMPARA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMNOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> R$' . htmlentities($linha['VALORNOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['MATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTEMISSAONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['VENCIMENTONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['FRETENOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAENTRADA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['OBS']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTREFERENCIA']) . ' </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function converteData($data) {
        if ($data == "") {
            return null;
        }

        $array = explode('/', $data);
        // 10/10/2013
        return $array[2] . '-' . $array[1] . '-' . $array[0];
    }

    public function tableNota($dataIni, $dataFim, $idobra) {
        //die('aaa '.$dataIni.' a aa');

        $obra = new clsObra();
        $obra->preencheDados($idobra);

        $html = 'Período da busca: ' . $dataIni . ' à ' . $dataFim . ' - Obra: ' . $obra->getDescricao() . '
            </br>
            </br>
            <table border = "3" cellspacing = "2" cellpadding = "2">
            <tr height = "2">
            <b><span style="font-size: 20px">Adição por Nota Fiscal</span></b>
            <th align = "center" class = "small" width = "600px">Descri&ccedil;&atilde;o</th>
            <th align = "center" class = "small" width = "150px">Quantidade</th>
            <th align = "center" class = "small" width = "150px">Data Entrada</th>
            </tr>';


        $SQL = "SELECT mt.IDMATERIAL, mn.QUANTMATNOTA AS ESTOQUE, 
                CONCAT(mt.DESCMATERIAL, ' / ', un.SIGLAUNID) AS MATERIAL, nf.DATAENTRADA,
                mt.TIPOMATERIAL
                FROM notafiscal nf
                INNER JOIN compra cp
                ON nf.IDCOMPRA = cp.IDCOMPRA
                INNER JOIN obra ob
                ON cp.IDOBRA = ob.IDOBRA
                INNER JOIN material_nota mn
                ON nf.IDNOTA = mn.IDNOTA
                INNER JOIN item it
                ON mn.IDITEM = it.IDITEM
                INNER JOIN material mt
                ON it.IDMATERIAL = mt.IDMATERIAL
                INNER JOIN unidade un
                ON it.IDUNIDADE = un.IDUNIDADE
                WHERE 1=1 AND mn.QUANTMATNOTA > 0";

        if ($idobra != '0') {
            $SQL.=" AND ob.IDOBRA =" . $idobra . " ";
        }

        if ($dataIni != null && $dataFim != null) {
            $SQL.=" AND STR_TO_DATE(nf.DATAENTRADA,'%d/%m/%Y') BETWEEN STR_TO_DATE('" . $dataIni . "','%d/%m/%Y') AND STR_TO_DATE('" . $dataFim . "','%d/%m/%Y')";
        }

        $SQL.=" ORDER BY STR_TO_DATE(nf.DATAENTRADA,'%d/%m/%Y'), mt.DESCMATERIAL ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {
            if ($linha['TIPOMATERIAL'] != "CONTA") {
                $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['MATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['ESTOQUE']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAENTRADA']) . ' </td>
                </tr>';
            }
        }


        $html .= '</table>';


        //die(print_r($arrayNota));

        return $html;
    }

    public function tableAdicao($dataIni, $dataFim, $idobra) {

        $html = '<table border = "3" cellspacing = "2" cellpadding = "2"> 
                <tr height = "2">
                </br>
                <b><span style="font-size: 20px">Adição Livre</span></b>
                <th align = "center" class = "small" width = "600px">Descri&ccedil;&atilde;o</th>
                <th align = "center" class = "small" width = "150px">Quantidade</th>
                <th align = "center" class = "small" width = "150px">Data Entrada</th>
                </tr>';


        $SQL = "SELECT mt.IDMATERIAL, ae.QUANTESTOQUE AS ESTOQUE,
                CONCAT(mt.DESCMATERIAL, ' / ', un.SIGLAUNID) AS MATERIAL, ae.DATAENTESTOQUE,
                mt.TIPOMATERIAL
                FROM add_estoque ae
                INNER JOIN material mt
                ON ae.IDMATERIAL = mt.IDMATERIAL
                INNER JOIN unidade un
                ON ae.IDUNIDADE = un.IDUNIDADE
                WHERE 1=1 ";

        if ($idobra != '0') {
            $SQL.=" AND ae.IDOBRA =" . $idobra . " ";
        }

        if ($dataIni != null && $dataFim != null) {
            $SQL.=" AND STR_TO_DATE(ae.DATAENTESTOQUE,'%d/%m/%Y') BETWEEN STR_TO_DATE('" . $dataIni . "','%d/%m/%Y') AND STR_TO_DATE('" . $dataFim . "','%d/%m/%Y')";
        }

        $SQL.=" ORDER BY STR_TO_DATE(ae.DATAENTESTOQUE,'%d/%m/%Y'), mt.DESCMATERIAL ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {
            if ($linha['TIPOMATERIAL'] != "CONTA") {
                $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['MATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['ESTOQUE']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAENTESTOQUE']) . ' </td>
                </tr>';
            }
        }


        $html .= '</table>';


        //die(print_r($arrayNota));

        return $html;
    }

    public function tableRetirada($dataIni, $dataFim, $idobra) {


        $html = '<table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                </br>
                <b><span style="font-size: 20px">Retirada de Material</span></b>
                <th align = "center" class = "small" width = "600px">Descri&ccedil;&atilde;o</th>
                <th align = "center" class = "small" width = "150px">Quantidade</th>
                <th align = "center" class = "small" width = "150px">Data Saída</th>
                </tr>';


        $SQL = "SELECT re.IDOBRA, re.IDMATERIAL, re.QUANTRETIRADA ESTOQUE,
                CONCAT(mt.DESCMATERIAL, ' / ', un.SIGLAUNID) AS MATERIAL, re.DATARETESTOQUE,
                mt.TIPOMATERIAL
                FROM retirada_estoque re
                INNER JOIN material mt
                ON re.IDMATERIAL = mt.IDMATERIAL
                INNER JOIN unidade un
                ON re.IDUNIDADE = un.IDUNIDADE
                WHERE 1=1 ";

        if ($idobra != '0') {
            $SQL.=" AND IDOBRA =" . $idobra . " ";
        }

        if ($dataIni != null && $dataFim != null) {
            $SQL.=" AND STR_TO_DATE(re.DATARETESTOQUE,'%d/%m/%Y') BETWEEN STR_TO_DATE('" . $dataIni . "','%d/%m/%Y') AND STR_TO_DATE('" . $dataFim . "','%d/%m/%Y')";
        }

        $SQL.=" ORDER BY STR_TO_DATE(re.DATARETESTOQUE,'%d/%m/%Y'), mt.DESCMATERIAL ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {
            if ($linha['TIPOMATERIAL'] != "CONTA") {
                $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['MATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['ESTOQUE']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATARETESTOQUE']) . ' </td>
                </tr>';
            }
        }


        $html .= '</table></br><b><span style="font-size: 20px">ESTOQUE TOTAL</span></b> ';


        //die(print_r($arrayNota));

        return $html;
    }

    public function RelatorioCentroCusto($idobra, $idcentro) {

        //DIE($idobra. '   dwdqw '.$idcentro);
        $obra = new clsObra();
        $obra->preencheDados($idobra);

        $centroNome = "";
        if ($idcentro > 0) {
            $centro = new clsCentroCusto();
            $centro->RetornaCentroCusto($idcentro);
            $centroNome = " - Centro de Custo: " . $centro->getDescCentro();
        }

        $html = '<table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                </br>
                <b><span style="font-size: 20px">Retirada de Material</span></b>
                </br>
                <span align="center" style="font-size: 20px">Obra: ' . $obra->getDescricao() . $centroNome . '</span>
                <th align = "center" class = "small" width = "150px">Data Retirada</th>
                <th align = "center" class = "small" width = "600px">Material</th>
                <th align = "center" class = "small" width = "150px">Quantidade</th>
                </tr>';


        $SQL = "SELECT re.QUANTRETIRADA, re.DATARETESTOQUE, CONCAT(mt.DESCMATERIAL, ' / ' , un.SIGLAUNID) MATERIAL
                FROM retirada_estoque re
                INNER JOIN material mt
                ON re.IDMATERIAL = mt.IDMATERIAL
                INNER JOIN unidade un
                ON re.IDUNIDADE = un.IDUNIDADE
                WHERE re.IDOBRA = " . $idobra . "";
//die($SQL);
        if ($idcentro > 0) {
            $SQL.=" AND re.IDCENTRO =" . $idcentro . " ";
        }


        $SQL.=" ORDER BY STR_TO_DATE(re.DATARETESTOQUE,'%d/%m/%Y'), mt.DESCMATERIAL ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATARETESTOQUE']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['MATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $linha['QUANTRETIRADA'] . ' </td>
                </tr>';
        }


        $html .= '</table> ';






        $html .= '<table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                </br>
                <b><span style="font-size: 20px">Retirada de Material - Soma Geral</span></b>  
                <th align = "center" class = "small" width = "650px">Material</th>
                <th align = "center" class = "small" width = "250px">Quantidade</th>
                </tr>';


        $SQL = "SELECT SUM(re.QUANTRETIRADA) SOMA, re.DATARETESTOQUE, CONCAT(mt.DESCMATERIAL, ' / ' , un.SIGLAUNID) MATERIAL
                FROM retirada_estoque re
                INNER JOIN material mt
                ON re.IDMATERIAL = mt.IDMATERIAL
                INNER JOIN unidade un
                ON re.IDUNIDADE = un.IDUNIDADE
                WHERE re.IDOBRA = " . $idobra . "";
//die($SQL);
        if ($idcentro > 0) {
            $SQL.=" AND re.IDCENTRO =" . $idcentro . " ";
        }


        $SQL.=" GROUP BY mt.DESCMATERIAL 
                ORDER BY mt.DESCMATERIAL ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1"> 
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['MATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $linha['SOMA'] . ' </td>
                </tr>';
        }


        $html .= '</table> ';





        //die(print_r($arrayNota));

        return $html;
    }

    public function RelatorioProtocoloNotaFiscal($dataIni, $dataFim, $notaFiscal, $fornecedor) {
        //die('dtIni-'.$dataIni.' __ dtFim-'.$dataFim); 
        //die('nota-'.$notaFiscal.' __ fornecedor-'.$fornecedor); 

        $dtIniNova = $this->converteData($dataIni);
        $dtFimNova = $this->converteData($dataFim);

        if ($notaFiscal == "") {
            $notaFiscal = null;
        }

        if ($fornecedor == "") {
            $fornecedor = null;
        }

        $cabecalho = 'Intervalo de Data: ' . $dataIni . ' às ' . $dataFim . '';
        if ($dtIniNova == null && $dtFimNova == null) {
            $cabecalho = "Intervalo de Data: Sem filtro de data";
        }

        //die('dtIni-'.$dtIniNova.' __ dtFim-'.$dtFimNova); 

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
            <tr height = "1">
                <td align = "left" class = "small" width = "300px"> ' . $cabecalho . ' </td>
            </tr>        
                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "160px">Fornecedor</th>
                <th align = "center" class = "small" width = "100px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "60px">Valor</th> 
                <th align = "center" class = "small" width = "60px">Emissão</th>
                <th align = "center" class = "small" width = "60px">Vencimento</th>
                <th align = "center" class = "small" width = "40px">Frete</th>
                <th align = "center" class = "small" width = "60px">Data Lançamento</th>
                <th align = "center" class = "small" width = "60px">Observação</th>
                </tr>';


        $SQL = "SELECT 	nf.IDNOTA, NOMECOMPARA, NUMNOTA, VALORNOTA, DTEMISSAONOTA, VENCIMENTONOTA, FRETENOTA,
                DATAENTRADA, STR_TO_DATE(DATAENTRADA,'%d/%m/%Y') AS DATAENT,
                CASE  
                WHEN STR_TO_DATE(DATAENTRADA,'%d/%m/%Y') = STR_TO_DATE(VENCIMENTONOTA,'%d/%m/%Y') THEN 'A PAGAR'
                WHEN STR_TO_DATE(DATAENTRADA,'%d/%m/%Y') < STR_TO_DATE(VENCIMENTONOTA,'%d/%m/%Y') THEN 'FATURADO'
                ELSE 'A VISTA' END AS OBS
                FROM notafiscal nf
                INNER JOIN material_nota mn
                ON nf.IDNOTA = mn.IDNOTA
                INNER JOIN item it
                ON mn.IDITEM = it.IDITEM
                INNER JOIN material ma
                ON it.IDMATERIAL = ma.IDMATERIAL
                INNER JOIN unidade un
                ON it.IDUNIDADE = un.IDUNIDADE
                WHERE 1=1 ";

        if ($notaFiscal != null) {
            $SQL.=" AND UPPER(NUMNOTA) LIKE UPPER('%" . $notaFiscal . "%')";
        }
        if ($fornecedor != null) {
            $SQL.=" AND UPPER(NOMECOMPARA) LIKE UPPER('%" . $fornecedor . "%')";
        }

        if ($dtIniNova != null || $dtFimNova != null) {
            $SQL.=" AND STR_TO_DATE(DATAENTRADA,'%d/%m/%Y') BETWEEN '" . $dtIniNova . "' AND '" . $dtFimNova . "' ";
        }
        $SQL.=" GROUP BY nf.IDNOTA 
                ORDER BY STR_TO_DATE(VENCIMENTONOTA,'%d/%m/%Y'), NOMECOMPARA ";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECOMPARA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMNOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> R$' . htmlentities($linha['VALORNOTA']) . ' </td> 
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTEMISSAONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['VENCIMENTONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['FRETENOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAENTRADA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['OBS']) . ' </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function RelatorioAnaliseExtrato($mes, $ano, $doc, $idcentro) {

        $this->executaAnalise($mes, $ano, $idcentro);

        $html = "";

        if ($doc == 0) {
            $html = $this->RelatCaixaAnalise($mes, $ano, $doc, $idcentro);
        } else {
            $html = $this->RelatExtratoAnalise($mes, $ano, $doc, $idcentro);
        }

        return $html;
    }

    public function RelatCaixaAnalise($mes, $ano, $doc, $idcentro) {

        if (strlen($mes) == 1) {
            $mes = '0' . $mes;
        }

        $nomeRelat = "CAIXA";

        $cabecalho = $nomeRelat . ' - ' . $mes . '/' . $ano . ' - <input type="submit" value="Salvar"/>';


        $html = "";


        $html .= '
                <input type="hidden" name="docHid" value="' . $doc . '" />
                <input type="hidden" name="mes" value="' . $mes . '" />
                <input type="hidden" name="ano" value="' . $ano . '" />
                <input type="hidden" name="IDCENTROFINANC" value="' . $idcentro . '" />
                <table border = "0" cellspacing = "3" cellpadding = "0">
                <tr height = "1">
                <td align = "left" class = "small" width = "300px"> ' . $cabecalho . ' </td>
                </tr>        
                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "100px">DT. PAGTO.</th> 
                <th align = "center" class = "small" width = "250px">FORNECEDOR</th>
                <th align = "center" class = "small" width = "200px">NOTA FISCAL</th>     
                <th align = "center" class = "small" width = "200px">VENCIMENTO</th>
                <th align = "center" class = "small" width = "60px">VALOR</th>
                <th align = "center" class = "small" width = "60px">DT. ENVIO</th>
                <th align = "center" class = "small" width = "30px">NUM.</th>
                </tr>';

        if ($idcentro == 0) {
            $SQL = "SELECT IDNOTAFINANC, DATAPAGAMENTO, f.NOMEFORNECEDOR, NUMNOTAFINANC, DTREFERENCIA, 
                DTVENCIMENTO, VALORNOTAFINANC, DATAENVIO, NUMENVIO,
                TIPONOTA, IDCENTRO, EXTRATO
                FROM notafiscalfinanceiro nff
                INNER JOIN fornecedor f
                ON nff.IDFORNECEDOR = f.IDFORNECEDOR
                WHERE 1=1 AND TIPONOTA =0 AND (IDCENTRO=1 OR IDCENTRO=2 OR IDCENTRO=3 OR IDCENTRO=10 OR 
                                               IDCENTRO=11 OR IDCENTRO=12 OR IDCENTRO=13 OR IDCENTRO=14 OR 
                                               IDCENTRO=15 OR IDCENTRO=17) AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'
                UNION 
                SELECT CONCAT(IDNOTA,'_NF'), DATAPAGAMENTO, f.NOMEFORNECEDOR, NUMNOTA, DTREFERENCIA, 
                VENCIMENTONOTA, VALORNOTA, DATAENVIO, NUMENVIO,
                TIPONOTA, IDCENTROFINANC, EXTRATO
                FROM notafiscal nf 
                INNER JOIN fornecedor f
                ON nf.NOMECOMPARA = f.NOMEFORNECEDOR
                WHERE 1=1 AND TIPONOTA =0 AND (IDCENTROFINANC=1 OR IDCENTROFINANC=2 OR IDCENTROFINANC=3 OR IDCENTROFINANC=10 OR 
                                               IDCENTROFINANC=11 OR IDCENTROFINANC=12 OR IDCENTROFINANC=13 OR IDCENTROFINANC=14 OR 
                                               IDCENTROFINANC=15 OR IDCENTROFINANC=17) AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'
                ORDER BY STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y'), STR_TO_DATE(DTVENCIMENTO,'%d/%m/%Y'), NOMEFORNECEDOR ";
        } else {
            $SQL = "SELECT IDNOTAFINANC, DATAPAGAMENTO, f.NOMEFORNECEDOR, NUMNOTAFINANC, DTREFERENCIA, 
                DTVENCIMENTO, VALORNOTAFINANC, DATAENVIO, NUMENVIO,
                TIPONOTA, IDCENTRO, EXTRATO
                FROM notafiscalfinanceiro nff
                INNER JOIN fornecedor f
                ON nff.IDFORNECEDOR = f.IDFORNECEDOR
                WHERE 1=1 AND TIPONOTA =0 AND IDCENTRO=" . $idcentro . " AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'
                UNION 
                SELECT CONCAT(IDNOTA,'_NF'), DATAPAGAMENTO, f.NOMEFORNECEDOR, NUMNOTA, DTREFERENCIA, 
                VENCIMENTONOTA, VALORNOTA, DATAENVIO, NUMENVIO,
                TIPONOTA, IDCENTROFINANC, EXTRATO
                FROM notafiscal nf 
                INNER JOIN fornecedor f
                ON nf.NOMECOMPARA = f.NOMEFORNECEDOR
                WHERE 1=1 AND TIPONOTA =0 AND IDCENTROFINANC=" . $idcentro . " AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'
                ORDER BY STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y'), STR_TO_DATE(DTVENCIMENTO,'%d/%m/%Y'), NOMEFORNECEDOR ";
        }
        // die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $cor = 'style="background-color: lightsalmon;"';


        foreach ($tbl as $chave => $linha) {

            $html .= '
                <tr height = "1">
                <td align = "center" class = "small" width = "100px" > ' . htmlentities($linha['DATAPAGAMENTO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMEFORNECEDOR']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . strtoupper($linha['NUMNOTAFINANC']) . ' </td>                
                <td align = "center" class = "small" width = "100px"> ' . strtoupper(htmlentities($linha['DTVENCIMENTO'])) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . strtoupper(htmlentities($linha['VALORNOTAFINANC'])) . ' </td>';
            if ($linha['NUMENVIO'] == 0) {
                $linha['NUMENVIO'] = "";
            }
            $html .= '<td align = "center" class = "small" width = "100px"> ' . strtoupper(htmlentities($linha['DATAENVIO'])) . ' </td>
                      <td align = "center" class = "small" width = "100px"> ' . strtoupper(htmlentities($linha['NUMENVIO'])) . ' </td>';

            if ($linha['EXTRATO'] == 1) {
                $html .= '<td align = "center" class = "small" width = "100px" style="background-color: lightsalmon;" > <input type="checkbox" checked name="confirma[]" value="' . $linha['IDNOTAFINANC'] . '" /> </td>';
            } else {
                $html .= '<td align = "center" class = "small" width = "100px"> <input type="checkbox" name="confirma[]" value="' . $linha['IDNOTAFINANC'] . '" /> </td>';
            }

            $html .= '</tr>';
            //<div style="border-radius: 100%; width: 15px; height: 15px; margin: auto; background-color: red;  "></div>
            //<td align = "center" class = "small" width = "100px"> ' . strtoupper(htmlentities($linha['DTREFERENCIA'])) . ' </td>
            //die($total);       
        }

        //$totalGeral = str_replace('.', ',', $total);
        //$totalGeral = number_format($total, 2, ",", ".");

        $html .= '</table> </table>';

        return $html;
    }

    public function RelatExtratoAnalise($mes, $ano, $doc, $idcentro) {


        if (strlen($mes) == 1) {
            $mes = '0' . $mes;
        }
        $nomeRelat = "EXTRATO";
        $cabecalho = $nomeRelat . ' - ' . $mes . '/' . $ano . ' - <input type="submit" value="Salvar"/>';


        $html = "";

        $html .= '
                <input type="hidden" name="docHid" value="' . $doc . '" />
                <input type="hidden" name="mes" value="' . $mes . '" />
                <input type="hidden" name="ano" value="' . $ano . '" />
                <input type="hidden" name="IDCENTROFINANC" value="' . $idcentro . '" />
                <table border = "0" cellspacing = "3" cellpadding = "0">    
                <tr height = "1">
                <td align = "left" class = "small" width = "300px"> ' . $cabecalho . ' </td>
                </tr>        
                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "200px">DT. PAGTO.</th> 
                <th align = "center" class = "small" width = "200px">NR. DOC.</th>
                <th align = "center" class = "small" width = "250px">HISTÓRICO</th>     
                <th align = "center" class = "small" width = "200px">VALOR</th> 
                <th align = "center" class = "small" width = "200px">OK</th>';
        if ($idcentro == 1 || $idcentro == 0) {
            $html .= '<th align = "center" class = "small" width = "250px">DESC</th>';
        }

        $html .= '</tr>';


//<th align = "center" class = "small" width = "60px">REFERÊNCIA / PERÍODO</th>



        if ($idcentro == 0) {
            $SQL = "SELECT ext.IDEXTRATO, ext.DATA, ext.NRDOC, ext.HISTORICO, ext.VALOR, ext.DEBCRED, ext.MES, ext.ANO, ext.EXTRATO,
                nff.VALORNOTAFINANC , CONCAT(f.NOMEFORNECEDOR,' / ', nff.NUMNOTAFINANC,' / ', nff.DTVENCIMENTO) AS DETALHE
                FROM extrato ext
                LEFT JOIN notafiscalfinanceiro nff ON ext.DATA = nff.DATAPAGAMENTO 
                AND ext.VALOR = nff.VALORNOTAFINANC  AND (nff.IDCENTRO=1  OR nff.IDCENTRO=2 OR nff.IDCENTRO=3 OR nff.IDCENTRO=10 
                OR nff.IDCENTRO=11 OR nff.IDCENTRO=12 OR nff.IDCENTRO=13 OR nff.IDCENTRO=14 
                OR nff.IDCENTRO=15 OR nff.IDCENTRO=17)
                LEFT JOIN fornecedor f
                ON nff.IDFORNECEDOR = f.IDFORNECEDOR
                WHERE (IDCENTROCUSTOFINANC=1  OR IDCENTROCUSTOFINANC=2  OR IDCENTROCUSTOFINANC=3  
                OR IDCENTROCUSTOFINANC=10  OR IDCENTROCUSTOFINANC=11  OR IDCENTROCUSTOFINANC=12  
                OR IDCENTROCUSTOFINANC=13  OR IDCENTROCUSTOFINANC=14  OR IDCENTROCUSTOFINANC=15  OR IDCENTROCUSTOFINANC=17) 
                AND STR_TO_DATE(DATA,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'
                ORDER BY STR_TO_DATE(ext.DATA,'%d/%m/%Y'), ext.VALOR DESC ";
        } else if ($idcentro == 1) {

            $SQL = "SELECT ext.IDEXTRATO, ext.DATA, ext.NRDOC, ext.HISTORICO, ext.VALOR, ext.DEBCRED, ext.MES, ext.ANO, ext.EXTRATO,
                nff.VALORNOTAFINANC , CONCAT(f.NOMEFORNECEDOR,' / ', nff.NUMNOTAFINANC,' / ', nff.DTVENCIMENTO) AS DETALHE
                FROM extrato ext
                LEFT JOIN notafiscalfinanceiro nff ON ext.DATA = nff.DATAPAGAMENTO 
                AND ext.VALOR = nff.VALORNOTAFINANC  AND nff.IDCENTRO=1
                LEFT JOIN fornecedor f
                ON nff.IDFORNECEDOR = f.IDFORNECEDOR
                WHERE IDCENTROCUSTOFINANC=" . $idcentro . " AND STR_TO_DATE(DATA,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'
                ORDER BY STR_TO_DATE(ext.DATA,'%d/%m/%Y'), ext.VALOR DESC ";
        } else {

            $SQL = "SELECT 	IDEXTRATO, DATA, NRDOC, HISTORICO, VALOR, 
                DEBCRED, MES, ANO, EXTRATO	 
                FROM extrato
                WHERE IDCENTROCUSTOFINANC=" . $idcentro . " AND STR_TO_DATE(DATA,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'
                ORDER BY STR_TO_DATE(DATA,'%d/%m/%Y')";
        }
        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();


        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">';

            $html .= '
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $linha['NRDOC'] . ' </td> 
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['HISTORICO']) . ' </td>
                <td align = "right" class = "small" width = "100px"> ' . htmlentities($linha['VALOR']) . '&nbsp;' . $linha['DEBCRED'] . '&nbsp; </td>';
            //die('...'.$linha['DEBCRED'].'...');
            if (trim($linha['DEBCRED']) == "D") {
                if ($linha['EXTRATO'] == 1) {
                    $html .= '<td align = "center" class = "small" width = "100px" style="background-color: lightsalmon;" > <input type="checkbox" checked name="confirma[]" value="' . $linha['IDEXTRATO'] . '" /> </td>';
                } else {
                    $html .= '<td align = "center" class = "small" width = "100px"> <input type="checkbox" name="confirma[]" value="' . $linha['IDEXTRATO'] . '" /> </td>';
                }
            } else {

                $html .= '<td align = "center" class = "small" width = "100px"  >  </td>';
            }
            if ($idcentro == 1 || $idcentro == 0) {
                $html .= '<td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DETALHE']) . ' </td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table> </table>';

        return $html;
    }

    public function RelatorioProtocoloFornecedorMaterial($idmaterial) {

        $material = new clsMaterial();
        $material->preencheDados($idmaterial);

        $cabecalho = 'MATERIAL PESQUISADO: ' . $material->getDescricao();

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
            <tr height = "1">
                <td align = "left" class = "small" width = "300px"> ' . $cabecalho . ' </td>
            </tr>        
                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "560px">Fornecedor</th>
                <th align = "center" class = "small" width = "150px">Valor</th> 
                </tr>';
        //<th align = "center" class = "small" width = "150px">Data da Compra</th> 


        $SQL = "SELECT 	comp.NOMECOMPARA, MIN(comp.VALORCOMPARA) AS VALOR, cp.DATACOMPRA,
                CONCAT(ma.DESCMATERIAL, ' / ', un.SIGLAUNID) AS MATERIAL, comp.MELHORCOMPARA
                FROM compara comp
                INNER JOIN item it
                ON it.IDITEM = comp.IDITEM  
                LEFT JOIN compra cp
                ON comp.IDCOMPRA = cp.IDCOMPRA
                INNER JOIN material ma
                ON it.IDMATERIAL = ma.IDMATERIAL
                INNER JOIN unidade un
                ON it.IDUNIDADE = un.IDUNIDADE
                WHERE 1=1 AND  ma.IDMATERIAL = " . $idmaterial . " 
                GROUP BY comp.NOMECOMPARA
                ORDER BY comp.MELHORCOMPARA DESC, comp.VALORCOMPARA, comp.NOMECOMPARA ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            if ($linha['MELHORCOMPARA'] == 1) {
                $add = 'style="color: red"';
            } else {
                $add = '';
            }

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECOMPARA']) . ' </td>
                <td align = "center" class = "small" width = "100px" ' . $add . '> R$' . htmlentities($linha['VALOR']) . ' </td>
                </tr>';
        }
//      <td align = "center" class = "small" width = "100px"> ' . $linha['DATACOMPRA'] . ' </td>

        $html .= '</table> </table>';



        return $html;
    }

    public function RelatorioFinanceiro($tipo, $centroCusto, $fornecedor, $dtLancaIni, $dtLancaFim, $dtPagIni, $dtPagFim, $num, $envio) {
//die($envio);
        //die('dtIni-'.$dataIni.' __ dtFim-'.$dataFim); 
        //die('nota-'.$notaFiscal.' __ fornecedor-'.$fornecedor); 

        $cc = new clsCentroCustoFinanceiro();
        $cc->preencheDados($centroCusto);

        if ($tipo == 0) {
            $tipoNome = 'MOVIMENTO DE CAIXA';
        } else {
            $tipoNome = 'GUIA DE ENCAMINHAMENTO';
        }


        $dtLancaIniBanco = $this->converteData($dtLancaIni);
        $dtLancaFimBanco = $this->converteData($dtLancaFim);
        $dtPagIniBanco = $this->converteData($dtPagIni);
        $dtPagFimBanco = $this->converteData($dtPagFim);

        //die('dtIni-'.$dtIniNova.' __ dtFim-'.$dtFimNova); 

        $cabecalho = $tipoNome;
        if ($dtLancaIni != "" && $dtLancaFim != "") {
            $cabecalho .= ' - INTERVALO DE DATA: ' . $dtLancaIni . ' ÀS ' . $dtLancaFim;
        }
        if ($centroCusto != 0) {

            $cabecalho .= ' - CENTRO DE CUSTO: ' . strtoupper($cc->getNome());
        }

        //die('dtIni-'.$dtIniNova.' __ dtFim-'.$dtFimNova); 

        $html = "";


        if ($tipo == 0) {
            $html .= '<th align = "center" class = "small" width = "100px">DT. PAGTO.</th>';
        }
        $html .= '
                <th align = "center" class = "small" width = "250px">FORNECEDOR</th>
                <th align = "center" class = "small" width = "200px">NOTA FISCAL</th> ';
        if ($tipo == 0) {
            if ($centroCusto == 4) {
                $html .= '<th align = "center" class = "small" width = "200px">OBRA</th>';
            } else if ($centroCusto == 1 || $centroCusto == 2 || $centroCusto == 3 || $centroCusto == 17) {
                $html .= '<th align = "center" class = "small" width = "200px">TIPO</th>';
            } else {
                $html .= '<th align = "center" class = "small" width = "200px">VENCIMENTO</th>';
            }
        } else {
            $html .= '<th align = "center" class = "small" width = "200px">VENCIMENTO</th>';
        }

        $html .= '<th align = "center" class = "small" width = "60px">VALOR</th>';
        if ($envio == -1) {
            $html .= ' <th align = "center" class = "small" width = "60px">DT. ENVIO</th>
                <th align = "center" class = "small" width = "30px">NUM.</th>';
        }
        $html .= '</tr>';
//<th align = "center" class = "small" width = "60px">REFERÊNCIA / PERÍODO</th>

        $SQL = "SELECT DATAPAGAMENTO, f.NOMEFORNECEDOR, NUMNOTAFINANC, DTREFERENCIA, 
                DTVENCIMENTO, VALORNOTAFINANC, DATAENVIO, NUMENVIO,
                TIPONOTA, IDCENTRO,
                CASE
                WHEN DTVENCIMENTO = 'CUPOM FISCAL' THEN '1'
                WHEN DTVENCIMENTO = 'RECIBO' THEN '2'
                ELSE '3'
                END AS ORDEM
                FROM notafiscalfinanceiro nff
                INNER JOIN fornecedor f
                ON nff.IDFORNECEDOR = f.IDFORNECEDOR
                WHERE 1=1 AND TIPONOTA =" . $tipo;

        if ($centroCusto != 0) {
            $SQL.=" AND IDCENTRO=" . $centroCusto;
        }

        if ($fornecedor != "0") {
            $SQL.=" AND f.NOMEFORNECEDOR='" . $fornecedor . "'";
        }
        if ($dtLancaIni != "" && $dtLancaFim != "") {
            $SQL.=" AND STR_TO_DATE(DATAENVIO,'%d/%m/%Y') BETWEEN '" . $dtLancaIniBanco . "' AND '" . $dtLancaFimBanco . "' ";
        }
        if ($dtPagIni != "" && $dtPagFim != "") {
            $SQL.=" AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $dtPagIniBanco . "' AND '" . $dtPagFimBanco . "' ";
        }
        if ($num != "") {
            $SQL.=" AND NUMENVIO=" . $num;
        }
        $SQL.="  UNION ";

        //die($SQL);
        $SQL .= "SELECT DATAPAGAMENTO, f.NOMEFORNECEDOR, NUMNOTA, DTREFERENCIA, 
                VENCIMENTONOTA, VALORNOTA, DATAENVIO, NUMENVIO,
                TIPONOTA, IDCENTROFINANC,
                CASE
                WHEN VENCIMENTONOTA = 'CUPOM FISCAL' THEN '1'
                WHEN VENCIMENTONOTA = 'RECIBO' THEN '2'
                ELSE '3'
                END AS ORDEM
                FROM notafiscal nf 
                INNER JOIN fornecedor f
                ON nf.NOMECOMPARA = f.NOMEFORNECEDOR
                WHERE 1=1 AND TIPONOTA =" . $tipo;

        if ($centroCusto != 0) {
            $SQL.=" AND IDCENTROFINANC=" . $centroCusto;
        }

        if ($fornecedor != "0") {
            $SQL.=" AND f.NOMEFORNECEDOR='" . $fornecedor . "'";
        }
        if ($dtLancaIni != "" && $dtLancaFim != "") {
            $SQL.=" AND STR_TO_DATE(DATAENVIO,'%d/%m/%Y') BETWEEN '" . $dtLancaIniBanco . "' AND '" . $dtLancaFimBanco . "' ";
        }
        if ($dtPagIni != "" && $dtPagFim != "") {
            $SQL.=" AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $dtPagIniBanco . "' AND '" . $dtPagFimBanco . "' ";
        }
        if ($num != "") {
            $SQL.=" AND NUMENVIO=" . $num;
        }
        if ($tipo == 0) {
            if ($centroCusto == 4) {
                $SQL.=" ORDER BY NUMENVIO DESC, DTVENCIMENTO, STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y'), NOMEFORNECEDOR, NUMNOTAFINANC ";
            } else {
                $SQL.=" ORDER BY NUMENVIO DESC, ORDEM, STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y'), STR_TO_DATE(DTVENCIMENTO,'%d/%m/%Y'), NOMEFORNECEDOR, NUMNOTAFINANC ";
            }
        } else {
            $SQL.=" ORDER BY NUMENVIO DESC, STR_TO_DATE(DTVENCIMENTO,'%d/%m/%Y'), NOMEFORNECEDOR, NUMNOTAFINANC ";
        }
        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $total = 0;
        $tam = "700";

        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">';
            if ($tipo == 0) {
                $html .= '<td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAPAGAMENTO']) . ' </td>';
            }
            if ($linha['NUMENVIO'] == 0) {
                $linha['NUMENVIO'] = "";
            }
            $html .= '
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMEFORNECEDOR']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . strtoupper($linha['NUMNOTAFINANC']) . ' </td>
                
                <td align = "center" class = "small" width = "100px"> ' . strtoupper(($linha['DTVENCIMENTO'])) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . strtoupper(($linha['VALORNOTAFINANC'])) . ' </td>';
            if ($envio == "-1") {
                $html .= '<td align = "center" class = "small" width = "100px"> ' . strtoupper(htmlentities($linha['DATAENVIO'])) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . strtoupper(htmlentities($linha['NUMENVIO'])) . ' </td>';
            }
            $html .= '</tr>';

            //<td align = "center" class = "small" width = "100px"> ' . strtoupper(htmlentities($linha['DTREFERENCIA'])) . ' </td>

            $linha['VALORNOTAFINANC'] = str_replace('.', '', $linha['VALORNOTAFINANC']);
            $total += floatval(str_replace(',', '.', $linha['VALORNOTAFINANC']));
            //die($total);       

            if ($envio == 1) {
                $tam = "1070";
                $data = date("Y");
                $ano = $data[2] . $data[3];
                $cabecalho .= ' - DT. ENVIO: ' . strtoupper(htmlentities($linha['DATAENVIO']));
                $cabecalho .= ' - NUM: ' . strtoupper(htmlentities($linha['NUMENVIO'])) . '/' . $ano;
                $envio = "0";
            }
        }

        //$totalGeral = str_replace('.', ',', $total);
        $totalGeral = number_format($total, 2, ",", ".");




        $html .= '</table> </table>';
        $html .= '<table width="' . $tam . 'px" border="0" align="center" cellpadding="0" cellspacing="1">
            <tr height = "1">
                <td align = "right"  style="font-size: 20px" class = "small" width = "10%">
                Total: R$ <input name="valor" type="text" size="10" style="border:0; font-size: 20px;" value="' . $totalGeral . '"  onKeyPress="return(FormataReais(this, \'.\', \',\', event))" /> </td>
            </tr></table>';

        if ($centroCusto == 4 || $centroCusto == 17) {
            //die('aki');
            if ($centroCusto == 4) {
                $nome = "Ivódio Aris Veiga";
                $cpf = "159.281.601-00";
                $banco = "Caixa Econômica Federal";
                $agencia = "1315";
                $conta = "10608-2";
            } else if ($centroCusto == 17) {
                $nome = "Gabriel Silveira Rodrigues";
                $cpf = "098.771.916-52";
                $banco = "Caixa Econômica Federal";
                $agencia = "1533";
                $conta = "17905-0";
            }
            $html .= '</br></br></br><table width="400px" border="1" align="center" cellpadding="0" cellspacing="1" >
                <tr height = "1">
                    <td align = "right"  style="font-size: 20px" class = "small" width = "100px">
                    Nome: 
                    </td>
                    <td align = "left"  style="font-size: 20px" class = "small" width = "400px">
                    ' . $nome . '
                    </td>
                </tr>
                <tr height = "1">
                    <td align = "right"  style="font-size: 20px" class = "small" width = "100px">
                    CPF: 
                    </td>
                    <td align = "left"  style="font-size: 20px" class = "small" width = "400px">
                    ' . $cpf . '
                    </td>
                </tr>
                <tr height = "1">
                    <td align = "right"  style="font-size: 20px" class = "small" width = "100px">
                    Banco:  
                    </td>
                    <td align = "left"  style="font-size: 20px" class = "small" width = "400px">
                    ' . $banco . ' 
                    </td>
                </tr>
                <tr height = "1">
                    <td align = "right"  style="font-size: 20px" class = "small" width = "100px">
                    Agência: 
                    </td>
                    <td align = "left"  style="font-size: 20px" class = "small" width = "400px">
                    ' . $agencia . '
                    </td>
                </tr>
                <tr height = "1">
                    <td align = "right"  style="font-size: 20px" class = "small" width = "100px">
                    Conta:
                    </td>
                    <td align = "left"  style="font-size: 20px" class = "small" width = "400px">
                     ' . $conta . '
                    </td>
                </tr>
                </table>';
        }

        $htmlIni = '<table border = "0" cellspacing = "3" cellpadding = "0">
            <tr height = "1">
                <td align = "left" class = "small" width = "100%"> ' . $cabecalho . ' </td>
            </tr>        
             
                <table border = "3" cellspacing = "2" cellpadding = "2" width="1060px">
                <tr height = "2">';



        return $htmlIni . $html;
    }

    public function RelatorioFinanceiroObra($tipo, $centroCusto, $fornecedor, $dtLancaIni, $dtLancaFim, $dtPagIni, $dtPagFim, $num) {
        //die('dtIni-'.$dataIni.' __ dtFim-'.$dataFim); 
        //die('nota-'.$notaFiscal.' __ fornecedor-'.$fornecedor); 

        $dtLancaIniBanco = $this->converteData($dtLancaIni);
        $dtLancaFimBanco = $this->converteData($dtLancaFim);
        $dtPagIniBanco = $this->converteData($dtPagIni);
        $dtPagFimBanco = $this->converteData($dtPagFim);

        //die('dtIni-'.$dtIniNova.' __ dtFim-'.$dtFimNova); 
        //die('dtIni-'.$dtIniNova.' __ dtFim-'.$dtFimNova); 

        $html = '  <br/><b>RELATÓRIO FINANCEIRO OBRA</b>
              <table border = "3" cellspacing = "2" cellpadding = "2">
                
                <tr height = "2">';
        if ($tipo == 0) {
            $html .= '<th align = "center" class = "small" width = "100px">Data Pagto.</th>';
        }
        $html .= '
                <th align = "center" class = "small" width = "200px">Fornecedor</th>
                <th align = "center" class = "small" width = "100px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "60px">Referência / Período</th>
                <th align = "center" class = "small" width = "60px">Vencimento</th>
                <th align = "center" class = "small" width = "60px">Valor</th>
                <th align = "center" class = "small" width = "60px">Data Lançamento</th>
                <th align = "center" class = "small" width = "60px">Número</th>
                </tr>';


        $SQL = "SELECT DATAPAGAMENTO, f.NOMEFORNECEDOR, NUMNOTA, DTREFERENCIA, 
                VENCIMENTONOTA, VALORNOTA, DATAENVIO, NUMENVIO,
                TIPONOTA, IDCENTROFINANC
                FROM notafiscal nf 
                INNER JOIN fornecedor f
                ON nf.NOMECOMPARA = f.NOMEFORNECEDOR
                WHERE 1=1 AND TIPONOTA =" . $tipo;

        if ($centroCusto != 0) {
            $SQL.=" AND IDCENTROFINANC=" . $centroCusto;
        }

        if ($fornecedor != "0") {
            $SQL.=" AND f.NOMEFORNECEDOR='" . $fornecedor . "'";
        }
        if ($dtLancaIni != "" && $dtLancaFim != "") {
            $SQL.=" AND STR_TO_DATE(DATAENVIO,'%d/%m/%Y') BETWEEN '" . $dtLancaIniBanco . "' AND '" . $dtLancaFimBanco . "' ";
        }
        if ($dtPagIni != "" && $dtPagFim != "") {
            $SQL.=" AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $dtPagIniBanco . "' AND '" . $dtPagFimBanco . "' ";
        }
        if ($num != "") {
            $SQL.=" AND NUMENVIO=" . $num;
        }
        $SQL.=" ORDER BY STR_TO_DATE(VENCIMENTONOTA,'%d/%m/%Y') ";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $total = 0;
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">';
            if ($tipo == 0) {
                $html .= '<td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAPAGAMENTO']) . ' </td>';
            }
            if ($linha['NUMENVIO'] == 0) {
                $linha['NUMENVIO'] = "";
            }
            $html .= '
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMEFORNECEDOR']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMNOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DTREFERENCIA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['VENCIMENTONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['VALORNOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATAENVIO']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMENVIO']) . ' </td>
                </tr>';

            $total += floatval(str_replace(',', '.', $linha['VALORNOTA']));
        }
        $total += $_SESSION['valor'];

        $totalGeral = str_replace('.', ',', $total);




        $html .= '</table> </table>';
        $html .= '<table width="980px" border="0" align="center" cellpadding="0" cellspacing="1">
            <tr height = "1">
                <td align = "right"  style="font-size: 20px" class = "small" width = "10%">Total obtido: ' . $totalGeral . ' </td>
            </tr></table>';


        return $html;
    }

    public function executaAnalise($mes, $ano, $idcentro) {

        if ($idcentro == 0) {
            $SQL = "SELECT ext.IDEXTRATO, nff.IDNOTAFINANC, nf.IDNOTA FROM extrato ext 
                LEFT JOIN notafiscalfinanceiro nff ON ext.DATA = nff.DATAPAGAMENTO 
                AND ext.VALOR = nff.VALORNOTAFINANC 
                LEFT JOIN notafiscal nf ON ext.DATA = nf.DATAPAGAMENTO 
                AND ext.VALOR = nf.VALORNOTA 
                WHERE ext.MES = '" . $mes . "' AND ext.ANO = '" . $ano . "' 
                AND ext.IDCENTROCUSTOFINANC ='1' AND 
                ((nf.IDCENTROFINANC = '1' OR nff.IDCENTRO = '1') OR
                (nf.IDCENTROFINANC = '2' OR nff.IDCENTRO = '2') OR
                (nf.IDCENTROFINANC = '3' OR nff.IDCENTRO = '3') OR
                (nf.IDCENTROFINANC = '10' OR nff.IDCENTRO = '10') OR
                (nf.IDCENTROFINANC = '11' OR nff.IDCENTRO = '11') OR
                (nf.IDCENTROFINANC = '12' OR nff.IDCENTRO = '12') OR
                (nf.IDCENTROFINANC = '13' OR nff.IDCENTRO = '13') OR
                (nf.IDCENTROFINANC = '14' OR nff.IDCENTRO = '14') OR
                (nf.IDCENTROFINANC = '15' OR nff.IDCENTRO = '15') OR
                (nf.IDCENTROFINANC = '17' OR nff.IDCENTRO = '17'))";
        } else {

            $SQL = "SELECT ext.IDEXTRATO, nff.IDNOTAFINANC, nf.IDNOTA FROM extrato ext 
                LEFT JOIN notafiscalfinanceiro nff ON ext.DATA = nff.DATAPAGAMENTO 
                AND ext.VALOR = nff.VALORNOTAFINANC 
                LEFT JOIN notafiscal nf ON ext.DATA = nf.DATAPAGAMENTO 
                AND ext.VALOR = nf.VALORNOTA 
                WHERE ext.MES = '" . $mes . "' AND ext.ANO = '" . $ano . "' 
                AND ext.IDCENTROCUSTOFINANC ='" . $idcentro . "' AND 
                (nf.IDCENTROFINANC = '" . $idcentro . "' OR nff.IDCENTRO = '" . $idcentro . "')";
        }

        //die($SQL);
        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $textoExtrato = "";
        $textoNotaFinanc = "";
        $textoNota = "";
        foreach ($tbl as $chave => $linha) {
            if ($linha['IDNOTAFINANC'] > 0 || $linha['IDNOTA'] > 0) {
                $textoExtrato.=$linha['IDEXTRATO'] . ',';
            }
            if ($linha['IDNOTAFINANC'] > 0) {
                $textoNotaFinanc.=$linha['IDNOTAFINANC'] . ',';
            }
            if ($linha['IDNOTA'] > 0) {
                $textoNota.=$linha['IDNOTA'] . ',';
            }
        }
        $textoExtrato.='-1';
        $textoNotaFinanc.='-1';
        $textoNota.='-1';

        $SQL = "UPDATE extrato SET 
		EXTRATO=1
                WHERE IDEXTRATO IN( " . $textoExtrato . ")";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();

        $SQL = "UPDATE notafiscalfinanceiro SET 
		EXTRATO=1
                WHERE IDNOTAFINANC IN( " . $textoNotaFinanc . ")";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();

        $SQL = "UPDATE notafiscal SET 
		EXTRATO=1
                WHERE IDNOTA IN( " . $textoNota . ")";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function atualizaExtrato($confirma, $doc, $mes, $ano, $idcentro) {
        $textoExtrato = "";
        $textoExtratoNF = "";

        if ($confirma != 0) {

            if ($doc == 0) {
                foreach ($confirma as &$value) {
                    $pos = strpos($value, "_NF");
                    if ($pos === false) {
                        $textoExtrato.=$value . ',';
                    } else {
                        $textoExtratoNF.= str_replace("_NF", "", $value) . ',';
                    }
                }
                $textoExtrato.='-1';
                $textoExtratoNF.='-1';
                //die($textoExtrato);

                $SQL = "UPDATE notafiscal SET 
                    EXTRATO=0
                    WHERE IDCENTROFINANC = " . $idcentro . " AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'";

                //die($doc); 
                $con = new gtiConexao();
                $con->gtiConecta();
                $con->gtiExecutaSQL($SQL);
                $con->gtiDesconecta();

                $SQL = "UPDATE notafiscal SET 
                    EXTRATO=1
                    WHERE IDCENTROFINANC = " . $idcentro . " AND IDNOTA IN( " . $textoExtratoNF . ") AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'";


                //die($doc); 
                $con = new gtiConexao();
                $con->gtiConecta();
                $con->gtiExecutaSQL($SQL);
                $con->gtiDesconecta();




                $SQL = "UPDATE notafiscalfinanceiro SET 
                    EXTRATO=0
                    WHERE IDCENTRO = " . $idcentro . " AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'";

                //die($doc); 
                $con = new gtiConexao();
                $con->gtiConecta();
                $con->gtiExecutaSQL($SQL);
                $con->gtiDesconecta();

                $SQL = "UPDATE notafiscalfinanceiro SET 
                    EXTRATO=1
                    WHERE IDCENTRO = " . $idcentro . " AND  IDNOTAFINANC IN( " . $textoExtrato . ") AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'";


                //die($doc); 
                $con = new gtiConexao();
                $con->gtiConecta();
                $con->gtiExecutaSQL($SQL);
                $con->gtiDesconecta();
            } else {

                foreach ($confirma as &$value) {
                    $textoExtrato.=$value . ',';
                }
                $textoExtrato.='-1';

                $SQL = "UPDATE extrato SET 
                    EXTRATO=0
                    WHERE IDCENTROCUSTOFINANC = " . $idcentro . " AND  STR_TO_DATE(DATA,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'";

                //die($doc); 
                $con = new gtiConexao();
                $con->gtiConecta();
                $con->gtiExecutaSQL($SQL);
                $con->gtiDesconecta();

                $SQL = "UPDATE extrato SET 
                    EXTRATO=1
                    WHERE IDCENTROCUSTOFINANC = " . $idcentro . " AND  IDEXTRATO IN( " . $textoExtrato . ") AND STR_TO_DATE(DATA,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'";


                //die($doc); 
                $con = new gtiConexao();
                $con->gtiConecta();
                $con->gtiExecutaSQL($SQL);
                $con->gtiDesconecta();
            }
        } else {

            if ($doc == 0) {
                $SQL = "UPDATE notafiscal SET 
                        EXTRATO=0
                        WHERE IDCENTROFINANC = " . $idcentro . " AND STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'";

                $con = new gtiConexao();
                $con->gtiConecta();
                $con->gtiExecutaSQL($SQL);
                $con->gtiDesconecta();

                $SQL = "UPDATE notafiscalfinanceiro SET 
                        EXTRATO=0
                        WHERE IDCENTRO = " . $idcentro . " AND  STR_TO_DATE(DATAPAGAMENTO,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'";
            } else {
                $SQL = "UPDATE extrato SET 
                        EXTRATO=0
                        WHERE IDCENTROCUSTOFINANC = " . $idcentro . " AND  STR_TO_DATE(DATA,'%d/%m/%Y') BETWEEN '" . $ano . "-" . $mes . "-01' AND '" . $ano . "-" . $mes . "-31'";
            }
            //die($SQL); 
            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();
        }
    }

}

?>