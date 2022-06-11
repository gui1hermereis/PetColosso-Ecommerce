<?php
	require_once '../sql/conexao.php'; // Chama conexão.
    session_start();

    //Produtos carousel
    $sql1 = "SELECT * FROM produtos where prod_status = 'a' and prod_estoque > 0 ORDER BY id_prod DESC LIMIT 4";
    $result1 = mysqli_query($conexao,$sql1);

    $sql2 = "SELECT * FROM produtos where prod_status = 'a' and prod_estoque > 0 ORDER BY id_prod DESC LIMIT 4 OFFSET 4";
    $result2 = mysqli_query($conexao,$sql2);

    //Realiza a busca dos dados digitados na pesquisa, se nao tiver nenhuma pesquisa exibe os 16 primeiros
    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $query = "SELECT * FROM produtos WHERE id_prod LIKE '%$data%' or prod_nome LIKE '%$data%' or prod_valor LIKE '%$data%' ORDER BY id_prod";
    }
    else
    {
        $query = "SELECT * FROM produtos where prod_status = 'a' and prod_estoque > 0 ORDER BY id_prod  ASC LIMIT 16";
    }
    $result = mysqli_query($conexao,$query);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        <link rel="stylesheet" type="text/css" href="../../css/carousel.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="header">
            <div class="container"><br>
                <!--Tradutor-->
                <?php include ('../includes/tradutor.php'); 
                echo"<div id='google_translate_element' align='right'></div>"?>
                <!--Menu-->
                <?php include ('../includes/menu.php'); ?>
                <div class="row">
                    <div class="col-2">
                        <h1> Melhor qualidade e cuidados para
                        seu pet! </h1>
                        <p>Com grande variedade de produtos a pronta entrega para todos tipos de animais, Pet Colosso proporciona a seus clientes uma experiencia única na hora de cuidar do seu cachorro.</p>

                        <a href="../paginas/produtos.php" class="btn"> Novidades selecionadas para você</a>
                    </div>
                    <div class="col-2">
                        <img src="../../images/imagem1.png">
                    </div>
                </div><br><br>
            </div>
        </div><br><br>


        <!-------------- Carousel -------------->
        <div class="container">
            <h2 class="title">Novos Produtos</h2>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h3></h3>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 hidden-xs">
                    <div class="controls pull-right">
                        <a class="left fa fa-chevron-left btn btn-info " href="#carousel-example" data-slide="prev"></a>
                        <a class="right fa fa-chevron-right btn btn-info" href="#carousel-example" data-slide="next"></a>
                    </div>
                </div>
            </div>
            <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel" data-type="multi">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                        <?php 
                        //Exibe os dados do produto com o id da pesquisa
                        while ($row = mysqli_fetch_array($result1)) { ?>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-4">
                                    <div><a href="../paginas/detalhe-produto.php?&id=<?php echo $row["id_prod"];?>"><img src="../../images/produtos/<?php echo $row["prod_imagem"]; ?>"></a></div> 
                                    <div><h4><?php echo $row["prod_nome"]; ?></h4></div>
                                    <div><p>R$ <?php echo $row["prod_valor"]; ?></p></div><br>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <?php while ($row = mysqli_fetch_array($result2)) { ?>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-4">
                                    <div><a href="../paginas/detalhe-produto.php?&id=<?php echo $row["id_prod"];?>"><img src="../../images/produtos/<?php echo $row["prod_imagem"]; ?>"></a></div> 
                                    <div><h4><?php echo $row["prod_nome"]; ?></h4></div>
                                    <div><p>R$ <?php echo $row["prod_valor"]; ?></p></div><br>
                                </div>
                            </div>  
                            <?php
                            }
                            ?>                        
                        </div>
                    </div>
                </div>
            </div>
        </div><br>

        <!------------- Produtos-------------->
        <div class="small-container">
            <h2 class="title"> Produtos </h2>

            <!------------- Pesquisa -------------->
            <div class="index">
                <form>
                    <input type="search" name= "search" placeholder="Pesquisar produto">
                    <div class= row>
                        <div class="col-4"> 
                            <button onclick="searchData()" class="btn">Pesquisar</button>
                        </div>
                    </div>
                </form><br>
            </div>

            <div class="row">
                <?php 
                    if(mysqli_num_rows($result) > 0) {
                        //Exibe todos os produtos da busca cadastrados no banco de dados
                        while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="col-4">
                            <form method="post" action="../carrinho/carrinho.php?action=add&id=<?php echo $row["id_prod"]; ?>">
                                <div><a href="../paginas/detalhe-produto.php?&id=<?php echo $row["id_prod"];?>"><img src="../../images/produtos/<?php echo $row["prod_imagem"]; ?>"></a></div> 
                                <div><h4><?php echo $row["prod_nome"]; ?></h4></div>
                                <div><p>R$ <?php echo $row["prod_valor"]; ?></p></div><br>
                                <?php if($row["prod_status"] == 'a') { //So exibe produtos ativos ?>
                                <div><input type="hidden" name="quantity" value="1"></div>
                                <input type="hidden" name="hidden_name" value="<?php echo $row["prod_nome"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["prod_valor"]; ?>">
                                <?php 
                                    //Se o estoque for menor que 1 não exibe o botao adicionar ao carrinho
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
            </div><br><br>
            
            <!------------- Ofertas-------------->
            <?php $sqlprod = "SELECT * FROM produtos where id_prod = 49";
            $resultprod = $conexao->query($sqlprod);
            $row_prod = mysqli_fetch_array($resultprod);?>
            <div class="offer">
                <div class="small-container">
                    <div class="row">
                        <div class="col-2">
                            <a href="../paginas/detalhe-produto.php?&id=<?php echo $row_prod["id_prod"];?>"><img src="../../images/produtos/<?php echo $row_prod["prod_imagem"]; ?>" class="offer-img" height="100%"></a>
                        </div>
                        <div class="col-2">
                            <p></p>
                            <h2><?php echo $row_prod["prod_nome"];?></h2><br>
                            <small>- Ideal para ambientes internos. <br>- Indicada para cachorros. <br><br>R$ <?php echo $row_prod["prod_valor"];?><br></small>
                            <a href="../paginas/detalhe-produto.php?&id=<?php echo $row_prod["id_prod"];?>" class="btn">Compre agora</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!------------- Testamento ------------->
        <div class="testimonial">
            <div class="small-container">
                <div class="row">
                    <div class="col-3">
                        <p>Atendimento de qualidade, entrega muito rapida, o produto chegou muito bem embalado, recomendo!!</p>
                        <div class="rating"></div>
                        <img src="../../images/user1.jpg">
                        <h3>Pedro cabral</h3>
                    </div>

                    <div class="col-3">
                        <p>Produto de qualidade, preço acessivel e entrega rapida!!</p><br>
                        <img src="../../images/user-2.png">
                        <h3>Fabio Giga</h3>
                    </div>

                    <div class="col-3">
                        <p>Recomendo muito, vendedor atencioso e prestativo!!</p><br><br>
                        <img src="../../images/user3.jpg">
                        <h3>Genésio Silva</h3>
                    </div>
                </div>
            </div>
        </div>

        <!------------- Marcas no rodapé ------------->
        <div class="brands">
            <div class="small-container">
                <div class="row">
                    <div class="col-5">
                        <img src="../../images/logo-golden.png">
                    </div>
                    <div class="col-5">
                        <img src="../../images/logo-premier.png">
                    </div>
                    <div class="col-5">
                        <img src="../../images/logo-pedigree.png">
                    </div>
                    <div class="col-5">
                        <img src="../../images/logo-whiskas.png">
                    </div>
                    <div class="col-5">
                        <img src="../../images/logo-royal.png">
                    </div>
                    <div class="col-5">
                        <img src="../../images/logo-special.png">
                    </div>
                </div>
            </div>
        </div>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>                                                             

        <?php mysqli_close($conexao); //Fecha conexão com o banco de dados?>
        
        <!--Codigo JavaScript-->
        <script type="text/javascript">
            var search = document.getElementById('pesquisar');

            search.addEventListener("keydown", function(event) {
                if (event.key === "Enter") 
                {
                    searchData();
                }
            });

            function searchData()
            {
                window.location = '../paginas/index.php?search='+search.value;
            }

        </script>
    </body>
</html>