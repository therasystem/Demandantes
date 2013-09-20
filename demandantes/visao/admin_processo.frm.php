<?php
session_start();

require_once("../modelo/usuario.cls.php");
require_once("../config.cls.php");
$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $admin = new clsUsuario();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));
} else {
    $config->Logout(true);
    $config->ConfirmaOperacao($config->GetPaginaPrincipal(), "Voc\xEA n\xE3o tem permiss\xE3o para acessar essa p\xE1gina!");
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Sistema Gerenciador de Processos</title>
        <link rel="shortcut icon" href="../imagens/_favicon.ico" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <style type="text/css">
            <!--
            @import url(estilo/estilo.css);
            .style23 {font-family: Tahoma, Arial, sans-serif}
            -->
        </style>

        <script type="text/javascript" src="js/geral.js"></script>

    </head>
    <body>
        <table align="center" cellpadding="0" cellspacing="1" width="780px">
            <tr>
                <td><img src="../imagens/banner.jpg" alt="" width="100%" /></td>
            </tr>
            <tr>
                <td bgcolor="#EEFFDD">
                    <table cellpadding="0" cellspacing="0" class="style4">
                        <tr>
                            <td width="75%" class="style7 style23">&nbsp;&nbsp; Seja Bem Vindo&nbsp; <?php echo $admin->GetNome(); ?>!</td>
                            <?php if ($_SESSION['cargo'] == 1 || $_SESSION['cargo'] == 2 || $_SESSION['cargo'] == 5) { ?>
                            <td  width="25%"><a href="admin.frm.php">Gerenciador de Compras</a></td>
                            <?php } ?>
                            <td style="padding:0 7px;"><img alt="" src="../imagens/bt_logout.jpg" style="margin-top: 0px" /></td>
                            <td style="padding:0 7px;"><b><a href="../<?php echo $config->GetPaginaPrincipal() ?>">SAIR</a></b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                    <table class="style8">
                        <tr>
                            <td onclick="location.href = 'processo_origem.frm.php'" onmouseover="CarregaToolTip('bt_cria_processo')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/bt_cria_processo.png" alt="Criar Processo" /><br />
                                Criar Processo
                            </td>

                            <td onclick="location.href = 'processo_inicio.frm.php'" onmouseover="CarregaToolTip('bt_processo')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/bt_processo.png" alt="Iniciar Processo" /><br />
                                Iniciar Processo
                            </td>
 
                        </tr>
                    </table>
                    
                    <br /><br />
                </td>
            </tr>
            <tr>
                <td>
                    <table class="style9" align="center">
                        <tr>
                            <td>
                                <textarea cols="" rows=""  id="txtInfo" class="semBorda">Clique sobre uma das op&ccedil;&otilde;es acima para acessar as &aacute;reas de configura&ccedil;&otilde;es.</textarea>
                            </td>
                        </tr>
                    </table>
                    <br />
                </td>
            </tr>
            <tr>
                <td background="../imagens/barra.jpg" valign="middle" align="center" height="27px">
                    &nbsp; 
                </td>
            </tr>
        </table>
    </body>
</html>