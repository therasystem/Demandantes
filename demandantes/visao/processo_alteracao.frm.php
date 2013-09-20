<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/obra.cls.php");
require_once("../modelo/processo.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $processo = new clsProcesso();
    $admin = new clsUsuario();
    $obra = new clsObra();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));

    if ($_GET) {
        $metodo = $_GET['metodo'];
    } else {
        $metodo = null;
    }

    if ($metodo == 1) {
        // EDITAR Exibir dados
        $cod = $_GET['idproc'];
        $processo->preencheDados($cod);
    }
} else {
    $config->Logout(false);
    $config->ConfirmaOperacao($config->GetPaginaPrincipal(), "Voc\xEA n\xE3o tem permiss\xE3o para acessar essa p\xE1gina!");
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Sistema Gerenciador de Processos</title>
        <link rel="shortcut icon" href="../imagens/_favicon.ico" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="estilo/estilo.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top"> 
                    <form id="form1" name="form1" method="post" action="processo.exe.php"> 
                        <input type="hidden" name="metodo" id="metodo" value="<?php echo $metodo ?>"/>
                        <input type="hidden" name="codigo" id="codigo" value="<?php echo $processo->getCodigo() ?>"/>
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
                                            <td>&nbsp;<a href="processo.frm.php"><b>VOLTAR</b></a></td>
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
                                            <td  height="36"><b><br />&nbsp;&nbsp;&nbsp;CADASTRO DE PROCESSOS<br /> 
                                                    </tr>
                                                    <tr>
                                                        <tr>
                                                            <td align="right" class="small">Processo pai: </td>
                                                            <td>
                                                                <select name="PROCRELAT">
                                                                    <?php echo $processo->ListaComboProcessoALLPesc($processo->getIdprocessorelat()); ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <!--<tr>
                                                            <td align="right" class="small">Obra: </td>
                                                            <td>
                                                                <select name="IDOBRA">
                                                                    <?php //echo $obra->ListaComboObraALLPesc($processo->getIdobra()); ?>
                                                                </select>
                                                            </td>
                                                        </tr>-->
                                                        <tr>
                                                            <td  align="right" class="small">Nome:</td>
                                                            <td><input class="campo_texto" name="NOMEPROC" type="text" value='<?php echo $processo->getNomeproc() ?>' size="40" maxlength="100"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Descri&ccedil;&atilde;o:</td>
                                                            <td>
                                                                <textarea name="DESCPROC" cols="50" rows="2"><?php echo $processo->getDescproc() ?></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right" class="small">Documenta&ccedil;&atilde;o: </td>
                                                            <td>
                                                                <textarea name="DOCPROC" cols="50" rows="2"><?php echo $processo->getDocproc() ?></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right" class="small">Local: </td>
                                                            <td><input  class="campo_texto" name="LOCPROC" id="DESC" type="text" value='<?php echo $processo->getLocalproc() ?>' size="40"  maxlength="300">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right" class="small">Contato: </td>
                                                            <td><input  class="campo_texto" name="CONPROC" id="DATA" type="text" value='<?php echo $processo->getContatoproc() ?>' size="40"  maxlength="200" >
                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td  align="right" class="small">Valor:</td>
                                                            <td><input class="campo_texto" name="VALPROC" type="text" value='<?php echo $processo->getValorproc() ?>' size="20" maxlength="200"></td>  
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Tempo:</td>
                                                            <td><input class="campo_texto" name="TEMPPROC" type="text" value='<?php echo $processo->getTempoproc() ?>' size="20" maxlength="150"></td>  
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Ordenação:</td>
                                                            <td><input class="campo_texto" name="ORDEMPROC" type="text" value='<?php echo $processo->getOrdemproc() ?>' size="10" maxlength="10"></td>  
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

