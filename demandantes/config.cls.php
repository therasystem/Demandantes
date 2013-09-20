<?php

class clsConfig {

    private $app_raiz;
    private $app_biblioteca;
    private $app_controle;
    private $app_js;
    private $app_modelo;
    private $app_visao;
    private $app_imagens;
    private $app_estilos;
    private $email_recurso;
    //configuracoes bd
    private $m_host;
    private $m_usuario;
    private $m_senha;
    private $m_esquema;
    private $m_driver;

    function clsConfig() {

        /*
          //dados do banco Servidor
          $this->m_driver = 'mysql';
          $this->m_esquema = 'solobase_compras';
          $this->m_host = 'localhost';
          $this->m_usuario = 'solobase_root';
          $this->m_senha = 'mysql';
          // */

        $this->m_driver = 'mysql';
        $this->m_esquema = 'demandantes';
        $this->m_host = 'localhost';
        $this->m_usuario = 'root';
        $this->m_senha = 'mysql';
    }

    public function getEmail_recurso() {
        return $this->email_recurso;
    }

    public function GetRaiz() {
        return $this->app_raiz;
    }

    public function GetHost() {
        return $this->m_host;
    }

    public function GetUsuario() {
        return $this->m_usuario;
    }

    public function GetSenha() {
        return $this->m_senha;
    }

    public function GetEsquema() {
        return $this->m_esquema;
    }

    public function GetDriver() {
        return $this->m_driver;
    }

    public function GetPaginaPrincipal() {
        return "index.php";
    }

    public function GetPaginaMenu() {
        return "visao/admin.frm.php";
    }

    public function GetPaginaConfirmacao() {
        return "confirmacao.frm.php";
    }

    public function GetPaginaConfirmacaoIr() {
        return "confirmacao_ir.frm.php";
    }

    public function ConfirmaOperacao($volta, $mensagem) {
        //die('location:' . $this->GetPaginaConfirmacao() . '?pagina=' . $volta . '&mensagem=' . $mensagem);
        header('location:' . $this->GetPaginaConfirmacao() . '?pagina=' . $volta . '&mensagem=' . $mensagem);
    }

    public function ConfirmaOperacaoTempoVolta($volta, $mensagem, $tempoVolta) {
        session_start();
        $_SESSION['voltaPaginaTempo'] = $tempoVolta;
        //die('location:' . $this->GetPaginaConfirmacao() . '?pagina=' . $volta . '&mensagem=' . $mensagem);
        header('location:' . $this->GetPaginaConfirmacao() . '?pagina=' . $volta . '&mensagem=' . $mensagem);
    }

    public function ConfirmaOperacaoIr($volta, $mensagem) {
        header('location:' . $this->GetPaginaConfirmacaoIr() . '?pagina=' . $volta . '&mensagem=' . $mensagem);
    }

    public function Logout($redireciona) {
        ob_start();
        //Erro tela Login abaixo
        //session_start();
        //DESTR I AS SESSOES
        $_SESSION['codigo'] = array();
        unset($_SESSION['codigo']);
        $_SESSION['usuarioNome'] = "";
        unset($_SESSION['usuarioNome']);
        $_SESSION['permissao'] = "";
        unset($_SESSION['permissao']);


        //REDIRECIONA PARA A TELA DE LOGIN
        if ($redireciona == true) {
            Header('Location:' . $this->GetPaginaPrincipal());
        }
    }

}

?>