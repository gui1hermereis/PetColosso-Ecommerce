<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é cliente
    if ($email != '' && $adm == 0){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não é cliente
    }

    $logado = $_SESSION['usuario'];
    $nome = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Meus pedidos - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        <link rel="stylesheet" type="text/css" href="../../css/carousel.css">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>

        <div class="col-4">
        <?php echo "<h2>Cliente: $nome</h2>"; ?>
        </div>

        <!-- Exibe todos produtos do banco de dados -->
        <table>
            <thead>
                <tr>
                    <th scope="col">Venda</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Status</th>
                    <th scope="col">Codigo rastreamento</th>
                    <th scope="col">Data da compra</th>
                    <th scope="col">Total da compra</th>
                </tr>
            </thead>
            <tbody>

            <?php //Seleciona do banco de dados os dados do endereço do cliente
                $sqlcli = "SELECT * FROM clientes where id_usuario = '$logado'";
                $resultcli = $conexao->query($sqlcli);
                $row_cli = mysqli_fetch_array($resultcli);
                $id = $row_cli['id_cliente'];

                $sql = "SELECT * FROM vendas where id_cliente = $id";
                $result = $conexao->query($sql);
                
                if(mysqli_num_rows($result) == 0) {
                    echo "<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                    Nenhum pedido a mostrar.</h3>";
                    echo "<br>";
                }else{
                    while($row_vendas = mysqli_fetch_assoc($result)) {
                        $idvendas = $row_vendas ['id_vendas'];
                        $data = $row_vendas['vnd_data'];
                        $identrega =  $row_vendas['id_entregas'];
                        $total =  $row_vendas['vnd_valor'];

                        $sql1 = "SELECT * FROM entregas where id_entregas = '$identrega'";
                        $result1 = $conexao->query($sql1);
                        $row_entregas = mysqli_fetch_array($result1);

                        $status = $row_entregas['entr_status'];
                        $codigo = $row_entregas['entr_codRastr'];

                        $sql2 = "SELECT * FROM itens_vendas where id_vendas = '$idvendas'";
                        $result2 = $conexao -> query($sql2);

                        foreach ($result2 as $row_itens){
                            $idprod = $row_itens['id_prod']; 
                            $idvenda = $row_itens['id_vendas'];
                            $valor = $row_itens['itv_valor'];
                            $quantidade = $row_itens['itv_quant'];

                            $sql3 = "SELECT prod_nome FROM produtos where id_prod = $idprod";
                            $result3 = $conexao -> query($sql3);
                            $row_prod = mysqli_fetch_array($result3);

                            $produto = $row_prod['prod_nome'];

                            echo "<tr>";
                                echo "<td> $idvenda </td>";
                                echo "<td> $produto </td>";
                                echo "<td>R$ " .$valor. "</td>";
                                echo "<td> $quantidade </td>";
                                echo "<td> $status </td>";
                                echo "<td> $codigo </td>";
                                echo "<td> $data </td>";
                                echo "<td>R$ ".$total."</td>";
                            echo "</tr>";
                        }
                    }
                }
            ?>
            </tbody>
        </table><br><br>
        &nbsp;&nbsp;&nbsp;
        <a href="../cliente/conta.php" class="btn" title="Voltar">Voltar</a>
        
        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                                              

        <!------------- Fecha a conexão com o banco de dados ------------->
        <?php mysqli_close($conexao); ?>

    </body>
</html>