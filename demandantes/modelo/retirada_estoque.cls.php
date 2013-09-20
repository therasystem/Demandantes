<?php

require_once("../controle/conexao.gti.php");

class clsRetiradaEstoque {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $idobra;
    private $idmaterial;
    private $idunidade;
    private $quantidade;
    private $dataentrada;
    private $idcentro;
    private $idrelaciona;

    //M�TODOS------------------------------------------------------
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
    
    public function getIdmaterial() {
        return $this->idmaterial;
    }

    public function setIdmaterial($idmaterial) {
        $this->idmaterial = $idmaterial;
    }

    public function getIdunidade() {
        return $this->idunidade;
    }

    public function setIdunidade($idunidade) {
        $this->idunidade = $idunidade;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getDataentrada() {
        return $this->dataentrada;
    }

    public function setDataentrada($dataentrada) {
        $this->dataentrada = $dataentrada;
    }
    
    public function getIdcentro() {
        return $this->idcentro;
    }

    public function setIdcentro($idcentro) {
        $this->idcentro = $idcentro;
    }

    public function getIdrelaciona() {
        return $this->idrelaciona;
    }

    public function setIdrelaciona($idrelaciona) {
        $this->idrelaciona = $idrelaciona;
    }

    
    function __construct() {
        $this->codigo = "";
        $this->idobra = "";
        $this->idmaterial = "";
        $this->idunidade = "";
        $this->quantidade = "";
        $this->dataentrada = "";
        $this->idcentro = "";
        $this->idrelaciona = "";
    }

    //M�todo para excluir um cargo
    public function Excluir($codigo) {
        $SQL = 'DELETE FROM retirada_estoque WHERE IDRETIRADA=' . $codigo . ';';
//die($SQL);
        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }


    //M�todo que realiza o cadastro de um novo cargo
    public function Salvar() {

        $SQL = "INSERT INTO retirada_estoque (IDOBRA, IDMATERIAL, IDUNIDADE, QUANTRETIRADA, DATARETESTOQUE, IDCENTRO, IDRELACIONA) VALUES 
                ('" . $this->idobra . "','" . $this->idmaterial . "','" . $this->idunidade . "','" . $this->quantidade . "','" . $this->dataentrada . "','" . $this->idcentro . "','" . $this->idrelaciona . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }
  

}

?>