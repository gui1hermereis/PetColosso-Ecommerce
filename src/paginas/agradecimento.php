<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();

    //Verifica a sessão 
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se esta logado, se não estiver proibe a entrada na pagina
    if ($email != '' && $adm >= 0){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não estiver logado
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agradecimento - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="header">
            <div class="navbar"></div>
            <div class="container">
                <!--Tradutor-->
                <?php include ('../includes/tradutor.php'); ?>
                <div class="row">
                    <div class="col-2">
                        <h2>Obrigado por comprar em nosso site!!</h2>
                        <a href="../cliente/conta.php" class="btn">Minha conta</a>
                        <a href="../paginas/enquete.php" class="btn">Avaliar o site</a>
                    </div>
                    <div class="col-2">
                        <img src="../../images/imagem1.png">
                    </div>
                </div>
            </div>
        </div>

        <!--Footer-->
        <?php include ('../includes/footer.php'); ?>

        <!--Fecha a conexão com o banco de dados-->
        <?php mysqli_close($conexao); ?>
    </body>
</html>