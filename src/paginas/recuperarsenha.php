<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recuperar senha - Pet Colosso</title>
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
                                <span>Recuperar senha</span>
                                <hr id="Indicator">
                            </div>
                            <div class="login">
                                <form id="RecupForm" action="../sql/recuperarsenhasql.php" method="POST">
                                    <h6>Insira o seu usuario e email cadastrado em sua conta para prosseguir com a recuperação da senha.</h6><br>
                                    <input type="text" name="usuario" placeholder="Usuario" required maxlength="100">
                                    <input type="email" name="email" placeholder="Email" required maxlength="100">
                                    <div class="erro">
                                        <?php
                                            if(isset($_SESSION['erro'])){
                                                echo $_SESSION['erro'];
                                                unset($_SESSION['erro']);
                                            }
                                        ?>
                                    </div>
                                    <button type="submit" class="btn">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            &nbsp;&nbsp;&nbsp;<a href="../paginas/logarcadastrar.php" class="btn">Voltar</a>
        </div>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>     
    </body>
</html>