<?php
session_start();
require_once("../modelo/gerador_generico.cls.php");
require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $usuario = new clsusuario();

    if ($_GET) {
        $metodo = $_GET['metodo'];
    } else {
        $metodo = null;
    }

    if ($metodo == 1) {
// EDITAR Exibir dados
        $cod = $_GET['IDUSUARIO'];
        $usuario->preencheDados($cod);
    }
} else {
    $config->Logout(false);
    $config->ConfirmaOperacao($config->GetPaginaPrincipal(), "Voc\xEA n\xE3o tem permiss\xE3o para acessar essa p\xE1gina!");
}
?>
<html lang="en">
    <head>
        <meta charset="iso-8859-1">
        <title>Demandantes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="css/styleadmin.css" rel="stylesheet">

        <link href="css/tabela.css" rel="stylesheet">

        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
                background-color: #f5f5f5;
            }


            .form-signin {
                max-width: 500px;
                padding: 19px 29px 29px;
                margin: 0 auto 20px;
                background-color: #fff;
                border: 1px solid #e5e5e5;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin input[type="text"],
            .form-signin input[type="password"] {
                font-size: 16px;
                height: auto;
                margin-bottom: 15px;
                padding: 7px 9px;
            }


        </style>
        <link href="css/bootstrap-responsive.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../assets/ico/favicon.png">
    </head>

    <body>

        <div class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Cadastro de demandantes</a>
                    <a href="../index.php" style="text-decoration: none; margin-top:1%" class="navbar-link pull-right"> Logout</a>

                </div>
            </div>
        </div>

        <div id="admin" class="container">

            <form id="form1" name="form1" method="POST" action="usuario.exe.php" class="form-signin">
                <input type="hidden" name="metodo" id="metodo" value="<?php echo $metodo ?>"/>
                <input type="hidden" name="codigo" id="codigo" value="<?php echo $usuario->getCodigo() ?>"/>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 >Cadastro de parâmetros </h4>
                    </div>

                    <div class="panel-body" > 

                       


                        <div class="form-group">
                            <label class="control-label" >Tabela:</label>
                            <select class="form-control"  name="IDENTIDADE">
                                
                                    <option value="0" selected="selected"> ----- SELECIONE ----- </option>
                              
                                    <option value="estado_civil"> Estado civil </option>
                                    <option value="grau_instrucao"> Grau instrução </option>
                                    <option value="def_grau_parentesco"> Grau parentesco </option>
                                    <option value="dd_destino_lixo"> Destino de lixo </option>
                                    <option value="dd_especie_domicilio"> Espécie domicílio </option>
                                    <option value="dd_estado_conservacao"> Estado conservação </option>
                                    <option value="dd_forma_abastecimento"> Forma de abastecimento </option>
                                    <option value="dd_forma_escoamento_sanitario"> Forma de escoamento </option>
                                    <option value="dd_forma_utilizacao"> Forma de utilização </option>
                                    <option value="dd_iluminacao_casa"> Iluminação da casa </option>
                                    <option value="dd_tipo_construcao"> Tipo de construção </option>
                                    <option value="dd_tipo_material_parede_externa"> Tipo de material de parede externa </option>
                                    <option value="dd_tipo_material_piso_interno"> Tipo de material de piso interno </option>
                                    <option value="dd_tipo_uso"> Tipo de uso </option>
                                    <option value="df_comunidade"> Comunidade </option>
                                    <option value="df_tipo_risco"> Tipo de risco </option>
                                    <option value="ds_deficiencia"> Deficiência </option>
                                    <option value="ds_ocupacao"> Ocupação </option>
                                    <option value="ds_situacao_mercado_trabalho"> Situação no mercado de trabalho </option>

                                
                            
                                ?> 
                            </select>
                        </div>

                        <div class="form-group" style="margin-top:2%">
                            <label class="control-label" >Descrição:</label>
                            <input class="form-control" type="text"  name="NOMEUSU" value="<?php echo $usuario->getNOMEUSU() ?>" >

                        </div>
                        <a type="submit"  onclick = "document.form1.submit();" class="btn btn-success">Confirmar</a>
                        <a href="cadastro_parametros.frm.php"  class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            </form>
        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/js/bootstrap-transition.js"></script>
        <script src="../assets/js/bootstrap-alert.js"></script>
        <script src="../assets/js/bootstrap-modal.js"></script>
        <script src="../assets/js/bootstrap-dropdown.js"></script>
        <script src="../assets/js/bootstrap-scrollspy.js"></script>
        <script src="../assets/js/bootstrap-tab.js"></script>
        <script src="../assets/js/bootstrap-tooltip.js"></script>
        <script src="../assets/js/bootstrap-popover.js"></script>
        <script src="../assets/js/bootstrap-button.js"></script>
        <script src="../assets/js/bootstrap-collapse.js"></script>
        <script src="../assets/js/bootstrap-carousel.js"></script>
        <script src="../assets/js/bootstrap-typeahead.js"></script>

    </body>
</html>
