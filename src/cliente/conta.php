<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();
    
    //Verifica a sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é cliente
    if ($email != '' && $adm == 0){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não for cliente
    }
    
    $logado = $_SESSION['usuario'];
    $nome = $_SESSION['nome'];
?>

<!DOCTYPE html> 
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Conta - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        <link rel="stylesheet" type="text/css" href="../../css/carousel.css">

        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="header">
            <div class="container">
                <div class="navbar">
                    <!--Tradutor-->
                    <?php include ('../includes/tradutor.php'); ?>
                    <!--Menu-->
                    <?php include ('../includes/menu.php'); ?>
                    <a href="../sql/sair.php" class="btn" title="Sair">Sair</a>
                </div>
                <div class="row">
                    <div class="col-2">
                        <?php echo "<h2>Bem vindo, $nome!</h2>"; ?>
                    </div>
                    <div class="col-2">
                        <img src="../../images/imagem1.png">
                    </div><br><br><br><br>

                    <a href="../cliente/consultardados.php" class="btn" title="Consultar dados">Consultar dados</a>
                    <a href="../cliente/meuspedidos.php" class="btn" title="Meus pedidos">Meus pedidos</a>
                </div><br><br>
            </div>
        </div>
       
        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                                              

        <?php mysqli_close($conexao); //Fecha a conexão com o banco de dados ?>
    </body>
</html>