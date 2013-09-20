<?php session_start(); ?>
<html lang="en">
    <head>
        <meta charset="iso-8859-1">
        <title>Demandantes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="css/styleadmin.css" rel="stylesheet">
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
                background-color: #f5f5f5;
            }


            .form-signin {
                max-width: 800px;
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

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
        </script>
        <script>
            $(document).ready(function() {
                $("#img1").hover(function() {
                    $("#img1").animate({
                        height: '140px',
                        width: '140px'
                    });
                }, function() {
                    $("#img1").animate({
                        height: '120px',
                        width: '120px'
                    });
                });

                $("#img2").hover(function() {
                    $("#img2").animate({
                        height: '150px',
                        width: '150px'
                    });
                }, function() {
                    $("#img2").animate({
                        height: '120px',
                        width: '120px'
                    });
                });

                $("#img3").hover(function() {
                    $("#img3").animate({
                        height: '140px',
                        width: '140px'
                    });
                }, function() {
                    $("#img3").animate({
                        height: '120px',
                        width: '120px'
                    });
                });

                $("#img4").hover(function() {
                    $("#img4").animate({
                        height: '140px',
                        width: '140px'
                    });
                }, function() {
                    $("#img4").animate({
                        height: '120px',
                        width: '120px'
                    });
                });
            });
        </script>
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
            <form class="form-signin">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 >Menu administrador </h4>
                    </div>

                    <div class="panel-body" >

                        <a style="margin-left: 6%; margin-top:2%" href="cadastro_usuario.frm.php"><img id="img1" src="img/usuario.png" class="img-polaroid"/></a>
                        <?php if ($_SESSION['permissao'] == 1) { ?>
                            <a style="margin-left: 6%; margin-top:2%"href="cadastro_entidade.frm.php"><img id="img2"  src="img/entidade.png" style=" height: 120px; width:120px " class="img-polaroid"/></a>
                            <a style="margin-left: 6%; margin-top:2%" href="cadastro_parametros.frm.php"><img id="img4" src="img/parametros.png" style="height: 120px; width:120px;" class="img-polaroid"/></a>
                        <?php } ?>
                        <?php if ($_SESSION['permissao'] == 3) { ?>
                            <a style="margin-left: 6%; margin-top:2%" href="solicitante.frm.php"><img id="img3"  src="img/demandantes.png" class="img-polaroid"></a>
                        <?php }else{ ?>
                            <a style="margin-left: 6%; margin-top:2%" href="cadastro_demandante.frm.php"><img id="img3"  src="img/demandantes.png" class="img-polaroid"></a>
                        <?php } ?>
                        <div>
                            <label style="margin-left: 6%;"><h6>Cadastro de usuário</h6></label>
                            <?php if ($_SESSION['permissao'] == 1) { ?>
                                <label style="margin-left: 6%; "><h6>Cadastro de entidade</h6></label>
                                <label style="margin-left: 2%; "><h6>Cadastro de parâmetros</h6></label>
                            <?php } ?>
                            <label style="margin-left: 3%; "><h6>Cadastro de demandantes</h6></label>
                        </div>

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
