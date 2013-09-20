<?php
require_once("../config.cls.php");
$config = new clsConfig();
$config->Logout(false);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <title>Sistema Gerenciador de Compras</title>
        <link rel="shortcut icon" href="../imagens/_favicon.ico" />
        <link href="estilo/estilo.css" rel="stylesheet" type="text/css" />

        <style type="text/css">
            .style23 {background-color: #efd; font: 14px Tahoma, Arial, sans-serif}
        </style>

        <script src="js/validator.js" type="text/javascript"></script>

    </head>
    <body>

        <table align="center" cellpadding="0" cellspacing="1" width="780px">
            <tr>
                <td>
                    <img src="imagens/banner.jpg" alt="" width="100%" />
                </td>
            </tr>
            <tr>
                <td class="style7 style23">&nbsp;&nbsp; Seja Bem Vindo! &nbsp; Por favor, efetue seu login para iniciar a sess&atilde;o!</td>
            </tr>
            <tr>
                <td class="style4 style7">&nbsp;</td>
            </tr>
            <tr>
                <td><br />
                    <form id="frmInicial" name="frmInicial" method="post" action="inicial.exe.php" onsubmit="return v.exec()">
                        <table width="380" align="center" cellpadding="0" cellspacing="0" class="telaLogin" >
                            <tr>
                                <td width="380">
                                    <table cellpadding="0" cellspacing="0" class="formLogin" align="center">

                                        <tr>
                                            <td class="style3">
                                                Login:</td>
                                            <td style="text-align: left">
                                                <input id="txtLogin" name="txtLogin" type="text" class="caixaGrande" maxlength="20" value=""/></td>
                                        </tr>
                                        <tr>
                                            <td class="style3">
                                                Senha:</td>
                                            <td style="text-align: left">
                                                <input id="txtSenha" name="txtSenha" type="password" class="caixaGrande" maxlength="20" value=""/></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td style="text-align: right">
                                                <input id="cmdConfirmar" name="cmdConfirmar" type="submit" value="Confirmar" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td align="center" valign="middle" bgcolor="#FFFFFF" class="rodape">&nbsp;</td>
            </tr>
            <tr>
                <td style="background-image: url(imagens/barra.jpg); vertical-align:middle;text-align:center;height:27px;">
                    &nbsp;
                    <img alt=""  src="imagens/postgres.gif" width="80" height="15" />
                    <img alt=""  src="imagens/php.png" width="80" height="15" />
                    <div align="center"></div></td>
            </tr>
        </table>

    </body>
    <script type="text/javascript">

        var campos =
            {
            'txtLogin': {'l':'Login','r':true,'mn':1,'mx':20,'t':'txtLogin'},
            'txtSenha': {'l':'Senha','r':true,'mn':1,'mx':20,'t':'txtSenha'}
        }

        var v = new validator('frmInicial', campos);

    </script>
</html>
