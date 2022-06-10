<?php
	require_once '../sql/conexao.php'; // Chama conexão.
	session_start();
	
	$email = isset($_POST["email"]) ? $_POST["email"]: '0';
	$senha = isset($_POST["senha"]) ? $_POST["senha"]: '0';
	
	if ($email != '0' && $senha != '0') {
		$sql_01 = "select cli_nome, cli_email, id_usuario from clientes where cli_email = '$email'";
		$result_01 = $conexao -> query($sql_01);
		
		//Se existir continua a requisição, se não retorna tela de login novamente.
		if (mysqli_num_rows($result_01) > 0) {
			$row_01 = mysqli_fetch_array($result_01);
			
			$id_usuario = $row_01['id_usuario'];
			$_SESSION['usuario'] = $row_01['id_usuario'];
			$_SESSION['nome'] = $row_01['cli_nome'];
			$_SESSION['email'] = $row_01['cli_email'];
			mysqli_free_result($result_01);
			
			$sql_02 = "select user_senha, user_tipo, user_status from usuarios where user_status = 'a' and id_usuario = '$id_usuario'";
			$result_02 = $conexao -> query($sql_02);
			$row_02 = mysqli_fetch_array($result_02);

		if (mysqli_num_rows($result_02) > 0) {
			if (password_verify($senha, $row_02['user_senha'])){ 

				$_SESSION['senha'] = $row_02['user_senha'];
				$_SESSION['adm'] = $row_02['user_tipo'];
				$row_02['user_status'];
				mysqli_free_result($result_02);
				
				if ($row_02['user_tipo'] == 0) {
					//Se for cliente vai pra tela de cliente.
					header("Location: ../cliente/conta.php");
				} else {
					//Se for adminstrador vai pra tela de adm.
					if ($row_02['user_tipo'] == 1) {
						header("Location: ../administrador/contaadm.php");
					}
				}	
			}else{

				if(mysqli_query($conexao, $sql_02)){ 

					//Mensagem de erro 
					echo "<script language='javascript'>";
						$_SESSION['erro'] = "<h6>Email ou senha não encontrados!!</h6>";
						echo "window.location='../paginas/logarcadastrar.php'";
					echo "</script>";
				}
			}
		}
		} else {
			//Mensagem de erro 
			echo "<script language='javascript'>";
				$_SESSION['erro'] = "<h6>Email ou senha não encontrados!!</h6>";
				echo "window.location='../paginas/logarcadastrar.php'";
			echo "</script>";
		}

	} else { // Não acessa
		header('location: ../paginas/logarcadastrar.php');
	}

	mysqli_close($conexao); //Fecha conexão com banco de dados
?>
