<?php

require_once("../modelo/fornecedor.cls.php");
require_once("../config.cls.php");

$fornecedor = new clsFornecedor();
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

    $fornecedor->setCodigo($codigo);
    $fornecedor->setNome($NOME);
    $fornecedor->setContato($CONTATO);
    $fornecedor->setCnpj($CNPJ);
    $fornecedor->setEndereco($END);
    $fornecedor->setTelefone1($TEL1);
    $fornecedor->setTelefone2($TEL2);
    $fornecedor->setEmail($EMAIL);

    $fornecedor->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/fornecedor.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idfornecedor'];
    $fornecedor->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/fornecedor.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $fornecedor->setNome($NOME);
    $fornecedor->setContato($CONTATO);
    $fornecedor->setCnpj($CNPJ);
    $fornecedor->setEndereco($END);
    $fornecedor->setTelefone1($TEL1);
    $fornecedor->setTelefone2($TEL2);
    $fornecedor->setEmail($EMAIL);

    $fornecedor->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacaoTempoVolta("visao/fornecedor_alteracao.frm.php", $msg,2);
}
 
?>