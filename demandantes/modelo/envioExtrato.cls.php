<?php

require_once("../controle/conexao.gti.php");

class clsEnvioExtrato {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $conta;
    private $data;
    private $nrdoc;
    private $historico;
    private $valor;
    private $debcred;
    private $mes;
    private $ano;
    private $idcentro;

    //M�TODOS------------------------------------------------------
    function __construct() {
        $this->codigo = "";
        $this->conta = "";
        $this->data = "";
        $this->nrdoc = "";
        $this->historico = "";
        $this->valor = "";
        $this->debcred = "";
        $this->mes = "";
        $this->ano = "";
        $this->idcentro = "";
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getConta() {
        return $this->conta;
    }

    public function setConta($conta) {
        $this->conta = $conta;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getNrdoc() {
        return $this->nrdoc;
    }

    public function setNrdoc($nrdoc) {
        $this->nrdoc = $nrdoc;
    }

    public function getHistorico() {
        return $this->historico;
    }

    public function setHistorico($historico) {
        $this->historico = $historico;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getDebcred() {
        return $this->debcred;
    }

    public function setDebcred($debcred) {
        $this->debcred = $debcred;
    }

    public function getMes() {
        return $this->mes;
    }

    public function setMes($mes) {
        $this->mes = $mes;
    }

    public function getAno() {
        return $this->ano;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }
    
    public function getIdcentro() {
        return $this->idcentro;
    }

    public function setIdcentro($idcentro) {
        $this->idcentro = $idcentro;
    }

    
    //M�todo que realiza o cadastro de um novo fornecedor
    public function Salvar() {

        $SQL = "INSERT INTO extrato (CONTA, DATA, NRDOC, HISTORICO, VALOR, DEBCRED, MES, ANO, IDCENTROCUSTOFINANC) VALUES 
                ('" . $this->conta . "', '" . $this->data . "', '" . $this->nrdoc . "', '" . $this->historico . "', '" . $this->valor . "', '" . $this->debcred . "', '" . $this->mes . "', '" . $this->ano . "', '" . $this->idcentro . "');";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    public function SalvarExtrato($doc, $mes, $ano, $idcentro) {

        $this->VerificaMesAno($mes, $ano, $idcentro);

        $nome = str_replace("\\", "", $doc['name']);
        //$file = 'c:/temp/' . $nome.'_'.$mes.'_'.$ano;
        $file = '../extrato/' . $mes . '_' . $ano . '_' . $nome;

        $flag = 0;
        
        $this->setIdcentro($idcentro);
        
        if (@move_uploaded_file($doc['tmp_name'], $file)) {
            $arquivo = file($file);
            foreach ($arquivo as $linha) {
                //die($line);
                if ($flag == 1) {

                    $arrayLinha = explode(";", $linha);
                    $arrayLinha = str_replace('"', "", $arrayLinha);

                    $this->setConta($arrayLinha[0]);
                    //20130402
                    $data = $arrayLinha[1];
                    $data = $data[6] . $data[7] . '/' . $data[4] . $data[5] . '/' . $data[0] . $data[1] . $data[2] . $data[3];

                    $this->setData($data);
                    $this->setNrdoc($arrayLinha[2]);
                    $this->setHistorico($arrayLinha[3]);
                    
                    $this->setValor( trim(number_format(str_replace(',','.',$arrayLinha[4]), 2, ',', '.')));
                    
                    $this->setDebcred($arrayLinha[5]);
                    $this->setMes($mes);
                    $this->setAno($ano);

                    $this->Salvar();
                     
                } else {
                    $flag++;
                }
            }
        }
    }

    public function VerificaMesAno($mes, $ano, $idcentro) {

        $SQL = "SELECT IDEXTRATO
                FROM extrato 
                WHERE IDCENTROCUSTOFINANC = '" . $idcentro . "' AND MES = '" . $mes . "' AND ANO = '" . $ano . "'";

        //die($SQL);

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();
        
        $texto= "";
        foreach ($tbl as $chave => $linha) {
            $texto.=$linha['IDEXTRATO'].',';
        }
        $texto.='-1';

        $SQL = 'DELETE FROM extrato WHERE IDEXTRATO IN ('.$texto.')';

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

}

?>