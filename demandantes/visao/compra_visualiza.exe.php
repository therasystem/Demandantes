<?php

require_once("../modelo/compra.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../config.cls.php");

session_start();

$compra = new clsCompra();
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
    // VERIFICA LIBERAÇÃO DE COMPRA
    $cod = $_GET['idcompra'];
    $resp = $_GET['idresp'];
    $autoriza = $_GET['autoriza'];
    $bloqueio = false;

    if ($_SESSION['codigo'] != $resp) {
        if ($usuario->verificaSeCargoDeSocio() == true) {
            $bloqueio = false;
        } else {
            $bloqueio = true;
        }
    }

    if ($bloqueio) {
        $msg = "Você não tem autorização para liberar esta compra!";
        $config->ConfirmaOperacao("visao/compra.frm.php", $msg);
    } else {
        $compra->AtualizaLiberacaoCompra($cod, $autoriza, $resp);
        if ($autoriza <= 2) {
            $msg = "Compra liberada!";
        } else {
            $msg = "Compra bloqueada!";
        }
        $config->ConfirmaOperacao("visao/compra.frm.php", $msg);
    }
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idcompra'];
    $autoriza = $compra->Excluir($cod);
    $compra->ExcluirItemcompra($cod);
    if ($autoriza == true) {
        $msg = "Registro excluido com sucesso!";
    } else {
        $msg = "O registro não pode ser excluido! Verificar se as compras estão bloqueadas. Somente o criador da compra poderá excluir a mesma!";
    }
    $config->ConfirmaOperacao("visao/compra.frm.php", $msg);
} else if ($metodoG == 3 || $metodoP == 3) {
    $cod = $_GET['idcompra'];
    $emp = $_GET['nomeEmp'];
    $compra->abreArquivo($cod, $emp);
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $compra->setIdobra($OBRA);
    if ($OBRA != 0) {
        $compra->Salvar();
        $msg = "Registro inserido com sucesso!";
    } else {
        $msg = "Registro não inserido!";
    }
    $config->ConfirmaOperacao("visao/compra.frm.php", $msg);
}
?>