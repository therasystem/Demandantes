<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/notafiscal.cls.php");
require_once("../modelo/fornecedor.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $nota = new clsNotaFiscal();
    $fornecedor = new clsFornecedor();
    $admin = new clsUsuario();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));

    if (isset($_GET['temItem'])) {
        $temItem = $_GET['temItem'];
    }
    if (isset($_GET['idnota'])) {
        $idnota = $_GET['idnota'];
        $nota->preencheDados($idnota);
    }
    //die($temItem);
    $idcompra = $_GET['idcompra'];
    $nomeEmp = $_GET['nomeEmp'];
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
                    <form id="form1" name="form1" method="post" action="notafiscal_visualiza.exe.php">
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
                                            <td>&nbsp;<a href="compra_visualiza_alteracao.frm.php?idcompra=<?php echo $idcompra ?>"><b>VOLTAR</b></a></td>
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
                                        <input type="hidden" name="idcompra" value="<?php echo $idcompra ?>" />
                                        <input type="hidden" name="nomeEmp" value="<?php echo $nomeEmp ?>" />
                                        <input type="hidden" name="metodo" value="0" />
                                        <tr>
                                            <td  height="36"><b><br />&nbsp;&nbsp;&nbsp;LANÇAMENTO NOTA FISCAL<br /> 
                                                    <tr>
                                                        <td valign="top">
                                                            <?php
                                                            $semForm = false;
                                                            if (isset($idnota)) {
                                                                $html = $nota->EditaMaterialNota($idnota);
                                                                //die($html); 
                                                            } else {
                                                                $html = $nota->ListaMaterialNota($idcompra, $nomeEmp, $temItem);
                                                                //die($html);
                                                                if (substr($html, 0, 1) == 1) {
                                                                    $semForm = true;
                                                                    $html[0] = "";
                                                                }
                                                            }
                                                            echo $html;
                                                            ?>
                                                        </td>
                                                    </tr>
                                            </td>
                                        </tr>
                                    </table> 
                                    <?php if ($semForm == false) { ?>
                                        <table width="700" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                            <tr style="padding-left: 33">
                                                <td> 
                                                    <!-- <tr>
                                                        <td width="30px">
                                                            </br>
                                                            Fornecedor: 
                                                            </br> 
                                                            <select name="idfornecedor">
                                                    <?php
                                                    //echo $fornecedor->ListaComboFornecedorALL($nota->getIdfornecedor());
                                                    ?>
                                                            </select>
                                                        </td>
                                                        <td> 
                                                            </br>
                                                        </td>
                                                    </tr> -->

                                                    <tr>
                                                        <td valign="top">
                                                            </br>
                                                            Nº Nota Fiscal: 
                                                            <input type="text" name="numNota" value="<?php echo $nota->getNumNotaFiscal() ?>" />
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td valign="top">
                                                            Data de Emissão: 
                                                            <input type="text" name="dataNota" value="<?php echo $nota->getDtEmissao() ?>" maxlength="10" onkeyup="mascaraData(this, event);" size="18" />
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td valign="top">
                                                            Valor da Nota 1: 
                                                            <input type="text" name="valorNota1" value=""  onKeyPress="return(FormataReais(this, '.', ',', event))" size="20" />
                                                        </td>
                                                        <td valign="top">
                                                            Vencimento 1: 
                                                            <input type="text" name="vencimentoNota1" value=""  size="22" />
                                                        </td>
                                                    </tr>

 
                                                    <tr>
                                                        <td valign="top">
                                                            Valor da Nota 2: 
                                                            <input type="text" name="valorNota2" value=""  onKeyPress="return(FormataReais(this, '.', ',', event))" size="20" />
                                                        </td>
                                                        <td valign="top">
                                                            Vencimento 2: 
                                                            <input type="text" name="vencimentoNota2" value=""  size="22" />
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td valign="top">
                                                            Valor da Nota 3: 
                                                            <input type="text" name="valorNota3" value=""  onKeyPress="return(FormataReais(this, '.', ',', event))" size="20" />
                                                        </td>
                                                        <td valign="top">
                                                            Vencimento 3: 
                                                            <input type="text" name="vencimentoNota3" value=""  size="22" />
                                                        </td>
                                                    </tr>
 
                                                    <tr>
                                                        <td valign="top">
                                                            Valor da Nota 4: 
                                                            <input type="text" name="valorNota4" value=""  onKeyPress="return(FormataReais(this, '.', ',', event))" size="20" />
                                                        </td>
                                                        <td valign="top">
                                                            Vencimento 4: 
                                                            <input type="text" name="vencimentoNota4" value=""  size="22" />
                                                        </td>
                                                    </tr>



                                                    <tr>
                                                        <td valign="top">
                                                            Valor da Nota 5: 
                                                            <input type="text" name="valorNota5" value=""  onKeyPress="return(FormataReais(this, '.', ',', event))" size="20" />
                                                        </td>
                                                        <td valign="top">
                                                            Vencimento 5: 
                                                            <input type="text" name="vencimentoNota5" value=""  size="22" />
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td valign="top">
                                                            Frete: 
                                                            <input type="text" name="freteNota" value="<?php echo $nota->getFrete() ?>" size="29" />
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td valign="top">
                                                            Referência: 
                                                            <input type="text" name="referencia" value="<?php echo $nota->getReferencia() ?>"  size="24"  />
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td valign="top"> 
                                                            <input type="submit" name="submit" value="Enviar" />
                                                        </td>
                                                    </tr>
                                                </td>
                                            </tr>
                                        </table> 
                                    <?php } ?>
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

