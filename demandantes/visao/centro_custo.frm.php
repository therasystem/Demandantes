<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/centro_custo.cls.php");

$config = new clsConfig();
$metodo = "";
$voltar = "admin.frm.php";

if ($_POST) {
    $pesq = $_POST['pesquisa'];
} else {
    $pesq = "";
    if ($_GET) {
        $idcentro = $_GET['idcentro'];
        $metodo = $_GET['metodo'];
//die('aas'.$idcentro);
        if ($metodo == 1) {
            $voltar = "aaacentro_custo.frm.php";
        } else {
            $voltar = "centro_custo.frm.php";
        }
    }
}

if ((isset($_SESSION['codigo']))) {

    $admin = new clsUsuario();

    $centroCusto = new clsCentroCusto();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));
} else {
    $config->Logout(false);
    $config->ConfirmaOperacao($config->GetPaginaPrincipal(), "Voc\xEA n\xE3o tem permiss\xE3o para acessar essa p\xE1gina!");
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Sistema Gerenciador de Compras</title>
        <link rel="shortcut icon" href="../imagens/_favicon.ico" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="estilo/estilo.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top">
                    <form id="form1" name="form1" method="post" action="centro_custo.frm.php">
                        <table width="780px" border="0" align="center" cellpadding="0" cellspacing="1">
                            <tr>
                                <td>
                                    <img alt="" src="../imagens/banner.jpg" width="100%"/></td>
                            </tr>
                            <tr>
                                <td width="100%" bgcolor="#EEFFDD">
                                    <table cellpadding="0" cellspacing="0" class="style4">
                                        <tr>
                                            <td width="100%" class="style7 style23">&nbsp;&nbsp; Seja Bem Vindo <?php echo $admin->GetNome(); ?>!&nbsp;</td>
                                            <td><img src="../imagens/back.png" alt="Voltar" /></td>
                                            <td>&nbsp;<a href="<?php echo $voltar ?>"><b>VOLTAR</b></a></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td class="style6"><img src="../imagens/bt_logout.jpg" alt="Sair" /></td>
                                            <td>&nbsp;&nbsp;&nbsp;<b><a href="../<?php echo $config->GetPaginaPrincipal() ?>"><b>SAIR</b></a></b></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- TABELA GRID-->
                                    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td  height="36"><b><br />&nbsp;&nbsp;&nbsp;CENTRO DE CUSTO<br /> 
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <?php
                                                            if ($metodo == "") {
                                                                echo $centroCusto->ListaCentroPesq($pesq);
                                                            } else if ($metodo == 1) {
                                                                
                                                            } else {
                                                                echo $centroCusto->ListaCentroMateriPesq($idcentro, $metodo);
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    </table> 
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#F0FFE0" valign="middle" align="center">
                                                &nbsp;
                                                <div align="center"></div>
                                            </td>
                                        </tr>
                                    </table>
                                    </form>
                                </td>
                            </tr>
                        </table> 
                        </body>
                        </html>
