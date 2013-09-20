<?php

class clsSmtpMail {

    private $notificacao_enviada;

    //propriedade NOTIFICACAO_ENVIADA
    public function SetNotificacaoEnviada($value) {
        $this->notificacao_enviada = $value;
    }

    public function GetNotificacaoEnviada() {
        return $this->notificacao_enviada;
    }

    function EnviaEmailSmtp($assunto, $email_destinatario, $nome_destinatario, $texto_email) {
        require_once "phpmailer/class.phpmailer.php";
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "recepta@ifmg.edu.br";
        $mail->Password = "receptaifmg";
        $mail->From = "recepta@ifmg.edu.br";
        $mail->FromName = "RECEPTA";
        $mail->Subject = $assunto;

        $html = "<strong>" . $texto_email . "</strong>";
        $texto = $texto_email;

        $mail->Body = $html;
        $mail->AltBody = $texto;
        $mail->AddAddress($email_destinatario, $nome_destinatario);

        if (!$mail->Send()) {
            $this->notificacao_enviada = false;
        } else {
            $this->notificacao_enviada = true;
        }
    }

    function GeraSenhaTemporaria() {


        $senha = null;
        //$letras = 'abcdefghijklmnopqrstvuwxyzabcdefghijklmnopqrstvuwxyzabcdefghijklmnopqrstvuwxyzabcdefghijklmnopqrstvuwxyz';
        $numeros = '012345678901234567890123456789';
        //$especiais = '!@#$%&*?/!@#$%&*?/!@#$%&*?/!@#$%&*?/!@#$%&*?/';
        $especiais = '';
        $max_letras = strlen($letras) - 1;
        $max_numeros = strlen($numeros) - 1;
        $max_especiais = strlen(especiais) - 1;
        for ($i = 0; $i < 3; $i++) {
            //$senha .= $letras[mt_rand(0, $max_letras)];
            $senha .= $numeros[mt_rand(0, $max_numeros)];
            //$senha .= $especiais[mt_rand(0, $max_especiais)];
        }
        //for ($i = 0; $i < 2; $i++) {
            //$senha .= $letras[mt_rand(0, $max_letras)];
        //}
        for ($i = 0; $i < 3; $i++) {
            $senha .= $numeros[mt_rand(0, $max_numeros)];
        }
        return $senha;
    }

    function AlteraSenha($cpf, $senha) {

        $SQL = "UPDATE candidato SET
        senha=md5('" . $senha . "'), temporario = 1
        WHERE
        cpf='" . $cpf . "'";

        $con = new gtiConexao();
        $con->gtiConecta();
        $con->gtiExecutaSQL($SQL);
        $con->gtiDesconecta();
    }

    function VerificaSenhaCadastrado($cpf) {
        $SQL = "SELECT senha
		FROM candidato
		WHERE cpf='" . $cpf . "';";

        $con = new gtiConexao();
        $con->gtiConecta();
        $tbl = $con->gtiPreencheTabela($SQL);
        $con->gtiDesconecta();

        foreach ($tbl as $chave => $linha) {
            return($linha['senha']);
        }
    }

    function validarEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return false;
        return true;
    }

    /*  VERSÃO PHP 5.3.0 - incompatível
        function validarEmail($email) {
        $domain = explode('@', $email);
        $domain = $domain[1];


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            if (!(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A"))) {

                return false;
            } else {
                return true;
            }
        }
    }

    */
}

?>