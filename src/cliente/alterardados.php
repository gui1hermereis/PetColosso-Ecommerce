<?php
    require_once '../sql/conexao.php';//Chama conexão
    session_start();

    //Verifica a sessão 
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';
    
    //Verifica se esta logado
    if ($email != '' && $adm >= 0){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não estiver logado   
    }

    $logado = $_SESSION["usuario"];
    
    $nome = $_SESSION["nome"];

    //Realiza a busca dos dados do cliente logado
    $sqlSelect = "SELECT * FROM clientes WHERE id_usuario = '$logado'";
    $result = $conexao->query($sqlSelect);
    while($user_data = mysqli_fetch_assoc($result)) {
        //Dados do cliente
        $nome = $user_data['cli_nome'];
        $email = $user_data['cli_email'];
        $cpf = $user_data['cli_cpf'];
        $celular = $user_data['cli_cel'];
        $email = $user_data['cli_email'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar dados - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); ?>
        <center>        
            <?php
                //Mensagem de sucesso
                if(isset($_SESSION['alterado'])){
                    echo $_SESSION['alterado'];
                    unset($_SESSION['alterado']);
                }
            ?>
        </center>

        <h3 class="title">Dados a alterar</h3>        

        <!--Formulario para alteração de dados-->
        <div class="formulario">
            <form id="update" action="../sql/alterardadossql.php" method="POST" onsubmit="return valida( this )";>
                <center>
                    <p>Usuario:</p>
                    <input type="text" value="<?php echo $logado;?>" disabled><br>
                    <p>Email:</p>
                    <input type="text" value="<?php echo $email;?>" disabled><br>
                    <p>Nome:</p>
                    <input type="text" name="nome" id="nome" required maxlength="255" placeholder="Nome" value="<?php echo $nome;?>"><br>
                    <p>CPF:</p>
                    <input type="text" placeholder = "Não cadastrado" name="cpf" id="cpf" required minlength="11" maxlength="11" value=<?php echo $cpf;?>><br>
                    <p>celular:</p>
                    <input type="text" placeholder = "Não cadastrado" name="cel" id="cel" minlength="11" maxlength="11" required value=<?php echo $celular;?>><br>
                    <p>Senha:</p>
                    <input type="password" name="senha" id="senha" required  minlength="8" placeholder = "Senha"maxlength="45"><br>
                    <input type="hidden" name="usuario" value=<?php echo $logado;?>>
                    <div class="dados">
                        <button type="submit" name="submit" class="btn" title="Enviar">Enviar</button>
                    </div>
                </center>
            </form><br>
        </div>

        <!--Botões de redirecionamento de paginas-->
        <div class="tot">
            <a href="javascript: history.go(-2)" class="btn">Voltar</a>
            <?php if ($adm == 0){?>
            <a href="../cliente/confirmardeletar.php" class = "btn" title="Deletar conta">Deletar conta</a>
            <?php }?>
        </div>

        <!--Footer-->
        <?php include ('../includes/footer.php'); ?>

        <!--Codigo JavaScript-->
        <script language="javascript">
            function valida( frm ){
                var cpf = frm.cpf.value ;
                var cel = frm.cel.value ;
                var senha = frm.senha.value ;
                var msg = "" ;
                
                if ( cpf.search( /\s/g ) != -1 ){
                    msg+= "Não é permitido espaços em branco\n" ;
                    cpf = cpf.replace( /\s/g , "" ) ;
                }	
                if ( cpf.search( /[^a-z0-9]/i ) != -1 ){
                    msg += "Não é permitido caracteres especiais" ;
                    cpf = cpf.replace( /[^a-z0-9]/gi , "" ) ;
                }
                if ( cel.search( /\s/g ) != -1 ){
                    msg+= "Não é permitido espaços em branco\n" ;
                    cel = cel.replace( /\s/g , "" ) ;
                }	
                if ( cel.search( /[^a-z0-9]/i ) != -1 ){
                    msg += "Não é permitido caracteres especiais" ;
                    cel = cel.replace( /[^a-z0-9]/gi , "" ) ;
                }
                if ( senha.search( /\s/g ) != -1 ){
                    msg+= "Não é permitido espaços em branco\n" ;
                    senha = senha.replace( /\s/g , "" ) ;
                }
                if ( msg ){
                    alert( msg ) ;
                    frm.cpf.value = cpf ;
                    frm.cel.value = cel ;
                    frm.senha.value = senha ;
                    return false ;
                }
                return true ;	
            }
        </script>
        
        <?php mysqli_close($conexao); //Fecha conexão com banco de dados ?>
    </body>
</html>