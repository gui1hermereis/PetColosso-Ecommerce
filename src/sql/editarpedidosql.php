<?php 
    require_once '../sql/conexao.php'; // Chama a conexão.
    session_start();

    //Dados recebidos do formulario
    $id = $_POST['id'];
    $status = $_POST['status'];
    $venda = $_POST['venda'];

    //Realiza a alteraçao do status da entrega
    $sql_01 = "update entregas set entr_status = '$status' where id_entregas = '$id'";
    $result_01 = $conexao -> query($sql_01);

    //Mensagem de sucesso
    echo "<script language='javascript'>";
        $_SESSION['msg'] = "<h5>Status alterado com sucesso<br> ID da venda: ".$venda."</h5><br>";
        echo "window.location='../administrador/pedidosadm.php'";//Redirecionamento
    echo "</script>";

    mysqli_close($conexao); //Fecha conexão com banco de dados
?>