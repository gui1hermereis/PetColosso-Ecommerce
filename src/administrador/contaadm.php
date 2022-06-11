<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é administrador
    if ($email != '' && $adm == 1){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não for administrador
    }

    $logado = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Conta administrador - Pet Colosso</title>
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
                        
                    <?php
                        echo "<h2>Bem vindo, $logado!</h2>";
                    ?>
                    </div>
                    <div class="col-2">
                        <img src="../../images/imagem1.png">
                    </div><br><br>

                    <!--Funções do administrador-->
                    <a href="../administrador/administrador.php" class="btn" title="Clientes">Clientes</a>
                    <a href="../administrador/produtosadm.php" class="btn" title="Produtos">Produtos</a>
                    <a href="../administrador/pedidosadm.php" class="btn" title="Pedidos">Pedidos</a>
                    <a href="../administrador/enqueteadm.php" class="btn" title="Resultados enquete">Resultados enquete</a>
                </div>
            </div><br><br>
        </div>
        
        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?> 
    </body>
</html>