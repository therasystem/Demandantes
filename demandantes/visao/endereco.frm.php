<?php
session_start();

require_once("../config.cls.php");
require_once("../modelo/usuario.cls.php");
require_once("../modelo/dados_domicilio.cls.php");
require_once("../modelo/gerador_generico.cls.php");

$config = new clsConfig();

if ((isset($_SESSION['codigo']))) {
    $endereco = new clsDadosDomicilio();

    if ($_GET) {
        $metodo = $_GET['metodo'];
    } else {
        $metodo = null;
    }

    if ($metodo == 1) {
        // EDITAR Exibir dados
        $cod = $_GET['IDDADODOMICILIO'];
        $endereco->preencheDados($cod);
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
                        <li class="active"><a href="#">Endereço</a></li>
                        <li><a href="domiciliar.frm.php">Região Domiciliar</a></li>
                        <li><a href="familia.frm.php">Dados ente familiar</a></li>
                        <li><a href="dadosfamilia.frm.php">Dados da família</a></li>
                        <li><a href="dadosimovel.frm.php">Dados do imóvel</a></li>
                    </ul>
                </div>

            </div>

            </hr>
            <form id="form1" name="form1" method="post" class="form-inline" action="endereco.exe.php"> 
                <input type="hidden" name="metodo" id="metodo" value="<?php echo $metodo ?>"/>
                <input type="hidden" name="codigo" id="codigo" value="<?php echo $endereco->getCodigo() ?>"/>
                <div class="row-fluid">
                    <div class="span4">
                        <h3>Dados do domicílio</h3 >
                        <div class="control-group">

                            <div class="control-group">
                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Tipo logradouro:</label>
                                <div  class="controls">
                                    <select style="width: 200px;" name="IDTIPOLOGRADOURO">
                                        <?php
                                        $gerador = new clsGeradorGenerico("tipo_logradouro");
                                        echo $gerador->ListaComboALL($endereco->getIDTIPOLOGRADOURO());
                                        ?>
                                    </select>
                                </div>

                                <div style="margin-top: 1%"></div>
                                <label class="control-label"> Complemento:</label>
                                <div  class="controls">
                                    <input style="height: 30px;" name="COMPLEMENTO" type="text" value="<?php echo $endereco->getCOMPLEMENTO() ?>"  />
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label">UF:</label>
                                <div  class="controls">
                                    <select style="width:100px" name="IDESTADO">
                                        <?php
                                        $gerador = new clsGeradorGenerico("estado");
                                        echo $gerador->ListaComboALL3colunas($endereco->getIDESTADO());
                                        ?>
                                    </select>
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Tipo de construção:</label>
                                <div  class="controls">
                                    <select style="width:100px" name="IDCONSTRUCAO">
                                        <?php
                                        $gerador = new clsGeradorGenerico("dd_tipo_construcao");
                                        echo $gerador->ListaComboALL($endereco->getIDCONSTRUCAO());
                                        ?>
                                    </select>
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label" max-lenght="150">Tipo de uso:</label>
                                <div  class="controls">
                                    <select style="width:100px" name="IDTIPOUSO">
                                        <?php
                                        $gerador = new clsGeradorGenerico("dd_tipo_uso");
                                        echo $gerador->ListaComboALL($endereco->getIDTIPOUSO());
                                        ?>
                                    </select>
                                </div>

                                <div style="margin-top: 2%"></div>
                                <label class="control-label" max-lenght="150">Desde quando reside no município?</label>
                                <div  class="controls">
                                    <input style="height: 30px;" name="DATAINICIOMORARMUNICIP" type="text" value="<?php echo $endereco->getDATAINICIOMORARMUNICIP() ?>"  />
                                </div>


                                <div style="margin-top: 3%"></div>
                                <label class="control-label" max-lenght="150">Quantidade de comodos utilizados como dormitorio permanente:</label>
                                <div  class="controls">
                                    <input style="height: 30px;" name="QUANTDORMIT" type="text" value="<?php echo $endereco->getQUANTDORMIT() ?>"  />
                                </div>

                                <div style="margin-top: 3%"></div>
                                <label class="control-label" max-lenght="150">O domicilio tem agua canalizada para, pelo menos, um comodo?</label>
                                <div  class="controls">
                                    <input style="height: 30px;" name="QTAGUACANALIZADA" type="text"  value="<?php echo $endereco->getQTAGUACANALIZADA() ?>" />
                                </div>

                                <div style="margin-top: 3%"></div>
                                <label class="control-label" max-lenght="150">De que forma e feito o escoamento do banheiro ou sanitario?</label>
                                <div  class="controls">
                                    <select style="width:100px" name="IDFORMAESCOASANITARIO">
                                        <?php
                                        $gerador = new clsGeradorGenerico("dd_forma_escoamento_sanitario");
                                        echo $gerador->ListaComboALL($endereco->getIDFORMAESCOASANITARIO());
                                        ?>
                                    </select>
                                </div>

                                <div style="margin-top: 3%"></div>
                                <label class="control-label" max-lenght="150">Qual a forma de iluminacao utilizada no seu domicilio?</label>
                                <div  class="controls">
                                    <select style="width:100px" name="IDILUMINACAOCASA">
                                        <?php
                                        $gerador = new clsGeradorGenerico("dd_iluminacao_casa");
                                        echo $gerador->ListaComboALL($endereco->getIDILUMINACAOCASA());
                                        ?>
                                    </select>
                                </div>

                                <div style="margin-top: 3%"></div>
                                <label class="control-label" max-lenght="150">Qual o valor das despesas?</label>
                                <div  class="controls">
                                    <label class="control-label">Água e esgoto:</label>

                                    <div  class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on">R$</span>
                                            <input style="height: 30px; width: 80px" name="VALAGUAESGOTO" type="text" value="<?php echo $endereco->getVALAGUAESGOTO() ?>"  maxlength="11" />
                                        </div>
                                    </div>

                                    <label class="control-label">Energia elétrica:</label>


                                    <div  class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on">R$</span>
                                            <input style="height: 30px; width: 80px" name="VALENERGIA" type="text" value="<?php echo $endereco->getVALENERGIA() ?>"  maxlength="11" />
                                        </div>
                                    </div>


                                    <label class="control-label">Aluguel:</label>

                                    <div  class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on">R$</span>
                                            <input style="height: 30px; width: 80px" name="VALALUGUEL" type="text" value="<?php echo $endereco->getVALALUGUEL() ?>"  maxlength="11" />
                                        </div>
                                    </div>  




                                </div>



                                <div style="margin-top: 4%"></div>

                                <a  name="btcadastro"  class="btn btn-success" onclick = "document.form1.submit();">Avançar <i class="icon-circle-arrow-right icon-white"></i></a>
                                <a class="btn" >Voltar</a>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid" style="margin-top: 5.5%;">
                        <div class="span4">

                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Nome logradouro:</label>
                            <div  class="controls">
                                <input style="height: 30px; width: 300px;" name="NOMELOGRADOURO" type="text" maxlength="150" value="<?php echo $endereco->getNOMELOGRADOURO() ?>" />
                            </div>
                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Bairro:</label>
                            <div  class="controls">
                                <input style="height: 30px;" name="BAIRRO" type="text" value="<?php echo $endereco->getBAIRRO() ?>"  />
                            </div>


                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Município:</label>
                            <div  class="controls">
                                <select style="width:100px" name="IDMUNICIPIO">
                                    <?php
                                    $gerador = new clsGeradorGenerico("municipio");
                                    echo $gerador->ListaComboALL($endereco->getIDMUNICIPIO());
                                    ?>
                                </select>
                            </div>

                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Estado de conservação:</label>
                            <div  class="controls">
                                <select style="width:100px" name="IDESTCONSERVACAO">
                                    <?php
                                    $gerador = new clsGeradorGenerico("dd_estado_conservacao");
                                    echo $gerador->ListaComboALL($endereco->getIDESTCONSERVACAO());
                                    ?>
                                </select>
                            </div>
                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Especie do domicílio:</label>
                            <div  class="controls">
                                <select style="width:100px" name="IDESPECIEDOMICILIO">
                                    <?php
                                    $gerador = new clsGeradorGenerico("dd_especie_domicilio");
                                    echo $gerador->ListaComboALL($endereco->getIDESPECIEDOMICILIO());
                                    ?>
                                </select>
                            </div>

                            <div style="margin-top: 1%"></div>
                            <label class="control-label">Desde quando mora neste domicilio?</label>
                            <div  class="controls">
                                <input style="height: 30px;" name="DATAINICIOMORARDOMICILIO" type="text" value="<?php echo $endereco->getDATAINICIOMORARDOMICILIO() ?>" />
                            </div>


                            <div style="margin-top: 3%"></div>
                            <label class="control-label" max-lenght="150">Qual o material predominante no piso interno da moradia:</label>
                            <div  class="controls">
                                <select style="width:100px" name="IDTIPOMATERIALPISOINT">
                                    <?php
                                    $gerador = new clsGeradorGenerico("dd_tipo_material_piso_interno");
                                    echo $gerador->ListaComboALL($endereco->getIDTIPOMATERIALPISOINT());
                                    ?>
                                </select>
                            </div>

                            <div style="margin-top: 3%"></div>
                            <label class="control-label" max-lenght="150">Qual a forma de abastecimento de agua utilizada no seu domicilio:</label>
                            <div  class="controls">
                                <select style="width:100px" name="IDFORMAABASTECIMENTO">
                                    <?php
                                    $gerador = new clsGeradorGenerico("dd_forma_abastecimento");
                                    echo $gerador->ListaComboALL($endereco->getIDFORMAABASTECIMENTO());
                                    ?>
                                </select>
                            </div>

                            <div style="margin-top: 4%"></div>
                            <label class="control-label" max-lenght="150">No seu domicilio existe cozinha?</label>
                            <div style="margin-top: 5.6%" class="controls">
                                <span id="pnee_titular">
                                    <input type="radio"  class="radio">
                                    SIM
                                    <input type="radio" class="radio">
                                    NÃO 
                                </span>  
                            </div>

                            <div style="margin-top: 4%"></div>
                            <label class="control-label" max-lenght="150">Quantos nucleos familiares moram atualmente no domicilio?</label>
                            <div  class="controls">
                                <input style="height: 30px; width: 80px" name="NUMFAMILIAS" type="text"   maxlength="10"  value="<?php echo $endereco->getNUMFAMILIAS() ?>"/>
                            </div>
                        </div>

                        <div class="row-fluid" style="margin-top: 0%;">
                            <div class="span4">

                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Número imóvel:</label>
                                <div  class="controls">
                                    <input style="height: 30px; width: 100px;" value='<?php echo $endereco->getNUMDOMICILIO() ?>' name="NUMDOMICILIO" type="text" maxlength="10"  />
                                </div>
                                <div style="margin-top: 1%"></div>
                                <label class="control-label">CEP:</label>
                                <div  class="controls">
                                    <input style="height: 30px; width: 200px;" value='<?php echo $endereco->getCEP() ?>' name="CEP" type="text" maxlength="30"  />
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Referência:</label>
                                <div  class="controls">
                                    <input style="height: 30px; width: 160px;" value='<?php echo $endereco->getREFERENCIA() ?>' name="REFERENCIA" type="text"   />
                                </div>


                                <div style="margin-top: 1%"></div>
                                <label class="control-label">Forma de utilização:</label>
                                <div  class="controls">
                                    <select style="width:100px" name="IDUTILIZACAO">
                                        <?php
                                        $gerador = new clsGeradorGenerico("dd_forma_utilizacao");
                                        echo $gerador->ListaComboALL($endereco->getIDUTILIZACAO());
                                        ?>
                                    </select>
                                </div>

                                <div style="margin-top: 19.8%"></div>
                                <label class="control-label" max-lenght="150">Quantidade total de comodos:</label>
                                <div  class="controls">
                                    <input style="height: 30px;" name="QUANTCOMODOS" type="text" value="<?php echo $endereco->getQUANTCOMODOS() ?>"  />
                                </div>

                                <div style="margin-top: 2.2%"></div>
                                <label class="control-label" max-lenght="150">Qual e o material predominante na construcao das paredes externas:</label>
                                <div  class="controls">
                                    <select style="width:100px" name="IDTIPOMATERIALPAREDEEXT">
                                        <?php
                                        $gerador = new clsGeradorGenerico("dd_tipo_material_parede_externa");
                                        echo $gerador->ListaComboALL($endereco->getIDTIPOMATERIALPAREDEEXT());
                                        ?>
                                    </select>
                                </div>

                                <div style="margin-top: 4%"></div>
                                <label class="control-label" max-lenght="150">No seu domicilio existe banheiro ou sanitario?</label>
                                <div style="margin-top: 5.6%"  class="controls">
                                    <span id="pnee_titular">
                                        <input type="radio"  class="radio">
                                        SIM
                                        <input type="radio" class="radio">
                                        NÃO 
                                    </span>  
                                </div>


                                <div style="margin-top: 4%"></div>
                                <label class="control-label" max-lenght="150">Qual o destino do lixo da sua moradia?</label>
                                <div style="margin-top: 5.6%"  class="controls">
                                    <select style="width:100px" name="IDDESTINOLIXO">
                                        <?php
                                        $gerador = new clsGeradorGenerico("dd_destino_lixo");
                                        echo $gerador->ListaComboALL($endereco->getIDDESTINOLIXO());
                                        ?>
                                    </select>
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
