<?php

class gtiValidacao
{
	
	private $erro;
	private $mensagem;
	
	function gtiValidacao()
	{
		$this->erro = false;
		$this->mensagem = '<script type="text/javascript" language="javascript">alert("';
	}
	
	public function GetErro()
	{
		return $this->erro;
	}
	
	public function SetErro($value)
	{
		$this->erro = $value;
	}
	
	public function GetMensagem()
	{
		return $this->mensagem .'"); history.back(); </script>';
        }
  
	public function SetMensagem($value)
	{
		$this->mensagem = $value;
	}
	
	public function AddMensagem($value)
	{
		$this->mensagem .= $value;
	}
	
	public function ValidaTelefone($telefone, $campo)
	{
		$p1 = $telefone[0];
		$ddd = $telefone[1] . $telefone[2];
		$p2 = $telefone[3];
		$num1 = $telefone[5].$telefone[6].$telefone[7].$telefone[8];
		$traco = $telefone[9];
		$num2 = $telefone[10].$telefone[11].$telefone[12].$telefone[13];
		$tamanho_ddd = strlen($ddd);
		$tamanho_num1 = strlen($num1);
		$tamanho_num2 = strlen($num2);				
	
		echo "<br>P1: ".$p1;
		echo "<br>DDD: ".$ddd;
		echo "<br>P2: ".$p2;
		echo "<br>Num1: ".$num1;
		echo "<br>Tra�o: ".$traco;
		echo "<br>Num2: ".$num2;
		echo "<br>tam_ddd: ".$tamanho_ddd;
		echo "<br>tam_num1: ".$tamanho_num1;
		echo "<br>tam_num2: ".$tamanho_num2;		
		exit;
	
		if (!(($p1 == "(") and (is_numeric($ddd)==true) and ($p2 == ")") and (is_numeric($num1)==true) and ($traco == "-") and (is_numeric($num2))))
		{
			$this->erro = true;
			$this->mensagem .= '\n '.$campo.' Inv�lido!';
		}	
	}
	
	public function ValidaCampoNumerico($conteudo, $campo)
	{
		if (!(is_numeric($conteudo)))
		{
			$this->erro = true;
			$this->mensagem .= '\n \u00c9 necess\u00e1rio um n\u00famero no campo '.$campo.'!';
		}
	}
	
	public function ValidaCampoNumericoInteiro($conteudo, $campo)
	{
		if (!(is_numeric($conteudo)))
		{
			$this->erro = true;
			$this->mensagem .= '\n \u00c9 necess\u00e1rio um n\u00famero no campo '.$campo.'!';
		}
	}
	
	public function ValidaCampoRequerido($conteudo, $campo)
	{
		if (trim($conteudo)=="")
		{
			$this->erro = true;
			$this->mensagem .= '\n O campo '.$campo.' \u00e9 obrigat\u00f3rio!';
		}
	}
        public function ValidaRadioRequerido($conteudo, $campo)
	{
		if (trim($conteudo)=="")
		{
			$this->erro = true;
			$this->mensagem .= '\n Escolha um '.$campo.'';
		}
	}

	public function ValidaCampoRequerido_AvaliaTraco($conteudo, $campo)
	{
		if (trim($conteudo)=="" || trim($conteudo)=="-")
		{
			$this->erro = true;
			$this->mensagem .= '\n O campo '.$campo.' \u00e9 obrigat\u00f3rio!';
		}
	}
	
	public function ValidaNIS($pediu_isencao, $NIS)
	{
		if ($pediu_isencao==true)
		{
			if (trim($NIS)=="-")
			{
				$this->erro = true;
				$this->mensagem .= '\n Informe o numero do NIS!';
			}

			$tamanho_nis = strlen($NIS);
			if ($tamanho_nis != 11)
			{
				$this->erro = true;
				$this->mensagem .= '\n O NIS deve ter 11 caracteres!';
			}
		}
		else
		{
			if (trim($NIS)!="-")
			{
				$this->erro = true;
				$this->mensagem .= '\n Marque a caixa com a declara\xE7\xE3o de baixa renda ou retire o n\xFAmero do NIS!';
			}		
		}
	}

	
	public function ValidaMaiorZero($conteudo, $campo)
	{
		if (trim($conteudo)=="" or trim($conteudo<=0))
		{
			$this->erro = true;
			$this->mensagem .= '\n O campo '.$campo.' \u00e9 obrigat\u00f3rioe n\xE3o pode ser menor ou igual a zero!';
		}
	}
	
		
	/*
	* FUN��O PARA VALIDAR SE O COMBO FOI SELECIONADO
	* @AUTHOR = SILAS ANT�NIO CEREDA DA SILVA
	* 12/02/2009
	*/
	public function ValidaDPD($conteudo, $campo)
	{
		if (trim($conteudo)=="" or trim($conteudo)=="-- Selecione --")
		{
			$this->erro = true;
			$this->mensagem .= '\n O campo '.$campo.' \u00e9 obrigat\u00f3rio!';
		}
	}
	
