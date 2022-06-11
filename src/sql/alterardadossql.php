<?php
	require_once '../sql/conexao.php'; // Chama a conexão
	session_start();

	//Dados recebidos do formulario
	$logado = $_SESSION['usuario'];//Usuario logado
	$nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$celular = $_POST['cel'];
	$senha = $_POST['senha'];

    $senhacripto = password_hash($senha, PASSWORD_DEFAULT);

	$sql_01 = "update usuarios set user_senha = '$senhacripto' where id_usuario = '$logado'";
	$result_01 = $conexao -> query($sql_01);
	
	$sql_02 = "update clientes set cli_nome = '$nome', cli_cpf = $cpf, cli_cel = $celular where id_usuario = '$logado'";
	$result_02 = $conexao -> query($sql_02);
	
	echo "<script language='javascript'>";
		$_SESSION['alterado'] = "<h4>Dados alterados com sucesso.</h4>";
		echo "window.location='../cliente/alterardados.php'";
	echo "</script>";

	mysqli_close($conexao); //Fecha conexão com banco de dados
?>
