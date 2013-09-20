<?php 
require_once("config.cls.php"); 
require_once("modelo/gerador_generico_index.cls.php");
require_once("validarlogin.cls.php"); 

$config = new clsConfig();

$config->Logout(false);

$gerador = new clsGeradorGenerico("estado");
$htmlComboEstado = $gerador->ListaComboALL();

$gerador = new clsGeradorGenerico("municipio");
$htmlComboMunicipio = $gerador->ListaComboALL();

$gerador = new clsGeradorGenerico("entidade");
$htmlComboEnt = $gerador->ListaComboALL();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html lang="pt">
  <head>
    <meta charset="iso-8859-1">
    <title>Demandantes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login - Sistema de demandantes">
    <meta name="author" content="Odair">

    <!-- Le styles -->
    <link href="visao/css/bootstrap2.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 350px;
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
    

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
  
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">


    <script> 

        $(document).ready(function(){

            $("#admin").hide();

          });

          
         
                 function main()
                    {

                      document.getElementById("admin").checked=false;
                      $("#admin").show();
                      $("#main").hide();
                    document.getElementById("admin").checked=false;
                    }

                  function admin()
                    {
                      document.getElementById("admin").checked=false;
                      $("#main").show();
                      $("#admin").hide();
                     document.getElementById("usu").checked=false;
                  
                    }
        
        
        
      </script> 
  </head>

  <body>

    <div id="admin" class="container">

      <form class="form-signin" role="form" id="form1" name="form1" method="POST" action="login.exe.php">



        <h4 class="page-header">Login Administrador <small>acesse sua conta</small> </h4>
       
        <div class="form-group">
        <label>UF:</label>
        <select class="form-control"  name="uf">
            <option value="0" >Selecione uma UF</option>
            <?php echo $htmlComboEstado; ?>
        </select>
        </div>

        <div class="form-group">
        <label>Prefeitura Municipal:</label>
        <select class="form-control" name="municipio">
            <option value="0"  >Selecione um município</option>
            <?php echo $htmlComboMunicipio; ?>
        </select>
        </div>
        
        <div class="form-group">
        <label>Entidade social:</label>
        <select class="form-control"  placeholder="Entidade social" name="entidade">
            <option value="0"  >Selecione uma entidade</option>
            <?php echo $htmlComboEnt; ?>
        </select>
        </div>

        <div class="form-group">
        <input type="text" name="usuario" class="form-control" placeholder="CPF">
        </div>
        <div class="form-group">
        <input type="password" name="senha" class="form-control" placeholder="Senha">
        </div>

        <div class="form-group">
            <label class="checkbox">
          <input type="checkbox" name="usuario" onchange="admin()" id="usu" value="option1" >
            Usuário
          </label>
          </div>

        <hr/>
        
        

        <a type="submit"  onclick = "document.form1.submit();"  class="btn btn-large btn-success btn-block" >Entrar</a>
      </form>

    </div> <!-- /container -->


    <div id="main" class="container">

      <form class="form-signin">



        <h4 class="page-header">Login <small>acesse sua conta</small> </h4>
       
        <input type="text" name="cpf"  class="form-control" placeholder="Digite seu CPF">

         <label class="checkbox">
          <input type="checkbox" onchange="main()"  id="admin" value="option1" >
            Administrador
          </label>

        
        <hr/>
        
       

        <button class="btn btn-large btn-success btn-block" type="submit">Visualizar</button>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  </body>
</html>
