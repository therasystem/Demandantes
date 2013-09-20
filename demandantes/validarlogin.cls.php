<?php

require_once("controle/conexao.gti_index.php");

class clsValidarLogin {

    private $codigo;
    private $NOMEUSU;
    private $LOGINUSU;
    private $SENHAUSU;
    private $IDENTIDADE;
    private $IDPERMISSAO;

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNOMEUSU() {
        return $this->NOMEUSU;
    }

    public function setNOMEUSU($NOMEUSU) {
        $this->NOMEUSU = $NOMEUSU;
    }

    public function getLOGINUSU() {
        return $this->LOGINUSU;
    }

    public function setLOGINUSU($LOGINUSU) {
        $this->LOGINUSU = $LOGINUSU;
    }

    public function getSENHAUSU() {
        return $this->SENHAUSU;
    }

    public function setSENHAUSU($SENHAUSU) {
        $this->SENHAUSU = $SENHAUSU;
    }

    public function getIDENTIDADE() {
        return $this->IDENTIDADE;
    }

    public function setIDENTIDADE($IDENTIDADE) {
        $this->IDENTIDADE = $IDENTIDADE;
    }

    public function getIDPERMISSAO() {
        return $this->IDPERMISSAO;
    }

    public function setIDPERMISSAO($IDPERMISSAO) {
        $this->IDPERMISSAO = $IDPERMISSAO;
    }

    function __construct() {

        $this->IDUSUARIO = "";
        $this->NOMEUSU = "";
        $this->LOGINUSU = "";
        $this->SENHAUSU = "";
        $this->IDENTIDADE = "";
        $this->IDPERMISSAO = "";
    }

    function validarLogin($usuario, $senha) {
        $SQL = "SELECT * FROM usuario 
                WHERE LOGINUSU ='" . $usuario . "' AND SENHAUSU =MD5('" . $senha . "')";


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

//die($SQL);

        foreach ($tbl as $chave => $linha) {

            $this->setCodigo($linha['IDUSUARIO']);
            $this->setNOMEUSU($linha['NOMEUSU']);
            $this->setLOGINUSU($linha['LOGINUSU']);
            $this->setSENHAUSU($linha['SENHAUSU']);
            $this->setIDENTIDADE($linha['IDENTIDADE']);
            $this->setIDPERMISSAO($linha['IDPERMISSAO']);
        }


        if (empty($tbl)) {
            return false;
        } else {
            
            session_start();

            $_SESSION['codigo'] = $this->codigo;
            $_SESSION['usuarioNome'] = $this->LOGINUSU;
            $_SESSION['permissao'] = $this->IDPERMISSAO;
            $_SESSION['entidade'] = $this->IDENTIDADE;
            
        }

        return true;
    }

}

?>