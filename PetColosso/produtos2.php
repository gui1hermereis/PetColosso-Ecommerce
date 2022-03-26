<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Todos produtos - Pet Colosso</title>
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

        <div class="small-container">
            <div class="row row-2">
                <h2>Todos produtos</h2>
                <select>
                    <option>Selecione</option>
                    <option>Menor Preço</option>
                    <option>Maior Preço</option>
                    <option>Mais vendidos</option>
                    <option>Melhores avaliados</option>
                </select>
            </div>

            <div class="row">

                <div class="col-4">
                    <img src="images/produtos/produto17.jpg">
                    <h4>Brinquedo Milho Nylon Buddy Toys</h4>
                    <p>R$ 59,90</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto18.jpg">
                    <h4>Assento para Cães e Gatos Big One Tubline Couro Único</h4>
                    <p>R$ 152,90</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto19.jpg">
                    <h4>Roupa para Gato Soft Cat Glacê - Cappuccino</h4>
                    <p>R$ 87,99 </p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto20.jpg">
                    <h4>Bolsa para Cachorro Canguru Outback Blue</h4>
                    <p>R$ 135,48</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <img src="images/produtos/produto21.jpg">
                    <h4>Comedouro Alumínio Kakatoo</h4>
                    <p>R$ 12,50</p><br><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto22.jpg">
                    <h4>Arranhador Protetor De Sofá Para Gatos 2 Unidades</h4>
                    <p>R$ 125,00</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto23.jpg">
                    <h4>Spray Bite Stop Pet Clean Amargante 120ml</h4>
                    <p>R$ 12,99</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto24.jpg">
                    <h4>Ômega 3 Dog Organnact 30 Cápsulas 500 mg</h4>
                    <p>R$ 57,18</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>
            </div>
            <div class="row">

                <div class="col-4">
                    <img src="images/produtos/produto25.jpg">
                    <h4>Ninho de Corda Kakatoo</h4>
                    <p>R$ 14,25</p><br><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto26.jpg">
                    <h4>Ração para Répteis Reptomix Alcon 60g</h4>
                    <p>R$ 33,50</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto27.jpg">
                    <h4>Gaiola Para Hamster Tubo Labirinto Colorido Topolino Sírio</h4>
                    <p>R$ 188,99</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto28.jpg">
                    <h4>Graminha para Gatos - 100% Natural Único</h4>
                    <p>R$ 27,99</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>
            </div>

            <div class="row">

                <div class="col-4">
                    <img src="images/produtos/produto29.jpg">
                    <h4>Serragem para Hamster Prensada Mundo Pet 800 g</h4>
                    <p>R$ 6,55</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto30.jpg">
                    <h4>Toca Roedores Real Brinquedos Pet</h4>
                    <p>R$ 32,90</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto31.jpg">
                    <h4>Musgo Seco Verde 2L </h4>
                    <p>R$ 8,64</p><br><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>

                <div class="col-4">
                    <img src="images/produtos/produto32.jpg">
                    <h4>Bomba Submersa Okuma 400 L/H Aquário Fonte 110 V</h4>
                    <p>R$ 49,55</p><br>
                    <a href="" class="btn">Adicionar ao carrinho</a>
                </div>
            </div>

            <div class="page-btn">
                <span><a href="produtos.php">1</a></span>
                <span><a href="produtos2.php">2</a></span>
                <span><a href="produtos3.php">3</a></span>
                <span><a href="">...</a></span>
            </div>
        </div>

        <!------------- Footer ------------->

        <?php
            include ('footer.php');
        ?>

        
    </body>
</html>