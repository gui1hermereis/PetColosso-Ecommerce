<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nova senha - Pet Colosso</title>
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
                                <span>Nova Senha</span>
                                <hr id="Indicator">
                            </div><br><br>
                            <h6>Insira sua nova senha.</h6>
                            <div class="login">
                                <form id="RecupForm" action="../sql/novasenhasql.php" method="POST" onsubmit="return valida( this )";>
                                    <br><br><input type="password" name="senha" placeholder="Nova senha" required maxlength="100">
                                    <button type="submit" class="btn">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            &nbsp;&nbsp;&nbsp;<a href="../paginas/logarcadastrar.php" class="btn">Voltar</a>
        </div>

        <script>
            function valida( frm ){
                var senha = frm.senha.value ;
                var msg = "" ;
                
                if ( senha.search( /\s/g ) != -1 ){
                    msg+= "Não é permitido espaços em branco\n" ;
                    senha = senha.replace( /\s/g , "" ) ;
                }
                if ( msg ){
                    alert( msg ) ;
                    frm.senha.value = senha ;
                    return false ;
                }
                return true ;	
            }
        </script>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>     
    </body>
</html>