<?php
    require_once '../sql/conexao.php'; //Chama Conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é administrador
    if ($email != '' && $adm == 1){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não for adminsitrador
    }

    $logado = $_SESSION['nome'];

    //Consulta as opções de votação
    $result_enquete = "SELECT * FROM enquete limit 4";
    $result_enquete = mysqli_query($conexao, $result_enquete);

    //Consulta no banco de dados todos clientes
    $sql = "SELECT * FROM clientes ORDER BY id_cliente";
    $result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dados enquete - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>

        <div class="col-4">
            <?php echo "<h2>Administrador: $logado</h2>"; ?>
        </div>

        <!--Tabela com dados de quem votou-->
        <h3 class="title">Dados da votação</h3>
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Votação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        //Dados dos clientes
                        $idcli = $user_data['id_cliente'];
                        $cli_email = $user_data['cli_email'];
                        $id_voto = $user_data['id_votacao'];

                        $sql_voto = "select votos from enquete where id_votacao = '$id_voto'";
                        $result_voto = $conexao -> query($sql_voto);
                        $row_voto = mysqli_fetch_array($result_voto);
                        $voto = $row_voto['votos'];

                        echo "<tr>";
                        echo "<td>".$idcli."</td>";
                        echo "<td>".$cli_email."</td>";
                        echo "<td>".$voto."</td>";
                        echo "</tr>";
                        }
                ?><br>
            </tbody>
        </table><br><br><br>
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Quantidade de votos</th>
                    <th scope="col">Porcentagem de votos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row_enquete = mysqli_fetch_assoc($result_enquete)){
                    //Dados da votação
                        $id = $row_enquete['id_votacao'];
                        $nome = $row_enquete['votos'];
                        $qnt_votos = $row_enquete['qnt_votos'];
                        $tot_votos = $row_enquete['tot_votos'];
                        if ($qnt_votos > 0){
                            $porc_votos = ($qnt_votos * 100) / $tot_votos;

                            echo "<tr>";
                            echo "<td>".$nome."</td>";
                            echo "<td>".$qnt_votos."</td>";
                            echo "<td>".$porc_votos."% </td>";
                           echo "</tr>";
                        }
                    }

                ?>
            </tbody>
        </table><br>
        
        <div class="tot">
            <?php
                echo "<br><b>Total de votos:  " . $tot_votos . "</b><br><br>";
            ?>

            <a href="../administrador/contaadm.php" class="btn" title="Voltar">Voltar</a>
        </div>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                                              
        
        <!------------- Fecha a conexão com o banco de dados ------------->
        <?php mysqli_close($conexao); ?>

    </body>
</html>