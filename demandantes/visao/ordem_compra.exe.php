<?php

require_once("../config.cls.php");
require_once("../modelo/ordem_compra.cls.php");
require_once("../modelo/compra.cls.php");
require_once("../biblioteca/dompdf/dompdf_config.inc.php");

session_start();

$compra = new clsCompra();

// SALVAR
extract($_POST, EXTR_PREFIX_SAME, "wddx");

$compra->updateNumOrdemCompra($IDCOMPRA);

//die('aki');
clsOrdemCompra::setIdcompra($IDCOMPRA);
clsOrdemCompra::setNome($NOME);
clsOrdemCompra::setContato($CONTATO);
clsOrdemCompra::setFax($FAX);
clsOrdemCompra::setCel($CEL);
clsOrdemCompra::setEntrega($ENTREGA);
clsOrdemCompra::setPagamento($PAGAMENTO);
clsOrdemCompra::setFrete($FRETE);
clsOrdemCompra::setDesconto($DESCONTO);

$_SESSION['html'] = $compra->OrdemCompra();

//$pdf->WriteHTML2($_SESSION['html']);
echo($_SESSION['html']);  

$titulo = $NOME.'_'.$IDCOMPRA.'_'.  rand(0, 99999999999).'.pdf';
$compra->insereArquivo($titulo);

$dompdf = new DOMPDF();
$dompdf->set_paper("legal", "landscape"); // Altera o papel para modo paisagem.
$dompdf->load_html($_SESSION['html']); // Carrega o HTML para a classe.
$dompdf->render();
$pdf = $dompdf->output(); // Cria o pdf
$arquivo = "../arquivos/" . $titulo; // Caminho onde será salvo o arquivo.
if (file_put_contents($arquivo, $pdf)) { //Tenta salvar o pdf gerado
    return true; // Salvo com sucesso.
} else {
    return false; // Erro ao salvar o arquivo
}
//die($_SESSION['html']);
//die($compra->OrdemCompra());
//header('location:ordem_compra_alteracao.frm.php?nomecompara=vazio&metodo=-1&idcompra=' . $IDCOMPRA);
?>