<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/material.cls.php");
require_once("../modelo/quadro_comparativo.cls.php");

$config = new clsConfig();
$idcompra = $_GET['idcompra'];

if ((isset($_SESSION['codigo']))) {
    $quadro = new clsQuadroComparativo();
    $admin = new clsUsuario();
    $material = new clsMaterial();
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

        <script language="javascript" type="text/javascript">

            function PrintElementID(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
            
                      
            function FormataReais(fld, milSep, decSep, e) {

                var sep = 0;
                var key = '';
                var i = j = 0;
                var len = len2 = 0;
                var strCheck = '0123456789';
                var aux = aux2 = '';
                var whichCode = (window.Event) ? e.which : e.keyCode;
                if (whichCode == 13)
                    return true;
                key = String.fromCharCode(whichCode);  // Valor para o código da Chave
                if (strCheck.indexOf(key) == -1)
                    return false;  // Chave inválida
                len = fld.value.length;
                for (i = 0; i < len; i++)
                    if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep))
                        break;
                aux = '';
                for (; i < len; i++)
                    if (strCheck.indexOf(fld.value.charAt(i)) != -1)
                        aux += fld.value.charAt(i);
                aux += key;
                len = aux.length;
                if (len == 0)
                    fld.value = '';
                if (len == 1)
                    fld.value = '0' + decSep + '0' + aux;
                if (len == 2)
                    fld.value = '0' + decSep + aux;
                if (len > 2) {
                    aux2 = '';
                    for (j = 0, i = len - 3; i >= 0; i--) {
                        if (j == 3) {
                            aux2 += milSep;
                            j = 0;
                        }
                        aux2 += aux.charAt(i);
                        j++;
                    }
                    fld.value = '';
                    len2 = aux2.length;
                    for (i = len2 - 1; i >= 0; i--)
                        fld.value += aux2.charAt(i);
                    fld.value += decSep + aux.substr(len - 2, len);
                }
                return false;
            }



            array = ["valor", "data"];


        </script>

    </head>

    <body>

        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top">
                    <form id="form1" name="form1" method="post" action="quadro_comparativo.exe.php">
                        <input type="hidden" name="IDCOMPRA" value="<?php echo $idcompra ?>" />
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
                                            <td>&nbsp;<a href="liberacao_compra.frm.php"><b>VOLTAR</b></a></td>
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
                                        <br />
                                        <tr>
                                            <td valign="top" > 
                                                Material: <select name="MATERIAL"> <?php echo $material->ListaComboMaterialPorCompra($idcompra); ?> </select>
                                                Valor: R$<input name="VALOR" type="text" value="" size="25"  onKeyPress="return(FormataReais(this, '.', ',', event))" />
                                                <br />
                                                Empresa: <select name="EMPRESACOMBO"><?php echo $quadro->ListaComboEmpresaAll() ?></select>&nbsp;&nbsp;
                                                <a onclick="document.form1.submit();" title="Adicionar"><img name="btnsalvar" id="btnsalvar" src = "../imagens/novo.gif" width = "22" /></a> &nbsp;&nbsp;
                                                <a href="quadro_comparativo_alteracao.frm.php?idcompra=<?php echo $idcompra ?>" title="Editar"><img name="btnsalvar" id="btnsalvar" src = "../imagens/bt_editar.jpg" width = "22" /></a> &nbsp;&nbsp;
                                                <a href="#" onclick="PrintElementID('printableArea');" title="Imprimir"><img name="btnsalvar" id="btnsalvar" src = "../imagens/print.png" width = "22" /></a>
                                                <div align="center" style="color: red"> Clique no nome da empresa para gerar a ordem de compra.</div>
                                                <div id="printableArea" class="imprimir">
                                                    <br />
                                                    <?php echo $quadro->ListaQuadroPesq($idcompra) ?>
                                                </div>
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

