<?php

require_once("../modelo/processo_inicio.cls.php");
require_once("../config.cls.php");

$procInicio = new clsProcessoInicio();
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

    $procInicio->setCodigo($codigo);
    $procInicio->setIdoriproc($IDORI);
    $procInicio->setDescricao($DESC);

    $procInicio->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/processo_inicio.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idiniproc'];
    $procInicio->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/processo_inicio.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $procInicio->setIdoriproc($IDORI);
    $procInicio->setDescricao($DESC);

    $procInicio->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/processo_inicio.frm.php", $msg);
}
 
?>