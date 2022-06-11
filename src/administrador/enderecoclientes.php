<?php
    require_once '../sql/conexao.php'; // Chama a conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é administrador
    if ($email != '' && $adm == 1){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não for administradot
    }

    $logado = $_SESSION["email"];

    //Realiza a busca do endereço do cliente apartir do id do cliente
    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM clientes WHERE id_cliente=$id";
        $result = $conexao->query($sqlSelect);
        while($user_data = mysqli_fetch_assoc($result)){
            //Dados do endereco
            $cep = $user_data['cli_cep'];
            $complemento = $user_data['cli_compl'];
            $numero = $user_data['cli_numcasa'];
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> endereço clientes - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>

        <!--Dados do endereço-->
        <center>
        <div class="formulario">
            <h3 class="title">Dados do endereço</h3>
                <p>CEP: </p>
                <input type="text" readonly placeholder="Não cadastrado" value="<?php echo $cep ?>"><br><br>
                
                <p>complemento: </p>
                <input type="text" readonly placeholder="Não cadastrado" value="<?php echo $complemento ?>"><br><br>
                
                <p>Numero: </p>
                <input type="text" readonly placeholder="Não cadastrado" value="<?php echo $numero ?>"><br><br>
            </center>
        </div>
        
        &nbsp;&nbsp;&nbsp;
        <a href="../administrador/administrador.php" class="btn" title="Voltar">Voltar</a>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                                     

        <?php mysqli_close($conexao); //Fecha a conexão com o banco de dados ?>
    </body>
</html>