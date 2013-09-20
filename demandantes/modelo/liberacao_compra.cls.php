<?php

require_once("../controle/conexao.gti.php");

class clsLiberacaoCompra {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idobra;
    private $numcompra;
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
    
    
    
    public function AtualizaStatusCompra($cod, $autoriza) {
     
                    if ($autoriza == 0) {
                        $value = 1;
                    }
                    if ($autoriza == 1) {
                        $value = 0;
                    }
 
        $SQL = "UPDATE compra SET  
		EXECUTADACOMPRA='" . $value . "'
                WHERE IDCOMPRA='" . $cod . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }
    
    

    public function AtualizaLiberacaoCompra($cod, $autoriza, $resp) {

        $SQL = "SELECT *
                FROM usuario 
                WHERE CARGO = 1
                ORDER BY ID";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $count = 0;
        foreach ($tbl as $chave => $linha) {
            if ($count == $resp) {

                $SQL = "SELECT LIBERACAOCOMPRA
                FROM compra 
                WHERE IDCOMPRA='" . $cod . "'";

                $con1 = new gtiConexao();
                $con1->gtiConecta();
                $tbl1 = $con1->gtiPreencheTabela($SQL);
                $con1->gtiDesconecta();

                foreach ($tbl1 as $chave => $linha) {
                    $inteiro = $linha['LIBERACAOCOMPRA'];
                    $binario = decbin($inteiro);

                    $totalSocio = $this->buscaNumSocio();
                    while (strlen($binario) != $totalSocio) {
                        $binario = "0" . $binario;
                    }

                    if ($autoriza == 0) {
                        $value = 1;
                    }
                    if ($autoriza == 1) {
                        $value = 0;
                    }

                    $binario{$resp} = $value;
                }
            }
            $count++;
        }

        $SQL = "UPDATE compra SET  
		LIBERACAOCOMPRA='" . bindec($binario) . "'
                WHERE IDCOMPRA='" . $cod . "'";

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
    </tr>

    <table border = "3" cellspacing = "2" cellpadding = "2">
        <tr height = "2">
            <th align = "center" class = "small" width = "200px">Obra</th>
            <th align = "center" class = "small" width = "10px">Num.</th>
            <th align = "center" class = "small" width = "100px">Data da Solicitação</th>
            <th align = "center" class = "small" width = "150px">Visualizar / Editar / Apagar Itens</th>
            <th align = "center" class = "small" width = "100px">Liberação por Sócios</th> 
            <th align = "center" class = "small" width = "100px">Quadro Comparativo</th> 
            <th align = "center" class = "small" width = "100px">Compra Executada?</th> 
        </tr>';


        $SQL = "SELECT co.IDCOMPRA, ob.DESCOBRA, co.NUMCOMPRA, co.DATACOMPRA, ob.IDUSU, co.AUTORIZACOMPRA1, ob.IDUSU2, co.AUTORIZACOMPRA2, us.NOME, co.LIBERACAOCOMPRA, co.EXECUTADACOMPRA
        FROM compra co
        INNER JOIN obra ob 
        ON co.idobra = ob.idobra
        INNER JOIN usuario us
        ON co.IDUSU = us.ID
        WHERE co.AUTORIZACOMPRA1 > 0 AND co.AUTORIZACOMPRA2 > 0 ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" AND UPPER(descobra) LIKE UPPER('%" . $pesq . "%') ";
        }

        $SQL.=" ORDER BY ob.idobra, co.numcompra DESC ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as $chave => $linha) {

            $binario = decbin($linha['LIBERACAOCOMPRA']);
            //$inteiro = bindec("011");
            //die(strlen($binario).'-----');

            $totalSocio = $this->buscaNumSocio();
            //die('adadadsw'.$totalSocio);
            while (strlen($binario) != $totalSocio) {
                $binario = "0" . $binario;
                //die('adadadsw'.$binario);
            }
            $count = 0;

            $html .= ' <tr height = "1">
            <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCOBRA']) . ' </td>
            <td align = "center" class = "small" width = "10px"> ' . htmlentities($linha['NUMCOMPRA']) . ' </td>
            <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DATACOMPRA']) . ' </td>
            <td align = "center">';
            if($linha['LIBERACAOCOMPRA'] == 3){
                $html .= '<a href = "cotacao_preco.frm.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '">Cotação de Preços</a>';
            }else{
                $html .= '<a href = "liberacao_item_compra.frm.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '"><img border = "0" src = "../imagens/novo.gif" width = "20px" ></a> ';    
            }

            $html .= '</td> <td align = "center">';


            //die(strlen($binario) .'+++++++'. $count);
            while (strlen($binario) != $count) {
                //die(strlen($binario) .'----'. $count);
                $valor = substr($binario, $count, 1);
                if ($valor == 1) {
                    $html .= '<a href = "liberacao_compra.exe.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '&idresp=' . $count . '&autoriza=' . $valor . '&metodo=1"><img border = "0" src = "../imagens/joiaVerde.png" width = "20px" ></a>';
                } else {
                    $html .= '<a href = "liberacao_compra.exe.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '&idresp=' . $count . '&autoriza=' . $valor . '&metodo=1"><img border = "0" src = "../imagens/joiaVermelha.png" width = "20px" ></a>';
                }
                $count++;
            }
            $html .= '</td> <td align = "center">';
            
            if($linha['LIBERACAOCOMPRA'] == 3){
                $html .= '<a href = "quadro_comparativo.frm.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '">Quadro Comparativo</a>';
            }else{
                $html .= '<a><img border = "0" src = "../imagens/joiaVermelha.png" width = "20px" ></a> ';    
            }
            
            $html .= '</td> <td align = "center">';
            
            if($linha['EXECUTADACOMPRA'] == 1){
                    $html .= '<a href = "liberacao_compra.exe.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '&autoriza=' . $linha['EXECUTADACOMPRA'] . '&metodo=2"><img border = "0" src = "../imagens/joiaVerde.png" width = "20px" ></a>';
                } else {
                    $html .= '<a href = "liberacao_compra.exe.php?idcompra=' . htmlentities($linha['IDCOMPRA']) . '&autoriza=' . $linha['EXECUTADACOMPRA'] . '&metodo=2"><img border = "0" src = "../imagens/joiaVermelha.png" width = "20px" ></a>';
                }

        }
            
        $html .= '</td></table> </table>';



        return $html;
    }

    public function buscaNumSocio() {

        $SQL = "SELECT COUNT(1) NUM
                FROM usuario WHERE CARGO = 1";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {
            return $linha['NUM'];
        }
    }

}

?>