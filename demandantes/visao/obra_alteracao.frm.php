<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/obra.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $obra = new clsObra();
    $admin = new clsUsuario();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));

    if ($_GET) {
        $metodo = $_GET['metodo'];
    } else {
        $metodo = null;
    }

    if ($metodo == 1) {
        // EDITAR Exibir dados
        $cod = $_GET['idobra'];
        $obra->preencheDados($cod);
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

        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top"> 
                    <form id="form1" name="form1" method="post" action="obra.exe.php"> 
                        <input type="hidden" name="metodo" id="metodo" value="<?php echo $metodo ?>"/>
                        <input type="hidden" name="codigo" id="codigo" value="<?php echo $obra->getCodigo() ?>"/>
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
                                            <td>&nbsp;<a href="obra.frm.php"><b>VOLTAR</b></a></td>
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
                                            <td  height="36"><b><br />&nbsp;&nbsp;&nbsp;CADASTRO DE OBRAS<br /> 
                                                    </tr>
                                                    <tr>
                                                        <tr>
                                                            <td  align="right" class="small">N&uacute;mero:</td>
                                                            <td><input class="campo_texto" name="NUM" type="text" value='<?php echo $obra->getNumero() ?>' size="20" maxlength="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">CEI:</td>
                                                            <td><input class="campo_texto" name="CEI" type="text" value='<?php echo $obra->getCEI() ?>' size="20" maxlength="20"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right" class="small">Endere&ccedil;o: </td>
                                                            <td><input  class="campo_texto" name="END" id="END" type="text" value='<?php echo $obra->getEndereco() ?>' size="40" maxlength="150">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right" class="small">Descri&ccedil;&atilde;o: </td>
                                                            <td><input  class="campo_texto" name="DESC" id="DESC" type="text" value='<?php echo $obra->getDescricao() ?>' size="40"  maxlength="200">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right" class="small">Data inicio: </td>
                                                            <td><input  class="campo_texto" name="DATA" id="DATA" type="text" value='<?php echo $obra->getData() ?>' size="8"  maxlength="10" onkeyup="mascaraData(this, event);">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right" class="small">Respons&aacute;vel Principal: </td>
                                                            <td>
                                                                <select name="RESP">
                                                                    <?php echo $admin->ListaComboUsuarioCargoALL($obra->getId_usuario()); ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right" class="small">Respons&aacute;vel Secund&aacute;rio: </td>
                                                            <td>
                                                                <select name="RESP2">
                                                                    <?php echo $admin->ListaComboUsuarioCargoALL($obra->getId_usuario2()); ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Ordem de Compra:</td>
                                                            <td><input class="campo_texto" name="ORDEMCOMPRA" type="text" value='<?php echo $obra->getOrdemcompra() ?>' size="20" maxlength="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <br/>
                                                                <?php if ($metodo == 1) { ?>
                                                                    <input name="alterar" type="submit" value="Alterar" />
                                                                <?php } else { ?>
                                                                    <input name="salvar" type="submit" value="Salvar" />
                                                                <?php } ?>
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

