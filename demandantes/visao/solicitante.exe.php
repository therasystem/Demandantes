<?php

require_once("../modelo/dados_demandante.cls.php");
require_once("../config.cls.php");

$dadosDemandante = new clsDadosDemandante();
$config = new clsConfig();
$msg = "";

if ($_GET) {
    $metodoG = $_GET['metodo'];
} else {
    $metodoG = null;
}
if ($_POST) {
    $metodoP = $_POST['metodo'];
} else {
    $metodoP = null;
}

if ($metodoG == 1 || $metodoP == 1) {

    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $dadosDemandante->setCodigo($codigo);
    $dadosDemandante->setNome($CARGO);

    $dadosDemandante->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/cargo.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idcargo'];
    $dadosDemandante->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/cargo.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $dadosDemandante->setNome($CARGO);

    $dadosDemandante->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/cargo.frm.php", $msg);
}
 
?>