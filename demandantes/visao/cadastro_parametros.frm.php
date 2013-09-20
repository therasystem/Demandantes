<?php
session_start();

require_once("../config.cls.php");
require_once("../controle/conexao.gti.php");


$config = new clsConfig();
$pesq='';

if (isset($_POST['pesquisa'])) {
    $pesq = $_POST['pesquisa'];
}


if ((isset($_SESSION['codigo']))) {

    $html = '
            <div style="margin-top: 1px; float: left">
                            <input type="text" name="pesquisa" value="' . $pesq . '" class="form-control">
                        </div>
                    <div style="float: left; margin-left: 1%">
                    <a type="submit"  onclick = "document.form1.submit();" class="btn btn-primary">Pesquisar</a>
                    <a type="submit" href = "usuario_alteracao.frm.php"  class="btn btn-success">Adicionar</a>
                    <a href="../visao/menuadministrador.frm.php"  class="btn btn-primary"">Voltar</a>
                    </div>
                              <table class="table1 table1-bordered">
                              <thead>
                                <tr>
                                  <th>Tabela</th>
                                  <th>Descrição</th>
                                
                                  <th>Excluir</th>
                                </tr>
                              </thead>';



    $SQL = " SELECT * FROM tabelas_parametros ";

    //die(print_r($_SESSION));

    if ($pesq != "") {
        $pesq = str_replace(" ", "%", $pesq);

        $SQL.=" WHERE UPPER(TABELA) LIKE UPPER('%" . $pesq . "%') OR 
                UPPER(DESCESTCIVIL) LIKE UPPER('%" . $pesq . "%')  ";
    }

    $SQL.=" ORDER BY TABELA, DESCESTCIVIL ";

    $con = new gtiConexao();
    $con->gtiConecta();
    $tbl = $con->gtiPreencheTabela($SQL);
    $con->gtiDesconecta();

    //die($SQL);


    foreach ($tbl as $chave => $linha) {

        $pula = false;



        if ($pula == false) {
            $html .= '   <tbody>
                <td > ' . htmlentities($linha['TABELA']) . ' </td>
                <td > ' . htmlentities($linha['DESCESTCIVIL']) . ' </td>
              
                
                <td ><a href = "usuario.exe.php?NOMETABELA=' . htmlentities($linha['TABELA']) . '&metodo=2' . '&codigo=' . htmlentities($linha['IDESTADOCIVIL']) . '"><img  src = "img/delete.png"  ></a> </td>
                </tbody>
                ';
        }
    }


    $html .= ' </table>';
} else {
    $config->Logout(false);
    $config->ConfirmaOperacao($config->GetPaginaPrincipal(), "Voc\xEA n\xE3o tem permiss\xE3o para acessar essa p\xE1gina!");
}
?>
<html lang="pt">
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

            <form id="form1" name="form1" method="post" class="form-signin" action="cadastro_parametros.frm.php"> 


                <input type="hidden" value="1" name="pesq" />
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 >Cadastro de parÃ¢metros </h4>
                    </div>

                    <div class="panel-body" > 


<?php echo $html ?>



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
