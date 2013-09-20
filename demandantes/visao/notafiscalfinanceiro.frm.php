<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/notafiscalfinanceiro.cls.php");

$config = new clsConfig();
if ($_POST) {

    if (isset($_POST['pesquisa'])) {
        $pesq = $_POST['pesquisa'];
        $tipo = "";
    } else {
        $pesq = $_POST['pesquisa2'];
        $tipo = $_POST['tipoPesq'];
    }
    
} else {
    $pesq = "";
    $tipo = "";
}

if ((isset($_SESSION['codigo']))) {

    $admin = new clsUsuario();

    $centro = new clsNotaFiscalFinanceiro();
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

        <script language="JavaScript" type="text/javascript">

            function limpaCampo()
            {
                document.getElementById('pesquisa2').disabled = false;
                document.getElementById('pesquisa2').value = "";
                document.getElementById('pesquisa').disabled = false;
                document.getElementById('pesquisa').value = "";
                document.getElementById('tipoPesq').value = "3";
                document.getElementById('tipoPesq').disabled = false;
                document.getElementById('limpa').checked = 0;
            }
            function disableCampo()
            {
                document.getElementById('pesquisa2').disabled = true; 
                document.getElementById('pesquisa2').value = "";
                document.getElementById('tipoPesq').disabled = true;
            }
            function disableCampo2()
            {
                document.getElementById('pesquisa').disabled = true;
                document.getElementById('pesquisa').value = "";
            }
              function submitenter(myfield, e)
            {
                var keycode;
                if (window.event)
                    keycode = window.event.keyCode;
                else if (e)
                    keycode = e.which;
                else
                    return true;

                if (keycode == 13)
                {
                    myfield.form.submit();
                    return false;
                }
                else
                    return true;
            }

        </script>


    </head>

    <body style="font-family: arial">

        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top">
                    <form id="form1" name="form1" method="post" action="notafiscalfinanceiro.frm.php">
                        <table width="980px" border="0" align="center" cellpadding="0" cellspacing="1">
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
                                    <!-- TABELA GRID-->
                                    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td  height="36"><b><br />&nbsp;&nbsp;&nbsp;CADASTRO DE <?php if ($_SESSION['tiponota'] == 0) { ?>NOTAS FISCAIS<?php } else { ?>GUIA DE ENCAMINHAMENTO<?php } ?><br /> 
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <?php echo $centro->ListaCentroPesq($pesq, $tipo) ?>
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

