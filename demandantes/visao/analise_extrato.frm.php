<?php
session_start();
require_once("../config.cls.php");
require_once("../modelo/centro_custo_financeiro.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/relatorio.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $relat = new clsRelatorio();
    $admin = new clsUsuario();
    $centro = new clsCentroCustoFinanceiro();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));

    $html = "";

    if (!isset($_POST['docHid'])) {
        if (isset($_POST['mes'])) {

            $html = $relat->RelatorioAnaliseExtrato($_POST['mes'], $_POST['ano'], $_POST['documento'], $_POST['IDCENTROFINANC']);
            //$html .= $relat->RelatorioFinanceiroObra($_POST['TIPONOTA'], $_POST['IDCENTROFINANC'], $_POST['EMPRESACOMBO'], $_POST['dtLancaIni'], $_POST['dtLancaFim'], $_POST['dtPagIni'], $_POST['dtPagFim'], $_POST['numero']);
        }
    } else {
        if (!isset($_POST['confirma'])) {
            $_POST['confirma'] = 0;
        }
        $relat->atualizaExtrato($_POST['confirma'], $_POST['docHid'], $_POST['mes'], $_POST['ano'], $_POST['IDCENTROFINANC']);
        $html = $relat->RelatorioAnaliseExtrato($_POST['mes'], $_POST['ano'], $_POST['docHid'], $_POST['IDCENTROFINANC']);
    }

    if ($html == "") {
        $volta = "admin.frm.php";
    } else {
        $volta = "analise_extrato.frm.php";
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

    <body style="font-family: arial">

        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top"> 
                    <form id="form1" name="form1" method="post" action="analise_extrato.frm.php">  
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
                            <tr>
                                <td>
                                    <!-- TABELA GRID-->
                                    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td  height="36"><b><br />RELATÓRIO ANÁLISE DE EXTRATO<br /> 
                                                    </tr>
                                                    <tr>  
                                                        <?php if (!$_POST) { ?> 
                                                            <tr>
                                                                <td align="center" class="small" ><br/>
                                                                    Documento: <span style="color: red">*</span>
                                                                    <input type="radio" name="documento" value="0" checked>Caixa</input>
                                                                    <input type="radio" name="documento" value="1">Extrato</input> 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="small"><br/>
                                                                    Centro de Custo: <span style="color: red">*</span>
                                                                    <select name="IDCENTROFINANC">
                                                                        <option value="0">Escritório Completo</option>
                                                                        <?php echo $centro->ListaComboCentroCustoALL(); ?>
                                                                    </select>
                                                                </td> 
                                                            </tr> 
                                                            <tr>
                                                                <td align="center" class="small"><br/>
                                                                    Mês para Análise: <span style="color: red">*</span>

                                                                    <select name="mes">
                                                                        <option selected value="-1">----  SELECIONE O MÊS DESEJADO  ----</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="small"><br/>
                                                                    Ano para Análise: <span style="color: red">*</span>

                                                                    <select name="ano">
                                                                        <option selected value="-1">----  SELECIONE O ANO DESEJADO  ----</option>
                                                                        <option value="2012">2012</option>
                                                                        <option value="2013">2013</option>
                                                                        <option value="2014">2014</option>
                                                                        <option value="2015">2015</option>
                                                                        <option value="2016">2016</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10px" align="center" class="small">
                                                                    <br/><br/>
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

