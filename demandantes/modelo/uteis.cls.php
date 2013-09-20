<?php

/**
* Classe com fun��es �teis e gen�ricas, ou seja, que ser�o usados em v�rias telas
* @autor M�rcio Teodoro Dias
* @version 1.0
* since 19/07/2010
* Cria��o da classe
**/

class clsUteis
{

	// M�todo para transformar strings em Mai�scula ou Min�scula com acentos
	// $convertido = a string propriamente dita
	// $tc = tipo da convers�o: 1 para mai�sculas e 0 para min�sculas
	function Converte_Mai_ou_Min_com_acentos($para_converter, $tc)
	{
		if ($tc == "1") $convertido = strtr(strtoupper($para_converter),"������������������������������","������������������������������");
		elseif ($tc == "0") $convertido = strtr(strtolower($para_converter),"������������������������������","������������������������������");
		return $convertido;
	}
	
	function RetiraAcentos($texto)
	{
	  $trocarIsso = array('�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','O','�','�','�','�',);
	$porIsso = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','0','U','U','U','Y',);
	$titletext = str_replace($trocarIsso, $porIsso, $texto);
	return $titletext;
	} 	

	// M�todo para garantir que o cpf ser� mostrado com 11 d�gitos
	function CPF_11_digitos($cpf)
	{
	
		$tamanho = strlen($cpf);
		
		while ($tamanho < "11")
		{
			$cpf = '0'.$cpf;
			$tamanho = strlen($cpf);
		}

		
		return $cpf;
	}

	public function GeraNumeroAleatorio()
	{
		$num = rand(1000, 9999); //Gera um n�mero aleat�rio entre 1000 e 9999. Coloquei esses valores para garantir que o n�mero gerado ter� 4 caracteres.
		return $num;
	}

        public function ExibirCaixaDeAlerta($texto)
        {
            echo '<script type="text/javascript" language="javascript">alert("'.$texto.'");</script>';
        }

        public function ExibirCaixaDeAlerta_e_VoltarPaginaAnterior($texto)
        {
            echo '<script type="text/javascript" language="javascript">alert("'.$texto.'"); history.back();</script>';
        }

        public function RetornaNumOcorrenciasDeUmCaracter($texto,$caracter)
        {
            $array_texto = str_split($texto);
            $num_ocorrencias = 0;
            $cont = 0;
            foreach ($array_texto as $linha)
            {
                if($array_texto[$cont]==$caracter)
                {
                    $num_ocorrencias++;
                }
                $cont++;
            }
            return $num_ocorrencias;
        }

        public function ListaComboSimNao()
        {
            $drop = "<option value='S'>Sim</option>";
            $drop .= "<option value='N' selected='selected'>N&atilde;o</option>";

            return $drop;
        }

        public function ListaComboSimNaoComParametro($valor)
        {
            switch ($valor)
            {
                case 'S':
                    $drop = "<option value='S' selected='selected'>Sim</option>";
                    $drop .= "<option value='N'>N&atilde;o</option>";
                break;

                case 'N':
                    $drop = "<option value='S'>Sim</option>";
                    $drop .= "<option value='N' selected='selected'>N&atilde;o</option>";
                break;

            }

            return $drop;
        }

        public function ConverteSimNao($valor)
        {

            switch ($valor)
            {
                case 'S':
                    $valor_convertido = "Sim";
                break;
                case 'N':
                    $valor_convertido = "N&atilde;o";
                break;
                case 'Sim':
                    $valor_convertido = "S";
                break;
                case 'N&atilde;o':
                    $valor_convertido = "N";
                break;
            }

            return $valor_convertido;
        }

    public function ListaComboSiglaSexo()
    {
        $drop = "<option value='' selected='selected'>Selecione</option>";
        $drop .= "<option value='M'>M</option>";
        $drop .= "<option value='F'>F</option>";

	return $drop;
    }

