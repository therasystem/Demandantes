<?php

require_once("../controle/conexao.gti.php");

class clsNotaFiscal {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idfornecedor;
    private $idcompra;
    private $nomeCompara;
    private $numNotaFiscal;
    private $valorNota;
    private $dtEmissao;
    private $vencimento;
    private $frete;
    private $referencia;
    private $dataEntrada;

    //Mï¿½TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdfornecedor() {
        return $this->idfornecedor;
    }

    public function setIdfornecedor($idfornecedor) {
        $this->idfornecedor = $idfornecedor;
    }

    public function getNomeCompara() {
        return $this->nomeCompara;
    }

    public function setNomeCompara($nomecompara) {
        $this->nomeCompara = $nomecompara;
    }

    public function getIdcompra() {
        return $this->idcompra;
    }

    public function setIdcompra($idcompra) {
        $this->idcompra = $idcompra;
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

    public function getDtEmissao() {
        return $this->dtEmissao;
    }

    public function setDtEmissao($dtEmissao) {
        $this->dtEmissao = $dtEmissao;
    }

    public function getVencimento() {
        return $this->vencimento;
    }

    public function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
    }

    public function getFrete() {
        return $this->frete;
    }

    public function setFrete($frete) {
        $this->frete = $frete;
    }

    public function getReferencia() {
        return $this->referencia;
    }

    public function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    public function getDataEntradda() {
        return $this->dataEntrada;
    }

    public function setDataEntrada($dataEntrada) {
        $this->dataEntrada = $dataEntrada;
    }

    function __construct() {
        $this->codigo = "";
        $this->idfornecedor = "";
        $this->idcompra = "";
        $this->numNotaFiscal = "";
        $this->valorNota = "";
        $this->dtEmissao = "";
        $this->vencimento = "";
        $this->referencia = "";
        $this->frete = "";
        $this->dataEntrada = "";
    }

    //Mï¿½todo para excluir um fornecedor
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM notafiscal WHERE IDNOTA=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Metodo para alterar uma fornecedor
    function Alterar() {
        $SQL = "UPDATE notafiscal SET 
		IDFORNECEDOR='" . $this->idfornecedor . "',
		IDCOMPRA='" . $this->idcompra . "',
		NOMECOMPARA='" . $this->nomeCompara . "',
		NUMNOTA='" . $this->numNotaFiscal . "',
		VALORNOTA='" . $this->valorNota . "',
		DTEMISSAONOTA='" . $this->dtEmissao . "',
		VENCIMENTONOTA='" . $this->vencimento . "',
		DTREFERENCIA='" . $this->referencia . "',
		FRETENOTA='" . $this->frete . "',
		DATAENTRADA='(SELECT DATE_FORMAT(NOW(),'%d/%m/%Y'))'
                WHERE IDNOTA='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que realiza o cadastro de um novo fornecedor
    public function Salvar() {

        $valoresTam = strlen($this->valorNota);
        $this->valorNota[$valoresTam - 1] = "";
        $valoresDiv = explode(";", $this->valorNota);

        $vencimentoTam = strlen($this->vencimento);
        $this->vencimento[$vencimentoTam - 1] = "";
        $vencimentoDiv = explode(";", $this->vencimento);

        $tam = count($valoresDiv);
        $tam2 = count($vencimentoDiv);
        $tamOfi = 0;
        if ($tam > $tam2) {
            $tamOfi = $tam2;
        } else {
            $tamOfi = $tam;
        }

        //die('asa' . print_r($vencimentoDiv) . 'aaaa');
        $i = 0;
        while ($tamOfi > $i) {
 
            $this->valorNota = $valoresDiv[$i];
            $this->vencimento = $vencimentoDiv[$i];
            
            $i++;
            $numeroNotaAlterado = $this->numNotaFiscal;
            $numeroNotaAlterado .= " " . $i."/".$tamOfi;
            

                    $SQL = "INSERT INTO notafiscal (IDFORNECEDOR, IDCOMPRA, NOMECOMPARA, NUMNOTA, VALORNOTA, DTEMISSAONOTA, VENCIMENTONOTA, DTREFERENCIA, FRETENOTA, DATAENTRADA) VALUES 
                ('" . $this->idfornecedor . "','" . $this->idcompra . "','" . $this->nomeCompara . "', '" . $numeroNotaAlterado . "', '" . $this->valorNota . "', '" . $this->dtEmissao . "', '" . $this->vencimento . "', '" . $this->referencia . "', '" . $this->frete . "', (SELECT DATE_FORMAT(NOW(),'%d/%m/%Y')));";

            //die($SQL);

            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();
        }
        return $tamOfi;
    }

    //Mï¿½todo que lista as fornecedor em um array para preencher o grid
    public function ListaMaterialNota($idCompra, $nomeForn, $temItem = 0) {


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "300px">Material</th>
                <th align = "center" class = "small" width = "130px">Quantidade Total</th>
                <th align = "center" class = "small" width = "150px">Valor Unid.</th> 
                <th align = "center" class = "small" width = "60px">Recebido</th>
                <th align = "center" class = "small" width = "90px">Quantidade Recebida</th>
                </tr>';


        $SQL = 'SELECT comp.IDITEM, mat.DESCMATERIAL, it.QUANTITEM, comp.VALORCOMPARA, und.SIGLAUNID, it.QUANTITEM - SUM(mt.QUANTMATNOTA) AS RESTANTE
                FROM compara comp
                INNER JOIN item it 
                ON comp.IDITEM = it.IDITEM
                INNER JOIN material mat
                ON it.IDMATERIAL = mat.IDMATERIAL
                INNER JOIN unidade und
                ON it.IDUNIDADE = und.IDUNIDADE
                LEFT JOIN material_nota mt
                ON it.IDITEM = mt.IDITEM
                WHERE comp.IDCOMPRA = ' . $idCompra . ' AND comp.NOMECOMPARA = "' . $nomeForn . '" AND comp.MELHORCOMPARA = 1
                GROUP BY comp.IDITEM
                ORDER BY mat.DESCMATERIAL';

        //die($SQL);
        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();


        $count = 0;

        foreach ($tbl as $chave => $linha) {

            if ($linha['RESTANTE'] > 0 || $linha['RESTANTE'] == null) {

                if ($linha['RESTANTE'] == null) {
                    $quant = $linha['QUANTITEM'];
                } else {
                    $quant = $linha['RESTANTE'];
                }

                $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "90px"> ' . htmlentities($linha['DESCMATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "80px"> ' . $linha['QUANTITEM'] . ' ' . $linha['SIGLAUNID'] . '</td>
                <td align = "center" class = "small" width = "80px"> R$' . $linha['VALORCOMPARA'] . ' </td> 
                <td align = "center"><input type="checkbox" name="recebido[]" value="' . $count . '" /> </td>
                <td align = "center"><input type="text" name="quantidade[]" value="' . $quant . '" size="3" /> </td>
                <input type="hidden" name="iditem[]" value="' . $linha['IDITEM'] . '" />
                </tr>';
                $count++;
            }
        }

        $html .= '</table> </table>';

        if ($temItem == 1) {
            $html = "1" . $this->ModificaMaterialNota($idCompra, $nomeForn);
        }

        return $html;
    }

    public function EditaMaterialNota($idnota) {


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "300px">Material</th>
                <th align = "center" class = "small" width = "130px">Quantidade Total</th>
                <th align = "center" class = "small" width = "150px">Valor Unid.</th> 
                <th align = "center" class = "small" width = "60px">Recebido</th>
                <th align = "center" class = "small" width = "90px">Quantidade Recebida</th>
                </tr>';


        $SQL = 'SELECT mt.IDNOTA, comp.IDITEM, mat.DESCMATERIAL, it.QUANTITEM, comp.VALORCOMPARA, und.SIGLAUNID, mt.QUANTMATNOTA AS RESTANTE
                FROM compara comp
                INNER JOIN item it 
                ON comp.IDITEM = it.IDITEM
                INNER JOIN material mat
                ON it.IDMATERIAL = mat.IDMATERIAL
                INNER JOIN unidade und
                ON it.IDUNIDADE = und.IDUNIDADE
                LEFT JOIN material_nota mt
                ON it.IDITEM = mt.IDITEM
                WHERE mt.IDNOTA = ' . $idnota . '
                GROUP BY comp.IDITEM
                ORDER BY mat.DESCMATERIAL';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        $count = 0;

        foreach ($tbl as $chave => $linha) {

            if ($linha['RESTANTE'] > 0 || $linha['RESTANTE'] == null) {

                if ($linha['RESTANTE'] == null) {
                    $quant = $linha['QUANTITEM'];
                } else {
                    $quant = $linha['RESTANTE'];
                }

                $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "90px"> ' . htmlentities($linha['DESCMATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "80px"> ' . $linha['QUANTITEM'] . ' ' . $linha['SIGLAUNID'] . '</td>
                <td align = "center" class = "small" width = "80px"> R$' . $linha['VALORCOMPARA'] . ' </td> 
                <td align = "center"><input type="checkbox" name="recebido[]" value="' . $count . '" /> </td>
                <td align = "center"><input type="text" name="quantidade[]" value="' . $quant . '" size="3" /> </td>
                <input type="hidden" name="iditem[]" value="' . $linha['IDITEM'] . '" />
                </tr>';
                $count++;
            }
        }

        $html .= '</table> </table>';


        return $html;
    }

    public function ModificaMaterialNota($idCompra, $nomeForn) {

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0"> 
                
                <table border = "3" cellspacing = "2" cellpadding = "2"> 
                <tr height = "2">
                <th align = "center" class = "small" width = "180px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "90px">Valor</th>
                <th align = "center" class = "small" width = "110px">Data Emissão</th> 
                <th align = "center" class = "small" width = "170px">Vencimento</th>
                <th align = "center" class = "small" width = "170px">Frete</th> 
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT nf.IDNOTA, nf.NUMNOTA, nf.VALORNOTA, nf.DTEMISSAONOTA, nf.VENCIMENTONOTA, nf.FRETENOTA
                FROM notafiscal nf
                LEFT JOIN compara comp 
                ON nf.IDCOMPRA = comp.IDCOMPRA
                WHERE comp.IDCOMPRA = " . $idCompra . " AND nf.NOMECOMPARA = '" . $nomeForn . "' AND comp.MELHORCOMPARA = 1  
                GROUP BY nf.IDNOTA ";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "90px"> ' . htmlentities($linha['NUMNOTA']) . ' </td>
                <td align = "center" class = "small" width = "80px"> ' . htmlentities($linha['VALORNOTA']) . ' </td>
                <td align = "center" class = "small" width = "80px"> ' . htmlentities($linha['DTEMISSAONOTA']) . ' </td> 
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['VENCIMENTONOTA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['FRETENOTA']) . ' </td> 
                <td align = "center"><a href = "notafiscal_visualiza.exe.php?idcompra=' . $idCompra . '&nomeEmp=' . $nomeForn . '&idnota=' . htmlentities($linha['IDNOTA']) . '&metodo=1"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }

        $html .= '</table> </table>';

        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM notafiscal 
                WHERE IDNOTA = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDNOTA']);
            $this->setIdfornecedor($linha['IDFORNECEDOR']);
            $this->setIdcompra($linha['IDCOMPRA']);
            $this->setNumNotaFiscal($linha['NUMNOTA']);
            $this->setValorNota($linha['VALORNOTA']);
            $this->setDtEmissao($linha['DTEMISSAONOTA']);
            $this->setVencimento($linha['VENCIMENTONOTA']);
            $this->setReferencia($linha['DTREFERENCIA']);
            $this->setFrete($linha['FRETENOTA']);
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

    public function ListaComboFornecedorALL($idCompra, $nomeForn) {
        $SQL = 'SELECT mat.DESCMATERIAL, it.QUANTITEM, comp.VALORCOMPARA, und.SIGLAUNID
                FROM compara comp
                INNER JOIN item it 
                ON comp.IDITEM = it.IDITEM
                INNER JOIN material mat
                ON it.IDMATERIAL = mat.IDMATERIAL
                INNER JOIN unidade und
                ON it.IDUNIDADE = und.IDUNIDADE
                WHERE comp.IDCOMPRA = ' . $idCompra . ' AND comp.NOMECOMPARA = "' . $nomeForn . '" AND comp.MELHORCOMPARA = 1
                ORDER BY mat.DESCMATERIAL';


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

    function AlterarTipoNota() {
        $SQL = "SELECT *
                FROM notafiscal 
                WHERE IDNOTA = '" . $this->codigo . "'";

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
        $SQL = "UPDATE notafiscal SET 
		TIPONOTA='" . $tipo . "'
                WHERE IDNOTA='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    function ResetaTipoNota() {
        $SQL = "UPDATE notafiscal SET 
		TIPONOTA='-1',
                DATAENVIO='',
                NUMENVIO='0',
                IDCENTROFINANC='0'
                WHERE IDNOTA='" . $this->codigo . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

}

?>