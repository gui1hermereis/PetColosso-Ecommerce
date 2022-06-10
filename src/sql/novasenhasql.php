<?php
	require_once '../sql/conexao.php'; // Chama conexão
    session_start();

    //Dados digitados
    $senha = $_POST['senha'];
    $usuario = $_SESSION['usuario'];

    $senhacripto = password_hash($senha, PASSWORD_DEFAULT);

    //Altera a senha
    $sql = "UPDATE usuarios set user_senha = '$senhacripto' where id_usuario = '$usuario'";
    $result= $conexao->query($sql);

    //Mensagem de senha alterada
    echo "<script language='javascript'>";
        $_SESSION['erro1'] = "<h6>Cadastrado com sucesso</h6>";
        echo "window.location='../paginas/logarcadastrar.php'";
    echo "</script>";

    session_destroy();

    mysqli_close($conexao); //Fecha conexão com banco de dados
?>
