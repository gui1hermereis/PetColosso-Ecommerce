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
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Produto - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>

        <!--Formulario para o administrador cadastrar novos produtos-->
        <div class="prod">
            <form action="../sql/cadastroprodsql.php" method="POST" enctype="multipart/form-data">
                <center>
                    <?php
                        //Mensagem de erro
                        if(isset($_SESSION['erro'])){
                            echo $_SESSION['erro'];
                            unset($_SESSION['erro']);
                        }
                    ?>
                <h3 class="title">Cadastrar produto</h3>
                    <input type="text" name="produto" placeholder="Produto" required minlength="29" maxlength="51"><br>
                    <input type="number" name="valor" placeholder="Valor" min=0 required><br>
                    <input type="number" name="estoque" placeholder="Estoque" min=0 required><br>
                    <input type="file" name="arquivo" placeholder="Imagem" required><br>
                    <div class="dados">
                        <button type="submit" name="submit" class="btn" title="Enviar">Enviar</button>
                    </div>
                </center>
            </form>
        </div>
        &nbsp;&nbsp;&nbsp;
        <a href="../administrador/produtosadm.php" class="btn" title="Voltar">Voltar</a>

        <!--Footer-->
        <?php include ('../includes/footer.php'); ?>

        <?php mysqli_close($conexao); //Fecha conexão com banco de dados ?>
    </body>
</html>