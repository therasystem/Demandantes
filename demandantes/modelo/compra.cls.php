<?php

require_once("../controle/conexao.gti.php");

class clsCompra {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idobra;
    private $numcompra;
    private $numordemcompra;
    private $datacompra;
    private $autorizacompra1;
    private $autorizacompra2;
    private $idusu;

    //Mï¿½TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdobra() {
        return $this->idobra;
    }

    public function setIdobra($idobra) {
        $this->idobra = $idobra;
    }

    public function getNumcompra() {
        return $this->numcompra;
    }

    public function setNumcompra($numcompra) {
        $this->numcompra = $numcompra;
    }

    public function getDatacompra() {
        return $this->datacompra;
    }

    public function setDatacompra($datacompra) {
        $this->datacompra = $datacompra;
    }

    public function getAutorizacompra1() {
        return $this->autorizacompra1;
    }

    public function setAutorizacompra1($autorizacompra1) {
        $this->autorizacompra1 = $autorizacompra1;
    }

    public function getAutorizacompra2() {
        return $this->autorizacompra2;
    }

    public function setAutorizacompra2($autorizacompra2) {
        $this->autorizacompra2 = $autorizacompra2;
    }

    public function getIdusu() {
        return $this->idusu;
    }

    public function setIdusu($idusu) {
        $this->idusu = $idusu;
    }

    function __construct() {
        $this->codigo = "";
        $this->idobra = "";
        $this->numcompra = "";
        $this->datacompra = "";
        $this->autorizacompra1 = "";
        $this->autorizacompra2 = "";
        $this->idusu = "";
    }

    //Mï¿½todo para excluir um compra
    public function Excluir($codigo) {
        //session_start();

        $SQL = "SELECT AUTORIZACOMPRA1, AUTORIZACOMPRA2, IDUSU
                FROM compra 
                WHERE IDCOMPRA='" . $codigo . "' AND AUTORIZACOMPRA1 = 0 AND AUTORIZACOMPRA2 = 0 AND IDUSU = '" . $_SESSION['codigo'] . "' ";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        if ($tbl->RecordCount() > 0) {
            $SQL = 'DELETE FROM compra WHERE IDCOMPRA=' . $codigo . ';';

            $con = new gtiConexao();
            $con->gtiConecta();
            $con->gtiExecutaSQL($SQL);
            $con->gtiDesconecta();

            return true;
        } else {
            return false;
        }
    }

    public function ExcluirItemcompra($codigo) {
        $SQL = 'DELETE FROM item WHERE IDCOMPRA=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        session_start();

        $SQL = "SELECT COUNT(1)+1 AS num
                FROM compra 
                GROUP BY idobra
                HAVING idobra = '" . $this->idobra . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        if ($tbl->RecordCount() > 0) {
            foreach ($tbl as $chave => $linha) {

                $this->setNumcompra($linha['num']);
            }
        } else {
            $this->setNumcompra('1');
        }

        $SQL = "INSERT INTO compra (IDOBRA, NUMCOMPRA, DATACOMPRA, IDUSU) VALUES 
                ('" . $this->idobra . "', '" . $this->numcompra . "', (SELECT DATE_FORMAT(NOW(),'%d/%m/%Y')), '" . $_SESSION['codigo'] . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function AtualizaLiberacaoCompra($cod, $autoriza, $resp) {

        if ($autoriza == 1) {
            $SQL = "UPDATE compra SET  
		AUTORIZACOMPRA1='" . $resp . "'
                WHERE IDCOMPRA='" . $cod . "'";
        } else if ($autoriza == 2) {
            $SQL = "UPDATE compra SET  
		AUTORIZACOMPRA2='" . $resp . "'
                WHERE IDCOMPRA='" . $cod . "'";
        } else if ($autoriza == 3) {
            $SQL = "UPDATE compra SET  
		AUTORIZACOMPRA1='0'
                WHERE IDCOMPRA='" . $cod . "'";
        } else if ($autoriza == 4) {
            $SQL = "UPDATE compra SET  
		AUTORIZACOMPRA2='0'
                WHERE IDCOMPRA='" . $cod . "'";
        }

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que lista as cargo em um array para preencher o grid
    public function ListaCompraPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Compra" width = "30px" align = "right"><a href = "compra_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "200px">Obra</th>
                <th align = "center" class = "small" width = "30px">Num.</th>
                <th align = "center" class = "small" width = "100px">Data da Solicitação</th>
                <th align = "center" class = "small" width = "60px">Adicionar Itens</th>
                <th align = "center" class = "small" width = "60px">Liberação 1</th>
                <th align = "center" class = "small" width = "60px">Liberação 2</th>
                <th align = "center" class = "small" width = "170px">Criador</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT co.IDCOMPRA, ob.DESCOBRA, co.NUMCOMPRA, co.DATACOMPRA, ob.IDUSU, co.AUTORIZACOMPRA1, ob.IDUSU2, co.AUTORIZACOMPRA2, us.NOME
                FROM compra co
                INNER JOIN obra ob 
                ON co.idobra = ob.idobra
                INNER JOIN usuario us
                ON co.IDUSU = us.ID";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(descobra) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY ob.idobra, co.numcompra DESC ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCOBRA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMCOMPRA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATACOMPRA']) . ' </td>
                <td align = "center"><a href = "item_compra.frm.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '"><img border = "0" src = "../imagens/novo.gif" width = "20px" ></a> </td>';

            if ($linha['IDUSU'] == $linha['AUTORIZACOMPRA1']) {
                $html .= '<td align = "center"><a href = "compra.exe.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '&idresp=' . htmlentities($linha['IDUSU']) . '&autoriza=3&metodo=1"><img border = "0" src = "../imagens/joiaVerde.png" width = "20px" ></a> </td>';
            } else {
                $html .= '<td align = "center"><a href = "compra.exe.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '&idresp=' . htmlentities($linha['IDUSU']) . '&autoriza=1&metodo=1"><img border = "0" src = "../imagens/joiaVermelha.png" width = "20px" ></a> </td>';
            }
            if ($linha['IDUSU2'] == $linha['AUTORIZACOMPRA2']) {
                $html .= '<td align = "center"><a href = "compra.exe.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '&idresp=' . htmlentities($linha['IDUSU2']) . '&autoriza=4&metodo=1"><img border = "0" src = "../imagens/joiaVerde.png" width = "20px" ></a> </td>';
            } else {
                $html .= '<td align = "center"><a href = "compra.exe.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '&idresp=' . htmlentities($linha['IDUSU2']) . '&autoriza=2&metodo=1"><img border = "0" src = "../imagens/joiaVermelha.png" width = "20px" ></a> </td>';
            }
            $html .= ' <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOME']) . ' </td>
                         <td align = "center"><a href = "compra.exe.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td> </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function CotacaoPreco($idcompra = "") {


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0"  style="font-size: 15px; alignment-adjust: central">
                <tr>
                <td align = "left" valign = "middle"><img name = "logo" id = "logo" src = "../imagens/' . $_SESSION['logoEmp'] . '" width = "690" height = "110"></a></td>
                </tr>
                <tr>
                <td align = "left">' . $_SESSION['endEmp'] . '</td>
                </tr>
                <tr>
                <td align = "left">BAIRRO: ' . $_SESSION['bairroEmp'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FONE-FAX: ' . $_SESSION['fonefaxEmp'] . '</td>
                </tr>
                <tr>
                <td align = "left">COMPRADOR: ' . $_SESSION['compradorEmp'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email: ' . $_SESSION['emailEmp'] . '</td>
                </tr>
                <tr>
                <td align = "left">_________________________________________________________________________________________________</td>
                </tr>
                <tr>
                <td align = "left">_________________________________________________________________________________________________</td>
                </tr>
                
                <tr>
                <td align = "center" >COTAÇÃO DE PREÇOS / ' . $this->getNomeObra($idcompra) . '</td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "40px">ITEM</th>
                <th align = "center" class = "small" width = "300px">DESCRIÇÃO DOS MATERIAIS</th>
                <th align = "center" class = "small" width = "40px">UND.</th>
                <th align = "center" class = "small" width = "40px">QUANT.</th>
                <th align = "center" class = "small" width = "40px">VL. UNIT</th>
                <th align = "center" class = "small" width = "40px">VL. TOTAL</th>
                </tr>';


        $SQL = "SELECT co.IDCOMPRA, ma.DESCMATERIAL, un.SIGLAUNID, it.QUANTITEM, co.NUMCOMPRA
                FROM compra co
                INNER JOIN item it
                ON co.IDCOMPRA = it.IDCOMPRA
                INNER JOIN material ma
                ON it.IDMATERIAL = ma.IDMATERIAL
                INNER JOIN unidade un
                ON it.IDUNIDADE = un.IDUNIDADE
                WHERE co.IDCOMPRA = " . $idcompra . "
                ORDER BY ma.TIPOMATERIAL, ma.DESCMATERIAL";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        $count = 1;
        $numPedido = "";
        foreach ($tbl as $chave => $linha) {

            $numPedido = $linha['NUMCOMPRA'];

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . $count++ . ' </td>
                <td align = "left" class = "small" width = "100px"> ' . htmlentities($linha['DESCMATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['SIGLAUNID']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['QUANTITEM']) . ' </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>';
        }

        $html .= ' <tr height = "26">
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>';
        $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px"> Pedido nº' . $numPedido . ' </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>';

        $html .= '</table> ';

        $html .= '<table border = "0" cellspacing = "3" cellpadding = "0" style="font-size: 15px; alignment-adjust: central">
                <br />
                <tr>
                <td align = "left" width="200px">PREÇO TOTAL</td>
                <td align = "left">R$ ____________________________</td>
                </tr>
                <tr>
                <td align = "left">PRAZO DE PAGAMENTO</td>
                <td align = "left"> _______________________________</td>
                </tr>
                <tr>
                <td align = "left">VALIDADE DA PROPOSTA</td>
                <td align = "left"> _______________________________</td>
                </tr>
                <tr>
                <td align = "left">FORNECEDOR</td>
                <td align = "left"> _______________________________</td>
                </tr>
                <tr>
                <td align = "left">VISTO VENDEDOR</td>
                <td align = "left"> _______________________________  NOME _______________________  </td>
                </tr>
                </table>
                </table>';

        return $html;
    }

    public function getNomeObra($idcompra) {

        $SQL = "SELECT UPPER(ob.DESCOBRA) as DESCOBRA
                FROM compra co
                INNER JOIN obra ob
                ON co.idobra = ob.idobra 
                WHERE idcompra = '" . $idcompra . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        foreach ($tbl as $chave => $linha) {
            return $linha['DESCOBRA'];
        }
    }

    public function getNumOrdemCompra($idcompra) {

        $SQL = "SELECT ORDEMCOMPRA
                FROM compra co
                INNER JOIN obra ob
                ON co.idobra = ob.idobra 
                WHERE idcompra = '" . $idcompra . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        foreach ($tbl as $chave => $linha) {
            return $linha['ORDEMCOMPRA'];
        }
    }

    public function getEndObra($idcompra) {

        $SQL = "SELECT ENDOBRA
                FROM compra co
                INNER JOIN obra ob
                ON co.idobra = ob.idobra 
                WHERE idcompra = '" . $idcompra . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        foreach ($tbl as $chave => $linha) {
            return $linha['ENDOBRA'];
        }
    }

    public function OrdemCompra() {

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0"  style="font-size: 15px; alignment-adjust: central">
                <tr>
                <td align = "center" width="50px" valign = "middle">EMISSÃO DE NOTA FISCAL</td>
                <td align = "left" valign = "middle"><img name = "logo" id = "logo" src = "../imagens/' . $_SESSION['logoEmp'] . '" width = "690" height = "110"></a></td>
                </tr>
                </table>
                <table border = "0" cellspacing = "3" cellpadding = "0"  style="font-size: 15px; alignment-adjust: central">
                <tr>
                <td align = "center">' . $_SESSION['endEmp'] . '</td>
                </tr>
                <tr>
                <td align = "center">BAIRRO: ' . $_SESSION['bairroEmp'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FONE-FAX: ' . $_SESSION['fonefaxSolobaseEmp'] . '</td>
                </tr>
                <tr>
                <td align = "center">CNPJ: ' . $_SESSION['cnpjEmp'] . '&nbsp;&nbsp;&nbsp; INSC. ESTADUAL: ' . $_SESSION['inscriEstEmp'] . '</td>
                </tr>
                <tr>
                <td align = "center" >OBRA: ' . $this->getNomeObra(clsOrdemCompra::getIdcompra()) . '</td>
                </tr>
                <tr>
                <td align = "left">________________________________________________________________________________________________________</td>
                </tr>
                

                <table border = "1" cellspacing = "2" cellpadding = "2" width="840px">
                <tr height = "2" width="100%">
                <th align = "left" class = "small" width = "520px">ORDEM DE COMPRA Nº: ' . $this->getNumOrdemCompra(clsOrdemCompra::getIdcompra()) . '/' . substr(date('Y'), 2, 2) . '</th>
                <th align = "left" class = "small" width = "320px">DATA: ' . date('d/m/Y') . '</th>
                </tr>
                <tr height = "2">
                <th align = "left" class = "small" width = "520px">FORNECEDOR: ' . clsOrdemCompra::getNome() . '</th>
                <th align = "left" class = "small" width = "320px">FAX: ' . clsOrdemCompra::getFax() . '</th>
                </tr>
                <tr height = "2">
                <th align = "left" class = "small" width = "520px">CONTATO: ' . clsOrdemCompra::getContato() . '</th>
                <th align = "left" class = "small" width = "320px">CEL: ' . clsOrdemCompra::getCel() . '</th>
                </tr>
                


                <table border = "1" cellspacing = "2" cellpadding = "2" width="840px">
                <tr height = "2">
                <th align = "center" class = "small" width = "40px">ITEM</th>
                <th align = "center" class = "small" width = "300px">DESCRIÇÃO DOS MATERIAIS</th>
                <th align = "center" class = "small" width = "40px">UND.</th>
                <th align = "center" class = "small" width = "40px">QUANT.</th>
                <th align = "center" class = "small" width = "40px">VL. UNIT</th>
                <th align = "center" class = "small" width = "40px">VL. TOTAL</th>
                </tr>';


        $SQL = "SELECT co.IDCOMPRA, ma.DESCMATERIAL, un.SIGLAUNID, it.QUANTITEM, co.NUMCOMPRA, comp.VALORCOMPARA, comp.NOMECOMPARA
                FROM compra co
                INNER JOIN compara comp
                ON comp.IDCOMPRA = co.IDCOMPRA
                INNER JOIN item it
                ON comp.IDITEM = it.IDITEM
                INNER JOIN material ma
                ON it.IDMATERIAL = ma.IDMATERIAL
                INNER JOIN unidade un
                ON it.IDUNIDADE = un.IDUNIDADE
                WHERE co.IDCOMPRA = " . clsOrdemCompra::getIdcompra() . " AND comp.NOMECOMPARA = '" . clsOrdemCompra::getNome() . "' AND MELHORCOMPARA = 1
                ORDER BY ma.TIPOMATERIAL, ma.DESCMATERIAL";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        $count = 1;
        $numPedido = "";
        $total = "";
        foreach ($tbl as $chave => $linha) {

            $numPedido = $linha['NUMCOMPRA'];

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . $count++ . ' </td>
                <td align = "left" class = "small" width = "100px"> ' . htmlentities($linha['DESCMATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['SIGLAUNID']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $linha['QUANTITEM'] . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $linha['VALORCOMPARA'] . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . number_format($linha['QUANTITEM'] * str_replace(",", ".", $linha['VALORCOMPARA']), 2, ",", ".") . ' </td>';

            $total = $total + ($linha['QUANTITEM'] * str_replace(",", ".", $linha['VALORCOMPARA']));
        }
        

        $html .= ' <tr height = "26">
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>';
        $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px"> Pedido nº' . $numPedido . ' </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px"> DESC: </td>
                <td align = "center" class = "small" width = "100px"> ' . clsOrdemCompra::getDesconto() . ' </td>';

        //// lidando com o desconto
        $existe = strpos(clsOrdemCompra::getDesconto(), "%");

        if ($existe == false) {
            $total = $total - str_replace(",", ".", clsOrdemCompra::getDesconto());
        } else {
            $total = $total * ((100 - str_replace("%", "", clsOrdemCompra::getDesconto())) / 100);
        }
        
        $total = number_format($total, 2, ",", ".");

        $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px">  </td>
                <td align = "center" class = "small" width = "100px"> TOTAL: </td>
                <td align = "center" class = "small" width = "100px"> ' . $total . ' </td>';

        $html .= '</table> ';

        $html .= '<table border = "1" cellspacing = "10" cellpadding = "0" style="font-size: 15px; alignment-adjust: central" width="840px">
                <br />
                <tr>
                <td align = "left" valign="top" width="400px" height="40px">
                Data Entrega: ' . clsOrdemCompra::getEntrega() . '<br />
                Local entrega: ' . $this->getEndObra(clsOrdemCompra::getIdcompra()) . '<br /><br />
                Cond. Pagamento: ' . clsOrdemCompra::getPagamento() . '<br /><br />
                Frete: ' . clsOrdemCompra::getFrete() . '<br />
                </td> 
                <td align = "left" valign="top" width="400px" height="40px">
                COMPRADOR: ' . $_SESSION['compradorEmp'] . '<br />
                TELEFAX: ' . $_SESSION['fonefaxEmp'] . '<br />
                AUT.: <br /> 
                </td> 
                </tr>
                </table>
                
                </table>';

        return $html;
    }

    public function updateNumOrdemCompra($idcompra) {

        $SQL = "SELECT ob.IDOBRA, ORDEMCOMPRA
                FROM compra co
                INNER JOIN obra ob
                ON co.idobra = ob.idobra 
                WHERE idcompra = '" . $idcompra . "'";

        $ordem = 0;
        $obra = 0;

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        foreach ($tbl as $chave => $linha) {
            $obra = $linha['IDOBRA'];
            $ordem = $linha['ORDEMCOMPRA'];
        }

        $SQL = "UPDATE obra SET  
		ORDEMCOMPRA='" . ($ordem + 1) . "'
                WHERE IDOBRA='" . $obra . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();

        $this->numordemcompra = $ordem + 1;
    }

    public function ListaCompraVisualizacao($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "350px">Obra</th>
                <th align = "center" class = "small" width = "130px">Numero da Solicitação</th>
                <th align = "center" class = "small" width = "150px">Data da Solicitação</th>
                <th align = "center" class = "small" width = "100px">Visualizar</th>
                </tr>';


        $SQL = "SELECT co.IDCOMPRA, ob.DESCOBRA, co.NUMCOMPRA, co.DATACOMPRA, ob.IDUSU, co.AUTORIZACOMPRA1, ob.IDUSU2, co.AUTORIZACOMPRA2, us.NOME, co.EXECUTADACOMPRA
                FROM compra co
                INNER JOIN obra ob 
                ON co.idobra = ob.idobra
                INNER JOIN usuario us
                ON co.IDUSU = us.ID
                WHERE co.EXECUTADACOMPRA = 1 ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" AND UPPER(descobra) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY ob.DESCOBRA, co.DATACOMPRA DESC ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCOBRA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NUMCOMPRA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATACOMPRA']) . ' </td>
                <td align = "center"><a href = "compra_visualiza_alteracao.frm.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '"><img border = "0" src = "../imagens/busca.png" width = "20px" ></a> </td> </tr>';
        }

        $html .= '</table> </table>';


        return $html;
    }

    public function ListaCompraVisualizacaoSolicitacao($idcompra) {


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "70px">Pedido</th>
                <th align = "center" class = "small" width = "150px">Ordem de Compra</th>
                <th align = "center" class = "small" width = "200px">Empresa</th>
                <th align = "center" class = "small" width = "150px">Data da Solicitação</th>
                <th align = "center" class = "small" width = "150px">Visualizar Ordem de Compra</th>
                <th align = "center" class = "small" width = "50px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "50px">Excluir Nota</th>
                </tr>';


        $SQL = "SELECT co.IDCOMPRA, co.NUMCOMPRA, co.DATACOMPRA, arq.ORDEMCOMPRA,  comp.NOMECOMPARA
                FROM compra co
                INNER JOIN obra ob 
                ON co.idobra = ob.idobra
                INNER JOIN compara comp
                ON co.IDCOMPRA = comp.IDCOMPRA
                INNER JOIN arquivo arq
                ON arq.IDCOMPRA = comp.IDCOMPRA AND arq.EMPRESA = comp.NOMECOMPARA
                WHERE co.EXECUTADACOMPRA = 1 AND co.IDCOMPRA = " . $idcompra . "
                GROUP BY comp.NOMECOMPARA
                ORDER BY  arq.ORDEMCOMPRA DESC, comp.NOMECOMPARA";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . $linha['NUMCOMPRA'] . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $linha['ORDEMCOMPRA'] . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECOMPARA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $linha['DATACOMPRA'] . ' </td>
                <td align = "center"><a href = "compra_visualiza.exe.php?metodo=3&idcompra=' . htmlentities($linha['IDCOMPRA']) . '&nomeEmp=' . $linha['NOMECOMPARA'] . '"><img border = "0" src = "../imagens/busca.png" width = "20px" ></a> </td>
                <td align = "center"><a href = "notafiscal_visualiza.php?metodo=0&temItem=0&idcompra=' . htmlentities($linha['IDCOMPRA']) . '&nomeEmp=' . $linha['NOMECOMPARA'] . '">Lançar</a> </td>
                <td align = "center"><a href = "notafiscal_visualiza.php?metodo=0&temItem=1&idcompra=' . htmlentities($linha['IDCOMPRA']) . '&nomeEmp=' . $linha['NOMECOMPARA'] . '">Excluir</a> </td>';
        }

        $html .= '</tr></table> </table>';

        return $html;
    }

    public function ListaCompraVisualizacaoSolicitacaoPesquisa($idcompra, $pesquisa) {


        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "70px">Pedido</th>
                <th align = "center" class = "small" width = "150px">Ordem de Compra</th>
                <th align = "center" class = "small" width = "200px">Empresa</th>
                <th align = "center" class = "small" width = "150px">Data da Solicitação</th>
                <th align = "center" class = "small" width = "200px">Visualizar Ordem de Compra</th>
                <th align = "center" class = "small" width = "50px">Nota Fiscal</th>
                <th align = "center" class = "small" width = "50px">Excluir Notas</th>
                </tr>';


        $SQL = "SELECT co.IDCOMPRA, co.NUMCOMPRA, co.DATACOMPRA, arq.ORDEMCOMPRA,  comp.NOMECOMPARA
                FROM compra co
                INNER JOIN obra ob 
                ON co.idobra = ob.idobra
                INNER JOIN compara comp
                ON co.IDCOMPRA = comp.IDCOMPRA
                INNER JOIN arquivo arq
                ON arq.IDCOMPRA = comp.IDCOMPRA AND arq.EMPRESA = comp.NOMECOMPARA
                WHERE co.EXECUTADACOMPRA = 1 AND co.IDCOMPRA = " . $idcompra . " AND UPPER(comp.NOMECOMPARA) LIKE UPPER('%" . $pesquisa . "%') 
                GROUP BY comp.NOMECOMPARA
                ORDER BY  arq.ORDEMCOMPRA DESC, comp.NOMECOMPARA";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . $linha['NUMCOMPRA'] . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $linha['ORDEMCOMPRA'] . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECOMPARA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . $linha['DATACOMPRA'] . ' </td>
                <td align = "center"><a href = "compra_visualiza.exe.php?metodo=3&idcompra=' . htmlentities($linha['IDCOMPRA']) . '&nomeEmp=' . $linha['NOMECOMPARA'] . '"><img border = "0" src = "../imagens/busca.png" width = "20px" ></a> </td>
                <td align = "center"><a href = "notafiscal_visualiza.php?metodo=0&temItem=0&idcompra=' . htmlentities($linha['IDCOMPRA']) . '&nomeEmp=' . $linha['NOMECOMPARA'] . '">Lançar</a> </td>
                <td align = "center"><a href = "notafiscal_visualiza.php?metodo=0&temItem=1&idcompra=' . htmlentities($linha['IDCOMPRA']) . '&nomeEmp=' . $linha['NOMECOMPARA'] . '">Excluir</a> </td>';
        }

        $html .= ' </tr></table> </table>';

        return $html;
    }

    public function insereArquivo($arquivo = "") {

        $SQL = "SELECT * FROM arquivo WHERE nomearquivo LIKE '" . clsOrdemCompra::$nome . "_" . clsOrdemCompra::$idcompra . "%'";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        foreach ($tbl as $chave => $linha) {
            unlink("../arquivos/" . $linha['NOMEARQUIVO']);
        }

        $SQL = "DELETE FROM arquivo WHERE nomearquivo LIKE '" . clsOrdemCompra::$nome . "_" . clsOrdemCompra::$idcompra . "%'";
        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();

        $SQL = "INSERT INTO arquivo (IDCOMPRA, EMPRESA, NOMEARQUIVO, ORDEMCOMPRA) VALUES 
                ('" . clsOrdemCompra::$idcompra . "', '" . clsOrdemCompra::$nome . "', '" . $arquivo . "', '" . $this->numordemcompra . "');";
        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function abreArquivo($idcompra, $emp) {

        $SQL = "SELECT NOMEARQUIVO FROM arquivo WHERE EMPRESA ='" . $emp . "' AND IDCOMPRA = " . $idcompra;

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        foreach ($tbl as $chave => $linha) {
            header('Content-Type: application/pdf');
            //readfile("/home/solobase/public_html/compras/arquivos/" . $linha['NOMEARQUIVO']);
            readfile("C:\wamp\www\solobase\arquivos\\" . $linha['NOMEARQUIVO']);
        }
    }

}

?>