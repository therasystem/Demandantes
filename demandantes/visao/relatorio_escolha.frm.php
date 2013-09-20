<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/relatorio.cls.php");
require_once("../modelo/material.cls.php");
require_once("../modelo/obra.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $relatorioClass = new clsRelatorio();
    $obra = new clsObra();
    $material = new clsMaterial();
    $admin = new clsUsuario();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));


    $html = "";
    $relatorio = "";
    $voltar = "admin.frm.php";

    if (isset($_POST['RELAT'])) {

        $voltar = "relatorio_escolha.frm.php";
        if ($_POST['RELAT'] == 1) {
            $html = $relatorioClass->RelatorioObra($_POST['dataIni'], $_POST['dataFim'], $_POST['relatobra']);
            $relatorio = "Movimentação do Almoxarifado";
        } else if ($_POST['RELAT'] == 2) {
            $html = $relatorioClass->RelatorioNotaFiscal($_POST['dataIni'], $_POST['dataFim'], $_POST['notaFiscal'], $_POST['fornecedor'], 2);
            $relatorio = "Notas Fiscais Emissão";
        } else if ($_POST['RELAT'] == 3) {
            $html = $relatorioClass->RelatorioNotaFiscal($_POST['dataIni'], $_POST['dataFim'], $_POST['notaFiscal'], $_POST['fornecedor'], 3);
            $relatorio = "Notas Fiscais Lançamento";
        } else if ($_POST['RELAT'] == 4) {
            $html = $relatorioClass->RelatorioNotaFiscal($_POST['dataIni'], $_POST['dataFim'], $_POST['notaFiscal'], $_POST['fornecedor'], 4);
            $relatorio = "Notas Fiscais Vencimento";
        } else if ($_POST['RELAT'] == 5) {

            //die($_POST['relatobra2']);
            if ($_POST['relatcentrocusto'] == 0) {
                unset($_POST['RELAT']);
            } else {
                //die($_POST['relatobra2']);
                //////////////// FAZER RELATORIO AGORA ////////////////
                $html = $relatorioClass->RelatorioCentroCusto($_POST['relatobra2'], $_POST['relatcentrocusto']);
            }
            $relatorio = "Retiradas por Centro de Custo";
        } else if ($_POST['RELAT'] == 6) {
            $html = $relatorioClass->RelatorioProtocoloNotaFiscal($_POST['dataIni'], $_POST['dataFim'], $_POST['notaFiscal'], $_POST['fornecedor']);
            $relatorio = "Protocolo de Notas Fiscais";
        } else if ($_POST['RELAT'] == 7) {
            $html = $relatorioClass->RelatorioProtocoloFornecedorMaterial($_POST['IDMATERIAL']);
            $relatorio = "Fornecedores de Material";
            
        } else {
            unset($_POST['RELAT']);
            ?>
            <script> alert('Selecione um relatório!');</script>
            <?php
        }
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
        <script type="text/javascript" src="js/prototype.js"></script> 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/ajax/seleciona_concurso.ajax.js" ></script>
        <link rel="shortcut icon" href="../imagens/_favicon.ico" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="estilo/estilo.css" rel="stylesheet" type="text/css" />

        <script>
            $(document).ready(function() {
                $("#idrelatorioobra").hide();
                $("#idrelatorioobra2").hide();
                $("#idrelatorioperiodo").hide();
                $("#idrelatoriotexto").hide();
                $("#idrelatoriofornecedormaterial").hide();
                $("#selectNew").hide();

            });
        </script>

        <script>
            function mostrarDiv(index)
            {
                var i = index.options[index.selectedIndex].value;

                if (i == 0)
                {
                    $("#idrelatorioobra").hide();
                    $("#idrelatorioobra2").hide();
                    $("#idrelatorioperiodo").hide();
                    $("#idrelatoriotexto").hide();
                    $("#selectNew").hide();
                }
                else if (i == 1)
                {
                    $("#idrelatorioperiodo").show();
                    $("#idrelatorioobra").show();
                    $("#idrelatorioobra2").hide();
                    $("#idrelatoriotexto").hide();
                    $("#selectNew").hide();
                }
                else if (i == 2 || i == 3 || i == 4 || i == 6)
                {
                    $("#idrelatorioobra").hide();
                    $("#idrelatorioobra2").hide();
                    $("#selectNew").hide();
                    $("#idrelatorioperiodo").show();
                    $("#idrelatoriotexto").show();
                } else if (i == 5)
                {
                    $("#idrelatorioperiodo").hide();
                    $("#idrelatorioobra").hide();
                    $("#idrelatorioobra2").show();
                    $("#selectNew").show();
                    $("#idrelatoriotexto").hide();
                }  else if (i == 7)
                {
                    $("#idrelatorioperiodo").hide();
                    $("#idrelatorioobra").hide();
                    $("#idrelatoriofornecedormaterial").show();
                    $("#selectNew").hide();
                    $("#idrelatoriotexto").hide();
                }
            }
        </script>

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
                    <form id="form1" name="form1" method="post" action="relatorio_escolha.frm.php"> 
                        <table width="1000px" border="0" align="center" cellpadding="0" cellspacing="1">
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
                                            <td>&nbsp;<a href="<?php echo $voltar ?>"><b>VOLTAR</b></a></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td class="style6"><img src="../imagens/bt_logout.jpg" alt="Sair" /></td>
                                            <td>&nbsp;&nbsp;&nbsp;<b><a href="../<?php echo $config->GetPaginaPrincipal() ?>"><b>SAIR</b></a></b></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <!-- TABELA GRID-->
                                    <?php if (!isset($_POST['RELAT'])) { ?>
                                        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" height="36">
                                                    <b><br />&nbsp;&nbsp;&nbsp;RELATÓRIOS<br /> 
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td height="30px" align="center" class="small">
                                                    </br>
                                                    Escolha o Relatório:
                                                    <select name="RELAT" onchange="mostrarDiv(this)">
                                                        <?php if ($_POST['relatobra2'] > 0) { ?>
                                                            <option value="5">Retiradas por Centro de Custo</option>
                                                        <?php } else { ?>
                                                            <option value="0">------ SELECIONE ------</option>
                                                        <?php } ?>
                                                        <option value="1">Movimentação do Almoxarifado</option>
                                                        <option value="2">Notas Fiscais por Emissão</option>
                                                        <option value="3">Notas Fiscais por Lançamento</option>
                                                        <option value="4">Notas Fiscais por Vencimento</option>
                                                        <option value="5">Retiradas por Centro de Custo</option>
                                                        <option value="6">Protocolo de Notas Fiscais</option>
                                                        <option value="7">Fornecedores de Material</option>
                                                    </select>
                                                </td>

                                                <tr>
                                                    <td height="30px" align="center" class="small">
                                                        </br>
                                                        <div id="idrelatorioobra"> Obra:
                                                            <select name="relatobra" id="relatobra">
                                                                <?php echo $obra->ListaComboObraALLPesc() ?>
                                                            </select>
                                                        </div>

                                                        <?php if (isset($_POST['relatobra2'])) { ?>
                                                            Obra:
                                                            <select name="relatobra2" id="relatobra2" onchange="this.form.submit()">
                                                                <?php echo $obra->ListaComboObraALLPesc($_POST['relatobra2']) ?>
                                                            </select>

                                                        <?php } else { ?>
                                                            <div id="idrelatorioobra2"> Obra:
                                                                <select name="relatobra2" id="relatobra2" onchange="this.form.submit()">
                                                                    <?php echo $obra->ListaComboObraALLPesc($_POST['relatobra2']) ?>
                                                                </select>
                                                            </div>
                                                        <?php } ?>


                                                        <?php if (isset($_POST['relatobra2'])) { ?>
                                                            </br>
                                                            Centro de Custo:
                                                            <select name="relatcentrocusto" id="relatcentrocusto">
                                                                <?php echo $obra->ListaComboCentroALLPesc($_POST['relatobra2']) ?>
                                                            </select>

                                                        <?php } else { ?>
                                                            <div id="selectNew"> Centro de Custo:
                                                                <select name="relatcentrocusto" id="relatcentrocusto">
                                                                    <option value="0" selected>Selecione a Obra</option>
                                                                </select>
                                                            </div>
                                                        <?php } ?>


                                                        <div id="idrelatorioperiodo">
                                                            Intervalo de Data: 
                                                            <input name="dataIni" type="text" value="" size="10" maxlength="10" onkeyup="mascaraData(this, event);"></input> 
                                                            às 
                                                            <input name="dataFim" type="text" value="" size="10" maxlength="10" onkeyup="mascaraData(this, event);"></input>
                                                        </div>
                                                        <div id="idrelatoriofornecedormaterial"> 
                                                                <select name="IDMATERIAL">
                                                                    <?php echo $material->ListaComboMaterialALL(); ?>
                                                                </select> 
                                                        </div>

                                                        <div id="idrelatoriotexto">
                                                            Nota Fiscal: 
                                                            <input name="notaFiscal" type="text" value="" size="20"></input> 
                                                            </br>Fornecedor:
                                                            <input name="fornecedor" type="text" value="" size="20"></input>
                                                        </div>

                                                        <tr>
                                                            <td height="50px" align="center">
                                                                <input name="gerar" type="submit" value="Gerar" />
                                                            </td>
                                                        </tr>

                                                    </td>
                                                </tr>

                                            </tr>    
                                        </table> 
                                    <?php } else { ?>
                                        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td height="36" align="left">
                                                    <b><br />RELATÓRIO - <?php echo $relatorio ?><br /> 
                                                        </tr>
                                                        <tr align="center">
                                                            <td valign="top" align="center">
                                                                </br>
                                                                <?php echo $html ?>
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

