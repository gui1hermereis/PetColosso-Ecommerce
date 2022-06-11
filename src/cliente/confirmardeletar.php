<?php
    require_once '../sql/conexao.php';//Chama conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é cliente
    if ($email != '' && $adm == 0){  
    } else {
        header("Location: ../paginas/index.php"); //Redirecionamento se não for cliente  
    }

    $logado = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Deletar - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="header">
            <div class="container">
                <div class="navbar"></div>
                <!--Tradutor-->
                <?php include ('../includes/tradutor.php'); ?>
                    <div class="row">
                        <div class="col-2">
                            <h2>Tem certeza que deseja deletar a conta?</h2><br><br>

                            <a href="../sql/deletarconta.php" class="btn" title="Deletar conta">Deletar conta</a>
                            <a href="../cliente/alterardados.php" class="btn" title="Voltar">Voltar</a>
                        </div>
                        <div class="col-2">
                            <img src="../../images/imagem1.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Footer-->
        <?php include ('../includes/footer.php'); ?>

        <?php mysqli_close($conexao); //Fecha conexão com banco de dados ?>
    </body>
</html>