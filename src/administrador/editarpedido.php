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

    //Realiza a busca do cliente selecionado pelo id
    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM entregas WHERE id_entregas = $id";
        $result = $conexao->query($sqlSelect);
        while($user_data = mysqli_fetch_assoc($result)){
            $status = $user_data['entr_status'];
        }

        //Consulta os dados da venda
        $sql1 = "SELECT * FROM vendas where id_entregas = '$id'";
        $result1 = $conexao->query($sql1);
        $row_venda = mysqli_fetch_array($result1);

        $idvenda = $row_venda['id_vendas'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar pedido - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>

        <!--Status do pedido-->
        <h3 class="title">Status do pedido</h3>
        <center>
            <p>Status do pedido:</p>
            <?php echo "$status"; ?>
        </center><br>

        <!--Altera o status do pedido-->
        <h3 class="title">Dados a alterar</h3>
        <div class="formulario">
            <form id="update" action="../sql/editarpedidosql.php" method="POST">
                <center>
                    <p>Status do pedido:</p>
                    <select name="status" id="status">
                        <option value="" selected >Alterar status...</option>
                        <option value="Aguardando pagamento">Aguardando pagamento</option>
                        <option value="Pagamento efetuado">Pagamento efetuado</option>
                        <option value="Pedido enviado">Pedido enviado</option>
                        <option value="Pedido entregue">Pedido entregue</option>
                    </select><br><br>
                    <input type="hidden" name="id" value=<?php echo $id;?>>
                    <input type="hidden" name="venda" value=<?php echo $idvenda;?>>
                    <div class="dados">
                        <button type="submit" name="submit" class="btn" title="Alterar">Alterar</button>
                    </div>
                </center>
            </form><br>
        </div>
        &nbsp;&nbsp;&nbsp;
        <a href="../administrador/pedidosadm.php" class="btn" title="Voltar">Voltar</a>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                                          

        <?php mysqli_close($conexao); //Fecha a conexão com o banco de dados ?>
    </body>
</html>