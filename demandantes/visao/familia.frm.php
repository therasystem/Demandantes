<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/dados_ente_familiar.cls.php");
require_once("../modelo/gerador_generico.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $enteFamilia = new clsDadosEnteFamiliar();

    if ($_GET) {
        $metodo = $_GET['metodo'];
    } else {
        $metodo = null;
    }

    if ($metodo == 1) {
        // EDITAR Exibir dados
        $cod = $_GET['IDDADOENTEFAMILIA'];
        $enteFamilia->preencheDados($cod);
    }
} else {
    $config->Logout(false);
    $config->ConfirmaOperacao($config->GetPaginaPrincipal(), "Voc\xEA n\xE3o tem permiss\xE3o para acessar essa p\xE1gina!");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Demandantes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Empresa VTX - abril 2013" >
        <meta name="Odair Santiago">

        <!-- Le styles -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 20px;
                padding-bottom: 60px;
            }

            /* Custom container */
            .container {
                margin: 0 auto;
                max-width: 1000px;
            }
            .container > hr {
                margin: 60px 0;
            }

            /* Main marketing message and sign up button */
            .jumbotron {
                margin: 80px 0;
                text-align: center;

            }
            .jumbotron h1 {
                font-size: 100px;
                line-height: 1;
            }
            .jumbotron .lead {
                font-size: 24px;
                line-height: 1.25;
            }
            .jumbotron .btn {
                font-size: 21px;
                padding: 14px 24px;
            }

            /* Supporting marketing content */
            .marketing {
                margin: 60px 0;
            }
            .marketing p + h4 {
                margin-top: 28px;
            }


            /* Customize the navbar links to be fill the entire space of the .navbar */
            .navbar .navbar-inner {
                padding: 0;
            }
            .navbar .nav {
                margin: 0;
                display: table;
                width: 100%;
            }
            .navbar .nav li {
                display: table-cell;
                width: 16.5%;
                float: none;
            }
            .navbar .nav li a {
                font-weight: bold;
                text-align: center;
                border-left: 1px solid rgba(255,255,255,.75);
                border-right: 1px solid rgba(0,0,0,.1);
            }
            .navbar .nav li:first-child a {
                border-left: 0;
                border-radius: 3px 0 0 3px;
            }
            .navbar .nav li:last-child a {
                border-right: 0;
                border-radius: 0 3px 3px 0;
            }

            #push,	
            #footer {
                height: 120px;
            }
            #footer {
                background-color: #0258c7;
                margin-botton: 0px;
            }

        </style>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
    
     
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="img/favicon.png">
    </head>

    <body >

        <div class="container" style="background: white; padding-left: 2em; border-radius: 10px 10px;-webkit-border-radius: 10px 10px;-moz-border-radius: 10px;">
            <div id="contatos" style="padding-right: 1em"  > <i class="icon-headphones "></i> +55 (91) 3333 3333 </br>
                <i class="icon-envelope "></i> e-mail@email.com.br

            </div>

            <div class="masthead"  >
                <h3 class="muted"><img style=" width: 20%; height:22%" src="img/logo.png"/> <h1>CADASTRO DE DEMANDANTES</h1></h3>


                <div class="container">
                    <ul class="nav nav-tabs">
                        <li ><a href="solicitante.frm.php">Solicitante</a></li>
                        <li><a href="endereco.frm.php">Endereço</a></li>
                        <li><a href="domiciliar.frm.php">Região Domiciliar</a></li>
                        <li class="active"><a href="#">Dados ente familiar</a></li>
                        <li><a href="dadosfamilia.frm.php">Dados da família</a></li>
                        <li><a href="dadosimovel.frm.php">Dados do imóvel</a></li>
                    </ul>
                </div>

            </div>

            </hr>
            <form id="form1" name="form1" method="post" class="form-inline" action="familia.exe.php"> 
                <input type="hidden" name="metodo" id="metodo" value="<?php echo $metodo ?>"/>
                <input type="hidden" name="codigo" id="codigo" value="<?php echo $enteFamilia->getCodigo() ?>"/>

                <div class="row-fluid">
                    <div class="span4">
                        <h3>Dados Ente Familiar</h3 >
                        <div class="control-group">

                            <div class="control-group">
                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Grau de parentesco:</label>
                                <div  class="controls">
                                    <select style="width: 200px;" name="IDGRAUPARENTESCO">
                                        <?php
                                        $gerador = new clsGeradorGenerico("def_grau_parentesco");
                                        echo $gerador->ListaComboALL($enteFamilia->getIDGRAUPARENTESCO());
                                        ?>
                                    </select>
                                </div>

                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Nome da mãe:</label>
                                <div  class="controls">
                                    <input style="height: 30px;" name="NOMEMAE" type="text" value="<?php echo $enteFamilia->getNOMEMAE() ?>"  />
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label">UF orgão emissor:</label>
                                <div  class="controls">
                                    <select style="width: 200px;" name="IDESTADOIDENT">
                                        <?php
                                        $gerador = new clsGeradorGenerico("estado");
                                        echo $gerador->ListaComboALL3colunas($enteFamilia->getIDESTADOIDENT());
                                        ?>
                                    </select>
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Titulo de eleitor:</label>
                                <div  class="controls">
                                    <input style="height: 30px;" name="NUMTITULOELEITOR" type="text" value="<?php echo $enteFamilia->getNUMTITULOELEITOR() ?>"  maxlength="20" />
                                </div>

                                <div style="margin-top: 1%"></div>
                                <label class="control-label" max-lenght="150">País de origem:</label>
                                <div  class="controls">
                                    <select style="width: 200px;" name="IDPAISNASC">
                                        <?php
                                        $gerador = new clsGeradorGenerico("pais");
                                        echo $gerador->ListaComboALL($enteFamilia->getIDPAISNASC());
                                        ?>
                                    </select>
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label" max-lenght="150">Data nascimento:</label>
                                <div  class="controls">
                                    <input style="height: 30px;" name="DTNASC" type="text" value="<?php echo $enteFamilia->getDTNASC() ?>"  maxlength="15" />
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label">CPF do cônjuge ou companheiro:</label>
                                <div  class="controls">
                                    <input style="height: 30px;" name="CPFCONJUGE" type="text" value="<?php echo $enteFamilia->getCPFCONJUGE() ?>"  maxlength="20" />
                                </div>



                                <div style="margin-top: 3%"></div>
                                <label class="control-label" max-lenght="150">Valor renda mensal:</label>
                                <div  class="controls">
                                    <label class="control-label">Trabalho formal:</label>

                                    <div  class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on">R$</span>
                                            <input style="height: 30px; width: 80px" name="VALTRABFORMAL" type="text" value="<?php echo $enteFamilia->getVALTRABFORMAL() ?>"  maxlength="10" />
                                        </div>
                                    </div>

                                    <label class="control-label">Trabalho informal:</label>


                                    <div  class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on">R$</span>
                                            <input style="height: 30px; width: 80px" name="VALTRABINFORMAL" type="text" value="<?php echo $enteFamilia->getVALTRABINFORMAL() ?>"  maxlength="10" />
                                        </div>
                                    </div>
                                </div>

                                <div class="span4" style="width:400px">
                                    <div style="margin-top: 3%"></div>
                                    <label class="control-label" max-lenght="150">Em função da deficiência existe restrição de locomoção?</label>
                                    <div  class="controls">
                                        <span id="pnee_titular">
                                            <span id="pnee_titular">
                                                <input type="radio"  class="radio">
                                                SIM
                                                <input type="radio" class="radio">
                                                NÃO 
                                            </span>  
                                        </span> </label>
                                    </div>
                                </div>


                                <div class="span4">
                                    <div style="margin-top: 5%"></div>
                                    <label class="control-label">Código:</label>
                                    <div  class="controls">

                                        <select style="width: 200px;" name="IDRESTLOCOMOCAO">
                                            <?php
                                            $gerador = new clsGeradorGenerico("restricao_locomocao");
                                            echo $gerador->ListaComboALL($enteFamilia->getIDRESTLOCOMOCAO());
                                            ?>
                                        </select>



                                    </div>

                                </div>






                                <div style="margin-top: 4%"></div>

                                <a  name="btcadastro"  class="btn btn-success" onclick = "document.form1.submit();">Avançar <i class="icon-circle-arrow-right icon-white"></i></a>
                                <a class="btn" >Voltar</a>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid" style="margin-top: 5.5%;" >
                        <div class="span4">

                            <div style="margin-top: 1%"></div>
                            <label class="control-label">CPF:</label>
                            <div  class="controls">
                                <input style="height: 30px;width: 160px;" name="CPF" type="text" maxlength="20" value="<?php echo $enteFamilia->getCPF() ?>"   />
                            </div>
                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Identidade:</label>
                            <div  class="controls">
                                <input style="height: 30px;" name="RG" type="text" value="<?php echo $enteFamilia->getRG() ?>"  />
                            </div>


                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Sigla do orgão emissor:</label>
                            <div  class="controls">
                                <select style="width: 200px;" name="IDORGAOEMISSORIDENT">
                                    <?php
                                    $gerador = new clsGeradorGenerico("orgao_emissor");
                                    echo $gerador->ListaComboALL($enteFamilia->getIDORGAOEMISSORIDENT());
                                    ?>
                                </select>
                            </div>

                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Zona eleitoral:</label>
                            <div  class="controls">
                                <input style="height: 30px;" name="NUMZONAELEITOR" type="text"  value="<?php echo $enteFamilia->getNUMZONAELEITOR() ?>"  maxlength="10" />
                            </div>
                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Nacionalidade:</label>
                            <div  class="controls">
                                <input style="height: 30px;" name="NACIONALIDADENASC" type="text"  value="<?php echo $enteFamilia->getNACIONALIDADENASC() ?>"   />
                            </div>

                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Sexo:</label>
                            <div  class="controls">
                                <select style="width: 200px;" name="IDSEXO">
                                    <?php
                                    $gerador = new clsGeradorGenerico("sexo");
                                    echo $gerador->ListaComboALL($enteFamilia->getIDSEXO());
                                    ?>
                                </select>
                            </div>


                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Grau de instrução:</label>
                            <div  class="controls">
                                <select style="width: 200px;" name="IDGRAUINSTRUCAO">
                                    <?php
                                    $gerador = new clsGeradorGenerico("grau_instrucao");
                                    echo $gerador->ListaComboALL($enteFamilia->getIDGRAUINSTRUCAO());
                                    ?>
                                </select>
                            </div>



                            <div style="margin-top: 3%"></div>
                            <label class="control-label" max-lenght="150">Possui alguma deficiência permanente que limite suas atividades?</label>
                            <div  class="controls">
                                <span id="pnee_titular">
                                    <span id="pnee_titular">
                                        <input type="radio"  class="radio">
                                        SIM
                                        <input type="radio" class="radio">
                                        NÃO 
                                    </span>  
                                </span> 
                                </label>
                            </div>


                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Qual tipo de deficiência possui?</label>
                            <div  class="controls">

                                <label class="checkbox inline">
                                    <input type="checkbox" name="IDDEFICIENCIATIPO[]" value="">
                                    Cegueira
                                </label>

                                <label class="checkbox inline">
                                    <input type="checkbox" name="IDDEFICIENCIATIPO[]" value="">
                                    Mudez
                                </label>

                                <label class="checkbox inline">
                                    <input type="checkbox" name="IDDEFICIENCIATIPO[]" value="">
                                    Surdez
                                </label>

                                <label class="checkbox inline">
                                    <input type="checkbox" name="IDDEFICIENCIATIPO[]" value="">
                                    Mental
                                </label>

                                <label class="checkbox inline">
                                    <input type="checkbox" name="IDDEFICIENCIATIPO[]" value="">
                                    Física
                                </label>

                                <label class="checkbox inline">
                                    <input type="checkbox" name="IDDEFICIENCIATIPO[]" value="">
                                    Outra
                                </label> 
                            </div>  

                            <div style="margin-top: 3%"></div>
                            <label class="control-label" max-lenght="150">Vai morar no imóvel pretendido?</label>
                            <div  class="controls">
                                <span id="pnee_titular">
                                    <span id="pnee_titular">
                                        <input type="radio"  class="radio">
                                        SIM
                                        <input type="radio" class="radio">
                                        NÃO 
                                    </span>  
                            </div>


                        </div>



                        <div class="row-fluid" style="margin-top: 0%;">
                            <div class="span4">

                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Nome:</label>
                                <div  class="controls">
                                    <input style="height: 30px; " value="<?php echo $enteFamilia->getNOME() ?>" name="NOME" type="text" maxlength="60"  />
                                </div>
                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Data de emissão:</label>
                                <div  class="controls">
                                    <input style="height: 30px; " value="<?php echo $enteFamilia->getDTEMISSAO() ?>" name="DTEMISSAO" type="text" maxlength="15"  />
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Municipio:</label>
                                <div  class="controls">
                                    <select style="width: 200px;" name="IDMUNICIPIONASC">
                                        <?php
                                        $gerador = new clsGeradorGenerico("municipio");
                                        echo $gerador->ListaComboALL($enteFamilia->getIDMUNICIPIONASC());
                                        ?>
                                    </select>
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Seção eleitoral:</label>
                                <div  class="controls">
                                    <input style="height: 30px; width: 150px" name="NUMSECAOELEITOR" type="text" value="<?php echo $enteFamilia->getNUMSECAOELEITOR() ?>"  maxlength="10" />
                                </div>
                                <div style="margin-top: 1%"></div>
                                <label class="control-label">UF:</label>
                                <div  class="controls">
                                    <select style="width: 200px;" name="IDESTADONASC">
                                        <?php
                                        $gerador = new clsGeradorGenerico("estado");
                                        echo $gerador->ListaComboALL3colunas($enteFamilia->getIDESTADONASC());
                                        ?>
                                    </select>
                                </div>

                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Estado civil:</label>
                                <div  class="controls">
                                    <select style="width: 200px;" name="IDESTADOCIVIL">
                                        <?php
                                        $gerador = new clsGeradorGenerico("estado_civil");
                                        echo $gerador->ListaComboALL($enteFamilia->getIDESTADOCIVIL());
                                        ?>
                                    </select>
                                </div>




                                <div style="margin-top: 2%"></div>
                                <label class="control-label" max-lenght="150">Está matriculado na escola?</label>
                                <div  class="controls">
                                    <span id="pnee_titular">
                                        <span id="pnee_titular">
                                            <input type="radio"  class="radio">
                                            SIM
                                            <input type="radio" class="radio">
                                            NÃO 

                                        </span> </label>
                                </div>


                            </div>




                        </div> 
                    </div>

                </div>
            </form>


            <div id="push"></div>
        </div>

        <div id="footer">
            <div class="container">
                <div style="float: left" >
                    <h4 style="color:white;" ><i class="icon-tags icon-white"></i> Pesquisa de satisfação</h3>
                        <a style="color:white;" >Lorem ipsum dolor sit amet, consectetur adipiscing elit.</br>Fusce cursus quam libero, sit amet 						molestie urna.</a>	

                </div>

                <div style="float: left; " >
                    <img  style="margin-left: 30px;" src="img/divisor.jpg">
                </div>


                <div style="float: left; margin-left: 40px; " >
                    <h4 style="color:white;" ><i class="icon-envelope icon-white"></i> Cadastre-se</h3>
                        <p style="color:white;" >Receba novidades em seu e-mail.</p>	
                        <input class="input-text" type="text" />
                </div>

                <div style="float: left; " >
                    <img  style="margin-left: 30px;" src="img/divisor.jpg">
                </div>

                <div style="float: left; margin-left: 40px; " >
                    <h4 style="color:white;" ><i class="icon-list-alt icon-white"></i> Menu</h3>
                        <ul class="nav">
                            <li style="text-decoration: none;"><a style="color:white;" href="#">Home</a></li>
                            <li style="text-decoration: none;"><a style="color:white;" href="#">Projetos</a></li>

                            <li style=" text-decoration: none;"><a style="color:white;" href="#">Quem somos</a></li>

                            <li style=" text-decoration: none;"><a style="color:white;" href="#">Contato</a></li>
                        </ul>
                </div>


            </div>
        </div>

    </div> <!-- /container -->


    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>



    <script type="text/javascript" src="js/shCore.js"></script>
    <script type="text/javascript" src="js/shBrushXml.js"></script>
    <script type="text/javascript" src="js/shBrushJScript.js"></script>



    <!-- javascript
 
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
