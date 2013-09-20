<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/centro_custo_financeiro.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $centro = new clsCentroCustoFinanceiro();
    $admin = new clsUsuario();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));

    if ($_GET) {
        $metodo = $_GET['metodo'];
    } else {
        $metodo = null;
    }
 
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
                    <form id="form1" name="form1" method="post" action="centro_custo_financeiro.exe.php"> 
                        <input type="hidden" name="metodo" id="metodo" value="<?php echo $metodo ?>"/> 
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
                                            <td>&nbsp;<a href="centro_custo_financeiro.frm.php"><b>VOLTAR</b></a></td>
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
                                            <td  height="36"><b><br />&nbsp;&nbsp;&nbsp;CADASTRO DE CENTRO DE CUSTO<br /> 
                                                    </tr>
                                                    <tr> 
                                                        <tr>
                                                            <td  align="right" class="small">Empresa:</td>
                                                            <td>
                                                                <select name="EMPRESA">
                                                                    <?php echo $centro->ListaComboEmpresaALL()?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Centro de Custo:</td>
                                                            <td><input class="campo_texto" name="CENTRO" type="text" value='' size="40" maxlength="100"></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <br/> 
                                                                    <input name="salvar" type="submit" value="Salvar" /> 
                                                            </td>
                                                        </tr>
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

