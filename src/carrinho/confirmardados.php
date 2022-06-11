<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se esta logado
    if ($email != '' && $adm >= 0){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não estiver logado  
    }
    
    $email = $_SESSION["email"];
    $logado = $_SESSION["usuario"];

    //Realiza a busca dos dados do cliente logado
    $sqlSelect = "SELECT * FROM clientes WHERE id_usuario = '$logado'";
    $result = $conexao->query($sqlSelect);
        while($user_data = mysqli_fetch_assoc($result)) {
            $nome = $user_data['cli_nome'];
            $email = $user_data['cli_email'];
            $usuario = $user_data['id_usuario'];
            $cpf = $user_data['cli_cpf'];
            $celular = $user_data['cli_cel'];
            $cep = $user_data['cli_cep'];
            $complemento = $user_data['cli_compl'];
            $numero = $user_data['cli_numcasa'];
        }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmar dados - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>

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
            <input type="text" readonly  placeholder="Não cadastrado" value="<?php echo $cpf?>"><br><br>


            <p>Celular: </p>
                <input type="text" readonly  placeholder="Não cadastrado" value="<?php echo $celular?>"><br><br>

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

        <!--Dados do carrinho-->
        <h3 class="title">Dados da Compra</h3>
        <table>
            <tr>
                <th scope="col">Nome produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor do produto</th>
                <th scope="col">Total da compra</th>
            </tr>
            <?php
            
            if(!empty($_SESSION["carrinho"])){
                $total = 0;
                foreach ($_SESSION["carrinho"] as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $value["item_name"]; ?></td>
                        <td><?php echo $value["item_quantity"]; ?></td>
                        <td> R$ <?php echo $value["product_price"]; ?></td>
                        <td>R$ <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                    </tr>
                    
                <?php
                $total = $total + ($value["item_quantity"] * $value["product_price"]);
                }
                ?>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <th align="right">R$ <?php echo number_format($total, 2); ?></th>
                    </tr>
            <?php
                }
            $_SESSION['total'] = $total
            ?>
        </table>
        </center><br><br>
        <?php
            echo "<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Valor total da compra R$ ".$_SESSION['total'] ."</h3>";
        ?>

        <!--Finaliza a compra caso todos dados estejam cadastrados-->
        <?php 
            if ($cep && $cpf && $numero > 0){
                echo "<center><a href='../pagseguro/pagseguro.php' class= 'btn'>Continuar compra</a></center>";
            }else{
                echo "<center><h3>Faltam dados a serem preenchidos em sua conta.<h3></center><br>";
            }
        ?>

        <div class="tot">
            <a href="../carrinho/carrinho.php" class= "btn">Voltar</a>
            <a href="../cliente/alterardados.php" class= "btn">Alterar dados</a>
            <a href="../cliente/endereco.php" class= "btn">Alterar endereço</a>
        </div>
        <!--Footer-->
        <?php include ('../includes/footer.php'); ?>

        <?php  mysqli_close($conexao); //Fecha conexão com banco de dados ?>
    </body>
</html>