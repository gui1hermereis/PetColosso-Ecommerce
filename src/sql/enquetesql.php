<?php
	require_once '../sql/conexao.php'; // Chama conexão.
	session_start();

	//Dados recebidos
	$id = $_POST['id'];
	$email = $_SESSION['email'];

	//Realiza a busca dos dados do cliente que esta logado 
	$sql_01 = "SELECT * FROM clientes WHERE cli_email = '$email'";
	$result_01 = $conexao -> query($sql_01);

	while($user_data = mysqli_fetch_assoc($result_01)) {
		$id_voto = $user_data['id_votacao'];
	}

	//Se ja estiver votado nao pode votar novamente
	if ($id_voto == 5) {
		if (isset($id)) {
			if (isset($_COOKIE['voto_cont'])){
				header("Location: ../paginas/enquete.php");
			} else {
				// Computa os votos realizados
				setcookie('voto_cont', $_SERVER['REMOTE_ADDR'], time() + 5);

				//Adiciona no banco de dados os dados que o cliente votou
				$result_enquete = "UPDATE enquete SET qnt_votos = qnt_votos + 1
				WHERE id_votacao ='".$id."'"; 
				$result_enquete = mysqli_query($conexao, $result_enquete);

				$result_votos = "UPDATE enquete SET tot_votos=tot_votos + 1
				WHERE id_votacao "; 
				$result_votos = mysqli_query($conexao, $result_votos);

				if (mysqli_affected_rows($conexao)) {
					//Mensagem voto sucedido
					echo "<script language='javascript'>";
						$_SESSION['erro'] = "<h3> Voto computado com sucesso!!</h3>";
						echo "window.location='../paginas/enquete.php'";
					echo "</script>";
				}
				
				$sql = "update clientes set id_votacao = '$id' where cli_email = '$email'";
				$result = $conexao -> query($sql);
			}
		}
	} else {
		//Mensagem de erro caso o cliente ja tenha votado
		echo "<script language='javascript'>";
			$_SESSION['erro'] = "<h3>Permitido apenas um voto por cliente!!</h3>";
			echo "window.location='../paginas/enquete.php'";
		echo "</script>";
	}

	mysqli_close($conexao); //Fecha conexão com banco de dados
?>