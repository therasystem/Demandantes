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

    $usuario->setCodigo($codigo);
    $usuario->setNOMEUSU($NOMEUSU);
    $usuario->setLOGINUSU($LOGINUSU);
    $usuario->setIDENTIDADE($IDENTIDADE);
    $usuario->setIDPERMISSAO($IDPERMISSAO);
    $usuario->setSENHAUSU($SENHAUSU);

    $usuario->Alterar();
    $msg = "Registro alterado com sucesso!";
    $config->ConfirmaOperacao("visao/cadastro_usuario.frm.php", $msg);
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['IDUSUARIO'];
    $usuario->setCodigo($cod);
    $usuario->Excluir($cod);
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/cadastro_usuario.frm.php", $msg);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    
    $usuario->setNOMEUSU($NOMEUSU);
    $usuario->setLOGINUSU($LOGINUSU);
    $usuario->setIDENTIDADE($IDENTIDADE);
    $usuario->setIDPERMISSAO($IDPERMISSAO);
    $usuario->setSENHAUSU($SENHAUSU);

    $usuario->Salvar();
    $msg = "Registro inserido com sucesso!";
    $config->ConfirmaOperacao("visao/cadastro_usuario.frm.php", $msg);
}
 
?>