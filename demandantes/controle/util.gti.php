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
	
	//METODO QUE GERA UM REGISTRO UNICO PARA UTILIZA��O NA GERA��O DOS REGISTROS DAS MANIFESTA��ES
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
	  $trocarIsso = array('�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','O','�','�','�','�',);
	$porIsso = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','U','U','U','Y',);
	$titletext = str_replace($trocarIsso, $porIsso, $texto);
	return $titletext;
	} 
		
}


?>
