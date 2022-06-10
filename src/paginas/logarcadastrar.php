<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logar/Cadastrar - Pet Colosso</title>
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

        <!------------- Conta ------------->
        <div class="account-page">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <img src="../../images/imagem1.png" width="90%">
                    </div>

                    <div class="col-2">
                        <div class="form-container">
                            <div class="form-btn">
                                <span onclick="login()">Entrar</span>
                                <span onclick="register()">Registrar</span>
                                <hr id="Indicator">
                            </div>

                            <!------------- Faz login dos clientes ------------->
                            <div class="login">
                                <form id="LoginForm" action="../sql/loginsql.php" method="POST">
                                    <input type="text" name="email" placeholder="Email" maxlength="100" required>
                                    <input type="password" name="senha" placeholder="Senha" maxlength="45" required>
                                    <div class="erro">
                                        <?php
                                            //Mensagem de erro caso email ou senha não encontrados
                                            if(isset($_SESSION['erro'])){
                                                echo $_SESSION['erro'];
                                                unset($_SESSION['erro']);
                                            }
                                        ?>
                                    </div>
                                    <button type="submit" name="submit" class="btn">Entrar</button>
                                    <a href="../paginas/recuperarsenha.php">Recuperar Senha</a>

                                    <?php
                                        //Mensagem de erro dados caso ja cadastrados / cadastrado com sucesso
                                        if(isset($_SESSION['erro1'])){
                                            echo $_SESSION['erro1'];
                                            unset($_SESSION['erro1']);
                                        }
                                    ?>
                                </form>

                                <!------------- Cadastra novos clientes ------------->
                                <form id="RegForm" action="../sql/cadastrosql.php" method="POST" onsubmit="return valida( this )";>
                                    <input type="text" name= "nome" placeholder="Nome" maxlength="255" required>
                                    <input type="text" name= "usuario" placeholder="Usuario" required maxlength="45">
                                    <input type="email" name= "email" placeholder="Email" required maxlength="100">
                                    <input type="password" name= "senha" placeholder="Senha" required minlength="8" maxlength="45">
                                    <button type="submit" name="submit" class="btn">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>              

        <!--Codigo JavaScript-->
        <script language="javascript">
            var RegForm = document.getElementById("RegForm");
            var LoginForm = document.getElementById("LoginForm");
            var Indicator = document.getElementById("Indicator");
            
            function login() {
                RegForm.style.transform = "translateX(0px)";
                LoginForm.style.transform = "translateX(0px)";
                Indicator.style.transform = "translateX(0px)";
            }

            function register() {
                RegForm.style.transform = "translateX(-300px)";
                LoginForm.style.transform = "translateX(-300px)";
                Indicator.style.transform = "translateX(100px)";
            }

            function valida( frm ){
                var usuario = frm.usuario.value ;
                var senha = frm.senha.value ;
                var msg = "" ;
                
                if ( usuario.search( /\s/g ) != -1 ){
                    msg+= "Não é permitido espaços em branco\n" ;
                    usuario = usuario.replace( /\s/g , "" ) ;
                }	
                if ( usuario.search( /[^a-z0-9]/i ) != -1 ){
                    msg += "Não é permitido caracteres especiais" ;
                    usuario = usuario.replace( /[^a-z0-9]/gi , "" ) ;
                }
                if ( senha.search( /\s/g ) != -1 ){
                    msg+= "Não é permitido espaços em branco\n" ;
                    senha = senha.replace( /\s/g , "" ) ;
                }
                if ( msg ){
                    alert( msg ) ;
                    frm.usuario.value = usuario ;
                    frm.senha.value = senha ;
                    return false ;
                }
                return true ;	
            }
        </script>
    </body>
</html>