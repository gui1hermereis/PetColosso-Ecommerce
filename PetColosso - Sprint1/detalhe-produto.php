<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Casinha - Pet Colosso</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=
        Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome
        /4.7.0/css/font-awesome.min.css">
</head>
    <body>

        <!------------- Menu ------------->

        <?php
            include ('menu.php');
        ?>

        <!------------- Detalhe do produto ------------->

        <div class="small-container single-product">
            <div class="row">
                <div class="col-2">
                    <img src="images/produtos/casinha1.jpg" width="100%" id="ProductImg">
                    <div class="small-img-row">
                        <div class="small-img-col">
                            <img src="images/produtos/casinha1.jpg" width="100%" class="small-img">
                        </div>

                        <div class="small-img-col">
                            <img src="images/produtos/casinha2.jpg" width="100%" class="small-img">
                        </div>

                    </div>
                </div>
                <div class="col-2">

                    <h1> Casinha Cão Barraquinha Preto </h1>
                    <h4> R$ 280.77 </h4>
                    <input type="number" value="1">
                    <a href="carrinho.html" class="btn">Adicionar ao carrinho</a>

                    <h3>Informações do produto: </h3><br>
                    <p>Marca: E-nichos<br> Cor: Preto<br> Material: Mdf<br> Fabricante: E-nichos<br> Modelo: En108c03<br></p>
                </div>
            </div>
        </div>

        <!------------- Titulo ------------->
        <div class="small-container">
            <div class="row row-2">
                <h2>Produtos</h2>
                <a href="produtos.php">
                    <p> Veja Mais</p>
                </a>
            </div>
        </div>


        <!------------- Produtos ------------->
        <div class="small-container">
            <div class="row row-2">

                <div class="row">

                    <div class="col-4">
                        <img src="images/produtos/produto9.jpg">
                        <h4>Ração para peixes Alcon Koi flocos 45g carpa</h4>
                        <p>R$ 24,25</p>
                    </div>

                    <div class="col-4">
                        <img src="images/produtos/produto10.jpg">
                        <h4>Antipulgas Fiprolex Gatos Drop Spot 0,5 ml</h4>
                        <p>R$ 28,58</p>
                    </div>

                    <div class="col-4">
                        <img src="images/produtos/produto11.jpg">
                        <h4>Comedouro Premium NF Pet Vermelho 7,2 L</h4>
                        <p>R$ 145,90</p>
                    </div>

                    <div class="col-4">
                        <img src="images/produtos/produto12.jpg">
                        <h4>Peitoral MeuAuAu Turma da Mônica Pets Branco para Cães</h4>
                        <p>R$ 79,99</p>
                    </div>
                </div>
            </div>
        </div>

        <!------------- Footer ------------->

        <?php
            include ('footer.php');
        ?>

        <!------------- JS prduto ------------->

        <script>
            var ProductImg = document.getElementById("ProductImg");
            var SmallImg = document.getElementsByClassName("small-img");

            SmallImg[0].onclick = function() {
                ProductImg.src = SmallImg[0].src;
            }

            SmallImg[1].onclick = function() {
                ProductImg.src = SmallImg[1].src;
            }
        </script>
    </body>
</html>