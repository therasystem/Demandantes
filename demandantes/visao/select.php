<?
require_once("../controle/conexao.gti.php");

$cod = $_GET['cod'];


$sql = "SELECT cc1.idcentro AS id, CONCAT(cc1.desccentro,' ( ', cc.desccentro,' ) ')   AS nome, cc1.desccentro AS nome1
                FROM centro_custo cc
                RIGHT JOIN centro_custo cc1
                ON cc.idcentro = cc1.idrelaciona
                WHERE idobra =" . $cod . "
                ORDER BY cc1.idrelaciona";
//die('aaaaaaaaaaaaaaaaaa'.$sql);

$con = new gtiConexao();
$con->gtiConecta();
$tbl = $con->gtiPreencheTabela($sql);
$con->gtiDesconecta();
?>
<select name="relatcentrocusto" id="relatcentrocusto">
    <?
    foreach ($tbl as $chave => $linha) {

        if ($linha['nome'] == null) {
            $nome = $linha['nome1'];
        } else {
            $nome = $linha['nome'];
        }
        ?>
        <option value="<? echo $linha['id'] ?>"><? echo $nome ?></option>
    <? } ?>
</select>