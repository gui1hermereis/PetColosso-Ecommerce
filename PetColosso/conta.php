<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Conta - Pet Colosso</title>
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

        <!------------- Conta ------------->

        <div class="account-page">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <img src="images/imagem1.png" width="90%">
                    </div>

                    <div class="col-2">
                        <div class="form-container">
                            <div class="form-btn">
                                <span onclick="login()">Entrar</span>
                                <span onclick="register()">Registrar</span>
                                <hr id="Indicator">
                            </div>
                            <form id="LoginForm">
                                <input type="text" placeholder="Usuario">
                                <input type="password" placeholder="Senha">
                                <button type="submit" class="btn">Entrar</button>
                                <a href="">Recuperar Senha</a>
                            </form>

                            <form id="RegForm">
                                <input type="text" placeholder="Usuario">
                                <input type="email" placeholder="Email">
                                <input type="password" placeholder="Senha">
                                <button type="submit" class="btn">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!------------- Footer ------------->

        <?php
            include ('footer.php');
        ?>

        <!------------- JS form ------------->

        <script>
            var LoginForm = document.getElementById("LoginForm");
            var RegForm = document.getElementById("RegForm");
            var Indicator = document.getElementById("Indicator");

            function register() {
                RegForm.style.transform = "translateX(0px)";
                LoginForm.style.transform = "translateX(0px)";
                Indicator.style.transform = "translateX(100px)";
            }

            function login() {
                RegForm.style.transform = "translateX(300px)";
                LoginForm.style.transform = "translateX(300px)";
                Indicator.style.transform = "translateX(0px)";
            }
        </script>
    </body>
</html>