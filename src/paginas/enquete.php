<?php
    require_once '../sql/conexao.php'; // Chama a conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se esta logado, se nao estiver proibe a entrada
    if ($email != '' && $adm >= 0){  
    } else {
        header("Location: ../paginas/logarcadastrar.php");   
    }

    //Realiza a busca dos dados da enquete
    $result_enquete = "SELECT * FROM enquete limit 4";
    $result_enquete = mysqli_query($conexao, $result_enquete);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enquete - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!-- Menu-->
        <?php include ('../includes/menu.php'); ?><br>
        <center><h2> Pesquisa de satisfação:</h2></center><br>
        <center><h4> Nos de sua opinião em relação ao uso do site.</h4></center><br><br><br>

        <!--Opções da votação-->
        <div class="enquete">
            <form action="../sql/enquetesql.php" method="POST">
                <?php
                    if(isset($_SESSION['erro'])){
                        echo "<center>" .$_SESSION['erro']. "</center>";
                        unset($_SESSION['erro']);
                    }
                    echo "<br>";

                    while($row_enquete = mysqli_fetch_assoc($result_enquete)){

                        $id = $row_enquete['id_votacao'];
                        $nome = $row_enquete['votos'];

                        echo "<h3>&nbsp;&nbsp;<input type='radio' name='id' value='$id'>&nbsp;" . $nome . "</h3>";
                    }
                    echo "<br>";
                    echo "<div class='dados'>";
                        echo "<center><h4>&nbsp;&nbsp;<input type='submit' name='submit' class='btn' value='Votar' title='Votar'></h4></center><br>";		
                    echo "</div>";
                ?>
            </form>
        </div>
        &nbsp;&nbsp;&nbsp;<a href="../paginas/contato.php" class="btn" title="Voltar">Voltar</a>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                              

        <?php mysqli_close($conexao); //Fecha a conexão com o banco de dados?>
    </body>
</html>