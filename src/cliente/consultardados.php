<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();

    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é cliente
    if ($email != '' && $adm == 0){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não for cliente 
    }

    $logado = $_SESSION["usuario"];

    //Realiza a busca no banco de dados as informações do cliente
    $sqlSelect = "SELECT * FROM clientes WHERE id_usuario = '$logado'";
    $result = $conexao->query($sqlSelect);{
        while($user_data = mysqli_fetch_assoc($result)){//Dados do cliente
            $nome = $user_data['cli_nome'];
            $email = $user_data['cli_email'];
            $celular = $user_data['cli_cel'];
            $cpf = $user_data['cli_cpf'];
            $cep = $user_data['cli_cep'];
            $numero = $user_data['cli_numcasa'];
            $complemento = $user_data['cli_compl'];
            $usuario = $user_data['id_usuario'];
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Consultar dados - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?><br><br>

        <!--Dados do cliente-->
        <center>
        <div class="formulario">

            <h3 class="title">Meus dados</h3>
            <p>Nome: </p>
            <input type="text" readonly  value="<?php echo $nome?>"><br><br>

            <p>Usuario: </p>
            <input type="text" readonly  value="<?php echo $usuario?>"><br><br>

            <p>Email: </p>
            <input type="text" readonly  value="<?php echo $email?>"><br><br>

            <p>CPF: </p>
            <?php 
                if ($cpf > 1){
                    echo "<input type='text' readonly  value='$cpf'><br><br>";
                }else{ 
                    echo "<input type='text' readonly  placeholder='Não cadastrado'><br><br>";
                }
            ?>

            <p>Celular: </p>
            <?php 
                if ($celular > 1){
                    echo "<input type='text' readonly  value='$celular'><br><br>";
                }else{ 
                    echo "<input type='text' readonly  placeholder='Não cadastrado'><br><br>";
                }
            ?>
            
            <!--Dados do endereço-->
            <h3 class="title">Endereço</h3>
                <form>
                    <p>CEP: </p>
                        <input name="cep" type="text" placeholder="Não cadastrado" readonly  value=<?php echo $cep;?>><br><br>
                    <p>Complemento: </p>
                        <input type="text" placeholder="Não cadastrado" readonly value=<?php echo $complemento;?>><br><br>
                    <p>Número: </p>
                        <input type="text" placeholder="Não cadastrado" readonly value=<?php echo $numero;?>><br><br>
                </form>
            </div>
        </center>

        <center><a href="../cliente/alterardados.php" class="btn" title="Alterar dados">Alterar dados</a>&nbsp;
        <a href="../cliente/endereco.php" class="btn" title="Alterar endereço">Alterar endereço</a></center>
        
        <div class="tot">
            <a href="../cliente/conta.php" class="btn" title="Voltar">Voltar</a>
        </div>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>

        <?php mysqli_close($conexao); //Fecha a conexão com o banco de dados  ?>
    </body>
</html>