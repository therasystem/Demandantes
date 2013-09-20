<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/compra.cls.php"); 
require_once("../modelo/ordem_compra.cls.php");

$config = new clsConfig();



if ((isset($_SESSION['codigo']))) {

    if ($_GET) {
        $idcompra = $_GET['idcompra'];
        $nome = $_GET['nomecompara'];
        $metodo = $_GET['metodo'];
        $_SESSION['html'] = "";
 
        $compra = new clsCompra(); 
    }

    $admin = new clsUsuario();
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

            function fone() {
                if (document.form1.FAX.value.length == 0) {
                    document.form1.FAX.value = "(" + document.form1.FAX.value;
                }
                if (document.form1.FAX.value.length == 3) {
                    document.form1.FAX.value = document.form1.FAX.value + ")";
                }
                if (document.form1.FAX.value.length == 8) {
                    document.form1.FAX.value = document.form1.FAX.value + "-";
                }
            }

            function fone1() {
                if (document.form1.CEL.value.length == 0) {
                    document.form1.CEL.value = "(" + document.form1.CEL.value;
                }
                if (document.form1.CEL.value.length == 3) {
                    document.form1.CEL.value = document.form1.CEL.value + ")";
                }
                if (document.form1.CEL.value.length == 8) {
                    document.form1.CEL.value = document.form1.CEL.value + "-";
                }
            }


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
                    <form id="form1" name="form1" method="post" action="ordem_compra.exe.php">
                        <input type="hidden" name="IDCOMPRA" value="<?php echo $idcompra ?>" />
                        <input type="hidden" name="NOME" value="<?php echo $nome ?>" />
                        <input type="hidden" name="METODO" value="<?php echo $metodo ?>" />
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
                                            <td>&nbsp;<a href="quadro_comparativo.frm.php?idcompra=<?php echo $idcompra ?>"><b>VOLTAR</b></a></td>
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
                                            <td>

                                            </td>
                                            <td>  
                                                <b>&nbsp;&nbsp;&nbsp;GERAR ORDEM DE COMPRA<br /> 
                                            </td>  
                                        </tr>
                                        <br/>

                                        <tr>
                                            <td valign="top" align="right" width="40px"> 
                                                Contato:
                                            </td>
                                            <td valign="top" > 
                                                <input name="CONTATO" type="text" value="<?php echo clsOrdemCompra::getContato() ?>" size="30" maxlength="60"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" align="right" width="40px"> 
                                                Fax:
                                            </td>
                                            <td valign="top" > 
                                                <input name="FAX" id="FAX" type="text" value="<?php echo clsOrdemCompra::getFax() ?>" size="30" onKeyPress="fone();" maxlength="13"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" align="right" width="40px"> 
                                                Celular:
                                            </td>
                                            <td valign="top" > 
                                                <input name="CEL" id="CEL" type="text" value="<?php echo clsOrdemCompra::getCel() ?>" size="30"  onKeyPress="fone1();" maxlength="13"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" align="right" width="40px"> 
                                                Data Entrega:
                                            </td>
                                            <td valign="top" > 
                                                <input name="ENTREGA" type="text" value="<?php echo clsOrdemCompra::getEntrega() ?>" size="30" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" align="right" width="40px"> 
                                                Cond. Pagamento:
                                            </td>
                                            <td valign="top" > 
                                                <input name="PAGAMENTO" type="text" value="<?php echo clsOrdemCompra::getPagamento() ?>" size="30"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" align="right" width="40px"> 
                                                Frete:
                                            </td>
                                            <td valign="top" > 
                                                <input name="FRETE" type="text" value="<?php echo clsOrdemCompra::getFrete() ?>" size="30"/> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" align="right" width="40px"> 
                                                Desconto:
                                            </td>
                                            <td valign="top" > 
                                                <input name="DESCONTO" type="text" value="<?php echo clsOrdemCompra::getDesconto() ?>" size="30"/>
                                            </td>
                                        </tr>
                                        <tr><td></td>
                                            <td valign="top" width="40px"> 
                                                <a onclick="document.form1.submit();" title="Gerar"><img name="btnsalvar" id="btnsalvar" src = "../imagens/gerar.png" width = "84" height="37" /></a> &nbsp;&nbsp;
                                                <!-- <a href="#" onclick="PrintElementID('printableArea');" title="Imprimir"><img name="btnsalvar" id="btnsalvar" src = "../imagens/print.png" width = "22" /></a> -->

                                                <div id="printableArea" class="imprimir">
                                                    <br />
                                                    <?php
                                                    if ($metodo != 3) {
                                                        //die('aa'.$_SESSION['html']);
                                                        echo $_SESSION['html'];
                                                    }
                                                    ?>
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

