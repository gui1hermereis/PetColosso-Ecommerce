<?php
	require_once '../sql/conexao.php'; // Chama conexão
	session_start();

	//Dados recebidos do formulário
	$logado = $_SESSION['usuario'];

	$cep = $_POST['cep'];
	$complemento = $_POST['complemento'];
	$numero = $_POST['numero'];

	//Atualiza no banco de dados os dados recebidos do fomulario
	$sql = "UPDATE `clientes` SET `cli_cep` = '$cep', `cli_numcasa` = '$numero', `cli_compl` = '$complemento' WHERE id_usuario = '$logado'";
	$result = mysqli_query($conexao, $sql); 

	//Mensagem de sucesso
	echo "<script language='javascript'>";
		$_SESSION['sucesso'] = "<h4>Endereço cadastrado/alterado com sucesso.</h4>";
		echo "window.location='../cliente/endereco.php'";
	echo "</script>";

	mysqli_close($conexao); //Fecha a conexão com banco de dados
?>