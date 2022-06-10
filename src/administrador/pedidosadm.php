<?php
	require_once '../sql/conexao.php'; // Chama conexão.
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é administardor
    if ($email != '' && $adm == 1){  
    } else {
        header("Location: ../paginas/index.php"); //Redirecionamento se não for administrador
    }

    $logado = $_SESSION['nome'];

    //Realiza a busca no banco de dados de todos dados da tabela vendas
    $sql = "SELECT * FROM vendas ORDER BY id_vendas DESC";
    $result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pedidos - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?><br><br>

        <div class="col-4">
            <?php echo "<h2>Administrador: $logado</h2>"; ?>
        </div>

        <center>
        <?php
            //Mensagem de erro caso email ou senha não encontrados
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>
        </center>

        <!-- Tabela dos pedidos-->
        <table>
            <thead>
                <tr>
                    <th scope="col">ID cliente</th>
                    <th scope="col">ID Venda</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Data da compra</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(mysqli_num_rows($result) == 0) {
                        echo "<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Nenhum pedido a mostrar.</h3>";
                        echo "<br>";
                    }else{
                        while($user_data = mysqli_fetch_assoc($result)) {
                            //Dados dos pedidos
                            $idvendas = $user_data ['id_vendas'];
                            $data = $user_data['vnd_data'];
                            $valor = $user_data['vnd_valor'];
                            $idcli =  $user_data['id_cliente'];
                            $identrega =  $user_data['id_entregas'];
                        
                            //Consulta os dados do entregas cliente cadastrado
                            $sql2 = "SELECT * FROM entregas where id_entregas = '$identrega'";
                            $result2 = $conexao->query($sql2);
                            $row_status = mysqli_fetch_array($result2);

                            $status = $row_status['entr_status'];

                            //Exibe os dados do banco de dados
                            echo "<tr>";
                            echo "<td> $idcli </td>";
                            echo "<td> $idvendas </td>";
                            echo "<td> $valor </td>";
                            echo "<td> $data </td>";
                            echo "<td> $status </td>";
                            echo "<td>
                                <a class='btn btn-sm btn-primary' href='../administrador/editarpedido.php?id=$identrega' title='Editar'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                                    </svg>
                                </a> 
                            </td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table><br>

        &nbsp;&nbsp;&nbsp;
        <a href="../administrador/contaadm.php" class="btn" title="Voltar">Voltar</a><br><br>
        
        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                                             

        <?php mysqli_close($conexao); //Fecha a conexão com o banco de dados?>
    </body>
</html>