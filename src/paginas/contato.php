<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contato - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        <link rel="stylesheet" type="text/css" href="../../css/carousel.css">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="header">
            <div class="container"><br>
                <!--Tradutor-->
                <?php include ('../includes/tradutor.php'); 
                echo"<div id='google_translate_element' align='right'></div>"?>
                <!--Menu-->
                <?php include ('../includes/menu.php'); ?>
            </div>
        </div>

        <!------------- Contato ------------->
        <div class="pagina-contato">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <img src="../../images/imagem1.png" width="90%">
                    </div>

                    <div class="col-2">
                        <div class="form-container">
                            <div class="form-btn">
                                <span>Fale conosco</span>
                                <hr id="Indicator">
                            </div>
                            <div class="login">
                                <!-- Formulario que manda pro email as mensagens enviadas pelos clientes -->
                                <form id="FaleForm" action="https://api.staticforms.xyz/submit" method="POST">
                                    <input type="hidden" name="accessKey" value="4a58a412-27c8-4aa6-af9c-0a4573296599">
                                    <input type="hidden" name="redirectTo" value="http://localhost/PetColosso/src/paginas/contato.php">

                                    <input type="text" name="name" placeholder="Nome" required>
                                    <input type="email" name="email" placeholder="Email" required maxlength="100">
                                    <input type="telefone" name="phone" placeholder="Telefone" required maxlength="12">
                                    <div class="contato">
                                        <input type="text" name="message" placeholder="Mensagem" required>
                                    </div>
                                    <button type="submit" class="btn">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>

            <!--Pesquisa de satisfação-->
            &nbsp;&nbsp;&nbsp;<a href="../paginas/enquete.php" class="btn">Pesquisa de satisfaçao</a>
        </div>

        <!--Footer-->
        <?php include ('../includes/footer.php'); ?>
    </body>
</html>