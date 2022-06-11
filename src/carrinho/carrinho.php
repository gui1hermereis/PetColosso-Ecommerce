<?php
    require_once '../sql/conexao.php'; // Chama conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se esta logado
    if ($email != '' && $adm >= 0){  
    } else {
        header("Location: ../paginas/logarcadastrar.php");//Redirecionamento se não estiver logado
    }

    $logado = $_SESSION['usuario'];
    $nome = $_SESSION['nome'];

    //Função para funcionamento do carrinho
    if (isset($_POST["add"])){
        if (isset($_SESSION["carrinho"])){
            $item_array_id = array_column($_SESSION["carrinho"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["carrinho"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["carrinho"][$count] = $item_array;
                echo '<script>window.location="../carrinho/carrinho.php"</script>';
            }else{
                echo '<script>window.location="../carrinho/carrinho.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["carrinho"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["carrinho"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["carrinho"][$keys]);
                    echo '<script>window.location="../carrinho/carrinho.php"</script>';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carrinho - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container"><br>
            <!--Tradutor-->
            <?php include ('../includes/tradutor.php'); 
            echo"<div id='google_translate_element' align='right'></div>"?>
            <!--Menu-->
            <?php include ('../includes/menu.php'); ?><br><br>
        </div>    

        <!--Tabela de exibição dos itens do carrinho-->
        <table>
            <tr>
                <th scope="col">Nome produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor do produto</th>
                <th scope="col">Total da compra</th>
            </tr>

            <div class="col-4">
                <?php echo "<h2>Carrinho: $nome</h2>"; ?>
            </div>

            <?php
                //Dados do carrinho
                if(!empty($_SESSION["carrinho"])){
                    $total = 0;
                    foreach ($_SESSION["carrinho"] as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td> R$ <?php echo $value["product_price"]; ?></td>
                            <td>
                            R$ <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>

                            <td><a class='btn btn-sm btn-danger' href="../carrinho/carrinho.php?action=delete&id=<?php echo $value["product_id"]; ?>" title='Deletar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg></a></td>
                        </tr>

                    <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
                    ?>

                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <th align="right">R$ <?php echo number_format($total, 2); ?></th>
                        <td></td>
                    </tr>
            <?php 
                } 
            ?>
            </table><br><br>

            <!--Consulta o CEP-->
            <div class="cep">
                <form method="POST">
                    &nbsp;&nbsp;
                    <input type="text" name= "cep" id="cep" placeholder="Calcular frete">
                    <a onclick="calculo();" class="btn btn-sm btn-danger">
                        <center>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </center>
                    </a>
                </form><br>
            </div>

        <!--Retorna os valores da consulta do CEP-->
        <h4 id="retorno"> </h4>
        
        <?php
        if ($logado < 1){
            echo "<script language='javascript'>";
                $_SESSION['erro'] = "<h5>Para acessar o carrinho precisa estar logado</h5>";
                header("Location: ../paginas/logarcadastrar.php");//Redirecionamento
            echo "</script>";

        }else{
            if($total == 0){
                echo "<script language='javascript'>";
                    $_SESSION['vazio'] = "<h3>O carrinho está vazio</h3>";
                    header("Location: ../paginas/produtos.php");//Redirecionamento
                echo "</script>";
            }else{
        ?>

        &nbsp;&nbsp;&nbsp;  
        <a href="../paginas/produtos.php" class="btn">Continuar comprando</a>
        <a href="../carrinho/confirmardados.php" class="btn">Confirmar dados</a>

        <?php
            }
        }
        ?><br><br>

        <!--Footer-->
        <?php include ('../includes/footer.php'); ?>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <!--Codigo JavaScript -->
        <script>
            function calculo(){
                var cep = $("#cep").val();
                $.post('../carrinho/calculafrete.php',{cep:cep},function(data){
                $("#retorno").html(data);
                });
            }
        </script>
        
        <?php mysqli_close($conexao); //Fecha conexão com banco de dados ?>
    </body>
</html>