<?php

require_once("../controle/conexao.gti.php");

class clsGeradorGenerico {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $desc;
    private $dadoExtra;
    private $colunas;
    private $tabela;

    //M�TODOS------------------------------------------------------
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function getDadoExtra() {
        return $this->dadoExtra;
    }

    public function setDadoExtra($dadoExtra) {
        $this->dadoExtra = $dadoExtra;
    }

    public function getTabela() {
        return $this->tabela;
    }

    public function setTabela($tabela) {
        $this->tabela = $tabela;
    }

    public function getColunas() {
        return $this->colunas;
    }

    public function setColunas($colunas) {
        $this->colunas = $colunas;
    }

    function __construct($tabela) {


        $this->codigo = "";
        $this->desc = "";
        $this->tabela = $tabela;

        $this->setarColunas($tabela);
    }

    public function setarColunas($tabela) {

        $SQL = "SHOW COLUMNS FROM " . $tabela . "";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $i = 0;
        $array = null;

        foreach ($tbl as $chave => $linha) {
            $array[$i] = $linha['Field'];
            $i++;
        }


        $this->setColunas($array);
    }

    public function preencheDados($cod) {

        $array = $this->getColunas();

        $SQL = "SELECT *
                FROM " . $this->getTabela() . " 
                WHERE " . $array[0] . " = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $tam = count($array);
        $i = 2;
        $variavelExtra = "";
        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha[$array[0]]);
            $this->setDesc($linha[$array[1]]);

            if ($tam > 2) {

                while ($tam > $i) {
                    $variavelExtra .= $linha[$array[$i]] . ' ; ';
                    $i++;
                }
                $this->setDadoExtra($variavelExtra);
            }
        }

        die($this->getDesc());
    }

    public function ListaComboALL($cod = "", $where = "") {

        $array = $this->getColunas();

        $SQL = "SELECT " . $array[0] . " as id,  " . $array[1] . " as descricao
                FROM " . $this->getTabela() . " " . $where . "";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $desc = htmlentities($linha['descricao']);

            if ($id == $cod) {
                $drop .= '<option value="' . $id . '" selected>' . $desc . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $desc . '</option>';
            }
        }

        return $drop;
    }
    
     public function ListaComboALL3colunas($cod = "", $where = "") {

        $array = $this->getColunas();

        $SQL = "SELECT " . $array[0] . " as id,  " . $array[2] . " as descricao
                FROM " . $this->getTabela() . " " . $where . "";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $desc = htmlentities($linha['descricao']);

            if ($id == $cod) {
                $drop .= '<option value="' . $id . '" selected>' . $desc . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $desc . '</option>';
            }
        }

        return $drop;
    }

    public function inserirGenerico($cod = "") {

        $array = $this->getColunas();

        $SQL = "INSERT INTO " . $this->getTabela() . " (" . $array[1] . ") VALUES ('" . $cod . "');";
        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function deletarGenerico($cod = "") {

        $array = $this->getColunas();

        $SQL = "DELETE FROM " . $this->getTabela() . " WHERE " . $array[0] . "=. $cod .";
        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

}

?>