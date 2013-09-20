<?php
session_start();

require_once("../modelo/usuario.cls.php");
require_once("../config.cls.php");
$config = new clsConfig();
unset($_SESSION['tiponota']);
unset($_SESSION['centroCusto']);

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
        <title>Sistema Gerenciador de Compras</title>
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
                            <td  width="25%"><a href="admin_processo.frm.php">Gerenciador de Processos</a></td>
                            <?php }else{ ?>
                            <td  width="25%"></td>
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
                            <td onclick="location.href = 'usuario.frm.php'" onmouseover="CarregaToolTip('bt_usuario')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/bt_usuario.png" alt="Usuario" /><br />
                                Usu&aacute;rios
                            </td>

                            <td onclick="location.href = 'obra.frm.php'" onmouseover="CarregaToolTip('bt_obra')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/obra.png" alt="Obra" /><br />
                                Obras
                            </td>

                            <td onclick="location.href = 'material.frm.php'" onmouseover="CarregaToolTip('bt_material')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/material.png" alt="Material" /><br />
                                Material
                            </td>

                            <td onclick="location.href = 'cargo.frm.php'" onmouseover="CarregaToolTip('bt_cargos')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/bt_cargos.png" alt="Cargos" /><br />
                                Cargos
                            </td>

                            <td onclick="location.href = 'fornecedor.frm.php'" onmouseover="CarregaToolTip('bt_fornecedor')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/ico_fornecedor.jpg" alt="Fornecedor" /><br />
                                Fornecedor
                            </td>
                        </tr>
                    </table>
                    <table class="style8">
                        <tr>
                            <td onclick="location.href = 'compra.frm.php'" onmouseover="CarregaToolTip('bt_relatorios')" onmouseout="CarregaToolTip('')">
                                <img alt="" src="../imagens/bt_relatorios.png" alt="Solicitação de Compra" /><br />
                                Solicita&ccedil;&atilde;o de Compra
                            </td>

                            <td onclick="location.href = 'liberacao_compra.frm.php'" onmouseover="CarregaToolTip('bt_liberacao_compra')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/bt_liberacao_compra.png" alt="Liberação Compra" /><br />
                                Liberação da Compra
                            </td>

                            <td onclick="location.href = 'compra_visualiza.frm.php'" onmouseover="CarregaToolTip('bt_visualiza_compra')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/bt_relatorios_visu.png" alt="Visualização da Compra" /><br />
                                Visualizar Compra
                            </td>

                            <td onclick="location.href = 'add_estoque.frm.php'" onmouseover="CarregaToolTip('bt_estoque')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/bt_estoque.png" alt="Adicionar ao Estoque" /><br />
                                Adicionar ao Estoque
                            </td>

                            <td onclick="location.href = 'centro_custo.frm.php'" onmouseover="CarregaToolTip('bt_estoque_out')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/bt_estoque_out.jpg" alt="Baixas Estoque" /><br />
                                Baixas no Estoque
                            </td>
                            <td onclick="location.href = 'relatorio_escolha.frm.php'" onmouseover="CarregaToolTip('bt_relatorio')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/bt_relat.png" alt="Relatórios" /><br />
                                Relatórios
                            </td>

                            <!--<td onclick="location.href = 'busca_candidato.frm.php'" onmouseover="CarregaToolTip('bt_candidato')" onmouseout="CarregaToolTip('')">
                                <img src="../imagens/bt_usuario.png" alt="Candidato" /><br />
                                Teste
                            </td>-->
                        </tr>
                    </table>
                    <?php if ($_SESSION['cargo'] == 1 || $_SESSION['cargo'] == 2 || $_SESSION['cargo'] == 5) { ?>
                    <table class="style8">
                        <tr>
                                <td onclick="location.href = 'centro_custo_financeiro.frm.php'" onmouseover="CarregaToolTip('bt_centro_custo')" onmouseout="CarregaToolTip('')">
                                    <img alt="" src="../imagens/bt_cc.jpg" alt="Centro De Custos" /><br />
                                    Centro de Custos
                                </td>
                            
                                <td onclick="location.href = 'acessar_centro_custo.frm.php'" onmouseover="CarregaToolTip('bt_lancamento_notas')" onmouseout="CarregaToolTip('')">
                                    <img alt="" src="../imagens/bt_nota.jpg" alt="Lançamento de Notas" /><br />
                                    Lançamento de Notas
                                </td>

                                <td onclick="location.href = 'relatorio_escolha_financeiro.frm.php'" onmouseover="CarregaToolTip('bt_relatorio_financeiro')" onmouseout="CarregaToolTip('')">
                                    <img src="../imagens/bt_relatorio.png" alt="Relatórios Financeiros" /><br />
                                    Relatórios Financeiros
                                </td>
                            
                                <td onclick="location.href = 'envio_extrato.frm.php'" onmouseover="CarregaToolTip('bt_envio_extrato')" onmouseout="CarregaToolTip('')">
                                    <img alt="" src="../imagens/bt_envioArquivo.png" alt="Enviar Extrato" /><br />
                                    Enviar Extrato
                                </td>
                            
                                <td onclick="location.href = 'analise_extrato.frm.php'" onmouseover="CarregaToolTip('bt_analise_extrato')" onmouseout="CarregaToolTip('')">
                                    <img src="../imagens/bt_analise.png" alt="Análise de Extrato" /><br />
                                    Análise de Extrato
                                </td>
                            </tr>
                        </table>
                    <?php } ?>
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