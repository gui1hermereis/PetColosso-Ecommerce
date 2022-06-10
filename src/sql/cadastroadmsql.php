<?php
    require_once '../sql/conexao.php'; //Chama a conexão
    session_start();

    //Dados recebidos do formulario
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $adm = $_POST['adm'];
    $id = time();

    //Codigo sql para cadastrar no banco de dados um novo cliente
    $sql1= "select * from clientes where cli_email = '$email'";
    $result= $conexao -> query($sql1);

    $sql2= "select * from usuarios where id_usuario = '$usuario'";
    $result1= $conexao -> query($sql2);

    if (mysqli_num_rows($result1) == 1){

        //Mensagem de erro se nome de usuario ja cadastrado
        echo "<script language='javascript'>";
            $_SESSION['erro'] = "<h5>Nome de usuario ja cadastrado</h5>";
            echo "window.location='../administrador/cadastraradm.php'";
        echo "</script>";

    }else if (mysqli_num_rows($result) == 0){

        $sql_01 = "INSERT INTO usuarios (id_usuario, user_senha, user_tipo, user_status) VALUES ('$usuario', '$senha', '$adm', 'a')";
        $result_01 = $conexao -> query($sql_01);

        $sql_02 = "INSERT INTO clientes (id_cliente, cli_nome, cli_email, id_usuario, id_votacao) VALUES ('$id', '$nome', '$email', '$usuario', 5)";
        $result_02 = $conexao -> query($sql_02);

        //Mensagem se cadastrar com sucesso
        echo "<script language='javascript'>";
            $_SESSION['erro'] = "<h4>Cadastrado com sucesso</h4>";
            echo "window.location='../administrador/cadastraradm.php'";
        echo "</script>";

    }else{ 
        //Mensagem de erro se email ja cadastrado
        echo "<script language='javascript'>";
            $_SESSION['erro'] = "<h5>Email ja cadastrado</h5>";
            echo "window.location='../administrador/cadastraradm.php'";
        echo "</script>";
    }

    mysqli_close($conexao); //Fecha conexão com banco de dados
?>