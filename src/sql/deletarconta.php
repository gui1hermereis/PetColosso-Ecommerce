<?php
    require_once '../sql/conexao.php'; //Chama conexão
    session_start();

    //Verifica a sessão
    $email = isset($_SESSION["email"]) ? $_SESSION["email"]: '';
    $adm = isset($_SESSION['adm']) ? $_SESSION['adm']: '';

    //Verifica se é cliente
    if ($email != '' && $adm == 0){  
    } else {
        header("Location: ../paginas/index.php"); //Redirecionamento se não for cliente  
    }

    $logado = $_SESSION['usuario'];

    //Consulta os dados do usuario logado
    $sql = "SELECT * FROM clientes where id_usuario = '$logado' ";
    $result = $conexao -> query($sql);

    //Atualiza o status da conta de a(ativo) para i(inativo)
    $sql1 = "update usuarios set user_status = 'i' where id_usuario = '$logado'";
    $result1 = $conexao -> query($sql1);

    //Mensagem confirmando a exclusão da conta
    echo "<script language='javascript'>";
        echo "alert('Conta excluida com sucesso!!');";
        echo "window.location='../paginas/logarcadastrar.php'";
    echo "</script>";

    session_destroy (); //Destroi a sessão
    mysqli_close($conexao); //Fecha conexão com banco de dados
?>