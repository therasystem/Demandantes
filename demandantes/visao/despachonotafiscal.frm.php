<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/notafiscalfinanceiro.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $nota = new clsNotaFiscalFinanceiro();
    $admin = new clsUsuario();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));

    if ($_SESSION['tiponota'] == 0) {
        $nome = "MOVIMENTA��O DE CAIXA";
    } else {
        $nome = "GUIA DE ENCAMINHAMENTO";
    }
    if ($_POST) {
        $nota->EnvioNota($_POST['data'], $_POST['ENVIO'], $_POST['numero']);
    } else if ($_GET) {
        $nota->EnvioNotaAtualizaObra($_GET['data2'], $_GET['ENVIO2'], $_GET['numero2']);
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

        <script language="JavaScript" type="text/javascript">

            function mascaraData(campo, e)
            {
                var kC = (document.all) ? event.keyCode : e.keyCode;
                var data = campo.value;

                if (kC != 8 && kC != 46)
                {
                    if (data.length == 2)
                    {
                        campo.value = data += '/';
                    }
                    else if (data.length == 5)
                    {
                        campo.value = data += '/';
                    }
                    else
                        campo.value = data;
                }
            }

        </script>

    </head>

    <body>

        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top">

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
                                        <td>&nbsp;<a href="acessar_centro_custo.frm.php"><b>VOLTAR</b></a></td>
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
                                <form id="form1" name="form1" method="post" action="despachonotafiscal.frm.php">
                                    <!-- TABELA GRID-->
                                    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td  height="36"><b><br />&nbsp;&nbsp;&nbsp;<?php echo $nome ?> <br /></td> 
                                        </tr>
                                        <tr>
                                            <td valign="top">
                                                <?php echo $nota->ListaMovimento() ?>
                                            </td>
                                        </tr>
                                </form>
                                <form id="form2" name="form2" method="get" action="despachonotafiscal.frm.php">
                                        <tr>
                                            <td  height="36"><b><br />&nbsp;&nbsp;&nbsp;<?php echo $nome ?> OBRA <br /></td> 
                                        </tr>
                                        <tr>
                                            <td valign="top">
                                                <?php echo $nota->ListaMovimentoObra() ?>
                                            </td>
                                        </tr>
                                    </table> 
                                </form>
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

                </td>
            </tr>
        </table>

    </body>
</html>