	public function ComparaCaptcha($campo)
	{
		session_name('captcha');
		session_start();


		if(isset($_POST['txtSeguranca']))
		{
  			if( $_SESSION['palavra'] <> $_POST['txtSeguranca'])
  			{
  				$this->erro = true;
				$this->mensagem .= '\n O campo '.$campo.' n\u00e3o confere!';
  			}
		}	
	}
	
	public function ValidaComparacao($conteudo, $compara, $campo, $operador)
	{
		if (trim($operador)=="==")
		{
			if (trim($conteudo)==$compara)
			{
				$this->erro = true;
				$this->mensagem .= '\n O campo '.$campo.' n�o foi preenchido corretamente ou selecionado!';
			}
		}
		else
		{
			if (trim($conteudo)!=$compara)
			{
				$this->erro = true;
				$this->mensagem .= '\n O campo '.$campo.' n�o foi preenchido corretamente ou selecionado!';
			}
		}
	}
	
	public function ValidaSexo($conteudo)
	{
		if ($conteudo == "--selecione--")
		{
			$this->erro = true;
			$this->mensagem .= '\n Selecione alguma op��o no campo sexo!';
		}
	}
	
	public function ValidaCEP($cep)
	{
		if (!((is_numeric($cep)) and (strlen($cep) == 8)))
		{
			$this->erro = true;
			$this->mensagem .= '\n CEP inv\u00e1lido!';
		}
			if(($cep == '11111111') || ($cep == '22222222') ||
			   ($cep == '33333333') || ($cep == '44444444') ||
			   ($cep == '55555555') || ($cep == '66666666') ||
			   ($cep == '77777777') || ($cep == '88888888') ||
			   ($cep == '99999999') || ($cep == '00000000') ) 
			{
				$this->erro = true;
				$this->mensagem .= '\n CEP inv\u00e1lido!';
			}
	}
	
	
	/*
	* FUN��O PARA VALIDA��O DE CPF
	* MODIFICADA DIA 02/03/2009
	* POR SILAS ANT�NIO CEREDA DA SILVA	
	*/
	public function ValidaCPF($cpf)
	{
	// Verifica se � somente numeros
		if(!is_numeric($cpf)) {
  			$this->erro = true;
			$this->mensagem .= '\n CPF inv\u00e1lido, tente novamente!';
		}
		else 
		{
			if(($cpf == '11111111111') || ($cpf == '22222222222') ||
			   ($cpf == '33333333333') || ($cpf == '44444444444') ||
			   ($cpf == '55555555555') || ($cpf == '66666666666') ||
			   ($cpf == '77777777777') || ($cpf == '88888888888') ||
			   ($cpf == '99999999999') || ($cpf == '00000000000') ) 
			{
				$this->erro = true;
				$this->mensagem .= '\n CPF inv\u00e1lido, tente novamente!';
			}
			else
			{
			   $dv_informado = substr($cpf, 9,2);
			   for($i=0; $i<=8; $i++) {
			   $digito[$i] = substr($cpf, $i,1);
   			}

   			/*Verificando o valor do d�cimo d�gito de verifica��o*/

			$posicao = 10;
			$soma = 0;
			for($i=0; $i<=8; $i++) 
			{
				$soma = $soma + $digito[$i] * $posicao;
				$posicao = $posicao - 1;
			}
			$digito[9] = $soma % 11;
			if($digito[9] < 2) 
			{
				$digito[9] = 0;
			}
			else
			{
				$digito[9] = 11 - $digito[9];
			}

		   /*Verificando o valor do d�cimo primeiro d�gito de verifica��o*/
		
			$posicao = 11;
			$soma = 0;
		
			for ($i=0; $i<=9; $i++) 
			{
				$soma = $soma + $digito[$i] * $posicao;
				$posicao = $posicao - 1;
			}
				$digito[10] = $soma % 11;
				if ($digito[10] < 2)
				{
					$digito[10] = 0;
				}
				else
				{
				$digito[10] = 11 - $digito[10];
				}

  			/*Verificando se o d�gito verificador � igual ao informado pelo usu�rio*/

			$dv = $digito[9] * 10 + $digito[10];
			if ($dv != $dv_informado)
			{
				$this->erro = true;
				$this->mensagem .= '\n CPF inv\u00e1lido, tente novamente!';
			}
			
			}
		}
	}
	
