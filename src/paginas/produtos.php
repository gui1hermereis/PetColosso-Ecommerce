<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();

    $ordem = "";
        if(isset($_GET['ordem'])){
            if($_GET['ordem'] == "menor"){
                $ordem = "ORDER BY prod_valor ASC";

            }elseif($_GET['ordem'] == "maior"){
                $ordem = "ORDER BY prod_valor DESC";

            }elseif($_GET['ordem'] == "nmenor"){
                $ordem = "ORDER BY prod_nome ASC";

            }elseif($_GET['ordem'] == "nmaior"){
                $ordem = "ORDER BY prod_nome DESC";
            }elseif($_GET['ordem'] == "normal"){
                $ordem= "ORDER BY id_prod ASC";
            }
        }

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $query = "SELECT * FROM produtos WHERE prod_nome LIKE '%$data%' or prod_valor LIKE '%$data%' ORDER BY id_prod";
    }
    else
    {
        $query = "SELECT * FROM produtos where prod_status = 'a' and prod_estoque > 0 $ordem";
    }
    $result = mysqli_query($conexao,$query);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Todos produtos - Pet Colosso</title>
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
            <?php include ('../includes/menu.php'); ?>
        </div>
        <!--Produtos-->
        <div class="small-container">
            <div class="row row-2">
                <h2>Todos produtos</h2>
                <div class="filtro">
                    <form action="" method="GET" id="ordena">
                        <select name="ordem" onchange= "onSelectChange();">
                            <option value="normal" <?php if(isset($_GET['ordem']) && $_GET['ordem'] == "normal") { echo "selected"; } ?>>Filtrar por: </option>
                            <option value="menor" <?php if(isset($_GET['ordem']) && $_GET['ordem'] == "menor") { echo "selected"; } ?> > Menor - Maior</option>
                            <option value="maior" <?php if(isset($_GET['ordem']) && $_GET['ordem'] == "maior") { echo "selected"; } ?> > Maior - Menor</option>
                            <option value="nmenor" <?php if(isset($_GET['ordem']) && $_GET['ordem'] == "nmenor") { echo "selected"; } ?> > A - Z</option>
                            <option value="nmaior" <?php if(isset($_GET['ordem']) && $_GET['ordem'] == "nmaior") { echo "selected"; } ?> > Z - A</option>
                        </select>
                    </form>
                </div>
            </div>

            <?php
                //Mensagem de erro
                if(isset($_SESSION['vazio'])){
                    echo $_SESSION['vazio'];
                    unset($_SESSION['vazio']);
                }
            ?><br>

            <div class="pesquisar">
                <form>
                    <input type="search" name= "search" placeholder="Pesquisar produto">
                    <input type="submit" onclick="searchData()" class="btn" value="Pesquisar">
                </form><br><br>
            </div>
            
            <!------------- Produtos do site ------------->
            <div class="produtos">
                <div class="row">
                    <?php 
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <div class="col-4">
                            <form method="post" action="../carrinho/carrinho.php?action=add&id=<?php echo $row["id_prod"]; ?>">
                                <div><a href="../paginas/detalhe-produto.php?&id=<?php echo $row["id_prod"];?>"><img src="../../images/produtos/<?php echo $row["prod_imagem"]; ?>"></a></div> 
                                <div><h4><?php echo $row["prod_nome"]; ?></h4></div>
                                <div><p>R$ <?php echo $row["prod_valor"]; ?></p></div>
                                <?php if($row["prod_status"] == 'a') { //So exibe produtos ativos?>
                                <div><input type="number" name="quantity" value="1" min="1" max=<?php echo $row["prod_estoque"]; ?>></div>
                                <input type="hidden" name="hidden_name" value="<?php echo $row["prod_nome"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["prod_valor"]; ?>">
                            <?php 
                                if ($row["prod_estoque"] < 1 ){
                                    echo "<h6>Produto indisponivel</h6><br><br><br>";
                                }else{
                                    echo "<input type='submit' name='add' class='btn' value= 'Adicionar ao carrinho'><br><br><br>";
                                }
                            }else{
                                echo "<br>";
                                echo "<h6>Produto indisponivel</h6><br><br><br>";
                            }
                            ?>
                        </form>
                    </div>
                    <?php
                        }
                        }else{
                            echo "<h2>Produto não encontrado...</h2>";
                        }
                    ?>
                </div>
            </div><br><br>
        </div>
        
        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                              

        <?php mysqli_close($conexao);//Fecha a conexão com o banco de dados ?>

        <!--Codigo JavaScript-->
        <script>
            function onSelectChange(){
                document.getElementById('ordena').submit();
            }
            
            var search = document.getElementById('pesquisar');
            search.addEventListener("keydown", function(event) {
                if (event.key === "Enter") 
                {
                    searchData();
                }
            });

            function searchData()
            {
                window.location = '../paginas/produtos.php?search='+search.value;
            }
        </script>
    </body>
</html>