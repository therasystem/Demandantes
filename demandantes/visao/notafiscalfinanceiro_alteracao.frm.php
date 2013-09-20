<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/fornecedor.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/notafiscalfinanceiro.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $centro = new clsNotaFiscalFinanceiro();
    $admin = new clsUsuario();
    $fornec = new clsFornecedor();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));

    if ($_GET) {
        $metodo = $_GET['metodo'];
    } else {
        $metodo = null;
    }


    if ($metodo == 1) {
        // EDITAR Exibir dados
        $cod = $_GET['idnota'];
        $centro->preencheDados($cod);
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


        <script type="text/javascript" >


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

    <body style="font-family: arial">

        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top"> 
                    <form id="form1" name="form1" method="post" action="notafiscalfinanceiro.exe.php"> 
                        <input type="hidden" name="metodo" id="metodo" value="<?php echo $metodo ?>"/>
                        <input type="hidden" name="codigo" id="codigo" value="<?php echo $centro->getCodigo() ?>"/>
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
                                            <td>&nbsp;<a href="notafiscalfinanceiro.frm.php"><b>VOLTAR</b></a></td>
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
                                            <td  height="36"><b><br />&nbsp;&nbsp;&nbsp;CADASTRO DE NOTA FISCAL<br /> 
                                                    </tr>
                                                    <tr>  
                                                        <tr>
                                                            <td  align="right" class="small">Fornecedor:</td>
                                                            <td>
                                                                <select name="IDFORNECEDOR">
                                                                    <?php echo $fornec->ListaComboFornecedorALL($centro->getIdfornecedor()) ?> 
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Nota Fiscal:</td>
                                                            <td><input class="campo_texto" name="NUMNOTA" type="text" value='<?php echo $centro->getNumNotaFiscal() ?>' size="40" maxlength="100"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Valor:</td>
                                                            <td><input class="campo_texto" name="VALORNOTA" type="text" value='<?php echo $centro->getValorNota() ?>' size="40" maxlength="100" onKeyPress="return(FormataReais(this, '.', ',', event))"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Data do Pagamento:</td>
                                                            <td><input class="campo_texto" name="DTPAGAMENTO" type="text" value='<?php echo $centro->getPagamento() ?>' size="40" maxlength="100"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Data Referência:</td>
                                                            <td><input class="campo_texto" name="DTREFERENCIA" type="text" value='<?php echo $centro->getDtReferencia() ?>' size="40" maxlength="100"></td>
                                                        </tr>
                                                        <tr> 
                                                            <?php
                                                            if ($_SESSION['tiponota'] == 0) {
                                                                if ($_SESSION['centroCusto'] == 4) {
                                                                    ?>
                                                                    <td  align="right" class="small">Obra:</td>
                                                                    <?php
                                                                } else if ($_SESSION['centroCusto'] == 1 || $_SESSION['centroCusto'] == 2 || $_SESSION['centroCusto'] == 3 || $_SESSION['centroCusto'] == 17) {
                                                                    ?>
                                                                    <td  align="right" class="small">Tipo:</td>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <td  align="right" class="small">Data Vencimento:</td>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <td  align="right" class="small">Data Vencimento:</td>
                                                                <?php
                                                            }
                                                            ?> 
                                                            <td><input class="campo_texto" name="DTVENCIMENTO" type="text" value='<?php echo $centro->getVencimento() ?>' size="40" maxlength="100"></td>
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

