<?php
session_start();
$pagina = $_GET['pagina'];
$mensagem = $_GET['mensagem'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="shortcut icon" href="../imagens/_favicon.ico" />
        <title>CONFIRMA&Ccedil;&Atilde;O</title>    
    </head>
    <body>

        <table align="center" cellpadding="0" cellspacing="0" class="style11">
            <tr>
                <td style="text-align: center">
                    <br />
                    <b>
                        <?php
                        echo htmlentities($mensagem);
                        ?>
                    </b>
                    <br />
                    <br />
                    <img alt="" src="../imagens/back.png" style="width: 17px; height: 16px" /><br />
                    <b>
                        <a href="../<?php echo $pagina; ?>">
                            VOLTAR</a>
                    </b></td>
            </tr>
        </table>

    </body>
</html>
<?php
if (isset($_SESSION['voltaPaginaTempo'])) {
    if ($_SESSION['voltaPaginaTempo'] == 1) {
        ?>
        <meta http-equiv = "refresh" content = "0.2;URL=notafiscalfinanceiro_alteracao.frm.php">
            <?php
            unset($_SESSION['voltaPaginaTempo']);
        } else if ($_SESSION['voltaPaginaTempo'] == 2) {
            ?>
            <meta http-equiv = "refresh" content = "0.2;URL=fornecedor_alteracao.frm.php">
                <?php
                unset($_SESSION['voltaPaginaTempo']);
            } else {
                unset($_SESSION['voltaPaginaTempo']);
            }
        }
        ?>
