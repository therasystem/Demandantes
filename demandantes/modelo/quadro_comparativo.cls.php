<?php

require_once("../controle/conexao.gti.php");

class clsQuadroComparativo {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idcompra;
    private $iditem;
    private $nome;
    private $valor;

    //Mï¿½TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdcompra() {
        return $this->idcompra;
    }

    public function setIdcompra($idcompra) {
        $this->idcompra = $idcompra;
    }

    public function getIditem() {
        return $this->iditem;
    }

    public function setIditem($iditem) {
        $this->iditem = $iditem;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    function __construct() {
        $this->codigo = "";
        $this->idcompra = "";
        $this->iditem = "";
        $this->nome = "";
        $this->valor = "";
    }

    //Mï¿½todo para excluir um compra
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM compara WHERE IDCOMPARA=' . $codigo . ';';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function Alterar($codigo, $melhor) {
        if ($melhor == 0) {
            $SQL = 'UPDATE compara SET MELHORCOMPARA = 1
             WHERE IDCOMPARA=' . $codigo . '';
        } else {
            $SQL = 'UPDATE compara SET MELHORCOMPARA = 0
             WHERE IDCOMPARA=' . $codigo . '';
        }

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //Mï¿½todo que realiza o cadastro de um novo cargo
    public function Salvar() {


        $SQL = "INSERT INTO compara (IDCOMPRA, IDITEM, NOMECOMPARA, VALORCOMPARA) VALUES 
                ('" . $this->idcompra . "', '" . $this->iditem . "', UPPER('" . $this->nome . "'), '" . $this->valor . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

//Mï¿½todo que lista as cargo em um array para preencher o grid
    public function ListaQuadroPesq($idcompra = "") {

        $html = "";

        $SQL = "SELECT co.IDCOMPRA, it.IDITEM, ma.DESCMATERIAL, un.SIGLAUNID, it.QUANTITEM, co.NUMCOMPRA
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

        if ($tbl->RecordCount() > 0) {

            $html = '<table width="100%" height="100%" border = "0" cellspacing = "3" cellpadding = "0"  style="font-size: 15px; alignment-adjust: central">
                <tr>
                <td align = "center">' . $_SESSION['nomeEmp'] . '</td>
                </tr>
                <tr>
                <td align = "center" >QUADRO COMPARATIVO DE PREÇOS / ' . $this->getNomeObra($idcompra) . '</td>
                </tr>
                <table border = "3" cellspacing = "2" cellpadding = "2">';

            $html .='<tr height = "2"><th align = "center" class = "small" width = "10px"> ITEM </th>';
            $count = 1;
            foreach ($tbl as $chave => $linha) {
                $html .= '<th align = "center" class = "small" width = "100px"> ' . $count++ . ' </th>';
            }
            $html .= '</tr>';

            $html .='<tr height = "2"><th align = "center" class = "small" width = "100px"> DESC. </th>';
            foreach ($tbl as $chave => $linha) {
                $html .= '<th align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCMATERIAL']) . '</th>';
            }
            $html .= '</tr>';

            $html .='<tr height = "2"><th align = "center" class = "small" width = "100px"> UNID. </th>';
            foreach ($tbl as $chave => $linha) {
                $html .= '<th align = "center" class = "small" width = "100px"> ' . htmlentities($linha['SIGLAUNID']) . '</th>';
            }
            $html .= '</tr>';

            $html .='<tr style="border-bottom-color: crimson;" height = "2"><th align = "center" class = "small" width = "100px"> QUANT. </th>';
            foreach ($tbl as $chave => $linha) {
                $html .= '<th align = "center" class = "small" width = "100px"> ' . htmlentities($linha['QUANTITEM']) . '</th>';
            }
            $html .= '</tr>';


            $SQL = "SELECT DISTINCT NOMECOMPARA
                FROM compara  
                WHERE IDCOMPRA = " . $idcompra . "
                ORDER BY NOMECOMPARA";

            $con1 = new gtiConexao();
            $con1->gtiConecta();
            $tbl1 = $con1->gtiPreencheTabela($SQL);
            $con1->gtiDesconecta();

            foreach ($tbl1 as $chave => $linha1) {
                $html .='<tr height = "2"><td align = "center" class = "small" width = "100px"><a style="color: #000" href="ordem_compra_alteracao.frm.php?nomecompara=' . $linha1['NOMECOMPARA'] . '&metodo=3&idcompra=' . $idcompra . '">  ' . htmlentities($linha1['NOMECOMPARA']) . ' </a></td>';

                $SQL = "SELECT co.IDCOMPARA, co.IDITEM, VALORCOMPARA, MELHORCOMPARA
                FROM compara co
                INNER JOIN item it
                ON co.IDITEM = it.IDITEM
                INNER JOIN material ma
                ON it.IDMATERIAL = ma.IDMATERIAL
                WHERE co.IDCOMPRA = " . $idcompra . " AND NOMECOMPARA = '" . $linha1['NOMECOMPARA'] . "'
                ORDER BY ma.TIPOMATERIAL, ma.DESCMATERIAL";

                $con2 = new gtiConexao();
                $con2->gtiConecta();
                $tbl2 = $con2->gtiPreencheTabela($SQL);
                $con2->gtiDesconecta();
//die(print_r($SQL));
                $flag = 0;

                foreach ($tbl2 as $chave => $linha2) {
                    $count = 0;
                    foreach ($tbl as $chave => $linha) {
                        if ($flag <= $count) {
                            
                            if ($linha['IDITEM'] == $linha2['IDITEM']) {
                                //die($linha['IDITEM']);
                                if ($linha2['MELHORCOMPARA'] == 0) {
                                    $html .= '<td align = "center" class = "small" width = "100px"><a style="color: #000" href="quadro_comparativo.exe.php?idcompara=' . $linha2['IDCOMPARA'] . '&melhor=' . $linha2['MELHORCOMPARA'] . '&metodo=1&idcompra=' . $idcompra . '"> ' . $linha2['VALORCOMPARA'] . '</a></td>';
                                } else {
                                    $html .= '<td align = "center" class = "small" width = "100px"><a style="color: red" href="quadro_comparativo.exe.php?idcompara=' . $linha2['IDCOMPARA'] . '&melhor=' . $linha2['MELHORCOMPARA'] . '&metodo=1&idcompra=' . $idcompra . '"> ' . $linha2['VALORCOMPARA'] . '</a></td>';
                                }
                                $flag++;
                                break;
                            } else {
                                $html .= '<td align = "center" class = "small" width = "100px"></td>';
                                $flag++;
                            }
                        }
                        $count++;
                    }
                }
                //die('aaa'.$count);
                while ($count < $tbl->RecordCount() - 1) {
                    $html .= '<td align = "center" class = "small" width = "100px"></td>';
                    $count++;
                }
            }




            $html .= '</tr></table></table>';
        }

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

    public function ListaComboEmpresaAll() {
        /*$SQL = 'SELECT DISTINCT UPPER(NOMECOMPARA) as id, UPPER(NOMECOMPARA) as nome
                FROM compara
                ORDER BY NOMECOMPARA'; */
        $SQL = 'SELECT DISTINCT UPPER(NOMEFORNECEDOR) AS id, UPPER(NOMEFORNECEDOR) AS nome , CNPJFORNECEDOR AS cnpj
                FROM fornecedor
                ORDER BY NOMEFORNECEDOR';
        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "<option value='0' selected>---------  SELECIONE  ---------</option>";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);
            $cnpj = $linha['cnpj'];

            $drop .= '<option value="' . $id . '">' . $nome . ' - '.$cnpj.'</option>';
        }

        return $drop;
    }

    public function ListaQuadroPesqEdita($idcompra = "") {


        $html = '<table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "50px">N&uacute;mero</th>
                <th align = "center" class = "small" width = "400px">Empresa</th>
                <th align = "center" class = "small" width = "400px">Material</th>
                <th align = "center" class = "small" width = "400px">Valor</th>
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT co.IDCOMPARA, ma.DESCMATERIAL, co.NOMECOMPARA,  co.VALORCOMPARA
                FROM compara co
                INNER JOIN item it
                ON co.IDITEM = it.IDITEM
                INNER JOIN material ma
                ON it.IDMATERIAL = ma.IDMATERIAL
                WHERE co.IDCOMPRA = " . $idcompra . "
                ORDER BY co.NOMECOMPARA,ma.TIPOMATERIAL, ma.DESCMATERIAL ";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        $count = 1;
        foreach ($tbl as $chave => $linha) {

            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . $count++ . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECOMPARA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['DESCMATERIAL']) . ' </td>
                <td align = "center" class = "small" width = "100px"> R$' . htmlentities($linha['VALORCOMPARA']) . ' </td>
                <td align = "center"><a href = "quadro_comparativo.exe.php?idcompara=' . htmlentities($linha['IDCOMPARA']) . '&idcompra=' . $idcompra . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';




        return $html;
    }

}

?>