	public function ValidaData($sData, $campo)
	{

		setlocale(LC_CTYPE,"pt_BR");
	
		if((trim($sData) == "") OR (strlen($sData) != 10))
		{
			$this->erro = true;
			$this->mensagem .= '\n Data '.$campo.' inv\u00e1lida!';			
		}
		else
		{
			if ($sData[2] == "/" )
			{
				$sData = str_replace('/','-',$sData);
			}
			
			list($d,$m,$a) = explode('-',$sData,3);			
			if(!checkdate($m,$d,$a))
			{
				$this->erro = true;
				$this->mensagem .= '\n Data '.$campo.' inv\u00e1lida!';
			}
		}
	}
	public function ValidaHora($sHora, $campo)
	{

		setlocale(LC_CTYPE,"pt_BR");

		if((trim($sHora) == "") OR (strlen($sHora) != 5))
		{
			$this->erro = true;
			$this->mensagem .= '\n Hora '.$campo.' inv\u00e1lida!';
		}
		else
		{
			list($h,$m) = explode(':',$sHora,2);
                        /* verificar se são números */
                        if($h[0] < '0' || $h[0] > '9' || $h[1] < '0' || $h[1] > '9' || $m[0] < '0' || $m[0] > '9' || $m[1] < '0' || $m[1] > '9')
			{
				$this->erro = true;
				$this->mensagem .= '\n Hora '.$campo.' inv\u00e1lida!';
			}
			if($h < 0 || $h > 23 || $m < 0 || $m > 59)
			{
				$this->erro = true;
				$this->mensagem .= '\n Hora '.$campo.' inv\u00e1lida!';
			}
		}
	}
	public function ValidaComparacaoData($data1, $data2, $operacao)
	{

		$data1 = strtotime($data1); 
		$data2 = strtotime($data2); 
	
		switch ($operacao)
		{
			//SELE��ES DE GRID----------------------------------------------
			case '>':
				if (!($data1 > $data2))
				{
					$this->erro = true;
					$this->mensagem .= '\n A data inicial deve ser maior que a final!';	
				}
			break;
			case '<':
				if (!($data1 < $data2))
				{
					$this->erro = true;
					$this->mensagem .= '\n A data inicial deve ser menor que a final!';	
				}
			break;
			case '==':
				if (!($data1 == $data2))
				{
					$this->erro = true;
					$this->mensagem .= '\n A data inicial deve ser igual a final!';	
				}
			break;
			case '!=':
				if (!($data1 != $data2))
				{
					$this->erro = true;
					$this->mensagem .= '\n A data inicial deve ser diferente da final!';	
				}
			break;
		}	
		
	}
	
