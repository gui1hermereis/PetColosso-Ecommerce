<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();

    //Verifica sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é administrador
    if ($email != '' && $adm == 1){  
    } else {
        header("Location: ../paginas/index.php");//Redirecionamento se não for administrador  
    }

    //Realiza a busca dos dados do cliente cadastrado
    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM clientes WHERE id_cliente=$id";
        $result = $conexao->query($sqlSelect);
        while($user_data = mysqli_fetch_assoc($result)){//Dados do cliente
            $nome = $user_data['cli_nome'];
            $usuario = $user_data['id_usuario'];
            $email = $user_data['cli_email'];
            $cpf = $user_data['cli_cpf'];
            $celular = $user_data['cli_cel'];
            $cep = $user_data['cli_cep'];
            $numero = $user_data['cli_numcasa'];
            $complemento = $user_data['cli_compl'];

            $sql1 = "SELECT * FROM usuarios where id_usuario = '$usuario'";
            $result1 = $conexao->query($sql1);
            $row_venda = mysqli_fetch_array($result1);

            $tipo = $row_venda['user_tipo'];
            $status = $row_venda['user_status'];
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar dados - Pet Colosso</title>
        <link rel="stylesheet" type="text/css" href="../../css/padrao.css">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Tradutor-->
        <?php include ('../includes/tradutor.php'); ?>
        <!--Menu-->
        <?php include ('../includes/menu.php'); 
        
            //Mensagem de sucesso
            if(isset($_SESSION['sucesso'])){
                echo $_SESSION['sucesso'];
                unset($_SESSION['sucesso']);
            }
        ?>
        <!--Dados do cliente-->
        <center>
        <div class="formulario">

            <h3 class="title">Meus dados</h3>
            <p>Nome: </p>
            <input type="text" readonly  value="<?php echo $nome?>"><br>
            <p>Usuário: </p>
            <input type="text" readonly  value="<?php echo $usuario?>"><br>
            <p>Email: </p>
            <input type="text" readonly  value="<?php echo $email?>"><br>
            <p>CPF: </p>
                <input type="text" readonly placeholder="Não cadastrado" value="<?php echo $cpf ?>"><br>
            <p>Celular: </p>
                <input type="text" readonly placeholder="Não cadastrado" value="<?php echo $celular ?>"><br>
            <p>Status:</p>
            <?php 
            if ($tipo == 0){
                    echo "<input type='text' readonly  value='Cliente'>";
                }else{ 
                    echo "<input type='text' readonly  value='Administrador'>";
                }
            ?><br>

            <p>Nivel de acesso:</p>
            <?php 
               if ($status == 'a'){
                    echo "<input type='text' readonly  value='Ativo'>";
                }else{ 
                    echo "<input type='text' readonly  value='Inativo'>";
                }
            ?><br><br>

            <!--Dados do cliente a ser alterados-->
            <h3 class="title">Alterar nivel de acesso ou status da conta</h3>
            <div class="formulario">
                <form id="update" action="../sql/editardadosadm.php" method="POST">
                    <p>Alterar nivel de acesso:</p>

                    <select name="nivel" id="nivel" >
                        <option value="<?php echo $tipo;?>" selected >Selecione...</option>
                        <option value="0">Cliente</option>
                        <option value="1">Administrador</option>
                    </select><br><br>
                
                    <p>Alterar status da conta:</p>
                    <select name="status" id="status" >
                        <option value="<?php echo $status;?>" selected >Selecione...</option>
                        <option value="a">Ativo</option>
                        <option value="i">Inativo</option>
                    </select><br><br>
                    <input type="hidden" name="usuario" value=<?php echo $usuario;?>>
                    <button type="submit" name="submit" class="btn" title="Alterar">Alterar</button>
                </form><br>
            </div>
        </center>

        &nbsp;&nbsp;&nbsp;
        <a href="../administrador/administrador.php" class="btn">Voltar</a>

        <!--Footer-->    
        <?php include ('../includes/footer.php'); ?>   
        
        <?php mysqli_close($conexao);//Fecha a conexão com o banco de dados ?>
    </body>
</html>