<?php 
    require_once '../sql/conexao.php'; // Chama a conexão.
    session_start();

    //Dados recebidos do formulario
    $usuario = $_POST['usuario'];
    $nivel = $_POST['nivel'];
    $status = $_POST['status'];

    //Realiza a alteraçao do nivel de acesso
    $sql_01 = "update usuarios set user_tipo = '$nivel', user_status = '$status' where id_usuario = '$usuario'";
    $result_01 = $conexao -> query($sql_01);

    //Mensagem de sucesso
    echo "<script language='javascript'>";
		$_SESSION['sucesso'] = "<h4>Alterado com sucesso</h4>";
		echo "window.location='../administrador/administrador.php'";//Redirecionamento
	echo "</script><br>";

    mysqli_close($conexao); //Fecha conexão com banco de dados
?>