	public function ValidaEscolaridade($escolaridade, $id_cargo)
	{
		switch ($id_cargo)
		{
			case 86: //Engenharia de Produ��o
				$opcao1 = '1'; //Gradua��o em Engenharia de Produ��o
				$opcao2 = '2'; //Gradua��o em Engenharia de Produ��o Mec�nica
				$opcao3 = '3'; //Gradua��o em Engenharia Civil com Mestrado e/ou Doutorado em Engenharia de Produ��o
				$opcao4 = '4'; //Gradua��o em Engenharia Mec�nica com Mestrado e/ou Doutorado em Engenharia de Produ��o
				$opcao5 = '5'; //Gradua��o em Engenharia Mecatr�nica com Mestrado e/ou Doutorado em Engenharia de Produ��o
				$opcao6 = '6'; //Gradua��o em Engenharia El�trica com Mestrado e/ou Doutorado em Engenharia de Produ��o
				if ($escolaridade!=$opcao1 && $escolaridade!=$opcao2 && $escolaridade!=$opcao3 && $escolaridade!=$opcao4 && $escolaridade!=$opcao5 && $escolaridade!=$opcao6)
				{
					$this->erro = true;
					$this->mensagem .= '\n Para o cargo escolhido, as op��es de escolaridade s�o: \n'.$opcao1.'\n'.$opcao2.'\n'.$opcao3.'\n'.$opcao4.'\n'.$opcao5.'\n'.$opcao6;
				}				
			break;
			
			case 87: //Administra��o				
				$opcao1 = '7'; //Bacharelado em Administra��o
				$opcao2 = '8'; //Tecnologia em Administra��o
				if ($escolaridade!=$opcao1 && $escolaridade!=$opcao2)
				{
					$this->erro = true;
					$this->mensagem .= '\n Para o cargo escolhido, as op��es de escolaridade s�o: \n'.$opcao1.'\n'.$opcao2;
				}
			break;
			
			case 88: //Estat�stica
				$opcao1 = '9'; //Licenciatura Plena em Estat�stica
				$opcao2 = '10'; //Bacharelado em Estat�stica
				$opcao3 = '11'; //Licenciatura Plena em Matem�tica
				$opcao4 = '12'; //Bacharelado em Matem�tica
				$opcao5 = '13'; //Gradua��o em Agronomia com Mestrado e/ou Doutorado em Estat�stica ou Estat�stica Aplicada
				$opcao6 = '14'; //Gradua��o em qualquer Engenharia com Mestrado e/ou Doutorado em Estat�stica ou Estat�stica Aplicada
				if ($escolaridade!=$opcao1 && $escolaridade!=$opcao2 && $escolaridade!=$opcao3 && $escolaridade!=$opcao4 && $escolaridade!=$opcao5 && $escolaridade!=$opcao6)
				{
					$this->erro = true;
					$this->mensagem .= '\n Para o cargo escolhido, as op��es de escolaridade s�o: \n'.$opcao1.'\n'.$opcao2.'\n'.$opcao3.'\n'.$opcao4.'\n'.$opcao5.'\n'.$opcao6;
				}				
			break;						
		}
	}	

	function VerificaTextoEscolaridade($texto_escolaridade)
	{
		$con = new gtiConexao();
		$con->gtiConecta();

		$sql="select count(*) from public.escolaridade where texto_escolaridade='".$texto_escolaridade."';";		
		$tbl = $con->gtiPreencheTabela($sql);
		$con->gtiDesconecta();		

		$this->erro = false;

		foreach($tbl as $chave => $linha)
		{
			if ($linha['count']==1)
			{
				$this->erro = true;
				$this->mensagem .= '\n Esta escolaridade j� est� cadastrada!';
			}
		}
	}

        public function ValidaDeficiente($necessita_atendimento_especial, $atendimento_especial)
	{
		if ($necessita_atendimento_especial==true)
		{
			if (trim($atendimento_especial)=="-")
			{
				$this->erro = true;
				$this->mensagem .= '\n Informe o tipo de atendimento que voc\xEA necessita!';
			}
		}
		else
		{
			if (trim($atendimento_especial)!="-")
			{
				$this->erro = true;
				$this->mensagem .= '\n Marque a op\xE7\xE3o que voc\xEA necessita de atendimento especial ou retire o atendimento especial!';
			}
		}
	}
         public function ValidaClassificacao($tabela, $tamanho)
         {
             for($i = 0; $i < $tamanho-1; $i++){
                 if($tabela[$i][1] > $tabela[$i+1][1]){
                     $aux = $tabela[$i+1][1];
                     $j = $i;
                     while($j >= 0 && $aux < $tabela[$j][1] ){
                         $tabela[$j+1][1] = $tabela[$j][1];
                         $tabela[$j][1] = $aux;
                         $j--;
                     }
                 }
             }
             for($i = 0; $i < $tamanho-1; $i++){
                 if($tabela[$i][1] == $tabela[$i+1][1] && $tabela[$i][1]!= 0){
                    $this->erro = true;
		    $this->mensagem .= '\n Existem classifica\xE7\xF5es iguais!';
                    break;
                 }
             }
         }

         public function ValidaNomeado($nomeado, $posse, $observacao)
	{
		if (($nomeado=='false' || $nomeado == NULL )&& $posse == 'true')
		{
			$this->erro = true;
			$this->mensagem .= '\n Dados de nomea\xE7\xE3o e posse inv\u00e1lidos!';
		}
                if ($nomeado == 'false' && trim($observacao) == "")
		{
			$this->erro = true;
			$this->mensagem .= '\n Especifique o motivo do candidato n\xE3o ser nomeado em \"Observa\xE7\xE3o\"!';
		}
		
                
	}
}



?>