<?php
session_start();
require_once("../modelo/quadro_comparativo.cls.php");
require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/relatorio.cls.php");
require_once("../modelo/centro_custo_financeiro.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $centro = new clsCentroCustoFinanceiro();
    $quadro = new clsQuadroComparativo();
    $relat = new clsRelatorio();
    $admin = new clsUsuario();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));

    $html = "";

    if (isset($_POST['TIPONOTA'])) {
        
 
        $html = $relat->RelatorioFinanceiro($_POST['TIPONOTA'], $_POST['IDCENTROFINANC'], $_POST['EMPRESACOMBO'], $_POST['dtLancaIni'], $_POST['dtLancaFim'], $_POST['dtPagIni'], $_POST['dtPagFim'], $_POST['numero'], $_POST['ENVIO']);
        //$html .= $relat->RelatorioFinanceiroObra($_POST['TIPONOTA'], $_POST['IDCENTROFINANC'], $_POST['EMPRESACOMBO'], $_POST['dtLancaIni'], $_POST['dtLancaFim'], $_POST['dtPagIni'], $_POST['dtPagFim'], $_POST['numero']);
    }
    if ($html == "") {
        $volta = "admin.frm.php";
    } else {
        $volta = "relatorio_escolha_financeiro.frm.php";
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
                    <form id="form1" name="form1" method="post" action="relatorio_escolha_financeiro.frm.php">  
                        <table width="1000px" border="0" align="center" cellpadding="0" cellspacing="1">
                            <tr>
                                <td>
                                    <?php
                                    if (isset($_POST['TIPONOTA'])) {
                                        if ($_SESSION['empresa'] == 0) {
                                            ?>
                                            <img alt="" src="../imagens/solobaseLogo.jpg" width="100%"/></td>
                                        <?php
                                    } else {
                                        ?>
                                        <img alt="" src="../imagens/acropoleLogo.jpg" width="100%"/></td>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <img alt="" src="../imagens/banner.jpg" width="100%"/></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php if (!isset($_POST['TIPONOTA'])) { ?>
                                <tr>
                                    <td width="100%" bgcolor="#EEFFDD">
                                        <table cellpadding="0" cellspacing="0" class="style4">
                                            <tr>
                                                <td width="100%" class="style7 style23">&nbsp;&nbsp; Seja Bem Vindo <?php echo $admin->GetNome(); ?>!&nbsp;</td>
                                                <td><img src="../imagens/back.png" alt="Voltar" /></td>
                                                <td>&nbsp;<a href="<?php echo $volta ?>"><b>VOLTAR</b></a></td>
                                                <td>&nbsp;&nbsp;&nbsp;</td>
                                                <td class="style6"><img src="../imagens/bt_logout.jpg" alt="Sair" /></td>
                                                <td>&nbsp;&nbsp;&nbsp;<b><a href="../<?php echo $config->GetPaginaPrincipal() ?>"><b>SAIR</b></a></b></td>
                                                <td>&nbsp;&nbsp;&nbsp;</td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>
                                    <!-- TABELA GRID-->
                                    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td  height="36"><b><br />RELATÓRIO FINANCEIRO ESCRITÓRIO<br /> 
                                                    </tr>
                                                    <tr> 

                                                        <?php if (!$_POST) { ?>
                                                            <tr>
                                                                <td  align="right" class="small"><br/>
                                                                    Para envio? 
                                                                </td>
                                                                <td>
                                                                    <br/>
                                                                    <input name="ENVIO" type="radio" value="1"  /> Sim
                                                                    <input name="ENVIO" type="radio" value="-1" checked="checked"  /> Não
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td  align="right" class="small"><br/>
                                                                    Tipo Nota Fiscal: <span style="color: red">*</span>
                                                                </td>
                                                                <td>
                                                                    <br/>
                                                                    <input name="TIPONOTA" type="radio" value="0" checked="checked" />Movimento de Caixa
                                                                    <input name="TIPONOTA" type="radio" value="1" />Guia de Encaminhamento 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="30px" align="right" class="small">Centro de Custo:</td>
                                                                <td>
                                                                    <select name="IDCENTROFINANC">
                                                                        <option value="0" selected="">---------  SELECIONE  ---------</option>
                                                                        <?php echo $centro->ListaComboCentroCustoALL(); ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="30px" align="right" class="small">Fornecedor: </td>
                                                                <td>
                                                                    <select name="EMPRESACOMBO">
                                                                        <?php echo $quadro->ListaComboEmpresaAll() ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="30px" align="right" class="small">Data Lançamento: </td>
                                                                <td>
                                                                    <input name="dtLancaIni" type="text" value=""  maxlength="10" onkeyup="mascaraData(this, event);" size="10" />
                                                                    à
                                                                    <input name="dtLancaFim" type="text" value=""  maxlength="10" onkeyup="mascaraData(this, event);" size="10" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="30px" align="right" class="small">Data Pagamento: </td>
                                                                <td>
                                                                    <input name="dtPagIni" type="text" value=""  maxlength="10" onkeyup="mascaraData(this, event);" size="10" />
                                                                    à
                                                                    <input name="dtPagFim" type="text" value=""  maxlength="10" onkeyup="mascaraData(this, event);" size="10" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="30px" align="right" class="small">Número Lançamento: </td>
                                                                <td>
                                                                    <input name="numero" type="text" value="" size="10" /> 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10px" align="right" class="small"></td> 
                                                                <td> 
                                                                    <input name="Acessar" type="submit" value="Gerar" />  
                                                                    <br/><br/>
                                                                </td>
                                                            </tr> 
                                                            <?php
                                                        } else {
                                                            echo $html;
                                                        }
                                                        ?>
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

