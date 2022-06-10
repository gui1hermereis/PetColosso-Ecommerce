<?php
	require_once '../sql/conexao.php'; // Chama conexão
    session_start();

    //Dados digitados
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];

    //Consulta se os dados digitados estao corretos no banco de dados
    $sql = "SELECT * FROM clientes WHERE cli_email = '$email' and id_usuario = '$usuario' ";
    $result= $conexao->query($sql);

    //Se estiver correto exibe a senha do cliente
    if (mysqli_num_rows($result) > 0){
        //Mensagem mostrando a senha
        $_SESSION['usuario'] = $usuario;
        header("Location: ../paginas/novasenha.php");
    }else{
        //Se estiver correto exibe que nao encontrou o email ou a senha
        if(mysqli_query($conexao, $sql)){ 
            //Mensagem caso email ou senha não cadastrados
            echo "<script language='javascript'>";
                $_SESSION['erro'] = "<h6> Email ou Usuario não encontrados.</h6>";
                echo "window.location='../paginas/recuperarsenha.php'";
            echo "</script>";
        }
    }
    mysqli_close($conexao); //Fecha conexão com banco de dados
?>
