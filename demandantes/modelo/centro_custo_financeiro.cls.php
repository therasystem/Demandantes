<?php

require_once("../controle/conexao.gti.php");

class clsCentroCustoFinanceiro {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idEmpresa;
    private $nome;

    //M�TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getIdEmpresa() {
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    function __construct() {
        $this->codigo = "";
        $this->idEmpresa = "";
        $this->nome = "";
    }

    
    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM centrocustofinanceiro WHERE IDCENTROCUSTOFINANC=' . $codigo . ';';
//die($SQL);
        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }
 
    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO centrocustofinanceiro (IDEMPRESA, NOMECENTRO) VALUES 
                ('" . $this->idEmpresa . "', '" . $this->nome . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    //M�todo que lista as cargo em um array para preencher o grid
    public function ListaCentroCustoPesq($pesq = "") {

        $pesquisa = $pesq;

        $html = '<table border = "0" cellspacing = "3" cellpadding = "0">
                <tr>
                <td align = "right">Pesquisa:</td>
                <td><input class = "campo_texto" name = "pesquisa" type = "text" value = "' . $pesquisa . '" size = "40"></td>
                <td title = "Pesquisar" style = "cursor: pointer"><a onclick = "document.form1.submit();" ><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/busca.png" width = "22" height = "22"></a></td>
                <td title = "Adicionar Centro de Custo" width = "30px" align = "right"><a href = "centro_custo_financeiro_alteracao.frm.php"><img name = "btnsalvar" id = "btnsalvar" src = "../imagens/novo.gif" width = "22" ></a></td>
                </tr>

                <table border = "3" cellspacing = "2" cellpadding = "2">
                <tr height = "2">
                <th align = "center" class = "small" width = "50px">N&uacute;mero</th>
                <th align = "center" class = "small" width = "400px">Empresa</th> 
                <th align = "center" class = "small" width = "400px">Nome</th> 
                <th align = "center" class = "small" width = "60px">Apagar</th>
                </tr>';


        $SQL = "SELECT IDCENTROCUSTOFINANC, ccf.IDEMPRESA, NOMECENTRO, emp.NOMEEMPRESA
                FROM centrocustofinanceiro ccf
                INNER JOIN empresa emp
                ON ccf.IDEMPRESA = emp.IDEMPRESA  ";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(NOMECENTRO) LIKE UPPER('%"   . $pesq . "%') OR UPPER(emp.NOMEEMPRESA) LIKE UPPER('%"   . $pesq . "%') ";
        }

        $SQL.=" ORDER BY emp.NOMEEMPRESA, NOMECENTRO ";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        //die($SQL);
        foreach ($tbl as  $chave =>  $linha) {
             
            $html .= ' <tr height = "1">
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['IDCENTROCUSTOFINANC']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMEEMPRESA']) . ' </td>
                <td align = "center" class = "small" width = "100px"> ' . htmlentities($linha['NOMECENTRO']) . ' </td>
                <td align = "center"><a href = "centro_custo_financeiro.exe.php?idcentrocusto=' . htmlentities($linha['IDCENTROCUSTOFINANC']) . '&metodo=2"><img border = "0" src = "../imagens/cancelar.png" width = "20px" ></a> </td>
                </tr>';
        }


        $html .= '</table> </table>';



        return $html;
    }

    public function preencheDados($cod) {

        $SQL = "SELECT *
                FROM centrocustofinanceiro 
                WHERE IDCENTROCUSTOFINANC = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as  $chave =>  $linha) {

            $this->setCodigo($linha['IDCENTROCUSTOFINANC']);
            $this->setIdEmpresa($linha['IDEMPRESA']);
            $this->setNome($linha['NOMECENTRO']);
        }
    }
    
    public function ListaComboCentroCustoALL($idCentro = "") {
        $SQL = 'SELECT ccf.IDCENTROCUSTOFINANC as id, CONCAT(NOMECENTRO, " - ", emp.NOMEEMPRESA)   as nome, emp.IDEMPRESA 
                FROM centrocustofinanceiro ccf
                INNER JOIN empresa emp
                ON ccf.IDEMPRESA = emp.IDEMPRESA ';

        $where = "";
        
        if($_SESSION['empresa'] == 0){
            $where = " WHERE emp.IDEMPRESA = 1 OR emp.IDEMPRESA = 5";
        }else{
            $where = " WHERE emp.IDEMPRESA = 2 ";
        }
        $SQL .= $where . " ORDER BY emp.NOMEEMPRESA DESC, NOMECENTRO "; 
        
        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);
            
            if ($id == $idCentro) { 
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }

        return $drop;
    }
     
    
    public function ListaComboEmpresaALL($idEmpresa = "") {
        $SQL = 'SELECT IDEMPRESA as id, NOMEEMPRESA as nome 
                FROM empresa 
                ORDER BY emp.NOMEEMPRESA DESC, NOMECENTRO';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);
            
            if ($id == idEmpresa) { 
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }

        return $drop;
    }
     
    
}

?>