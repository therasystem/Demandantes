<?php

require_once("../controle/conexao.gti.php");

class clsEntidade {

    private $codigo;
    private $NOMEENT;
    private $REGENT;
    private $IDMUNICIPIO;
    private $ENDENT;
    private $OBSENT;
    private $DATAENTRADAENT;

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
 
    public function getNOMEENT() {
        return $this->NOMEENT;
    }

    public function setNOMEENT($NOMEENT) {
        $this->NOMEENT = $NOMEENT;
    }

    public function getREGENT() {
        return $this->REGENT;
    }

    public function setREGENT($REGENT) {
        $this->REGENT = $REGENT;
    }
    
    public function getIDMUNICIPIO() {
        return $this->IDMUNICIPIO;
    }

    public function setIDMUNICIPIO($IDMUNICIPIO) {
        $this->IDMUNICIPIO = $IDMUNICIPIO;
    }

    
    public function getENDENT() {
        return $this->ENDENT;
    }

    public function setENDENT($ENDENT) {
        $this->ENDENT = $ENDENT;
    }

    public function getOBSENT() {
        return $this->OBSENT;
    }

    public function setOBSENT($OBSENT) {
        $this->OBSENT = $OBSENT;
    }

    public function getDATAENTRADAENT() {
        return $this->DATAENTRADAENT;
    }

    public function setDATAENTRADAENT($DATAENTRADAENT) {
        $this->DATAENTRADAENT = $DATAENTRADAENT;
    }

    
    function __construct() {

        $this->IDENTIDADE = "";
        $this->NOMEENT= "";
        $this->REGENT = "";
        $this->IDMUNICIPIO = "";
        $this->ENDENT = "";
        $this->OBSENT = "";
        $this->DATAENTRADAENT = "";
    }

//Mï¿½todo para excluir um cargo
    public function Excluir() {
        $SQL = 'DELETE FROM entidade WHERE IDENTIDADE=' . $this->codigo . ';';
//die($SQL);
        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

//Metodo para alterar uma cargo
    function Alterar() {
        $SQL = "UPDATE entidade SET 
                NOMEENT='" . $this->NOMEENT . "',
                REGENT ='" . $this->REGENT . "',
                IDMUNICIPIO ='" . $this->IDMUNICIPIO . "',
                ENDENT ='" . $this->ENDENT . "',
                OBSENT ='" . $this->OBSENT . "',
                DATAENTRADAENT ='" . $this->DATAENTRADAENT . "'
                WHERE IDENTIDADE='" . $this->codigo . "'";

//die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function Salvar() {

        $SQL = "INSERT INTO entidade (
            NOMEENT, REGENT, IDMUNICIPIO, ENDENT, OBSENT, DATAENTRADAENT       
            ) VALUES (
            '" . $this->NOMEENT . "','" . $this->REGENT . "','" . $this->IDMUNICIPIO . "',
            '" . $this->ENDENT . "','" . $this->OBSENT . "', '" . $this->DATAENTRADAENT . "');";

//die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

//Mï¿½todo que lista as cargo em um array para preencher o grid


    public function preencheDados($cod) {

        $SQL = "SELECT *
            FROM entidade
            WHERE IDENTIDADE = '" . $cod . "'";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDENTIDADE']);
            $this->setNOMEENT($linha['NOMEENT']);
            $this->setREGENT($linha['REGENT']);
            $this->setIDMUNICIPIO($linha['IDMUNICIPIO']);
            $this->setENDENT($linha['ENDENT']);
            $this->setOBSENT($linha['OBSENT']);
            $this->setDATAENTRADAENT($linha['DATAENTRADAENT']);
        }
    }

    public function ListaEntidade($pesq = "") {


        $pesquisa = $pesq;

        $html = '
            <div style="margin-top: 1px; float: left">
                            <input type="text" name="pesquisa" value="'.$pesquisa.'" class="form-control">
                        </div>
                    <div style="float: left; margin-left: 1%">
                    <a type="submit"  onclick = "document.form1.submit();" class="btn btn-primary">Pesquisar</a>
                    <a type="submit" href = "entidade_alteracao.frm.php"  class="btn btn-success">Adicionar</a>
                    <a href="../visao/menuadministrador.frm.php"  class="btn btn-primary">Voltar</a>
                    </div>
                              <table class="table1 table1-bordered">
                              <thead>
                                <tr>
                                  <th>Nome</th>
                                  <th>Região</th>
                                  <th>Município</th>
                                  <th>Endereço</th>
                                  <th>Editar</th>
                                  <th>Excluir</th>
                                </tr>
                              </thead>';

        $SQL = "SELECT IDENTIDADE, NOMEENT, REGENT, ENDENT, OBSENT, DATAENTRADAENT, m.DESCMUNICIPIO
                FROM entidade e
                INNER JOIN municipio m 
                ON e.IDMUNICIPIO = m.IDMUNICIPIO";

        if ($pesq != "") {
            $pesq = str_replace(" ", "%", $pesq);

            $SQL.=" WHERE UPPER(NOMEENT) LIKE UPPER('%" . $pesq . "%') OR UPPER(REGENT) LIKE UPPER('%" . $pesq . "%')  
                    OR UPPER(ENDENT) LIKE UPPER('%" . $pesq . "%') OR UPPER(OBSENT) LIKE UPPER('%" . $pesq . "%') 
                    OR UPPER(DESCMUNICIPIO) LIKE UPPER('%" . $pesq . "%')";
        }

        $SQL.=" ORDER BY NOMEENT ";

        //die($SQL);
        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
       
        foreach ($tbl as $chave => $linha) {

            $html .= '   <tbody>
                <td > ' . htmlentities($linha['NOMEENT']) . ' </td>
                <td > ' . htmlentities($linha['REGENT']) . ' </td>
                <td > ' . htmlentities($linha['DESCMUNICIPIO']) . ' </td>
                <td > ' . htmlentities($linha['ENDENT']) . ' </td>
                <td ><a href = "entidade_alteracao.frm.php?IDENTIDADE=' . htmlentities($linha['IDENTIDADE']) . '&metodo=1"><img src = "img/edit.png" ></a> </td>
                <td ><a href = "entidade.exe.php?IDENTIDADE=' . htmlentities($linha['IDENTIDADE']) . '&metodo=2"><img  src = "img/delete.png"  ></a> </td>
                </tbody>
                ';
        }

        $html .= ' </table>';


        return $html;
    }

}
?>