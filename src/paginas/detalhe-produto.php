<?php
    require_once '../sql/conexao.php'; //Chama conexão

    //Realiza a busca do produto com id especifico para mostrar na pagina
    $id = $_GET['id'];
    $query = "SELECT * FROM produtos where id_prod = $id";
    $result = mysqli_query($conexao,$query);

    $sql1 = "SELECT * FROM produtos ORDER BY id_prod DESC LIMIT 4 OFFSET 16 ";
    $result1 = mysqli_query($conexao,$sql1);

    if(mysqli_num_rows($result) < 0) {
    }else{
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalhes produto - Pet Colosso</title>
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
            <?php include ('../includes/menu.php'); 
        echo "</div>";

        //Exibe os dados do produto com o id da pesquisa
        while ($row = mysqli_fetch_array($result)) { ?>

        <!--Produto-->
        <div class="small-container single-product">
            <div class="row">
                <div class="col-2">
                <img src="../../images/produtos/<?php echo $row["prod_imagem"]; ?>" width="100%"><br>
                    <div class="small-img-row">
                    </div>
                </div>
                    <div class="col-2">
                        <form method="post" action="../carrinho/carrinho.php?action=add&id=<?php echo $row["id_prod"]; ?>">
                            <div><h4><?php echo $row["prod_nome"]; ?></h4></div>
                            <div><p>R$ <?php echo $row["prod_valor"]; ?></p></div><br>
                            <?php if($row["prod_status"] == 'a') { //So exibe produtos ativos ?>
                            <div><input type="number" name="quantity" value="1" min="1" max=<?php echo $row["prod_estoque"]; ?>></div><br>
                            <input type="hidden" name="hidden_name" value="<?php echo $row["prod_nome"]; ?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["prod_valor"]; ?>">
                            <?php 
                                //Se o estoque for menor que 1 não exibe o botao adicionar ao carrinho
                                if ($row["prod_estoque"] < 1 ){
                                    echo "<h6>Produto indisponivel</h6>";
                                }else{
                                    echo "<input type='submit' name='add' class='btn' value= 'Adicionar ao carrinho'>";
                                }
                                }else{
                                    echo "<h6>Produto indisponivel</h6>";
                                }
                            ?>
                        </form>
                    </div>
                <?php
                }
                }
                ?>
            </div>
        </div>

        &nbsp;&nbsp;&nbsp;
        <a href="javascript: history.go(-1)" class="btn">Voltar</a>

        <!------------- Veja mais ------------->
        <div class="small-container">
            <div class="row row-2">
                <h2>Produtos</h2>
                <a href="../paginas/produtos.php"><p> Veja Mais</p></a>
            </div>
            
            <!------------- Mais produtos ------------->
            <div class="row">
                <?php if(mysqli_num_rows($result1) > 0) {
                        //Exibe todos os produtos da busca cadastrados no banco de dados
                        while ($row = mysqli_fetch_array($result1)) { ?>
                        <div class="col-4">
                            <div><a href="../paginas/detalhe-produto.php?&id=<?php echo $row["id_prod"];?>"><img src="../../images/produtos/<?php echo $row["prod_imagem"]; ?>"></a></div> 
                            <div><h4><?php echo $row["prod_nome"]; ?></h4></div>
                            <div><p>R$ <?php echo $row["prod_valor"]; ?></p></div><br>
                        </div>
                    <?php
                        }
                    }?>
            </div>
        </div>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                                             
        
        <?php mysqli_close($conexao); //Fecha a conexão com o banco de dados?>
    </body>
</html>