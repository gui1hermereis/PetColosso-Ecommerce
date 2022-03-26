<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Colosso</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=
        Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome
        /4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
    <body>
        <div class="header">
            <div class="container">
                <div class="navbar">
                 
                <?php
                    include ('menu.php');
                ?>

                </div>
                <div class="row">
                    <div class="col-2">
                        <h1> Melhor qualidade e cuidados para
                            <BR> seu pet! </h1>

                        <p>Com grande variedade de produtos a pronta entrega para todos tipos de animais, Pet Colosso proporciona a seus clientes uma experiencia única
                            <br>na hora de cuidar do seu cachorro.
                        </p>

                        <a href="produtos.php" class="btn"> Novidades selecionadas para você &#8594;</a>
                    </div>
                    <div class="col-2">
                        <img src="images/imagem1.png">
                    </div>
                </div>
            </div>
        </div>

        <!-------------- Carousel -------------->

        <div class="container">
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
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-4">
                                    <img src="images/produtos/produto34.jpg">
                                    <h4>Areia Higiênica Pipicat Classic para Gatos</h4>
                                    <p>R$ 199,90</p><br>
                                    <a href="" class="btn">Adicionar ao carrinho</a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-4">
                                    <img src="images/produtos/produto16.jpg">
                                    <h4>Brinquedo Buddy Toys Nylon Kit Queridinhos Cenoura e Graveto para Cães</h4>
                                    <p>R$ 88,11</p>
                                    <a href="" class="btn">Adicionar ao carrinho</a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-4">
                                    <img src="images/produtos/produto40.jpg">
                                    <h4>Bola de Exercício Chalesco para Hamster Transparente</h4>
                                    <p>R$ 80,49</p><br>
                                    <a href="" class="btn">Adicionar ao carrinho</a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-4">
                                    <img src="images/produtos/produto48.jpg">
                                    <h4>Comedouro Interativo Pidan Verde</h4>
                                    <p>R$ 128,15</p><br>
                                    <a href="" class="btn">Adicionar ao carrinho</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-4">
                                    <img src="images/produtos/produto7.jpg">
                                    <h4>Ração Nero Premium Cães Adultos Carne e Frango 15kg</h4>
                                    <p>R$ 109,99</p><br>
                                    <a href="" class="btn">Adicionar ao carrinho</a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-4">
                                    <img src="images/produtos/produto13.jpg">
                                    <h4>Cerveja Cãolorado Sabor Carne para Cães</h4>
                                    <p>R$ 12,55</p><br>
                                    <a href="" class="btn">Adicionar ao carrinho</a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-4">
                                    <img src="images/produtos/produto36.jpg">
                                    <h4>Casa Furacão para Cães Preta</h4>
                                    <p>R$ 199,90</p><br><br>
                                    <a href="" class="btn">Adicionar ao carrinho</a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-4">
                                    <img src="images/produtos/produto28.jpg">
                                    <h4>Graminha para Gatos - 100% Natural Único</h4>
                                    <p>R$ 27,99</p><br>
                                    <a href="" class="btn">Adicionar ao carrinho</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>

        <!------------- Novos Produtos-------------->

        <div class="small-container">
            <h2 class="title">Novos Produtos</h2>
            <div class="row">

                <div class="col-4">
                    <img src="images/produtos/produto1.jpg">
                    <h4>Peitoral Zee.Dog Air Mesh Prisma para Cães</h4>
                    <p>R$ 159,00</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto2.jpg">
                    <h4>Porta Saquinhos Higiênicos Coletor de Fezes para Cachorro Chalesco</h4>
                    <p>R$ 29,90</p>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto3.jpg">
                    <h4>Cama Top Premium Fábrica Pet Preta G</h4>
                    <p>R$ 193,90 </p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto4.jpg">
                    <h4>Aquário Curvo Boyu EC-600 66 L Preto 220 V</h4>
                    <p>R$ 922,90</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>
            </div>

            <!-------------Produtos-------------->

            <h2 class="title"> Produtos </h2>
            <div class="row">
                <div class="col-4">
                    <img src="images/produtos/produto5.jpg">
                    <h4>Ração Golden Fórmula para Cães Adultos Carne e Arroz 15 kg</h4>
                    <p>R$ 154,90</p>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto6.jpg">
                    <h4>Ração Whiskas Gatos Adultos Melhor Por Natureza Salmão 10,1 kg</h4>
                    <p>R$ 185,99</p>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto7.jpg">
                    <h4>Ração Nero Premium Cães Adultos Carne e Frango 15kg</h4>
                    <p>R$ 109,99</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto8.jpg">
                    <h4>Funny Bunny Ração Delícias da Horta</h4>
                    <p>R$ 47,99</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>
            </div>

            <div class="row">

                <div class="col-4">
                    <img src="images/produtos/produto13.jpg">
                    <h4>Cerveja Cãolorado Sabor Carne para Cães</h4>
                    <p>R$ 12,55</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto14.jpg">
                    <h4>Brinquedo Jambo Mordedor Pelúcia Macaco Kelev Bege</h4>
                    <p>R$ 26,99</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto15.jpg">
                    <h4>Mangueira com Luva Massageadora p/ Banhos Pet </h4>
                    <p>R$ 43,99</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto16.jpg">
                    <h4>Brinquedo Buddy Toys Nylon Kit Queridinhos Cenoura e Graveto para Cães</h4>
                    <p>R$ 88,11</p>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>
            </div>

            <!------------- Ofertas-------------->

            <div class="offer">
                <div class="small-container">
                    <div class="row">
                        <div class="col-2">
                            <img src="images/produtos/casinha1.jpg" class="offer-img" height="100%">
                        </div>
                        <div class="col-2">
                            <p></p>
                            <h1>Casinha Cão Barraquinha Preto </h1>
                            <small>- Ideal para ambientes internos. <br>- Indicada para cachorros.  <br>- Resistente e durável.
                                            <br>- Marca: E-nichos <br>- Material: mdf. <br><br>R$280.77<br></small>
                            <a href="detalhe-produto.php" class="btn">Compre agora &#8594;</a>
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
                        <img src="images/user1.jpg">
                        <h3>Rafael Anão</h3>
                    </div>

                    <div class="col-3">
                        <p>Produto de qualidade, preço acessivel e entrega rapida!!</p>
                        <div class="rating"></div>
                        <img src="images/user-2.png">
                        <h3>Fabio Giga</h3>
                    </div>

                    <div class="col-3">
                        <p>Recomendo, vendedor atencioso e prestativo!!</p>
                        <div class="rating"></div>
                        <img src="images/user3.jpg">
                        <h3>Marlon Brandon Coelho</h3>
                    </div>
                </div>
            </div>
        </div>

        <!------------- Marcas ------------->

        <div class="brands">
            <div class="small-container">
                <div class="row">
                    <div class="col-5">
                        <img src="images/logo-golden.png">
                    </div>
                    <div class="col-5">
                        <img src="images/logo-premier.png">
                    </div>
                    <div class="col-5">
                        <img src="images/logo-pedigree.png">
                    </div>
                    <div class="col-5">
                        <img src="images/logo-whiskas.png">
                    </div>
                    <div class="col-5">
                        <img src="images/logo-royal.png">
                    </div>
                    <div class="col-5">
                        <img src="images/logo-special.png">
                    </div>
                </div>
            </div>
        </div>

        <!------------- Footer ------------->
        <?php
            include ('footer.php');
        ?>

    </body>
</html>