<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/fornecedor.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $fornecedor = new clsFornecedor();
    $admin = new clsUsuario();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));

    if ($_GET) {
        $metodo = $_GET['metodo'];
    } else {
        $metodo = null;
    }

    if ($metodo == 1) {
        // EDITAR Exibir dados
        $cod = $_GET['idfornecedor'];
        $fornecedor->preencheDados($cod);
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

        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top"> 
                    <form id="form1" name="form1" method="post" action="fornecedor.exe.php"> 
                        <input type="hidden" name="metodo" id="metodo" value="<?php echo $metodo ?>"/>
                        <input type="hidden" name="codigo" id="codigo" value="<?php echo $fornecedor->getCodigo() ?>"/>
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
                                            <td>&nbsp;<a href="fornecedor.frm.php"><b>VOLTAR</b></a></td>
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
                                            <td  height="36"><b><br />&nbsp;&nbsp;&nbsp;CADASTRO DE FORNECEDOR<br /> 
                                                    </tr>
                                                    <tr> 
                                                        <tr>
                                                            <td  align="right" class="small">Fornecedor:</td>
                                                            <td><input class="campo_texto" name="NOME" type="text" value='<?php echo $fornecedor->getNome() ?>' size="40" maxlength="150"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">CNPJ:</td>
                                                            <td><input class="campo_texto" name="CNPJ" type="text" value='<?php echo $fornecedor->getCnpj() ?>' size="40" maxlength="20"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Endereço:</td>
                                                            <td><input class="campo_texto" name="END" type="text" value='<?php echo $fornecedor->getEndereco() ?>' size="40" maxlength="150"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Telefone Principal:</td>
                                                            <td><input class="campo_texto" name="TEL1" type="text" value='<?php echo $fornecedor->getTelefone1() ?>' size="40" maxlength="50"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Telefone Secundário:</td>
                                                            <td><input class="campo_texto" name="TEL2" type="text" value='<?php echo $fornecedor->getTelefone2() ?>' size="40" maxlength="50"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">E-mail:</td>
                                                            <td><input class="campo_texto" name="EMAIL" type="text" value='<?php echo $fornecedor->getEmail() ?>' size="40" maxlength="100"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  align="right" class="small">Contato:</td>
                                                            <td><input class="campo_texto" name="CONTATO" type="text" value='<?php echo $fornecedor->getContato() ?>' size="40" maxlength="50"></td>
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

