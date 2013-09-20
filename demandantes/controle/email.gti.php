<?php

class gtiMail
{
    private $parts;
    
    /*
     * Método construtor
     */
    function __construct()
    {
        $this->parts = array();
        $this->boundary = md5(time());
    }
    
    /*
     * Adiciona Texto
     */
    function AdicionarTexto($body)
    {
        $body = stripslashes($body);
        $msg = $body;
        
        $this->parts[] = $msg;
    }
    
    /*
     * Adiciona Imagem
     */
    function AdicionarPng($arquivo, $download)
    {
        $fd=fopen($arquivo, 'rb');
        $contents=fread($fd, filesize($arquivo));
        $contents=chunk_split(base64_encode($contents),68,"n");
        fclose($fd);
        
        $msg  = "--{$this->mime_boundary}n";
        $msg .= "Content-Type: image/png; name={$download}n";
        $msg .= "Content-Transfer-Encoding: base64n";
        $msg .= "Content-Disposition: attachment; filename={$download}nn";
        $msg .= "{$contents}";
        
        $this->parts[] = $msg;
    }
    
    /*
     * Envia Email
     */
    function Enviar($de, $para, $assunto, $nome_remetente)
    {
       
        $msg = implode("n", $this->parts);
        
        mail($para, $assunto, $msg, "From: $nome_remetente\nContent-Type: text/html; charset=iso-8859-1");
    }
}

?>
