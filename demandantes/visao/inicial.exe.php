<?php

require_once("../modelo/usuario.cls.php");
require_once("../config.cls.php");

session_start();

$login = trim($_POST['txtLogin']);
$senha = trim($_POST['txtSenha']);
$empresa = $_POST['empresa'];
 

$usuario = new clsUsuario();
$config = new clsConfig();
$msg = "Login ou Senha incorretos!";

if ($usuario->Autentica($login, $senha) == true) {
    $_SESSION['codigo'] = $usuario->GetCodigo();
    $_SESSION['nome'] = $usuario->GetNome();
    $_SESSION['cargo'] = $usuario->getCargo();
    $_SESSION['empresa'] = $empresa;
    
    //////////////////  MUDANÇAS FREQUENTES!!!!!!!!!!!
    if($empresa == 0){//solobase
        //------------------------------------67033070  CEP
        $_SESSION['nomeEmp'] = "SOLOBASE ENGENHARIA LTDA";
        $_SESSION['endEmp'] = "ROD. BR-316 KM-8 TRAVESSA A ED. ANTÔNIO GONÇALVES II Nº10 3º ANDAR, ANANINDEUA/PA";
        $_SESSION['bairroEmp'] = "CENTRO";
        $_SESSION['fonefaxEmp'] = "Telefone:(91)3353-0687 Celular:(91)8419-5769";
        $_SESSION['fonefaxSolobaseEmp'] = "Telefone:(91)3353-0687 Celular:(91)8419-5769";
        $_SESSION['compradorEmp'] = "IVÓDIO VEIGA";
        $_SESSION['emailEmp'] = "acropolesolo@ig.com.br";
        $_SESSION['logoEmp'] = "solobaseLogo.jpg";
        $_SESSION['cnpjEmp'] = "00.768.783/0001-58";
        $_SESSION['inscriEstEmp'] = "15.184.640-5";
    }else if($empresa == 1){//acropole
        $_SESSION['nomeEmp'] = "ACRÓPOLE CONSTRUÇÕES CIVIS E ARQUITETURA LTDA";
        $_SESSION['endEmp'] = "TRAVESSA CASTELO BRANCO, Nº1711, BELÉM/PA";
        $_SESSION['bairroEmp'] = "SÃO BRAZ";
        $_SESSION['fonefaxEmp'] = "Telefone:(91)3249-7933 Celular:(91)8857-6655";
        $_SESSION['fonefaxSolobaseEmp'] = "Telefone:(91)3353-0687 Celular:(91)8419-5769";
        $_SESSION['compradorEmp'] = "IVÓDIO VEIGA";
        $_SESSION['emailEmp'] = "acropolesolo@ig.com.br";
        $_SESSION['logoEmp'] = "acropoleLogo.jpg";
        $_SESSION['cnpjEmp'] = "04.551.271/0001-96";
        $_SESSION['inscriEstEmp'] = "15.090.158-5";
    }else{
        $config->ConfirmaOperacao($config->GetPaginaPrincipal(), "Sem empresa selecionada!");;
    }
    
    header("location: admin.frm.php");
    exit;
} else {
    $config->ConfirmaOperacao($config->GetPaginaPrincipal(), $msg);;
}

//$config = new clsConfig();
//$config->Logout(false);
//$config->ConfirmaOperacao($config->GetPaginaPrincipal(), $msg);
?>
