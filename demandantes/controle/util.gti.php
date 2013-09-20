<?php

/**
 *
 * Classe que efetua processos generalizados
 *
 * ------------------------------------------------------------
 *
 *     CLASSE PARA UTILIDADES EM GERAL
 *        Propriedade da GTI - Criacao: 11/02/2009
 *
*/

class gtiUtil
{
	//construtor
	function __Construct()
    {
	}
	
	//METODO QUE GERA UM REGISTRO UNICO PARA UTILIZAÇÃO NA GERAÇÃO DOS REGISTROS DAS MANIFESTAÇÕES
	function GeraRegistroUnico()
	{
		$prefixo = 'S';
		$random = $prefixo;
		$random .= chr(rand(65,90));
		$random .= time();
		$random .= uniqid($prefixo);
		return $random;
	}
	
	function RetiraAcentos($texto)
	{
	  $trocarIsso = array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','O','Ù','Ü','Ú','Ÿ',);
	$porIsso = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','U','U','U','Y',);
	$titletext = str_replace($trocarIsso, $porIsso, $texto);
	return $titletext;
	} 
		
}


?>