    public function ListaComboSiglaSexoComParametro($valor)
    {
        switch ($valor)
        {
            case 'M':
                $drop = "<option value='M' selected='selected'>M</option>";
                $drop .= "<option value='F'>F</option>";
            break;

            case 'F':
                $drop = "<option value='M'>M</option>";
                $drop .= "<option value='F' selected='selected'>F</option>";
            break;

        }

	return $drop;
    }

    public function ListaComboAtivoInativoComParametro($valor)
    {
        switch ($valor)
        {
            case 'A':
                $drop = "<option value='A' selected='selected'>Ativo</option>";
                $drop .= "<option value='I'>Inativo</option>";
            break;

            case 'I':
                $drop = "<option value='I' selected='selected'>Inativo</option>";
                $drop .= "<option value='A'>Ativo</option>";
            break;
        }

	return $drop;
    }

    public function ListaComboAtivaInativaComParametro($valor)
    {
        switch ($valor)
        {
            case 'A':
                $drop = "<option value='A' selected='selected'>Ativa</option>";
                $drop .= "<option value='I'>Inativa</option>";
            break;

            case 'I':
                $drop = "<option value='I' selected='selected'>Inativa</option>";
                $drop .= "<option value='A'>Ativa</option>";
            break;
        }

	return $drop;
    }

    public function ListaComboSiglaEstados()
    {
        $drop = '<option value="AC">AC</option>
                 <option value="AL">AL</option>
                 <option value="AM<">AM</option>
                 <option value="AP">AP</option>
                 <option value="BA">BA</option>
                 <option value="CE">CE</option>
                 <option value="DF">DF</option>
                 <option value="ES">ES</option>
                 <option value="GO">GO</option>
                 <option value="MA">MA</option>
                 <option value="MG">MG</option>
                 <option value="MT">MS</option>
                 <option value="MT">MT</option>
                 <option value="PA">PA</option>
                 <option value="PB">PB</option>
                 <option value="PE">PE</option>
                 <option value="PI">PI</option>
                 <option value="PR">PR</option>
                 <option value="RJ">RJ</option>
                 <option value="RN">RN</option>
                 <option value="RO">RO</option>
                 <option value="RR">RR</option>
                 <option value="RS">RS</option>
                 <option value="SC">SC</option>
                 <option value="SE">SE</option>
                 <option value="SP">SP</option>
                 <option value="TO">TO</option>';

	return $drop;
    }

    public function ConverteNumeroFormatoAmericano($valor)
    {
        //Pra chegar ao banco de dados, tem que estar no formato americano, ou seja com o ponto separando as casas decimais
        //Verifica se s� tem v�rgula, se s� ponto ou se tem os dois
        $num_pontos = substr_count($valor,".");
        $num_virgulas = substr_count($valor,",");

        if ($num_virgulas==1)
        {
            if ($num_pontos==1)
            {
                //Se tiver os dois, � preciso eliminar o ponto e substituir a v�rgula digitada por um ponto
                $valor_convertido = str_replace(".", "", $valor);
                $valor_convertido = str_replace(",", ".", $valor_convertido);
            }
            else
            {
                //Se tem uma v�rgula, � preciso substituir por ponto
                $valor_convertido = str_replace(",", ".", $valor);
            }
        }
        else
        {
            //Se n�o tem v�rgula, n�o precisa fazer nenhum tratamento
            $valor_convertido = $valor;
        }

        return $valor_convertido;
    }
	
    public function ConverteNumeroFormatoBrasileiro($valor)
    {
        //Para exibir na tela o n�mero que est� no banco de dados no formato americano.
        //Verifica se s� tem v�rgula, se s� ponto ou se tem os dois
        $num_pontos = substr_count($valor,".");

        if ($num_pontos==1)
        {
			//Substitui o ponto por uma v�rgula
            $valor = str_replace(".", ",", $valor);
        }

        return $valor;
    }	

}
?>