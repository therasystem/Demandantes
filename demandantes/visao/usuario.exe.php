<?php

require_once("../modelo/usuario.cls.php");
require_once("../config.cls.php");

$usuario = new clsUsuario();
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

    $usuario->setCodigo($_POST['idusuario']);
    $usuario->setLogin($LOGIN);
    $usuario->setSenha($SENHA);
    $usuario->setNome($NOME);
    $usuario->setCargo($CARGO);
    
//    $result = $usuario->Excluir($usuario->getCodigo());
//    $usuario->Salvar();

    $usuario->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/usuario.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idusuario'];
    $result = $usuario->Excluir($cod);
    if ($result == true) {
        $msg = "Registro excluido com sucesso!";
    } else {
        $msg = "O registro não pode ser excluido! Existe obra dependente do mesmo!";
    }
    $config->ConfirmaOperacao("visao/usuario.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $usuario->setLogin($LOGIN);
    $usuario->setSenha($SENHA);
    $usuario->setNome($NOME);
    $usuario->setCargo($CARGO);

    $usuario->Salvar();
    $usuario = null;
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/usuario.frm.php", $msg);
}
?>