<?php

require_once("../modelo/centro_custo.cls.php");
require_once("../config.cls.php");

$centroCusto = new clsCentroCusto();
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

    /* extract($_POST, EXTR_PREFIX_SAME, "wddx");

      $estoque->setCodigo($codigo);
      $estoque->setIdobra($IDOBRA);
      $estoque->setIdmaterial($IDMATERIAL);
      $estoque->setIdunidade($IDUNIDADE);
      $estoque->setQuantidade($QUANTIDADE);
      $estoque->setDataentrada($DATAENTRADA);

      $estoque->Alterar();
      $msg = "Registro alterado com sucesso!";
      $config->ConfirmaOperacao("visao/add_estoque.frm.php", $msg);
     * 
     */
} else if ($metodoG == 2 || $metodoP == 2) {
    // DELETAR
    $cod = $_GET['idcentro'];
    $centroCusto->Excluir($cod); // Deleta  centro
    $msg = "Registro excluido com sucesso!";
    $config->ConfirmaOperacao("visao/centro_custo.frm.php", $msg);
} else if ($metodoG == 3 || $metodoP == 3) {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $centroCusto->RetornaCentroCusto($codigo);

    $centroCusto->setIdrelaciona($codigo);
    $centroCusto->setDescCentro($DESCCENTRO);
    $centroCusto->setIdobra($centroCusto->getIdobra());

    $centroCusto->Salvar(); // // salva Sub Centro
    header("Location: centro_custo.frm.php?idcentro=" . $codigo . "&metodo=2");
    //$msg = "Registro inserido com sucesso!";
    //$config->ConfirmaOperacao("visao/centro_custo.frm.php", $msg);
} else if ($metodoG == 4 || $metodoP == 4) {
    // DELETAR
    $cod = $_GET['idcentro'];
    $centroCusto->Excluir($cod); // Deleta sub centro
    //$msg = "Registro excluido com sucesso!";
    //$config->ConfirmaOperacao("visao/centro_custo.frm.php", $msg);
    header("Location: " . $_SERVER['HTTP_REFERER'] . "");
} else {
    // SALVAR
    extract($_POST, EXTR_PREFIX_SAME, "wddx");

    $centroCusto->setIdobra($IDOBRA);
    $centroCusto->setDescCentro($DESCCENTRO);

    $centroCusto->Salvar();
    $msg = "Registro inserido com sucesso!"; // salva centro
    $config->ConfirmaOperacao("visao/centro_custo.frm.php", $msg);
}
?>