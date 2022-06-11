<?php
    require_once '../sql/conexao.php'; // Chama a conexão.
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é administrador
    if ($email != '' && $adm == 1){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não for administrador  
    }

    //Realiza a busca dos produto do banco de dados pelo id 
    if(!empty($_GET['id_prod'])){
        $id = $_GET['id_prod'];
        $sqlSelect = "SELECT * FROM produtos WHERE id_prod=$id";
        $result = $conexao->query($sqlSelect);
        //Dados do produto
        while($user_data = mysqli_fetch_assoc($result)){
            $produto = $user_data['prod_nome'];
            $valor = $user_data['prod_valor'];
            $image = $user_data['prod_imagem'];
            $estoque = $user_data['prod_estoque'];
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar produto - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>

        <!--Insere dados do produto para alterar-->
        <h3 class="title">Dados do Produto a ser alterado</h3>
       
        <div class="prod">
            <form action="../sql/editarprodsql.php" method="POST" enctype="multipart/form-data">
                <center>
                    
                    <?php
                        //Mensagem de erro
                        if(isset($_SESSION['erro'])){
                            echo $_SESSION['erro'];
                            unset($_SESSION['erro']);
                        }
                    ?>

                    <p>Codigo produto:</p>
                    <input type="text" name="id_prod" disabled value=<?php echo $id;?> ><br>
                    <p>Produto:</p>
                    <input type="text" name="produto" placeholder="Produto" minlength="29" maxlength="51" required value="<?php echo $produto ?>" ><br>
                    <p>Valor:</p>
                    <input type="text" name="valor" placeholder="Valor" required value="<?php echo $valor ?>"><br>
                    <p>Estoque:</p>
                    <input type="number" name="estoque" required value=<?php echo $estoque;?>><br>
                    <p>Imagem:</p><br>
                    <div><img src="../../images/produtos/<?php echo $image; ?>"widht="200px" height="200px"></div> 
                    <input type="file" name="arquivo" required ><br><br>    
                    <input type="hidden" name="id_prod" required value=<?php echo $id;?>>
                    <div class="dados">
                        <button type="submit" name="submit" class="btn" title="Enviar">Enviar</button>
                    </div>
                </center>
            </form><br>
        </div>
        &nbsp;&nbsp;&nbsp;
        <a href="../administrador/produtosadm.php" class="btn" title="Voltar">Voltar</a>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                                             

        <?php mysqli_close($conexao); //Fecha a conexão com o banco de dados?>
    </body>
</html>