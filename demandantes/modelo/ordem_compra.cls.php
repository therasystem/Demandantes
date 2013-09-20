<?php

require_once("../controle/conexao.gti.php");

class clsOrdemCompra {

    // CAMPOS PRIVADOS-----------------------------------------
    public static $idcompra;
    public static $nome;
    public static $contato;
    public static $fax;
    public static $cel;
    public static $entrega;
    public static $pagamento;
    public static $frete;
    public static $desconto;
    
    //M�TODOS------------------------------------------------------

    public static function getIdcompra() {
        return clsOrdemCompra::$idcompra;
    }

    public static function setIdcompra($idcompra) {
        clsOrdemCompra::$idcompra = $idcompra;
    }

    public static function getNome() {
        return clsOrdemCompra::$nome;
    }

    public static function setNome($nome) {
        clsOrdemCompra::$nome = $nome;
    }

    public static function getContato() {
        return clsOrdemCompra::$contato;
    }

    public static function setContato($contato) {
        clsOrdemCompra::$contato = $contato;
    }

    public static function getFax() {
        return clsOrdemCompra::$fax;
    }

    public static function setFax($fax) {
        clsOrdemCompra::$fax = $fax;
    }

    public static function getCel() {
        return clsOrdemCompra::$cel;
    }

    public static function setCel($cel) {
        clsOrdemCompra::$cel = $cel;
    }

    public static function getEntrega() {
        return clsOrdemCompra::$entrega;
    }

    public static function setEntrega($entrega) {
        clsOrdemCompra::$entrega = $entrega;
    }

    public static function getPagamento() {
        return clsOrdemCompra::$pagamento;
    }

    public static function setPagamento($pagamento) {
        clsOrdemCompra::$pagamento = $pagamento;
    }

    public static function getFrete() {
        return clsOrdemCompra::$frete;
    }

    public static function setFrete($frete) {
        clsOrdemCompra::$frete = $frete;
    }

    public static function getDesconto() {
        return clsOrdemCompra::$desconto;
    }

    public static function setDesconto($desconto) {
        clsOrdemCompra::$desconto = $desconto;
    }

    function __construct() {
        clsOrdemCompra::$idcompra = "";
        clsOrdemCompra::$nome = "";
        clsOrdemCompra::$contato = "";
        clsOrdemCompra::$fax = "";
        clsOrdemCompra::$cel = "";
        clsOrdemCompra::$entrega = "";
        clsOrdemCompra::$pagamento = "";
        clsOrdemCompra::$frete = "";
        clsOrdemCompra::$desconto = "";
    }

 
}

?>