<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    // Verifica se é administrador
    if ($email != '' && $adm == 1){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se nao for administrador
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>

        <!-- Formulario para o administrador cadastrar novos usuarios -->
        <div class="formulario">
            <form id="update" action="../sql/cadastroadmsql.php" method="POST" onsubmit="return valida( this )";>
                <center>
                <?php
                    //Mensagem de erro
                    if(isset($_SESSION['erro'])){
                        echo $_SESSION['erro'];
                        unset($_SESSION['erro']);
                    }
                ?>

                <h3 class="title">Cadastrar usuário</h3>

                    <input type="text" name="nome" placeholder="Nome" required ><br>
                    <input type="text" name="usuario" placeholder="Usuario" required maxlength="45"><br>
                    <input type="text" name="email" placeholder="Email" required maxlength="100"><br>
                    <input type="password" name="senha" placeholder="Senha" required maxlength="45"><br>
                    <select name="adm" required>
                        <option>Selecione o nivel de acesso:</option>
                        <option value="0">Cliente</option>
                        <option value="1">Administrador</option>
                    </select><br><br>
                <div class="dados">
                    <button type="submit" name="submit" class="btn" title="Cadastrar">Cadastrar</button>
                </div>
                </center>
            </form>
        </div>
        &nbsp;&nbsp;&nbsp;
        <a href="../administrador/administrador.php" class="btn" title="Voltar">Voltar</a>

        <!--Footer-->
        <?php include ('../includes/footer.php'); ?>

        <!--Codigo JavaScript-->
        <script language="javascript">
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

        <?php mysqli_close($conexao); //Fecha conexão com banco de dados ?>
    </body>
</html>