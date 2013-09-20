<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/processo.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $proc = new clsProcesso();
//die(print_r($_POST));
    if ($_POST) {
        $proc->updateSituacao($_POST['idandproc'], $_POST['sitproc']);
    }

    $html = $proc->MontagemOrganograma($_GET['idiniproc']);
    $tbl = $proc->RetornaMontagemOrganograma($_GET['idiniproc']);
    $admin = new clsUsuario();
    $admin->SelecionaPorCodigo(trim($_SESSION['codigo']));
} else {
    $config->Logout(false);
    $config->ConfirmaOperacao($config->GetPaginaPrincipal(), "Voc\xEA n\xE3o tem permiss\xE3o para acessar essa p\xE1gina!");
}
?>

<!doctype html>

<html lang="pt">
    <head>
        <link rel="shortcut icon" href="../imagens/_favicon.ico" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema Gerenciador de Processos</title>
        <link rel="stylesheet" type="text/css" media="screen, print" href="/css/slickmap/slickmap.css" />
        <link href="estilo/slickmap.css" rel="stylesheet" type="text/css" />
        <!--[if lte IE 7]> <link rel="stylesheet" type="text/css" media="screen,print" href="/css/slickmap/slickmap-ie.css" /> <![endif]-->
        <!--[if lte IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-1180261-2']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>

        <?php
        foreach ($tbl as $chave => $linha) {
            ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#myModal<?php echo $linha['IDPROCESSO'] ?>').hide();
                    $(".btn<?php echo $linha['IDPROCESSO'] ?>").click(function() {

                        $('#myModal<?php echo $linha['IDPROCESSO'] ?>').modal('show');
                    });
                });
            </script> 
            <?php
        }
        ?>
    </head>

    <body>

        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="top">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
                        <tr>
                            <td>
                                <img alt="" src="../imagens/banner.jpg" width="100%" height="150px"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="100%" bgcolor="#EEFFDD">
                                <table cellpadding="0" cellspacing="0" class="style4">
                                    <tr>
                                        <td width="100%" class="style7 style23">&nbsp;&nbsp; Seja Bem Vindo <?php echo $admin->GetNome(); ?>!&nbsp;</td>
                                        <td><img src="../imagens/back.png" alt="Voltar" /></td>
                                        <td>&nbsp;<a href="processo_inicio.frm.php"><b>VOLTAR</b></a></td>
                                        <td>&nbsp;&nbsp;&nbsp;</td>
                                        <td class="style6"><img src="../imagens/bt_logout.jpg" alt="Sair" /></td>
                                        <td>&nbsp;&nbsp;&nbsp;<b><a href="../<?php echo $config->GetPaginaPrincipal() ?>"><b>SAIR</b></a></b></td>
                                        <td>&nbsp;&nbsp;&nbsp;</td>
                                    <br/>
                        </tr>
                    </table>
                    <br/>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
<div class="sitemap">
    <br/>
    <h1 style="height: 60px">Situação atual do Processo: <?php
        echo(strtoupper($_GET['nomeoriproc']) . ' - ');
        echo strtoupper($_GET['nomeiniproc']);
        ?></h1> 
    <br/>
    <ul id="primaryNav">
        <?php echo $html; ?>
        </li>
    </ul>

</div>

<?php
foreach ($tbl as $chave => $linha) {
    ?>
    <form id="form<?php echo $linha['IDPROCESSO'] ?>" name="form<?php echo $linha['IDPROCESSO'] ?>" method="post" action="processo_organograma.frm.php?idiniproc=<?php echo $_GET['idiniproc'] ?>&nomeiniproc=<?php echo $_GET['nomeiniproc'] ?>&nomeoriproc=<?php echo $_GET['nomeoriproc'] ?>">
        <div id="myModal<?php echo $linha['IDPROCESSO'] ?>" class="modal hide fade" style="width: 450px; height: 187px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class ="modal" style="position: relative; top: auto;left: auto;right: auto;margin: 0 auto 20px; z-index: 1; max-width: 100%; ">
                <div class="modal-header">
                    <a style="text-decoration: none;" type="button" id="modal_close" name="closeButton" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
                    <h4>Tela</h4>
                </div>

                <input type="hidden" name="idandproc" value="<?php echo $linha['IDANDPROC'] ?>" />
                <input type="hidden" name="sitproc" value="<?php echo $linha['SITPROC'] ?>" />

                <div class="modal-body">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
                        <tr>
                            <td style="width: 25%; text-align: right">
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword">Nome Processo:&nbsp;</label>
                                </div>
                            </td>
                            <td>
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword"><?php echo $linha['NOMEPROC'] ?></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%; text-align: right">
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword">Descrição:&nbsp;</label>
                                </div>
                            </td>
                            <td>
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword"><?php echo $linha['DESCPROC'] ?></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%; text-align: right">
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword">Documentos:&nbsp;</label>
                                </div>
                            </td>
                            <td>
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword"><?php echo $linha['DOCPROC'] ?></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%; text-align: right">
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword">Local:&nbsp;</label>
                                </div>
                            </td>
                            <td>
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword"><?php echo $linha['LOCALPROC'] ?></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%; text-align: right">
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword">Contato:&nbsp;</label>
                                </div>
                            </td>
                            <td>
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword"><?php echo $linha['CONTATOPROC'] ?></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%; text-align: right">
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword">Valor:&nbsp;</label>
                                </div>
                            </td>
                            <td>
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword"><?php echo $linha['VALORPROC'] ?></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%; text-align: right">
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword">Tempo:&nbsp;</label>
                                </div>
                            </td>
                            <td>
                                <div  class="control-group form-inline">
                                    <label  class="control-label" for="inputPassword"><?php echo $linha['TEMPOPROC'] ?></label>
                                </div>
                            </td>
                        </tr>
                    </table> 

                </div>
                <div class="modal-footer">
                    <?php if ($linha['SITPROC'] == 0) { ?>
                        <input type="submit" value='Processo executado!' style="text-decoration: none;" class="btn btn-primary"/>
                    <?php } else { ?>
                        <input type="submit" value='Processo não executado!' style="text-decoration: none;" class="btn btn-primary"/>
                    <?php } ?>
                </div>

            </div>
        </div>
    </form>
    <?php
}
?>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>



