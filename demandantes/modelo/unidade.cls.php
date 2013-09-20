<?php

require_once("../controle/conexao.gti.php");

class clsUnidade {

    // CAMPOS PRIVADOS-----------------------------------------
    private $codigo;
    private $nome;
    private $sigla;
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSigla() {
        return $this->sigla;
    }

    public function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    function __construct() {
        $this->codigo = "";
        $this->nome = "";
        $this->sigla = "";
    }

    
    public function ListaComboUnidadeALL($idUnidade = "") {
        $SQL = 'SELECT IDUNIDADE as id, CONCAT(NOMEUNID, " - ", SIGLAUNID) as nome
                FROM unidade 
                ORDER BY IDUNIDADE';


        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        $drop = "<option value='0' selected>---------  SELECIONE  ---------</option>";

        foreach ($tbl as $chave => $linha) {
            $id = $linha['id'];
            $nome = htmlentities($linha['nome']);
            
            if ($id == $idUnidade) { 
                $drop .= '<option value="' . $id . '" selected>' . $nome . '</option>';
            } else {
                $drop .= '<option value="' . $id . '">' . $nome . '</option>';
            }
        }

        return $drop;
    }
    
}

?>